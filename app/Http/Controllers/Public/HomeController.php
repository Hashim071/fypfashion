<?php

namespace App\Http\Controllers\Public;

use App\Models\Blog;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Customization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // In app/Http/Controllers/HomeController.php

    public function index()
    {
        // ... aapka pehle ka code (categories, latestProducts, etc.) yahan rahega ...
        $categories = Category::all();
        $latestProducts = Product::where('status', 'active')->latest()->take(4)->get();
        $customizableProducts = Product::where('is_customizable', true)->latest()->take(10)->get();

        $topSellingProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(12)
            ->get();

        $onSaleProducts = Product::where('status', 'active')
            ->whereColumn('retail_price', '<', 'actual_price')
            ->latest()
            ->take(12)
            ->get();

        $topRatedProducts = Product::where('status', 'active')->inRandomOrder()->take(12)->get();

        $allSectionProducts = $topSellingProducts->merge($onSaleProducts)->merge($topRatedProducts)->unique('id');


        return view('public.public', compact(
            'categories',
            'latestProducts',
            'customizableProducts',
            'allSectionProducts',
            'topSellingProducts',
            'onSaleProducts',
            'topRatedProducts'
        ));
    }

    public function showCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        return view('public.categories_details', compact('category', 'products'));
    }

    public function showproduct($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('public.product_details', compact('product'));
    }

    public function placeorder(Request $request, Product $product)
    {
        if ($request->isMethod('get')) {
            session()->forget('_old_input');
            $quantity = $request->input('quantity', 1);
            $customizations = $request->input('custom', []);
            return view('public.place_order', compact('product', 'quantity', 'customizations'));
        }

        if ($request->isMethod('post')) {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'product_id' => 'required|exists:products,id',
                'payment_method' => 'required|in:cod,payfast',
                'quantity' => 'required|integer|min:1',
                'custom' => 'nullable|array',
                'reference_image' => 'nullable|image|max:2048',
            ]);

            // Get or create user
            $user = User::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name'     => $validated['name'],
                    'address'  => $validated['address'],
                    'phone'    => $validated['phone'],
                    'password' => bcrypt(Str::random(10)),
                ]
            );

            // Create the order
            $order = Order::create([
                'user_id'          => $user->id,
                'delivery_address' => $validated['address'],
                'total'            => $product->retail_price * (int)$validated['quantity'],
                'status'           => 'pending',
                'payment_status'   => 'unpaid',
                'payment_method'   => $validated['payment_method'],
            ]);

            // Create order items
            $orderItem = $order->items()->create([
                'product_id' => $product->id,
                'quantity'   => (int)$validated['quantity'],
                'price'      => $product->retail_price,
                'subtotal'   => $product->retail_price * (int)$validated['quantity'],
            ]);

            // ✅ CUSTOMIZATION SAVE KARNE KA CODE
            if (isset($validated['custom']) && !empty($validated['custom'])) {
                $customData = $validated['custom'] ?? [];

                // Agar reference image upload hui hai
                if ($request->hasFile('reference_image')) {
                    $path = $request->file('reference_image')->store('order_references', 'public');
                    $customData['reference_image_url'] = $path; // Add the path to our data array
                }

                // If there's any customization data (text or image), save it
                if (!empty($customData)) {
                    $orderItem->customization()->create([
                        'size'                => $customData['size'] ?? null,
                        'fabric'              => $customData['fabric'] ?? null,
                        'color'               => $customData['color'] ?? null,
                        'style_description'   => $customData['style_description'] ?? null,
                        'reference_image_url' => $customData['reference_image_url'] ?? null,
                        'delivery_date'       => $customData['delivery_date'] ?? null,
                    ]);
                };
            }

            // Save guest order ID in session for authorization on the next page
            session(['guest_order_id' => $order->id]);

            // Redirect based on payment method
            if ($validated['payment_method'] === 'payfast') {
                return redirect()->route('payfast.pay', ['orderId' => $order->id]);
            }

            return redirect()->route('order.receipt', ['order' => $order->id])
                ->with('success', 'Order placed successfully!');
        }

        return abort(405);
    }
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int)$request->input('quantity', 1);
        $customizations = $request->input('custom', []);

        // Reference image ko handle karein agar hai to
        if ($request->hasFile('custom.reference_image')) {
            $path = $request->file('custom.reference_image')->store('custom_references', 'public');
            $customizations['reference_image_url'] = $path;
        }

        // Ek unique ID banayein product ID aur customization ke combination se
        // Sort karne se order ka farq nahi parta (e.g., color, size vs size, color)
        ksort($customizations);
        $cartItemId = $id . '_' . md5(json_encode($customizations));

        $cart = session()->get('cart', []);

        if (isset($cart[$cartItemId])) {
            // Agar same product with same customizations pehle se hai, to sirf quantity barhayein
            $cart[$cartItemId]['quantity'] += $quantity;
        } else {
            // Warna naya item add karein
            $cart[$cartItemId] = [
                'id'             => $product->id,
                'name'           => $product->name,
                'price'          => $product->retail_price,
                'image'          => $product->image ?? 'default.jpg',
                'quantity'       => $quantity,
                'stock'          => $product->quantity ?? 0,
                'customizations' => $customizations, // ✅ Customization data save karein
                'cart_item_id'   => $cartItemId // ✅ Unique ID save karein
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Product added to cart!');
    }

    public function showCheckout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        // Yahan aap total calculate kar ke view ko pass kar sakte hain
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('public.checkout_page', compact('cart', 'total')); // Aapko ek alag checkout_page.blade.php banani hogi
    }

    public function showCart()
    {
        $cart = session('cart', []);
        return view('public.cart', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared successfully.');
    }

    public function showReceipt(Order $order)
    {
        $isOwner = Auth::check() && Auth::id() === $order->user_id;

        $isGuestWithSession = Auth::guest() && session('guest_order_id') === $order->id;
        if ($isGuestWithSession) {
            session()->forget('guest_order_id');
        }

        $order->load('items.product');
        return view('public.order_receipt', compact('order'));
    }
    public function contact()
    {
        return view('public.contact');
    }

    public function storeContact(Request $request)
    {
        // Step 1: Validation
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email'        => 'required|email|max:255',
            'message'      => 'required|string',
        ]);

        // Step 2: Database me data save karein
        Contact::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'message'      => $request->message,
        ]);

        // Step 3: Success message ke sath wapis redirect karein
        return redirect()->back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }

    // Controller Code
    public function blog()
    {
        $blogs = Blog::whereNotNull('published_at')
            ->with('user') // ✅ 'user' relationship ko Eager Load karein (Bohat Zaroori)
            ->latest('published_at')
            ->paginate(6);

        return view('public.blog', compact('blogs'));
    }

    public function blogDetails(Blog $blog)
    {
        // Yeh function bilkul theek hai
        return view('public.blog_details', compact('blog'));
    }

    public function customizable()
    {
        // Sirf woh products fetch karein jinka 'is_customizable' status true hai.
        // latest() se naye product pehle aayenge aur take(10) se sirf 10 products show honge.
        $customizableProducts = Product::where('is_customizable', true)->latest()->take(10)->get();

        // Products ko home view me pass karein.
        // Agar aapki blade file ka naam kuch aur hai to 'home' ki jagah woh naam likhein.
        return view('public.public', compact('customizableProducts'));
    }
}

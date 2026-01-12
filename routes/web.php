<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayfastController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Cart\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Customer\AllReturnController;
use App\Http\Controllers\Admin\Return\ReturnController;
use App\Http\Controllers\Admin\Review\ReviewController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerReviewController;
use App\Http\Controllers\Customer\CustomerSettingController;
use App\Http\Controllers\Customer\AllCustomizationController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Admin\Transaction\TransactionController;
use App\Http\Controllers\Admin\Customization\CustomizationController;



Route::get('/', [HomeController::class, 'index'])->name('public.home');



// Login routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
// Register routes
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/category/{category}', [HomeController::class, 'showCategory'])->name('category.show');
Route::get('/product/{id}', [HomeController::class, 'showproduct'])->name('public.product.details');



// CART ROUTES
Route::get('/public/cart', [HomeController::class, 'showCart'])->name('cart.show');
Route::post('/add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('cart.add');
Route::get('/remove-from-cart/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/clear-cart', [HomeController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
// routes/web.php
Route::get('/checkout', [HomeController::class, 'showCheckout'])->name('checkout.index');


// GET: Show the form
Route::get('/place-order/{product}', [HomeController::class, 'placeorder'])->name('public.place_order');
Route::post('/place-order/{product}', [HomeController::class, 'placeorder'])->name('public.place_order.submit');
Route::get('/order/receipt/{order}', [HomeController::class, 'showReceipt'])->name('order.receipt');


// Form submit karne ke liye naya POST route
Route::post('/order/store', [HomeController::class, 'storeOrder'])->name('order.store');
// Checkout
Route::get('/contact', [HomeController::class, 'contact'])->name('public.contact');
Route::get('/blog', [HomeController::class, 'blog'])->name('public.blog');
Route::get('/blog/{blog:slug}', [HomeController::class, 'blogDetails'])->name('public.blog.details');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');

Route::get('/customizable', [HomeController::class, 'customizable'])->name('public.customizble');
Route::get('/search', [HomeController::class, 'search'])->name('public.search');
// All Products (Shop) Page
Route::get('/all-products', [HomeController::class, 'allProducts'])->name('public.all_products');

// PayFast
Route::get('/pay/{orderId}', [PayfastController::class, 'initiatePayment'])->name('payfast.pay');
Route::get('/payment/success', [PayfastController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PayfastController::class, 'paymentFailure'])->name('payment.failure');


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');


// Admin routes
Route::middleware(['role:admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('products/update/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    // Cart Management
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


    // Orders Management
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::put('/orders/{id}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus'); // ✅ New route
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{id}/invoice', [OrderController::class, 'generateInvoice'])->name('orders.invoice');
    Route::put('/orders/{id}/update-payment', [OrderController::class, 'updatePaymentStatus'])
        ->name('orders.updatePaymentStatus');



    // Customization Management
    Route::get('/customizations', [CustomizationController::class, 'index'])->name('customizations.index');
    Route::post('/customizations', [CustomizationController::class, 'store'])->name('customizations.store');
    Route::put('/customizations/{id}', [CustomizationController::class, 'update'])->name('customizations.update');
    Route::delete('/customizations/{id}', [CustomizationController::class, 'destroy'])->name('customizations.destroy');


    // Reviews Management
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Returns Management
    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');
    Route::put('/returns/{id}', [ReturnController::class, 'update'])->name('returns.update');
    Route::put('/returns/{id}/status', [ReturnController::class, 'updateStatus'])->name('returns.updateStatus');
    Route::delete('/returns/{id}', [ReturnController::class, 'destroy'])->name('returns.destroy');


    // Users Routes
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


    // Transactions Management
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

    Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/admin/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');


    Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');

    Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('/admin/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

// Customer routes
Route::middleware('role:customer')->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');


    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/customer/orders/{id}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');
    Route::get('/customer/orders/{id}/invoice', [CustomerOrderController::class, 'generateInvoice'])->name('customer.orders.invoice');


    Route::post('/customer/reviews', [CustomerReviewController::class, 'store'])->name('customer.reviews.store');


    Route::get('/customer/my-customizations', [AllCustomizationController::class, 'index'])
        ->name('customer.customizations.index');


    Route::get('/customer/my-returns', [AllReturnController::class, 'index'])->name('customer.returns.index');
    Route::post('/customer/my-returns', [AllReturnController::class, 'store'])->name('customer.returns.store');


    Route::get('/customer/settings', [CustomerSettingController::class, 'index'])->name('customer.settings.index');
    Route::put('/customer/settings/update', [CustomerSettingController::class, 'update'])->name('customer.settings.update');
});

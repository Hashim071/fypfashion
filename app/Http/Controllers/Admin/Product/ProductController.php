<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // ✅ added
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.product.all_products', compact('products', 'categories'));
    }
    public function store(Request $request)
    {
        // ✅ Validation updated for customization fields
        $validatedData = $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'retail_price' => 'required|numeric|min:0',
            'actual_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'action' => 'required|in:available,out_of_stock',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_customizable' => 'required|boolean',
            // Customization rules: required if is_customizable is true
            'customization_fields' => 'nullable|array|required_if:is_customizable,1',
            'customization_fields.*.name' => 'required_with:customization_fields|string',
            'customization_fields.*.label' => 'required_with:customization_fields|string',
            'customization_fields.*.type' => 'required_with:customization_fields|in:select,text,textarea,file',
            'customization_fields.*.options' => 'nullable|string|required_if:customization_fields.*.type,select',
        ]);

        // ✅ Data preparation updated
        $data = $request->except(['_token', 'image', 'customization_fields']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // ✅ Process and add customization_fields to data
        if ($request->boolean('is_customizable') && !empty($validatedData['customization_fields'])) {
            $processedFields = [];
            foreach ($validatedData['customization_fields'] as $field) {
                if ($field['type'] === 'select' && !empty($field['options'])) {
                    // Convert comma-separated options into an array
                    $field['options'] = array_filter(array_map('trim', explode(',', $field['options'])));
                } else {
                    $field['options'] = []; // Ensure options is an empty array if not a select
                }
                $processedFields[] = $field;
            }
            $data['customization_fields'] = $processedFields;
        } else {
            // Ensure the field is null if the product is not customizable
            $data['customization_fields'] = null;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function update(Request $request, Product $product)
    {
        // ✅ Validation updated for customization fields
        $validatedData = $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'retail_price' => 'required|numeric|min:0',
            'actual_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'action' => 'required|in:available,out_of_stock',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_customizable' => 'required|boolean',
            // Customization rules
            'customization_fields' => 'nullable|array|required_if:is_customizable,1',
            'customization_fields.*.name' => 'required_with:customization_fields|string',
            'customization_fields.*.label' => 'required_with:customization_fields|string',
            'customization_fields.*.type' => 'required_with:customization_fields|in:select,text,textarea,file',
            'customization_fields.*.options' => 'nullable|string|required_if:customization_fields.*.type,select',
        ]);

        // ✅ Data preparation updated
        $data = $request->except(['_token', '_method', 'image', 'customization_fields']);

        // Replace old image if new one is uploaded
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // ✅ Process and add customization_fields to data for update
        if ($request->boolean('is_customizable') && !empty($validatedData['customization_fields'])) {
            $processedFields = [];
            foreach ($validatedData['customization_fields'] as $field) {
                if ($field['type'] === 'select' && !empty($field['options'])) {
                    // Convert comma-separated options into an array
                    $field['options'] = array_filter(array_map('trim', explode(',', $field['options'])));
                } else {
                    $field['options'] = [];
                }
                $processedFields[] = $field;
            }
            $data['customization_fields'] = $processedFields;
        } else {
            $data['customization_fields'] = null;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        // ✅ Delete image from storage if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

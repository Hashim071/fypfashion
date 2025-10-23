<?php

namespace App\Http\Controllers\Admin\Customization;

use App\Http\Controllers\Controller;
use App\Models\Customization;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // ✅ 1. Import the Rule class

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::with(['orderItem.product', 'orderItem.order.user'])
            ->latest()
            ->paginate(10);

        return view('admin.customization.all_customization', compact('customizations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_item_id'       => 'required|exists:order_items,id',
            // ✅ 2. Update the size validation rule
            'size'                => ['nullable', Rule::in(['small', 'medium', 'large', 'extra-large'])],
            'fabric'              => 'nullable|string|max:100',
            'color'               => 'nullable|string|max:50',
            'style_description'   => 'nullable|string',
            'delivery_date'       => 'nullable|date',
            'reference_image_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('reference_image_url')) {
            $validated['reference_image_url'] = $request->file('reference_image_url')
                ->store('uploads/customizations', 'public');
        }

        Customization::create($validated);

        return redirect()
            ->route('customizations.index')
            ->with('success', '✅ Customization added successfully.');
    }

    public function update(Request $request, $id)
    {
        $customization = Customization::findOrFail($id);

        $validated = $request->validate([
            // ✅ 3. Update the size validation rule here as well
            'size'                => ['nullable', Rule::in(['small', 'medium', 'large', 'extra-large'])],
            'fabric'              => 'nullable|string|max:100',
            'color'               => 'nullable|string|max:50',
            'style_description'   => 'nullable|string',
            'delivery_date'       => 'nullable|date',
            'reference_image_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // If new image uploaded → delete old one & save new
        if ($request->hasFile('reference_image_url')) {
            if ($customization->reference_image_url && Storage::disk('public')->exists($customization->reference_image_url)) {
                Storage::disk('public')->delete($customization->reference_image_url);
            }

            $validated['reference_image_url'] = $request->file('reference_image_url')
                ->store('uploads/customizations', 'public');
        }

        $customization->update($validated);

        return redirect()
            ->route('customizations.index')
            ->with('success', '✅ Customization updated successfully.');
    }

    public function destroy($id)
    {
        $customization = Customization::findOrFail($id);
        if ($customization->reference_image_url && Storage::disk('public')->exists($customization->reference_image_url)) {
            Storage::disk('public')->delete($customization->reference_image_url);
        }

        $customization->delete();

        return redirect()
            ->route('customizations.index')
            ->with('success', '🗑️ Customization deleted successfully.');
    }
}

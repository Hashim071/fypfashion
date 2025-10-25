@extends('layouts.public_layout')

@section('content')
    <main>
        {{-- Breadcrumb waghera --}}
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Product Details</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <a href="">{{ $product->category->name }}</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">{{ $product->name }}</span>
                </div>
            </div>
        </div>

        <div class="ul-inner-page-container">
            <div class="container my-5">
                <div class="row">

                    {{-- LEFT: Product Images --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            @php
                                // Main product image ke liye URL decide karein
                                $mainImageUrl = Str::startsWith($product->image, 'admin/')
                                    ? asset($product->image)
                                    : asset('storage/' . $product->image);
                            @endphp
                            <img src="{{ $mainImageUrl }}" alt="{{ $product->name }}" class="img-fluid w-100 rounded border"
                                id="main-product-image">
                        </div>

                        {{-- Pehle check karein ke gallery images hain ya nahi --}}
                        @if (isset($product->galleryImages) && $product->galleryImages->count() > 0)
                            <div class="d-flex flex-wrap gap-2">
                                {{-- Pehla thumbnail main image ka hoga --}}
                                <img src="{{ $mainImageUrl }}" data-full-image-url="{{ $mainImageUrl }}" alt="Thumbnail 1"
                                    class="product-thumbnail active rounded border">

                                {{-- Baaqi thumbnails gallery se aayenge --}}
                                @foreach ($product->galleryImages as $galleryImage)
                                    @php
                                        // Har gallery image ke liye URL decide karein
                                        $galleryImageUrl = Str::startsWith($galleryImage->path, 'admin/')
                                            ? asset($galleryImage->path)
                                            : asset('storage/' . $galleryImage->path);
                                    @endphp
                                    <img src="{{ $galleryImageUrl }}" data-full-image-url="{{ $galleryImageUrl }}"
                                        alt="Thumbnail for {{ $product->name }}" class="product-thumbnail rounded border">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- RIGHT: Product Details --}}
                    <div class="col-md-6">
                        <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
                        <p class="text-muted">{{ $product->category->name ?? 'Uncategorized' }}</p>

                        {{-- Pricing --}}
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <h3 class="text-danger fw-bold" id="total-price">
                                Rs.{{ number_format($product->retail_price, 2) }}
                            </h3>
                            {{-- Discount waghera --}}
                        </div>

                        {{-- Stock --}}
                        @if ($product->quantity > 0)
                            <p class="text-success fw-bold">In Stock ({{ $product->quantity }} available)</p>
                        @else
                            <p class="text-danger fw-bold">Out of Stock</p>
                        @endif

                        <p class="mt-3">{{ $product->description ?? 'No description available.' }}</p>

                        <form id="product-form" action="{{ route('cart.add', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- Quantity Selector --}}
                            <div class="d-flex align-items-center mb-3">
                                <label for="quantity-input" class="me-3 fw-semibold">Quantity:</label>
                                <div class="input-group" style="width:130px;">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="this.parentNode.querySelector('input').stepDown(); this.parentNode.querySelector('input').dispatchEvent(new Event('input'))">−</button>
                                    <input type="number" id="quantity-input" name="quantity" value="1" min="1"
                                        max="{{ $product->quantity }}" class="form-control text-center">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="this.parentNode.querySelector('input').stepUp(); this.parentNode.querySelector('input').dispatchEvent(new Event('input'))">+</button>
                                </div>
                            </div>

                            {{-- Hidden fields for customization data will be added here by JS --}}
                            <div id="customization-hidden-fields"></div>

                            {{-- Buttons --}}
                            <div class="d-flex gap-3">
                                @if ($product->is_customizable)
                                    <button type="button" class="btn btn-info px-4" data-bs-toggle="modal"
                                        data-bs-target="#customizationModal">
                                        Customize
                                    </button>
                                @endif
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="flaticon-shopping-bag"></i> Add to Cart
                                </button>
                                {{-- Initial Link --}}
                                <button type="button" id="buy-now-btn" class="btn btn-dark px-4">
                                    Buy it Now
                                </button>
                            </div>
                        </form>

                        {{-- ✅ CUSTOMIZATION MODAL (POPUP) --}}
                        @if ($product->is_customizable)
                            <div class="modal fade" id="customizationModal" tabindex="-1"
                                aria-labelledby="customizationModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="customizationModalLabel">Customize Your Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- Yeh form sirf data collect karega, submit nahi hoga --}}
                                            <div id="custom-form-fields">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="custom_size" class="form-label">Size</label>
                                                        <select name="custom[size]" id="custom_size" class="form-select">
                                                            <option value="">Select Size</option>
                                                            <option value="small">Small</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="large">Large</option>
                                                            <option value="extra-large">Extra Large</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="custom_color" class="form-label">Color</label>
                                                        <input type="text" name="custom[color]" id="custom_color"
                                                            class="form-control" placeholder="e.g., Red, Blue">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="custom_fabric" class="form-label">Fabric</label>
                                                        <input type="text" name="custom[fabric]" id="custom_fabric"
                                                            class="form-control" placeholder="e.g., Cotton, Silk">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="custom_delivery_date" class="form-label">Desired
                                                            Delivery Date</label>
                                                        <input type="date" name="custom[delivery_date]"
                                                            id="custom_delivery_date" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="custom_style_description" class="form-label">Style
                                                            Description</label>
                                                        <textarea name="custom[style_description]" id="custom_style_description" class="form-control" rows="3"
                                                            placeholder="Any specific instructions or changes..."></textarea>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="custom_reference_image" class="form-label">Reference
                                                            Image (Optional)</label>
                                                        <input type="file" name="custom[reference_image]"
                                                            id="custom_reference_image" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="save-customizations-btn"
                                                data-bs-dismiss="modal">Save Customizations</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Elements ko haasil karein
            const productForm = document.getElementById('product-form');
            const quantityInput = document.getElementById('quantity-input');
            const priceElement = document.getElementById('total-price');
            const buyNowBtn = document.getElementById('buy-now-btn');
            const saveCustomBtn = document.getElementById('save-customizations-btn');
            const hiddenFieldsContainer = document.getElementById('customization-hidden-fields');

            // Check karein ke zaroori elements mojood hain
            if (!productForm || !quantityInput || !priceElement || !buyNowBtn) {
                console.error("A required element for the product form is missing.");
                return;
            }

            const basePrice = parseFloat("{{ $product->retail_price }}");

            // --- Function to update the displayed price ---
            function updatePrice() {
                const quantity = parseInt(quantityInput.value) || 1;
                const totalPrice = basePrice * quantity;
                priceElement.innerText = 'Rs. ' + totalPrice.toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // --- ✅ NAYA LOGIC: Jab modal ka "Save Customizations" button click ho ---
            if (saveCustomBtn) {
                saveCustomBtn.addEventListener('click', function() {
                    // Purane hidden fields ko saaf karein
                    hiddenFieldsContainer.innerHTML = '';

                    // Modal ke andar se saare form elements haasil karein
                    const customFields = document.querySelectorAll('#custom-form-fields [name^="custom["]');

                    // Har field ke liye main form mein aik hidden input banayein
                    customFields.forEach(field => {
                        // Image field ko skip karein, usko alag se handle karenge
                        if (field.type === 'file') return;

                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = field.name;
                        hiddenInput.value = field.value;
                        hiddenFieldsContainer.appendChild(hiddenInput);
                    });

                    // Image file ko handle karein
                    const imageInput = document.getElementById('custom_reference_image');
                    if (imageInput && imageInput.files.length > 0) {
                        // Aik naya hidden input banayein jo image ka naam rakhega (optional, for display)
                        const imageNameInput = document.createElement('input');
                        imageNameInput.type = 'hidden';
                        imageNameInput.name = 'custom[reference_image_name]'; // temporary name
                        imageNameInput.value = imageInput.files[0].name;
                        hiddenFieldsContainer.appendChild(imageNameInput);
                    }

                    // User ko batayein ke customizations save ho gayi hain
                    alert('Customizations have been saved! You can now "Add to Cart" or "Buy it Now".');
                });
            }

            // --- ✅ UPDATED LOGIC: Jab "Buy it Now" button click ho ---
            buyNowBtn.addEventListener('click', function(e) {
                e.preventDefault(); // Default action ko rokein

                // Image file input ko modal se main form mein move karein
                const imageInput = document.getElementById('custom_reference_image');
                if (imageInput && imageInput.files.length > 0) {
                    // form ke andar append karein taake submit ho
                    productForm.appendChild(imageInput);
                }

                // Form ka action aur method badal kar checkout page par bhejein
                productForm.action = "{{ route('public.place_order', $product->id) }}";
                productForm.method = 'GET';
                productForm.submit();
            });

            // Event listeners
            quantityInput.addEventListener('input', updatePrice);

            // Page load par price update karein
            updatePrice();
        });
    </script>
@endsection

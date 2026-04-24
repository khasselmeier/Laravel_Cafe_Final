<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#f7f5f3] px-4">
        <div class="w-full max-w-sm bg-white rounded-3xl shadow-xl p-5 text-[#3b2a1f]">

            <!-- Image -->
            <div class="rounded-2xl overflow-hidden">
                <img src="{{ asset($product->image ?? 'images/placeholder.jpg') }}"
                     class="w-full h-52 object-cover">
            </div>

            <!-- Info -->
            <div class="mt-4">
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $product->description }}</p>

                <div class="mt-3 text-lg font-semibold">
                    $<span id="product-price">{{ number_format($product->price / 100, 2) }}</span>
                </div>
            </div>

            <input type="hidden" id="product-price-value" value="{{ $product->price }}">

            <!-- SIZE (drinks only) -->
            @if(in_array($product->category, ['coffee', 'tea']))
                <div class="mt-5">
                    <p class="text-sm font-semibold mb-2">Size</p>

                    <div class="flex gap-2">
                        <button type="button" class="size-btn px-4 py-2 rounded-full border bg-[#3b2a1f] text-white"
                                data-size="small" data-price="{{ $product->price }}">
                            Small
                        </button>

                        <button type="button" class="size-btn px-4 py-2 rounded-full border"
                                data-size="medium" data-price="{{ $product->price + 50 }}">
                            Medium
                        </button>

                        <button type="button" class="size-btn px-4 py-2 rounded-full border"
                                data-size="large" data-price="{{ $product->price + 100 }}">
                            Large
                        </button>
                    </div>

                    <input type="hidden" id="product-option" value="small">
                </div>
            @else
                <!-- FOOD OPTIONS -->
                <div class="mt-5">
                    <label class="text-sm font-semibold">Options</label>

                    <select id="product-option" class="w-full mt-2 border rounded-lg px-3 py-2 text-sm">
                        <option value="default">Default</option>

                        @if($product->name === 'Croissant')
                            <option value="plain">Plain</option>
                            <option value="chocolate">Chocolate</option>
                        @elseif($product->name === 'Muffin')
                            <option value="blueberry">Blueberry</option>
                            <option value="chocolate">Chocolate</option>
                        @endif
                    </select>
                </div>
            @endif

            <!-- Quantity -->
            <div class="mt-5 flex items-center justify-between">
                <span class="text-sm font-semibold">Quantity</span>
                <input type="number" id="product-quantity" value="1" min="1"
                       class="w-16 border rounded-lg px-2 py-1 text-center">
            </div>

            <!-- Add to Cart -->
            @auth
                <button type="button"
                        onclick="addToCart({{ $product->id }})"
                        class="mt-6 w-full bg-black text-white py-3 rounded-full text-sm font-semibold">
                    Add to bag
                </button>
            @else
                <p class="mt-4 text-red-500 text-sm text-center">
                    <a href="{{ route('login') }}" class="underline">Log in</a> to add items
                </p>
            @endauth
        </div>
    </div>

    <script>
        const buttons = document.querySelectorAll('.size-btn');
        const optionInput = document.getElementById('product-option');
        const priceEl = document.getElementById('product-price');

        // SIZE SELECT
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('bg-[#3b2a1f]', 'text-white'));
                btn.classList.add('bg-[#3b2a1f]', 'text-white');

                optionInput.value = btn.dataset.size;
                priceEl.textContent = (btn.dataset.price / 100).toFixed(2);
            });
        });

        // ADD TO CART
        function addToCart(productId) {
            const optionEl = document.getElementById('product-option');
            const quantityEl = document.getElementById('product-quantity');

            const size = optionEl ? optionEl.value : 'small';
            const quantity = quantityEl ? quantityEl.value : 1;

            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    size,
                    quantity
                })
            })
                .then(async res => {
                    const data = await res.json();

                    if (!res.ok) {
                        console.error(data);
                        alert('Failed to add item');
                        return;
                    }

                    // update UI
                    if (window.updateCartCount) {
                        window.updateCartCount(data.cartCount);
                    }

                    if (window.showPopup) {
                        window.showPopup(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.error(err));
        }
    </script>
</x-layout>

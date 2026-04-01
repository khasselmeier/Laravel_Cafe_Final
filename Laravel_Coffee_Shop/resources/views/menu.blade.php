<x-layout>
    <x-slot name="heading">Our Menu</x-slot>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Tabs -->
        <div class="flex flex-wrap gap-2 mb-8 bg-white p-2 rounded shadow">
            <button class="tab-btn px-4 py-2 bg-orange-500 text-white rounded" data-tab="all">All</button>
            @foreach($categories as $category => $items)
                <button class="tab-btn px-4 py-2 bg-gray-100 rounded" data-tab="{{ $category }}">
                    {{ ucwords(str_replace('_', ' ', $category)) }}
                </button>
            @endforeach
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Products -->
            <div class="flex-1">
                <!-- All Products -->
                <div class="tab-content grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6" data-tab="all">
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product->id) }}" class="block bg-white rounded-xl shadow p-4 text-center hover:shadow-lg transition">
                            <div class="h-40 mb-4 overflow-hidden rounded">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full bg-gray-200"></div>
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-orange-500 font-bold mt-2">${{ number_format($product->price / 100, 2) }}</p>
                        </a>
                    @endforeach
                </div>

                <!-- Category Tabs -->
                @foreach($categories as $category => $items)
                    <div class="tab-content hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6" data-tab="{{ $category }}">
                        @foreach($items as $product)
                            <a href="{{ route('products.show', $product->id) }}" class="block bg-white rounded-xl shadow p-4 text-center hover:shadow-lg transition">
                                <div class="h-40 mb-4 overflow-hidden rounded">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full bg-gray-200"></div>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-orange-500 font-bold mt-2">${{ number_format($product->price / 100, 2) }}</p>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Sidebar -->
            <aside class="w-full lg:w-80">
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="font-semibold mb-2">Your Order</h3>

                    @if(auth()->check() && isset($order) && $order->items->count())
                        <ul class="divide-y divide-gray-200 mb-2">
                            @foreach($order->items as $item)
                                <li class="py-2 flex justify-between items-center">
                                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                    <div class="flex gap-2">
                                        <span>${{ number_format($item->quantity * $item->price / 100, 2) }}</span>
                                        <!-- Remove single item -->
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Remove</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <p class="font-bold text-right mb-2">Total: ${{ number_format($order->total_amount / 100, 2) }}</p>

                        <div class="flex gap-2">
                            <!-- Remove all items -->
                            <form action="{{ route('cart.removeAll') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex-1 bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm">
                                    Remove All
                                </button>
                            </form>

                            <!-- Checkout -->
                            @if(auth()->check())
                                <a href="{{ route('checkout.index') }}" class="flex-1 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-center">
                                    Checkout Now
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="flex-1 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-center">
                                    Login or Register to Checkout
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="text-center text-gray-400">
                            <p>Cart is empty. Add menu items.</p>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');

        const activeTab = "{{ $activeTab ?? 'all' }}";

        tabs.forEach(tab => {
            if(tab.dataset.tab === activeTab){
                tab.classList.add('bg-orange-500','text-white');
                document.querySelector(`.tab-content[data-tab="${activeTab}"]`).classList.remove('hidden');
            } else {
                tab.classList.remove('bg-orange-500','text-white');
                tab.classList.add('bg-gray-100');
                document.querySelector(`.tab-content[data-tab="${tab.dataset.tab}"]`)?.classList.add('hidden');
            }
        });

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;
                contents.forEach(c => c.classList.add('hidden'));
                document.querySelector(`.tab-content[data-tab="${target}"]`).classList.remove('hidden');

                tabs.forEach(t => t.classList.remove('bg-orange-500','text-white'));
                tabs.forEach(t => t.classList.add('bg-gray-100'));
                tab.classList.add('bg-orange-500','text-white');
                tab.classList.remove('bg-gray-100');
            });
        });
    </script>
</x-layout>

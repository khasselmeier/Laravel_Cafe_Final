<x-layout>
    <section class="relative h-[70vh] flex items-center justify-center text-center text-[#3b2a1f]">

        <div class="absolute inset-0">
            <img src="{{ asset('images/coffee-bg.jpg') }}" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-[#f4e3d3]/60"></div>
        </div>

        <div class="relative z-10 max-w-2xl">
            <p class="uppercase tracking-widest text-sm text-[#a05a2c]">
                Prescott's Best Virtual Coffee Shop
            </p>

            <h1 class="text-5xl md:text-6xl font-bold mt-4">
                The Coffee Kup
            </h1>

            <a href="/menu"
               class="mt-6 inline-block px-6 py-3 bg-[#a05a2c] text-white rounded-full hover:bg-[#7f4522] transition">
                Shop Now
            </a>
        </div>

    </section>

    <!-- PRODUCTS -->
    <section class="py-16 bg-[#f4e3d3]">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                Best Selling Products
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach ($bestSellers as $product)
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-md p-4 text-center">

                        <!-- Image -->
                        <div class="h-40 mb-4 overflow-hidden rounded">
                            @php
                                $image = $product->image ?? 'images/placeholder.jpg';
                                $imagePath = ltrim($image, '/'); // remove leading slash
                            @endphp

                            <img src="{{ asset($imagePath) }}"
                                 class="w-full h-full object-cover" />
                        </div>

                        <!-- Name and Price -->
                        <h3 class="font-semibold text-gray-800">
                            {{ $product->name ?? 'Unknown Product' }}
                        </h3>

                        <p class="text-[#a05a2c] font-bold">
                            ${{ number_format(($product->price ?? 0) / 100, 2) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>

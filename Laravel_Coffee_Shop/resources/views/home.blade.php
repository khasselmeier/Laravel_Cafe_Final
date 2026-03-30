<x-layout>
    <x-slot name="heading">
        Coffee Shop
    </x-slot>

    <!-- HERO -->
    <section class="relative h-[70vh] flex items-center justify-center text-center text-white">
        <div class="absolute inset-0">
            <img src="/images/coffee-bg.jpg" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 max-w-2xl">
            <p class="uppercase tracking-widest text-sm text-orange-300">Best Coffee Shop</p>
            <h1 class="text-4xl md:text-6xl font-bold mt-4">
                Coffee from the Best Sunny Plantations
            </h1>
            <button class="mt-6 px-6 py-3 bg-orange-500 hover:bg-orange-600 rounded-full">
                Shop Now
            </button>
        </div>
    </section>

    <!-- PRODUCTS -->
    <!-- PRODUCTS -->
    <section class="py-16 bg-stone-200">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                Best Selling Products
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Card -->
                <div class="bg-white rounded-xl shadow p-4 text-center">
                    <div class="h-40 bg-gray-200 mb-4"></div>
                    <p class="text-orange-500 font-bold">$23</p>
                </div>
                <div class="bg-white rounded-xl shadow p-4 text-center">
                    <div class="h-40 bg-gray-200 mb-4"></div>
                    <p class="text-orange-500 font-bold">$23</p>
                </div>
                <div class="bg-white rounded-xl shadow p-4 text-center">
                    <div class="h-40 bg-gray-200 mb-4"></div>
                    <p class="text-orange-500 font-bold">$23</p>
                </div>
                <div class="bg-white rounded-xl shadow p-4 text-center">
                    <div class="h-40 bg-gray-200 mb-4"></div>
                    <p class="text-orange-500 font-bold">$23</p>
                </div>
            </div>
        </div>
    </section>

</x-layout>

<x-layout>
    <x-slot name="heading">{{ $product->name }}</x-slot>

    <div class="max-w-4xl mx-auto py-12 flex flex-col lg:flex-row gap-8">
        <div class="flex-1">
            <img src="{{ $product->image ?? '/images/placeholder.png' }}" class="w-full rounded-xl shadow" />
            <p class="mt-4 text-gray-700">{{ $product->description }}</p>
            <p class="mt-2 font-bold text-orange-500 text-xl">${{ number_format($product->price / 100, 2) }}</p>

            @auth
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="tab" value="{{ request()->query('tab', 'all') }}">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Add to Cart</button>
                </form>
            @else
                <p class="mt-4 text-red-500">You must <a href="{{ route('login') }}" class="underline">log in</a> to add items to your cart.</p>
            @endauth
        </div>
    </div>
</x-layout>

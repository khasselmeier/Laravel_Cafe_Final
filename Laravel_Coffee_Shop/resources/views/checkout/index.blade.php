<x-layout>
    <x-slot name="heading">Checkout</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-xl p-6">
        @if($order && $order->items->count())
            <h2 class="text-xl font-semibold mb-4">Your Order</h2>
            <ul class="divide-y divide-gray-200 mb-4">
                @foreach($order->items as $item)
                    <li class="py-2 flex justify-between">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <span>${{ number_format($item->quantity * $item->price / 100, 2) }}</span>
                    </li>
                @endforeach
            </ul>

            <p class="font-bold text-right mb-4">
                Total: ${{ number_format($order->total_amount / 100, 2) }}
            </p>

            <form action="{{ route('checkout.payment') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                    Proceed to Payment
                </button>
            </form>
        @else
            <p class="text-gray-500 text-center">Your cart is empty.</p>
            <div class="text-center mt-4">
                <a href="{{ route('menu.index') }}">Menu</a>
            </div>
        @endif
    </div>
</x-layout>

<x-layout>
    <x-slot name="heading">Payment</x-slot>

    <div class="max-w-2xl mx-auto bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Payment</h2>
        <p class="mb-4">Total Amount: <strong>${{ number_format($order->total_amount / 100, 2) }}</strong></p>

        <form action="{{ route('checkout.confirm') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Card Number</label>
                <input type="text" name="card_number" placeholder="1234 5678 9012 3456" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4 flex gap-2">
                <div class="flex-1">
                    <label class="block mb-2 font-medium">Expiration</label>
                    <input type="text" name="expiry" placeholder="MM/YY" class="w-full border rounded p-2" required>
                </div>
                <div class="flex-1">
                    <label class="block mb-2 font-medium">CVC</label>
                    <input type="text" name="cvc" placeholder="123" class="w-full border rounded p-2" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                Pay Now
            </button>
        </form>
    </div>
</x-layout>

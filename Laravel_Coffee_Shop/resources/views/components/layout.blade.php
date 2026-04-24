<!doctype html>
<html lang="en" class="h-full bg-[#f4e3d3]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $heading ?? 'Coffee Shop' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div>

    <!-- NAV -->
    <nav class="bg-[#a05a2c] text-white">
        <div class="flex h-16 items-center justify-between px-4 md:px-6">

            <div class="flex items-center">
                <img src="/images/coffee.png" class="h-10 w-10 rounded-full bg-white p-1" />

                <div class="hidden md:flex ml-10 space-x-4">
                    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                    <x-nav-link href="/menu" :active="request()->is('menu')">Menu</x-nav-link>
                    <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                @guest
                    <x-nav-link href="/login">Login</x-nav-link>
                    <x-nav-link href="/register">Register</x-nav-link>
                @endguest

                @auth
                    <form method="POST" action="/logout">
                        @csrf
                        <x-form-button>Log Out</x-form-button>
                    </form>
                @endauth

                <!-- Cart -->
                <a href="{{ route('checkout.index') }}" class="relative p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8h14l-2-8M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>

                    <span id="cart-count"
                          class="absolute -top-1 -right-1 px-2 py-1 text-xs font-bold text-white bg-[#7f4522] rounded-full">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-4 py-6">
        {{ $slot }}
    </main>
</div>

<script>
    // CART UI ONLY
    function updateCartCount(count) {
        const badge = document.getElementById('cart-count');
        if (!badge) return;

        badge.innerText = count;
        sessionStorage.setItem('cartCount', count);
    }

    function showPopup(message) {
        const popup = document.createElement('div');
        popup.innerText = message;
        popup.className = "fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow z-50";
        document.body.appendChild(popup);

        setTimeout(() => popup.remove(), 2000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const stored = parseInt(sessionStorage.getItem('cartCount') || 0);
        updateCartCount(stored || {{ $cartCount ?? 0 }});
    });

    window.addEventListener('pageshow', () => {
        const stored = parseInt(sessionStorage.getItem('cartCount') || 0);
        updateCartCount(stored || {{ $cartCount ?? 0 }});
    });
</script>

</body>
</html>

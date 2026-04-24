<x-layout>

    <!-- CONTACT SECTION -->
    <section class="relative min-h-[80vh] flex items-center justify-center bg-[#f4e3d3]">

        <!-- Background decorative overlay -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[#f4e3d3]"></div>
            <div class="absolute right-5 top-20 w-1/2 h-4/6 bg-[#a05a2c] opacity-10"></div>
        </div>

        <div class="relative z-10 max-w-6xl w-full px-6 grid md:grid-cols-2 gap-10 items-center">

            <!-- LEFT TEXT -->
            <div>
                <p class="uppercase tracking-widest text-sm text-[#a05a2c] font-semibold">
                    Get in Touch
                </p>

                <h1 class="text-5xl font-bold text-[#3b2a1f] mt-4">
                    Enjoy Your <span class="italic">Coffee Time</span>
                </h1>

                <p class="mt-6 text-[#5a4638] leading-relaxed">
                    Have a question, feedback, or just want to say hello?
                    We’d love to hear from you. Reach out anytime and we’ll get back to you as soon as possible.
                </p>

                <p class="mt-6 text-[#6b4b3a] font-medium">
                    📍 Prescott, Arizona
                </p>

                <a href="mailto:test@coffeeshop.com"
                   class="inline-block mt-6 px-6 py-3 bg-[#a05a2c] text-white rounded-full hover:bg-[#7f4522] transition">
                    Send Email
                </a>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">
                <img src="{{ asset('images/contact-bg.jpg') }}"
                     alt=""
                     class="w-full h-full object-cover object-center">
            </div>

        </div>

    </section>
</x-layout>

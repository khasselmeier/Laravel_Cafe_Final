<button {{ $attributes->merge(['class'=>'rounded-md bg-[#a05a2c] px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#803300]', 'type'=>'submit']) }}>
    {{ $slot }}
</button>

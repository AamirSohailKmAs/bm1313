<a {{ $attributes->merge(['class' => 'text-white font-semibold px-3 py-2 rounded-md hover:text-white cursor-pointer', 'type' => 'button']) }}>
    {{ $value ?? $slot }}
</a>
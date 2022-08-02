@props([
'route' => '#',
'value' => '',

])
<li {{ $attributes->merge(['class' => '']) }}>
    <a href="{{ $route }}" class="flex items-center py-2 px-4 transition duration-200 hover:bg-yellow-900 hover:text-white font-bold">
        <span class="ml-3">{{ $value }}</span>
    </a>
</li>

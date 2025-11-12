@props(['href' => null])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2  border-2  rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300  transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2  border-2  rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@endif

@props(['active' => false])

<a {{ $attributes}} class = "{{ $active ? 'text-white bg-gray-900' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} text-base block font-medium px-3 py-2"
aria-current="{{ $active ? 'page' : 'false'}}"
>{{ $slot }}</a>
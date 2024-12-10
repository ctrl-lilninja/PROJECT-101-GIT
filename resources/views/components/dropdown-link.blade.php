<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:bg-red-700 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>

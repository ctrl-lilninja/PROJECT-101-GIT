@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 border-gray-700 bg-gray-900 text-gray-900 focus:border-red-500 focus:border-red-600 focus:ring-red-500 focus:ring-red-600 rounded-md shadow-sm']) }}>

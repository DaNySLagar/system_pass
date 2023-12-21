<button {{ $attributes->merge(['type' => 'submit', 'class' => 'font-bold text-sm text-white-600 bg-gray-100 rounded-md p-2 bg-principal text-gray-100 ml-auto']) }}>
    {{ $slot }} 
</button>

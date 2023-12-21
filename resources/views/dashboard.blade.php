{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            ¡Bienvenido al Sistema de Papeleta de Salida del Gobierno Regional de Puno!
            sfsdsdd
        </h2>
    </x-slot>

    @livewire('statistics-table')

</x-app-layout> --}}


<x-app-layout>
    <x-slot name="header">
            {{-- {{ __('Inicio') }} --}}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            @livewire('statistics-table')
        </div>
    </div>
</x-app-layout>
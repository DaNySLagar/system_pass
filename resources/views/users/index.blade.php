{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Usuarios
        </h2>
    </x-slot>


                @livewire('users-index')


</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
            {{-- {{ __('Inicio') }} --}}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            @livewire('users-index')
        </div>
    </div>
</x-app-layout>
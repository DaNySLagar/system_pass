<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ver Papeleta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-24 lg:px-24">
            <div class="mx-auto md:flex md:justify-between p-5 bg-white shadow-xl sm:rounded-lg">
                <div class="pl-2 w-72 text-gray-800">
                    <label class="block text-s font-semibold w-full">Nombre: </label>{{ $pass->user->name }}
                    <label class="block text-s font-semibold w-full">Codigo: </label>{{ $pass->user->ncard }}
                    <label class="block text-s font-semibold w-full">Cargo: </label>{{ $pass->user->charge->name_charge }}
                    <label class="block text-s font-semibold w-full">Dependencia: </label>{{ $pass->user->dependence->name_dependence }}
                    <label class="block text-s font-semibold w-full">Motivo de salida: </label>{{ $pass->motive }}
                </div>
                <div class="pl-2 w-72 text-gray-800">
                    <label class="block text-s font-semibold w-full">Lugar: </label>{{ $pass->place }}
                    <label class="block text-s font-semibold w-full">Tiempo autorizado: </label>{{ $pass->time->time_permision }}
                    <label class="block text-s font-semibold w-full">Hora de Salida Registrada: </label>{{ $pass->input }}
                    <label class="block text-s font-semibold w-full">Hora de ingreso registros: </label>{{ $pass->output }}
                    <label class="block text-s font-semibold w-full">Fecha: </label>{{ $pass->date }}
                </div>
                <div class="pl-2 w-80 text-gray-800 border rounded-lg border-gray-900">
                    <label class="block text-s font-semibold w-full">Observaciones: </label>{{ $pass->observation }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            LISTA DE PAPELETAS EN ESPERA POR EL INTERESADO
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class=" flex justify-between items-center max-w-7xl">
     

            <p class="mb-4 mx-5 mt-5 rounded text-left m-4">

                <a href="{{ route('passes.reporte') }}" class="bg-blue-500 text-white text-xs font-bold py-2 px-4 rounded">
                    Imprimir
                </a>
            </p>
        </div>


    </div>
    <div class="flex flex-col overflow-x-auto py-2 ">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
            <div class="relative overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table-fixed min-w-full text-sm text-left text-gray-800">
                    <thead class="text-xs uppercase bg-gray-700 text-white">
                        <tr class="align-center">
                            <th scope="col" class="px-1 py-2">Nombre</th>
                            <th scope="col" class="px-1 py-2">Motivo</th>
                            <th scope="col" class="px-1 py-2">Lugar</th>
                            <th scope="col" class="px-1 py-2">Tiempo Autorizado</th>
                            <th scope="col" class="px-1 py-2">Fecha</th>
                            <th scope="col" class="px-1 py-2">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($passes as $pass)
                        <tr
                            id="pass_ids{{ $pass->id }}"
                            class="bg-white border-b bg-white-800 border-gray-700"
                        >
                            <td class="py-2">{{ $pass->user->name }}</td>
                            <td class="py-2">{{ $pass->motive }}</td>
                            <td class="py-2">{{ $pass->place }}</td>
                            <td class="py-2">{{ $pass->time->time_permision }}</td>
                            <td class="py-2">{{ $pass->date }}</td>
                            <td class="py-2">
                                <div class=" flex justify-center items-center">
                                    @if ($pass->estado === 4)
                                        <div class="inline-block text-white text-center text-xs px-1 rounded bg-gray-400">Archivado</div>
                                    @elseif ($pass->estado === 3)
                                        <div class="inline-block text-white text-center text-xs px-1 rounded bg-green-400">Firmado por RRHH</div>
                                    @elseif ($pass->estado === 2)
                                        <div class="inline-block text-white text-center text-xs px-1 rounded bg-blue-400">Firmado por Jefe</div>
                                    @elseif ($pass->estado === 1)
                                        <div class="inline-block text-white text-center text-xs px-1 rounded bg-yellow-400">Firmado por Solicitante</div>
                                    @elseif ($pass->estado === 0)
                                        <div class="inline-block text-white text-center text-xs px-1 rounded bg-red-400">Sin firmar</div>
                                    @endif
                                </div>
                            </td >

                        </tr>
                        @empty
                        <tr class="bg-white border-b bg-white-800 dark:border-gray-700">
                            <td colspan="7">No has creado ningun permiso</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

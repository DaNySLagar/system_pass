<div class="overflow-x-auto flex-col bg-white rounded-lg  p-2 m-2 w-full">

<h1 class="font-bold text-center text-3xl mb-3">Seguimiento de Papeletas</h1>

    <!-- searchc -->
    <div class='bg-white flex space-x-1 pb-2 w-full h-12'>
        <div class="w-1/2 md:w-1/5">
            <input wire:model="search" type="text" class="rounded h-full w-full" placeholder="Ingrese datos" title="Búsqueda por [Nombre, Tiempo, Fecha y Lugar]">
        </div>

        <a href="{{ route('passesadmin.reporte') }}" class='h-10  px-2 inline-flex items-center bg-slate-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-500 focus:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-2">
                <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                </svg>                  
            Imprimir
        </a>


    </div>
    <!--datatable -->
    <div class="overflow-x-auto shadow rounded-lg">
        <table class="w-full">
            <thead class="bg-slate-800 text-xs text-white uppercase">
                <tr class="align-center text-center rounded-lg">
                    <th scope="col" class="p-2" wire:click="sortBy('user_name')">Nombre</th>
                    <th scope="col" class="p-2" wire:click="sortBy('motive')">Motivo</th>
                    <th scope="col" class="p-2" wire:click="sortBy('place')">Lugar</th>
                    <th scope="col" class="p-2" wire:click="sortBy('time_name')">Tiempo Autorizado</th>
                    <th scope="col" class="p-2" wire:click="sortBy('date')">Fecha</th>
                    <th scope="col" class="p-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($passes as $pass)
                <tr id="pass_ids{{ $pass->id }}" class="bg-white border-b bg-white-800">
                    <td class="p-2 border border-gray-300">{{ $pass->user->name }}</td>
                    <td class="p-2 border border-gray-300">{{ $pass->motive }}</td>
                    <td class="p-2 border border-gray-300">{{ $pass->place }}</td>
                    <td class="p-2 border border-gray-300">{{ $pass->time->time_permision }}</td>
                    <td class="p-2 border border-gray-300">{{ $pass->date }}</td>


                    <td class="p-2 border border-gray-300">
       

                        <div class="flex justify-center items-center">
                                    @if ($pass->estado === 3)
                                        <!--<span class="inline-block h-4 w-4 rounded-full bg-green-500"></span>-->
                                        <span class="bg-green-600 text-gray-50 rounded-md px-2 text-center">Permiso Firmado
                                            <br> por Jefe de Recursos <br> Humanos</span>
                                    @elseif ($pass->estado === 2)
                                        <!--<span class="inline-block h-4 w-4 rounded-full bg-blue-500"></span>-->
                                        <span class="bg-blue-600 text-gray-50 rounded-md px-2 text-center">Permiso Firmado
                                            por <br> Jefe de Oficina</span>
                                    @elseif ($pass->estado === 1)
                                        <!--<span class="inline-block h-4 w-4 rounded-full bg-yellow-500"></span>-->
                                        <span class="bg-amber-600 text-gray-50 rounded-md px-2 text-center">Permiso Firmado
                                            <br> por Usuario</span>
                                    @elseif ($pass->estado === 0)
                                        <!--<span class="inline-block h-4 w-4 rounded-full bg-red-500"></span>-->
                                        <span class="bg-neutral-600 text-gray-50 rounded-md px-2 text-center">Permiso no
                                            Firmado</span>
                                    @elseif ($pass->estado === 4)
                                        <!--<span class="inline-block h-4 w-4 rounded-full bg-red-500"></span>-->
                                        <span class="bg-teal-500 text-gray-50 rounded-md px-2 text-center">Permiso
                                            Archivado</span>
                                    @elseif ($pass->estado === 5)
                                        <!--<span class="inline-block h-4 w-4 rounded-full bg-red-500"></span>-->
                                        <span class="bg-red-500 text-gray-50 rounded-md px-2 text-center">Permiso
                                            Rechazado</span>

                                    @endif
                        </div>

                       </td>




                </tr>
                @empty
                <tr class="bg-white border-b bg-white-800 dark:border-gray-700">
                    <td colspan="6">No has creado ningun permiso</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>     
        <div class="bg-white relative overflow-x-auto shadow-md rounded-lg mt-2">   
            {{ $passes->links() }}
        </div>

</div>

{{-- <div class="overflow-x-auto flex-col bg-white rounded-lg  p-3 m-2 w-full">

        <!-- searchc -->
        <div class='bg-white flex space-x-1 pb-2 w-full h-12'>
            <div class='bg-yellow-400  w-1/2 md:w-1/5 '>
                <input wire:model="search" type="text" class="rounded h-full w-full" placeholder="Ingrese datos" title="Búsqueda por [DNI, Nombre, Fecha y Dependencia]">
            </div>
            
            <a href="{{ route('archived.reporte') }}" class='h-10  px-2 inline-flex items-center bg-slate-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-500 focus:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-2">
                <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                </svg>                  
            Imprimir
        </a>


        </div>
        <!-- datable -->
        <div class="overflow-x-auto shadow rounded-lg">

            <table class="w-full">
                <thead class="bg-slate-800 text-xs text-white uppercase">
                    <tr class="align-centeralign-center text-center rounded-lg">
                        <th scope="col" class="p-2" wire:click="sortBy('ncard')">DNI</th>
                        <th scope="col" class="p-2" wire:click="sortBy('user_name')">Nombre</th>
                        <th scope="col" class="p-2" wire:click="sortBy('name_dependence')">Dependencia</th>
                        <th scope="col" class="p-2" wire:click="sortBy('motive')">Motivo</th>
                        <th scope="col" class="p-2" wire:click="sortBy('place')">Lugar</th>
                        <th scope="col" class="p-2" wire:click="sortBy('time_name')">Tiempo Autorizado</th>
                        <th scope="col" class="p-2" wire:click="sortBy('date')">Fecha</th>
                        <th scope="col" class="p-2">Estado</th>
                        <th scope="col" class="p-2">Hora de Salida</th>
                        <th scope="col" class="p-2">Hora de Regreso</th>
                        <th scope="col" class="p-2">Observación</th>
                        <th scope="col" class="p-2">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($passes as $pass)
                        <tr id="pass_ids{{ $pass->id }}" class="bg-white border-b bg-white-800">
                            <td class="p-2 border border-gray-300">{{ $pass->user->ncard }}</td>
                            <td class="p-2 border border-gray-300">{{ $pass->user->name }}</td>
                            <td class="p-2 border border-gray-300">{{ $pass->user->dependence->name_dependence }}</td>
                            <td class="p-2 border border-gray-300">{{ $pass->motive }}</td>
                            <td class="p-2 border border-gray-300">{{ $pass->place }}</td>
                            <td class="p-2 border border-gray-300">{{ $pass->time->time_permision }}</td>
                            <td class="p-2 border border-gray-300">{{ $pass->date }}</td>
                            <td class="p-2 border border-gray-300">
                                <div class=" flex justify-center items-center">
                                    @if ($pass->estado === 4)
                                        <div
                                            class="inline-block text-white text-center text-xs px-1 rounded bg-gray-400">
                                            Archivado</div>
                                    @elseif ($pass->estado === 3)
                                        <div
                                            class="inline-block text-white text-center text-xs px-1 rounded bg-green-400">
                                            Firmado por RRHH</div>
                                    @elseif ($pass->estado === 2)
                                        <div
                                            class="inline-block text-white text-center text-xs px-1 rounded bg-blue-400">
                                            Firmado por Jefe</div>
                                    @elseif ($pass->estado === 1)
                                        <div
                                            class="inline-block text-white text-center text-xs px-1 rounded bg-yellow-400">
                                            Firmado por Solicitante</div>
                                    @elseif ($pass->estado === 0)
                                        <div
                                            class="inline-block text-white text-center text-xs px-1 rounded bg-red-400">
                                            Sin firmar</div>
                                    @endif
                                </div>

                            </td>

                            @if ($departure->contains('pass_id', $pass->id))
                                <td class="p-2 border border-gray-300">{{ $pass->departure_time->hour_departure }}</td>
                            @else
                                <td class="p-2 border border-gray-300">Sin marcar hora de salida</td>
                            @endif


                            @if ($return->contains('pass_id', $pass->id))
                                <td class="p-2 border border-gray-300">{{ $pass->return_time->hour_return }}</td>
                                <td class="p-2 border border-gray-300">{{ $pass->return_time->observation }}</td>
                            @else
                                <td class="p-2 border border-gray-300">Sin marcar hora de retorno</td>
                                <td class="p-2 border border-gray-300">Sin Observaciones</td>
                            @endif



                            <td class="flex px-auto py-5 mb-2 justify-center items-center flex-col text-center md:flex-row">
                                <a href="{{ route('archived.show', $pass) }}"
                                    class="bg-sky-900 text-white rounded px-2 py-1 mx-1 my-auto md:mt-3 mb-3">Ver</a>
                                <a href="{{ route('archived.print', $pass) }}"
                                    class="bg-sky-900 text-white rounded px-2 py-1 mx-1 my-auto md:mt-3 mb-3">Imprimir</a>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b bg-white-800">
                            <td colspan="13">No has creado ningun permiso</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white relative overflow-x-auto shadow-md rounded-lg mt-2">
            {{ $passes->links() }}
        </div>
</div> --}}


<div class="overflow-x-auto flex-col bg-white rounded-lg  p-3 m-2 w-full">

    {{-- tablas --}}
    <section class="container px-4 mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 ">Papeletas Archivados</h2>
    
                    {{-- <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full">kj</span> --}}

                </div>
    
                <p class="mt-1 text-sm text-gray-500  uppercase">{{auth()->user()->name}}</p>
            </div>
    
            {{-- <div class="flex items-center mt-4 gap-x-3">
                <a href="{{ route('passes.reporte') }}">
                <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto   hover:bg-gray-100 ">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_3098_154395)">
                        <path d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_3098_154395">
                        <rect width="20" height="20" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
    
                    <span>Exportar</span>
                </button>
                </a>
    
                <div class="flex justify-end">
                    @livewire('create-modal')
                </div>

            </div> --}}
        </div>
        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div class="mt-6 md:flex md:items-center md:justify-between">
                {{-- <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg  rtl:flex-row-reverse">
                    @foreach(['Todos','Firmados', 'No_Firmados', 'rechazados'] as $option)
                        <button wire:click="setOpcion('{{ $option }}')"
                                class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200
                                       {{ $opcion === $option ? 'bg-gray-100 ' : 'hover:bg-gray-100  ' }}">
                            {{ $option }}
                        </button>
                    @endforeach
                </div> --}}
            </div>
    
            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <input wire:model="search" type="text" title="Búsqueda por [Motivo, Lugar, Tiempo y Fecha]"  placeholder="Buscar" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5   focus:border-blue-400  focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
        </div>
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">Fecha</th>
                                    {{-- <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">Estado</th> --}}
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        <button class="flex items-center gap-x-3 focus:outline-none" wire:click="sortBy('motive')">
                                            <span> Nombres/DNI</span>
    
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </th>
                                    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal  rtl:text-right text-gray-500 ">
                                        Dependencia/Cargo
                                    </th>
                                    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Lugar/Motivo
                                    </th>
                                    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Salida/Regreso
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Observaciones
                                    </th>
                                    
                                    
                                    <th scope="col" class="relative py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 ">
                                @forelse($passes as $id=>$pass)
                                <tr id="pass_ids{{ $pass->id }}" >
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div>
                                            <h2 class="font-medium text-gray-800  ">{{ $pass->date }}</h2>
                                            <p class="text-sm font-normal text-gray-600 ">{{ $pass->time->time_permision }}</p>
                                        </div>
                                    </td>
                                    <td class="px-2 py-4 text-sm font-medium max-w-10 overflow-auto break-words">
                                        <div>
                                            <h2 class="font-medium text-gray-800  ">{{ $pass->user->name }}</h2>
                                            <p class="text-sm font-normal text-gray-600 ">{{ $pass->user->ncard }}</p>
                                        </div>
                                    </td>
                                    <td class="px-2 py-4 text-sm font-medium whitespace-nowrap">
                                        <div class="max-w-3 overflow-auto">
                                            <h2 class="font-medium text-gray-800 ">{{ $pass->user->dependence->name_dependence }}</h2>
                                            <p class="text-sm font-normal text-gray-600 ">{{ $pass->user->charge->name_charge }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="max-w-xs overflow-auto max-w-10"> <!-- Agregamos la clase max-w-10 para limitar el ancho -->
                                            <h4 class="text-gray-700 ">{{ $pass->place }}</h4>
                                            <p class="text-gray-500 ">{{ $pass->motive }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="max-w-xs overflow-auto max-w-10"> 
                                            <!-- Agregamos la clase max-w-10 para limitar el ancho -->
                                            
                                            <h4 class="text-gray-700 ">Salida: {{ $pass->departure_time->hour_departure ?? "No registro"}}</h4>
                                            <p class="text-gray-500 ">Regreso: {{ $pass->return_time->hour_return ?? "No registro" }}</p>
                                        </div>
                                    </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="max-w-xs overflow-auto max-w-10"> <!-- Agregamos la clase max-w-10 para limitar el ancho -->
                                                {{-- <h4 class="text-gray-700 ">{{ $pass->place }} </h4> --}}
                                                <p class="text-gray-500 ">{{ $pass->return_time->observation ?? "Sin obs." }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <a href="{{ route('archived.show', $pass) }}"
                                            class="bg-sky-900 text-white rounded px-2 py-1 mx-1 my-auto md:mt-3 mb-3">Ver</a>
                                        <a href="{{ route('archived.print', $pass) }}"
                                            class="bg-sky-900 text-white rounded px-2 py-1 mx-1 my-auto md:mt-3 mb-3">Imprimir</a>
                                        </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b bg-white-800">
                                    <td colspan="7" class="px-4 text-gray-500 ">Ninguno</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
      
        <div class="mt-6 sm:flex sm:items-center sm:justify-between">
            <div class="text-sm text-gray-500 ">
                Paginas <span class="font-medium text-gray-700">{{ $passes->currentPage() }} de {{ $passes->lastPage() }}</span>
            </div>

            <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                @if ($passes->previousPageUrl())
                    <a href="{{ $passes->previousPageUrl() }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100   ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                        <span>Atras</span>
                    </a>
                @endif

                @if ($passes->nextPageUrl())
                    <a href="{{ $passes->nextPageUrl() }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100   ">
                        <span>Siguiente</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </section>
    


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

    function mostrarConfirmacion(event, url) {
        event.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres realizar esta acción?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; 
            }
        });
    }


</script>
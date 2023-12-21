<div class="overflow-x-auto flex flex-col bg-white rounded-lg  p-2 m-2 w-full"> 

    <h1 class="font-bold text-center text-3xl mb-3">Lista de dependencias del Gobierno Regional</h1>

        <!-- search -->
    <div class='flex space-x-1 pb-2 w-full h-12'>        
            <input wire:model="search" type="text" class="rounded w-1/2 md:w-1/5 lg:w-1/5" placeholder="Ingrese datos" title="Búsqueda por nombre">
            
            <div class="flex-grow"></div>          
            <div class="flex justify-end">
                @livewire('create-dependence')
            </div>


            
    </div>
        @if ($dependences->count())
            <!-- table data -->
            <div class="overflow-auto shadow rounded-lg">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full ">
                    <thead class="bg-slate-800 text-xs text-white uppercase">
                        <tr class="align-center text-center rounded-lg">
                            <th scope="col" class="p-2" wire:click="sortBy('id')" >Id: </th>
                            <th scope="col" class="p-2" wire:click="sortBy('name_dependence')" >Nombre: </th>
                            <th scope="col" class="p-2" wire:click="sortBy('belonging_to')">pertenece a: </th>

                            <th scope="col" class="p-2" >Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dependences as $dependence)
                            <tr>
                                <td scope="col" class="p-2 border border-gray-300">{{ $dependence->id }}</td>
                                <td scope="col" class="p-2 border border-gray-300">{{ $dependence->name_dependence }}</td>


                                    @php
                                        $llave = false;
                                    @endphp

                                    @foreach(\App\Models\Dependence::orderBy('name_dependence')->get() as $depen)
                                        @if($depen->id == $dependence->belonging_to)
                                            <td scope="col" class="p-2 border border-gray-300">
                                                {{ $depen->name_dependence }}
                                                @php
                                                    $llave = true;
                                                @endphp
                                            </td>
                                        @endif
                                    @endforeach

                                    @if(!$llave)
                                        <td scope="col" class="p-2 border border-gray-300">
                                                
                                        </td>
                                    @endif

                                <td scope="col" class="p-2 border border-gray-300 w-32">
                                   <div class="flex place-content-around h-full w-full items-center"> 

                                    
                                        @livewire('edit-dependence', ['dependence' => $dependence], key('edit-dependence-'.$dependence->id))
                                       

                                        <form action="{{route('dependences.destroy', $dependence) }}" method="POST" class="deleteForm-{{ $dependence->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-red-700 text-gray-50 rounded p-2 w-8 h-8 " title="Eliminar" onclick="mostrarConfirmacionform({{ $dependence->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- paginate -->

            <div class="bg-white relative overflow-x-auto shadow-md rounded-lg mt-2">
                {{ $dependences->links() }}
            </div>
        @else
            <div>
                <strong>No existen Registros</strong>
            </div>

        @endif
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function mostrarConfirmacionform(dependenceId) {
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
                var form = document.querySelector('.deleteForm-' + dependenceId);
                form.submit();
            }
        });
    }
</script>
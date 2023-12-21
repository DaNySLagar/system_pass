<div class="overflow-x-auto flex flex-col bg-white rounded-lg  pl-2  pt-1  pr-2  pb-2"> 

    <h1 class="font-bold text-center text-3xl">Lista de Usuarios </h1>

        <!-- search -->
        <div class='flex w-full py-2'>
            <input wire:model="search" type="text" class="rounded-lg w-1/4" placeholder="buscar" title="Búsqueda por [Nombre, Código y Correo]">
            <div class="flex-grow"></div>
            <div class="flex justify-end">
                @livewire('create-user')    
            </div> 
        </div>


        @if ($users->count())
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
                            <th scope="col" class="p-2" wire:click="sortBy('name')" >Nombre </th>
                            <th scope="col" class="p-2" wire:click="sortBy('ncard')">Código </th>
                            <th scope="col" class="p-2" wire:click="sortBy('email')">Email </th>
                            <th scope="col" class="p-2" wire:click="sortBy('name_dependence')">Dependencia </th>
                            <th scope="col" class="p-2" wire:click="sortBy('name_charge')">Cargo </th>
                            <th scope="col" class="p-2" >Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td scope="col" class="p-2 border border-gray-300">{{ $user->name }}</td>
                                <td scope="col" class="p-2 border border-gray-300">{{ $user->ncard }}</td>
                                <td scope="col" class="p-2 border border-gray-300">{{ $user->email }}</td>
                                <td scope="col" class="p-2 border border-gray-300">{{ $user->name_dependence}}</td>
                                <td scope="col" class="p-2 border border-gray-300">{{ $user->name_charge}}</td>
                                <td scope="col" class="p-2 border border-gray-300 w-32">
                                   <div class="flex place-content-around h-full w-full items-center"> 
                                    
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="bg-amber-700 text-white rounded px-1 py-1 w-8 h-8 flex items-center justify-center" title="Asignar Rol">
                                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM12 18.86l-1.45 1.45c-.32.32-.74.48-1.17.48s-.85-.16-1.17-.48L8 18.85V4h8v14.86zM4 4h1v12.66L5.9 15.4 4 17.35V4zm16 0v13.35l-1.9-1.94L16 16.66V4h1c1.1 0 2-.9 2-2s-.9-2-2-2zM11 8h2v2h-2zm0 4h2v4h-2z" />
                                            </svg>
                                        </a>

                                    

                                        @livewire('edit-user', ['user' => $user], key('edit-user-' . $user->id))<!-- modificar -->
                    

                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="deleteForm-{{$user->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-red-800 text-gray-50 rounded p-2 w-8 h-8 " title="Eliminar" onclick="mostrarConfirmacionform({{$user->id}})">
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
                {{ $users->links() }}
            </div>
        @else
            <div>
                <strong>No existen Registros</strong>
            </div>

        @endif
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>

    function mostrarConfirmacionform(userId) {
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
                var form = document.querySelector('.deleteForm-'+userId);
                form.submit();
            }
        });
    }

</script>
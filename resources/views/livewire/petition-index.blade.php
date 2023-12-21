<div class="container">

    <div>
        <!-- search -->
        <div class="m-2">
            <input wire:model="search" type="text" class="rounded w-full md:w-1/2" placeholder="Ingrese Nombre o email">
        </div>

        @if($users->count())
        <!-- table data -->
        <div class="relative overflow-x-auto bg-white rounded-lg">
            <table class="table-fixed min-w-full text-sm text-left text-gray-800">
                <thead class="text-xs uppercase bg-gray-700 text-white">
                    <tr class="align-center">
                        <th scope="col" class="px-2 py-2">ID</th>
                        <th scope="col" class="px-1 py-2">Nombre</th>
                        <th scope="col" class="px-1 py-2">Nº Tarjeta</th>
                        <th scope="col" class="px-1 py-2">Email</th>
                        <th scope="col" class="px-1 py-2">Dependencia</th>
                        <th scope="col" class="px-1 py-2">Cargo</th>
                        <th scope="col" class="px-1 py-2">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td scope="col" class="px-2 py-2">{{ $user->id }}</td>
                        <td scope="col" class="px-1 py-2">{{ $user->name }}</td>
                        <td scope="col" class="px-1 py-2">{{ $user->ncard }}</td>
                        <td scope="col" class="px-1 py-2">{{ $user->email }}</td>
                        <td scope="col" class="px-1 py-2">{{ $user->dependence->name_dependence }}</td>
                        <td scope="col" class="px-1 py-2">{{ $user->charge->name_charge }}</td>
                        <td scope="col" class="px-1 py-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white rounded px-1 py-1 mx-auto flex items-center justify-center">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                            </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- paginate -->
        <div class="opacity-80 h-px my-2" style="background: linear-gradient(to right, rgba(200, 200, 200, 0) 0%, rgba(200, 200, 200, 1) 30%, rgba(200, 200, 200, 1) 70%, rgba(200, 200, 200, 0) 100%);"></div>
        <div class="px-3">
            {{ $users->links() }}
        </div>

        @else

        <div>
            <strong>No existen Registros</strong>
        </div>

        @endif
    </div>

</div>
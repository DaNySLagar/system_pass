<x-app-layout>
    <x-slot name="header">
    </x-slot>



    <div class="overflow-x-auto flex-col bg-white rounded-lg  p-2 m-2 w-full">
            
        <h1 class="font-bold text-center text-3xl mb-3">Lista de Registros de Tiempos del Gobierno Regional</h1>

            @if (session('message'))
                <div class="alert alert-primary text-center">
                    {{ session('message') }}
                </div>
            @endif


        <form action="times" method="POST" class=" bg-white flex space-x-1 pb-2 w-full h-12 ">
            @csrf
            <div class='bg-yellow-400  w-1/2 md:w-1/5 '>
                <input type="text" name="time_permision" class="rounded h-full w-full" placeholder="Nuevo Tiempo">
            </div>
            <input type="submit" value="Agregar" class="h-10 px-2 inline-flex items-center bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ">
                
        </form>


        
        <div class="overflow-x-auto shadow rounded-lg">
            <table class="w-full" id="charge_table">
                <thead class="bg-slate-800 text-xs text-white uppercase">
                    <tr class="align-center text-center rounded-lg">
                        <th scope="col" class="p-2">Tiempo Autorizado</th>
                        <th scope="col" class="p-2">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($times as $time)
                        <tr class="bg-white border-b bg-white-800">
                            <td class="p-2 border border-gray-300">{{ $time->time_permision }}</td>
                            <td class="p-2 border border-gray-300">
                                <div class="w-full h-full place-content-around flex  flex-col md:flex-row  justify-center items-center align-middle">
                                    <a href="{{ route('times.edit', $time) }}"
                                        class="bg-blue-800 text-white rounded px-2 py-1 mx-1" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                            <path
                                                d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                        </svg>
                                    </a>

                                    <form action="times/{{ $time->id }}" method="POST" id="deleteForm" class="deleteForm{{$time->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="button" class="bg-red-500 text-white rounded px-2 py-1 mx-1" value="Eliminar" onclick="mostrarConfirmacionform({{$time->id}})">
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr class="bg-white border-b bg-white-800 dark:border-gray-700">
                            <td colspan="4">
                                No hay Tiempos Creados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>



</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


<script>

     $('#charge_table').DataTable({
        "orderable": false,
        "pageLength": 10,
        "language": {
            "search": "Buscar:",
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        "lengthChange": false,
        "searching": true, 
        "paging": true, 
    });

function mostrarConfirmacionform(timeId) {
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
                var form = document.querySelector('.deleteForm'+timeId);
                form.submit();
            }
        });
    }

</script>

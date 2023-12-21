<div>
    <x-buttonR wire:click="$set('open', true)">
        generar reporte
    </x-buttonR>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h1 class="font-bold text-center text-lg mb-5">Ingrese los datos para generar el Reporte</h1> 
        </x-slot>
        <x-slot name="content">

            @if (session('message'))
                <div class="alert alert-danger text-center">
                    {{ session('message') }}
                </div>
            @endif
        
            <div class="flex flex-col items-center mb-2">

                <div class="flex justify-center space-x-20">
                    <div class="flex flex-col items-center">
                        <label class="text-s font-sans font-bold" >Fecha de Inicio:</label>
                        <input type="date" name="date" class="rounded border-gray-400" wire:model="date_inicio">
                    </div>

                    <div class="flex flex-col items-center">
                        <label class="text-s font-sans font-bold">Fecha de Fin:</label>
                        <input type="date" name="date" class="rounded border-gray-400" wire:model="date_final">
                    </div>
                </div>
            </div>

            @if (Auth::user()->hasAnyRole(['JefeRrHh', 'Guardian', 'Administrador']))
                <div class="mt-2">
                    <label class="text-s font-sans font-bold">Dependencia:</label>
                    <select wire:model="dependence"  wire:click="resetearUser" id="dependence" class="w-full rounded">
                        @foreach($dependences as $dep)
                            <option value="{{$dep->id}}">{{$dep->name_dependence}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mt-2">
                    <label class="text-s font-sans font-bold">Usuarios:</label>
                    <select wire:model="user" id="user" class="w-full rounded">
                        <option value="">Todos los usuarios de dependencia</option>
                        @foreach($users as $user)
                            <option value="{{--$user->id--}}{{$user->id}}">{{--$user->name--}}{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

            @elseif(Auth::user()->hasrole('JefeOficina'))
                <div class="mt-2">
                    <label class="text-s font-sans font-bold">Usuarios:</label>
                    <select wire:model="user" id="user" class="w-full rounded">
                        <option value="">Todos los usuarios de dependencia</option>
                        @foreach($users as $user)
                            <option value="{{--$user->id--}}{{$user->id}}">{{--$user->name--}}{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <button type="button" class="mt-3 text-blue-600 mb-3 underline" onclick="activarOpciones()">Más opciones de reporte</button>

            <div id="opciones" class="{{ $opcion ? 'block' : 'hidden' }}">
                <label class="text-s font-sans font-bold">Opciones de reporte:</label>
                <select wire:model="opcion" class="w-full rounded">
                    <option value="">Todos</option>
                    <option value="1">Papeletas con retorno</option>
                    <option value="2">Papeletas sin retorno</option>
                </select>
            </div>



        </x-slot>
        <x-slot name="footer">
            <button wire:click="generarReportePdf" class=' mr-3 h-10 px-2 inline-flex items-center bg-slate-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-500 focus:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-2">
                    <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                </svg>  
                Generar pdf
            </button>

            <button wire:click="generarReporteExcel" class='h-10  px-2 inline-flex items-center bg-slate-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-500 focus:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-2">
                    <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                </svg>      
                Generar excel
            </button>
        </x-slot>
    </x-dialog-modal>

</div>

<script>
    function activarOpciones() {
        var opciones = document.getElementById("opciones");
        opciones.classList.toggle("hidden");
        opciones.classList.toggle("block");
    }

</script>
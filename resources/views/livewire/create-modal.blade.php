<div>
    <button wire:click="$set('open', true)" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <span>Crear nueva papeleta</span>
    </button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
           

            <h1 class="font-bold text-center text-lg"> Ingrese los datos de la nueva papeleta</h1>


        </x-slot>
        <x-slot name="content">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white pt-2 px-4 overflow-hidden sm:rounded-lg">
                    <form action="{{ route('passes.store') }}" method="POST" id="pass">
                        @csrf
                        @if ($errors->any())
                        <ul class="list-none p-4 mb-4 bg-red-100 text-red-500">
                            @foreach($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                       
                        <label class="text-s font-bold">Motivo de Salida:</label>
                        <input type="text" class="rounded py-2 w-full border-gray-400" name="motive" id="motive-input" required>
                        <span id="motive-character-count" class="text-red-500">máximo de caracteres "250"</span><br>
                    
                        
                    
                        <br><label class="text-s font-bold">Lugar de Salida:</label>
                        <input type="text" class="rounded py-2 w-full border-gray-400" name="place"  required>
                    
                       
                        <div class="flex justify-between items-center w-full mt-3">


                            <div class="w-full">
                                <label class="text-s font-bold">Tiempo Solicitado:</label>
                                <select name="time_id" class="rounded py-2 w-full border-gray-400" >
                                    @foreach ($times as $time)
                                        <option value="{{ $time->id }}">{{ $time->time_permision }}</option>
                                    @endforeach
                                </select>
                            </div>

                        
  
                            <div class="w-full m-2">
                                @livewire('date-validation')
                            </div>

                        </div>

                        

                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            
            <div class="justify-right p-2">
                <input type="submit" id="btnGuardar" class="bg-blue-700 text-white rounded px-4 py-2" value="Registrar" onclick="desactivarBoton()">
            </div>
        </x-slot>
    </x-dialog-modal>
</div>


<script>
   function desactivarBoton() {
        var formulario = document.getElementById("pass");
        var camposRequeridos = formulario.querySelectorAll('[required]');
        var todosCamposCompletos = true;

        camposRequeridos.forEach(function (campo) {
            if (!campo.value) {
                todosCamposCompletos = false;
            }
        });

        if (todosCamposCompletos) {
            var boton = document.getElementById("btnGuardar");
            boton.disabled = true;
            boton.value = "Guardado...";
            formulario.submit();
        }
    }


    function setupCharacterCountValidation(inputId, countId) {
            const input = document.getElementById(inputId);
            const characterCount = document.getElementById(countId);

            input.addEventListener("input", function() {
                const currentLength = input.value.length;

                characterCount.textContent = `máximo de caracteres "${250}", vas por ${currentLength}`;

                if (currentLength > 250) {
                    document.getElementById("btnGuardar").disabled = true;
                } else {
                    document.getElementById("btnGuardar").disabled = false;
                }
            });
        }
    setupCharacterCountValidation("motive-input", "motive-character-count");

                    

</script>

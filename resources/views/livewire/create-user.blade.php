<div>
    <x-buttonR wire:click="$set('open', true)">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path d="M6 3a3 3 0 00-3 3v2.25a3 3 0 003 3h2.25a3 3 0 003-3V6a3 3 0 00-3-3H6zM15.75 3a3 3 0 00-3 3v2.25a3 3 0 003 3H18a3 3 0 003-3V6a3 3 0 00-3-3h-2.25zM6 12.75a3 3 0 00-3 3V18a3 3 0 003 3h2.25a3 3 0 003-3v-2.25a3 3 0 00-3-3H6zM17.625 13.5a.75.75 0 00-1.5 0v2.625H13.5a.75.75 0 000 1.5h2.625v2.625a.75.75 0 001.5 0v-2.625h2.625a.75.75 0 000-1.5h-2.625V13.5z" />
          </svg>  
          Crear Usuario        
    </x-buttonR>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <span class="flex justify-center">
                INGRESE DATOS DEl USUARIO
            </span>
        </x-slot>
        <x-slot name="content">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white pt-1 px-4 overflow-hidden sm:rounded-lg">
                    <form action="{{ route('users.store') }}" method="POST" id="pass">
                        @csrf
                        <div class="mt-2"><label class="text-s font-sans">NOMBRE COMPLETO</label>
                            <input type="text" class="uppercase  rounded py-1 w-full border-gray-400" name="name" id="motive-input" required>
                            {{-- <span id="motive-character-count" class="text-red-500 flex justify-end">máximo de caracteres "50"</span><br>                                                           --}}
                        </div>
                        <div class="mt-2">
                            <label class="text-s font-sans">CORREO ELECTRÓNICO</label>
                            <input type="text" class="rounded py-1 w-full border-gray-400" name="email"  required>
                        </div>
                        <div class="mt-2"> <label class="text-s font-sans">Ncard</label>
                            <input type="text" class="uppercase  rounded py-1 w-full border-gray-400" name="ncard"  required>
    
                        </div>
                        <div class="mt-2"><label class="text-s font-sans">CONTRASEÑA</label>
                            <input type="password" class="rounded py-1 w-full border-gray-400" name="password"  required>
                        </div>
                        <div class="mt-2"> <label class="text-s font-sans">CARGO</label>
                            <select class="w-full  rounded" name="charge_id" id="charge_id">
                                @foreach($charges as $charge)
                                <option value="{{$charge->id}}">{{$charge->name_charge}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2">
                            <label class="text-s font-sans">DEPENDENCIA:</label>
                            <select class="w-full rounded" name="dependence_id" id="dependence_id">
                                @foreach($dependences as $dependence)
                                <option value="{{$dependence->id}}">{{$dependence->name_dependence}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex justify-end mt-4">
                            <x-primary-button id="btnGuardar" onclick="desactivarBoton()">GUARDAR</x-primary-button>
                        </div>
                 
                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
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

                characterCount.textContent = `máximo de caracteres "${50}", vas por ${currentLength}`;

                if (currentLength > 50) {
                    document.getElementById("btnGuardar").disabled = true;
                } else {
                    document.getElementById("btnGuardar").disabled = false;
                }
            });
        }
    setupCharacterCountValidation("motive-input", "motive-character-count");

                    

</script>

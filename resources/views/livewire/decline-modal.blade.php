<div>

    <button wire:click="$set('open', true)" class="bg-red-600 text-white text-xs rounded px-1 py-2 flex items-center" title="Rechazar">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-1">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
          </svg>           --}}
        RECHAZAR</button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex ">
                <div class="w-full bg-blue-400 text-black p-4"> 
                    Rechazar Papeleta de Salida
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
                                
                <form action="{{ route('hours.store') }}" method="POST" id="pass">
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
                    
                    <label class="block text-s font-semibold w-full text-black">Nombre: </label>{{ $pass->user->name }} <br>

                    <!--Dato a validar-->
                    <input type="text" class="rounded py-1 w-full border-gray-400" value="{{ $passUser }}" name="user" required style="display: none;">



                    <label class="text-s font-semibold" style="display: none;">Hora de Retorno:</label>
                    <input type="time" class="rounded py-1 w-full border-gray-400" value="00:00" name="hour_return" required style="display: none;">

                    <label class="mt-2 text-black font-semibold">N° de pase de salida:</label>
                    <input type="integer" class="rounded py-1 w-full border border-gray-400" value=" {{ $pass->id }}" name="pass_id" readonly> 
                
                    <label class="mt-2 font-semibold text-black">Observaciones:</label>
                    <textarea name="observation" id="obs-input" class="rounded py-1 w-full border-gray-400" id=""cols="20" rows="6" type="text" required>Ninguna</textarea>
                    <span id="motive-character-count" class="text-red-500 mb-2">máximo de caracteres "250"</span>

                    <div class="flex justify-between items-center mt-3">
                        <div class="">
                            <input type="submit" id="btnGuardar" class="bg-blue-600 text-white rounded px-4 py-2" value="Guardar" onclick="desactivarBoton()">
                        </div>
                    </div>
                </form>

        </x-slot>


        <x-slot name="footer">
            {{ 'Papeleta de Salida' }}
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
    setupCharacterCountValidation("obs-input", "motive-character-count");

</script>
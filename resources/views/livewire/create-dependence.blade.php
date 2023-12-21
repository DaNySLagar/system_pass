<div>
    <x-buttonR wire:click="$set('open', true)">
        Nueva dependencia
    </x-buttonR>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Ingrese datos de la dependencia
        </x-slot>
        <x-slot name="content">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white pt-1 px-4 overflow-hidden sm:rounded-lg">
                    <form action="{{ route('dependences.store') }}" method="POST" id="pass">
                        @csrf
                  
                        <label class="text-s font-semibold">Dependencia:</label>
                        <input type="text" class="rounded py-1 w-full border-gray-400" name="name_dependence" required>
                                                        

                        <label class="text-s font-semibold mt-2">Pertenece a:</label>
                        <select class="w-full rounded" name="belonging_to" id="belonging_to">
                            <option value="">Seleccione</option>
                            @foreach($dependences as $dependence)
                            <option value="{{$dependence->id}}">{{$dependence->name_dependence}}</option>
                            @endforeach
                        </select>


                        <input type="submit" id="btnGuardar" class="bg-green-800 text-white rounded px-4 py-1 mt-4" value="Guardar" onclick="desactivarBoton()">
                 
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

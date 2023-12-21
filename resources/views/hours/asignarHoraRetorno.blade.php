<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-3 container">
        

        <div class="max-w-7xl mx-auto sm:px-24 lg:px-24">
            <div class="bg-white pt-2 px-4 overflow-hidden shadow-xl sm:rounded-lg">
                
                <h1 class="font-bold text-center text-3xl mb-3">ASIGNAR HORA</h1>
                

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


                    <div class="mt-4 flex">
                        <div class="w-3/4 pr-4">
                            <label class="text-s font-semibold">Hora de Retorno:</label>
                            <input type="time" class="rounded py-1 w-full border-gray-400" value="{{ $currentHour }}" name="hour_return" required>
                        </div>

                        <div class="w-1/4">
                            <label class="text-s font-semibold">N° de pase de salida:</label>
                            <input type="integer" class="rounded py-1 w-full border border-gray-400" value="  {{ $pase->id }}" name="pass_id" readonly>
                        </div>
                    </div><br>


                
                    <label class="text-s font-semibold">Observaciones:</label>
                    <textarea name="observation" id="obs-input" class="rounded py-1 w-full border-gray-400" id=""cols="20" rows="5" type="text" required>Ninguna</textarea>
                    <span id="motive-character-count" class="text-red-500">máximo de caracteres "250"</span>

                    <div class="opacity-80 h-px mt-4 md:mb-4" style="background: linear-gradient(to right, rgba(200, 200, 200, 0) 0%, rgba(200, 200, 200, 1) 30%, rgba(200, 200, 200, 1) 70%, rgba(200, 200, 200, 0) 100%);"></div>
                    <div class="flex justify-between items-center pb-5">
                        <div class="">
                            <input type="submit" id="btnGuardar" class="bg-blue-600 text-white rounded px-4 py-1" value="Guardar" onclick="desactivarBoton()">
                        </div>
                    </div>
                </form>
            </div>
</div>
    </div>
</x-app-layout>

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

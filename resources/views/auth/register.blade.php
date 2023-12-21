

<x-guest-layout>
    <x-authentication-card>
       <x-slot name="logo">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="#">
            @csrf

             <!--Nombre-->

            <div>
                <x-label for="name" value="{{ __('Nombre(s) y Apellidos') }}" />
                <x-input id="name" class="bg-gray-50 block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                pattern="[a-zA-Z ]+" title="Por favor, ingrese solo letras y espacios" maxlength="50"/>

            </div>

            <!--Correo-->

            <div class="mt-4 flex">
                <div class="w-3/4 pr-4">
                    <x-label for="email" value="{{ __('Correo') }}" />
                    <x-input id="email" class="bg-gray-50 block w-full" type="email" name="email" :value="old('email')" required autocomplete="email" title="Por favor, ingrese una dirección de correo válida" maxlength="50"/>
                    @error('email')
                        <div class="font-medium text-red-600 text-sm">El correo ya está registrado</div>
                    @enderror
                    <span id="email-title" class="font-medium text-red-600 text-sm"></span>
                </div>

                <div class="w-1/4">
                    <x-label for="ncard" value="{{ __('Código') }}" />
                    <x-input id="ncard" class="bg-gray-50 block w-full" type="text" name="ncard" :value="old('ncard')" autocomplete="ncard" pattern="[0-9]+" title="Por favor, ingrese solo números" maxlength="10"/>
                    @error('ncard')
                        <div class="font-medium text-red-600 text-sm">El código ya está registrado</div>
                    @enderror
                </div>
            </div>



            <!--Cargo-->

            <div class="mt-4">
                <x-label for="Charge" value="{{ __('Cargo') }}" />
                <select id="buscador_charge" name="charge_id" class=" bg-gray-50 block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach(\App\Models\Charge::all() as $charge)
                        <option value="{{ $charge->id }}" @if(old('charge_id') == $charge->id) selected @endif>{{ $charge->name_charge }}</option>
                    @endforeach
                </select>
            </div>


            <!--Dependencia-->
            <div>
                <div class="mt-4">
                    <label for="dependence_select" class="block text-sm font-medium text-blue-700">Selecciona tu dependencia:</label>
                    <select id="buscador_dependence" name="dependence_id" class="bg-gray-50 block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        @foreach(\App\Models\Dependence::orderBy('name_dependence')->get() as $dependence)
                            <option value="{{ $dependence->id }}"  @if(old('dependence_id') == $dependence->id) selected @endif>{{ $dependence->name_dependence }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <!--Contraseña-->

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <div class="relative">
                    <x-input id="password" class="bg-gray-50 block pr-10 mt-1 w-full" type="password" name="password"
                        required autocomplete="new-password"
                        pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$"
                        
                        title="La contraseña debe contener al menos una letra, un número y mínimo de 8 caracteres."
                    />
                    <button type="button"
                        class="absolute inset-y-0 right-0 px-3 py-2 bg-gray-200 rounded-r-md"
                        onclick="togglePasswordVisibility('password')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-gray-600">
                            <ellipse cx="12" cy="12" rx="9" ry="5" ry="6" stroke-width="2" />
                            <circle cx="12" cy="12" r="3" fill="currentColor" />
                        </svg>



                    </button>
                </div>
                @error('password')
                    <div class="font-medium text-red-600 text-sm">Las contraseñas son diferentes</div>
                @enderror
            </div>


            <!--Confirmacion de contraseña-->

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Repita Contraseña') }}" />
                <div class="relative">
                    <x-input id="password_confirmation" class="bg-gray-50 block pr-10 mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <button type="button"
                        class="absolute inset-y-0 right-0 px-3 py-2 bg-gray-200 rounded-r-md"
                        onclick="togglePasswordVisibility('password_confirmation')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-gray-600">
                            <ellipse cx="12" cy="12" rx="9" ry="5" ry="6" stroke-width="2" />
                            <circle cx="12" cy="12" r="3" fill="currentColor" />
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="font-medium text-red-600 text-sm">Las contraseñas son diferentes</div>
                @enderror
            </div>



            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="font-bold underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya tiene una cuenta?') }}
                </a>

                <x-button id="miBoton"  class="ml-4">
                    {{ __('Registrarme') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>


<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }

                
    $('#buscador_dependence').select2();
    $('#buscador_charge').select2();
                

    const emailInput = document.querySelector("#email");
    const emailTitle = document.querySelector("#email-title");

    emailInput.addEventListener("input", function() {
        const correo = this.value;
        const expReg = /^[a-zA-Z0-9._%+-]{3,}@([a-zA-Z0-9-]{3,}\.)+[a-zA-Z]{2,}$/;
        const esValido = expReg.test(correo);

        if (esValido) {
            emailTitle.textContent = ""; // Borrar el título si es válido
        } else {
            const title = this.title;
            emailTitle.textContent = title;
        }
    });

</script>


<style>

.select2-container .select2-selection {
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    height: 40px;
    margin-top:3px;
    padding-top: 5px;
}

</style>


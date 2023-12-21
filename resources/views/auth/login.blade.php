<x-guest-layout>
    <x-authentication-card>


        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        

            <h1 class="font-black text-blue-900 text-center underline text-1x2 mb-8 ">Sistema de Papeletas de Salida</h1>
            
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}" class="">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Correo:') }}" />
                    <x-input id="email" class="bg-gray-50 block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" title="Por favor, ingrese una dirección de correo válida" />
                    <span id="email-title" class="font-medium text-red-600 text-sm"></span>
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Contraseña:') }}" />

                    <div class="relative">

                        <x-input id="password" class="bg-gray-50 block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                        <button type="button"
                            class="absolute inset-y-0 right-0 px-3 py-2 bg-gray-200 rounded-r-md"
                            onclick="togglePasswordVisibility('password')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-gray-600">
                                <ellipse cx="12" cy="12" rx="9" ry="5" ry="6" stroke-width="2" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </button>

                    </div>

                </div>

               <!-- <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="font-bold ml-2 text-sm text-gray-600">{{ __('Recordar cuenta') }}</span>
                    </label>
                </div> -->

                <div class="flex items-center mt-8 mb-4">
                    
                    @if (Route::has('password.request'))
                        <a class="font-bold text-sm text-blue-900 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste la contraseña?') }}
                        </a>
                    @endif

                    <x-button >
                        {{ __('Ingresar') }} 
                    </x-button>
                
                </div><hr>
                <!-- <x-buttonR class="ml-4"> -->
                
                <div class="mt-2">
                    <a class=" font-bold underline text-sm text-gray-600  rounded-md p-2 hover:bg-principal hover:text-gray-100" href="{{ route('register') }}">
                        {{ __('Crear cuenta') }}
                    </a>
                </div>
                <!-- </x-buttonR> -->
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

    const emailInput = document.querySelector("#email");
    const emailTitle = document.querySelector("#email-title");

    emailInput.addEventListener("input", function() {
        const correo = this.value;
        const expReg = /^[a-zA-Z0-9._%+-]{3,}@([a-zA-Z0-9-]{3,}\.)+[a-zA-Z]{2,}$/;
        const esValido = expReg.test(correo);

        if (esValido) {
            emailTitle.textContent = "";
        } else {
            const title = this.title;
            emailTitle.textContent = title;
        }
    });

</script>
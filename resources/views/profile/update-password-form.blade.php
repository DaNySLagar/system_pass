<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualiza tu contraseña') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Asegúrese de que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <div class="relative">

                <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" required/>
                

                <button type="button"
                    class="absolute inset-y-0 right-0 px-3 py-2 bg-gray-200 rounded-r-md"
                    onclick="togglePasswordVisibility('current_password')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-gray-600">
                        <ellipse cx="12" cy="12" rx="9" ry="5" ry="6" stroke-width="2" />
                        <circle cx="12" cy="12" r="3" fill="currentColor" />
                    </svg>
                </button>

            </div>

        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" />

            <div class="relative">

                <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" 
                    pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"            
                    title="La contraseña debe contener al menos una letra, un número, un carácter especial y mínimo de 8 caracteres."
                    required
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

        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            
            <div class="relative">

                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" 
                autocomplete="new-password" required/>
                
                
                <button type="button"
                    class="absolute inset-y-0 right-0 px-3 py-2 bg-gray-200 rounded-r-md"
                    onclick="togglePasswordVisibility('password_confirmation')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-gray-600">
                        <ellipse cx="12" cy="12" rx="9" ry="5" ry="6" stroke-width="2" />
                        <circle cx="12" cy="12" r="3" fill="currentColor" />
                    </svg>
                </button>

            </div>

        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Tus datos fueron actualizados') }}
        </x-action-message>

        <x-button>
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>


<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }

    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
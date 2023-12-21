<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <h2>
            {{ __('
                Restablecer Contraseña
            ') }}
        </h2><br>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('
                Introduzca su dirección de correo electrónico registrada abajo para recibir el enlace de restablecimiento de contraseña.
            ') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('
                    Se envió a su dirección de correo electrónico el enlace de restablecimiento de contraseña.
                ') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Enviar Enlace de Reseteo') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

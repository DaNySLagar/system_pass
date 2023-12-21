<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Perfil de Informacion') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la informacion de tu perfil de cuenta y agrega un correo.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

                
        <!-- Email -->
        <div class="col-span-3 sm:col-span-3 text-black-900">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full text-black-900" wire:model.defer="state.email" autocomplete="username" title="Por favor, ingrese una dirección de correo válida" required  maxlength="50"/>
            <span id="email-title" class="font-medium text-red-600 text-sm"></span>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Name -->
        <div class="col-span-5 sm:col-span-5 text-gray-900">
            <x-label for="name" class="text-gray-500" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full text-white-500 bg-gray-200" wire:model.defer="state.name" autocomplete="name" 
                pattern="[a-zA-Z ]+" title="Por favor, ingrese solo letras y espacios" required  maxlength="50" readonly />
        </div>


        <!-- Dependencia -->
        <div class="col-span-8 sm:col-span-8 text-gray-900">
            <x-label  class="text-gray-500" for="dependence_id" value="{{ __('Dependencia') }}" />
            <select name="dependence_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-white-500 bg-gray-200" disabled>
                @foreach(\App\Models\Dependence::orderBy('name_dependence')->get() as $dependence)
                    <option value="{{ $dependence->id }}" @if($state['dependence_id'] == $dependence->id) selected @endif>{{ $dependence->name_dependence }}</option>
                @endforeach
            </select>
        </div>


        <!-- codigo -->
        <div class="col-span-2 sm:col-span-2 text-gray-900">
            <x-label  class="text-gray-500" for="ncard" value="{{ __('Código') }}" />
            <x-input id="ncard" type="text" class="mt-1 block w-full text-white-500 bg-gray-200" wire:model.defer="state.ncard" autocomplete="ncard" 
                pattern="[0-9]+" title="Por favor, ingrese solo letras y espacios" required  maxlength="10" readonly />
        </div>

        <!-- Cargo -->
        <div class="col-span-6 sm:col-span-6 text-gray-900">
            <x-label  class="text-gray-500" for="charge_id" value="{{ __('Cargo') }}" />
            <select name="charge_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-white-500 bg-gray-200" disabled>
                @foreach(\App\Models\Charge::all() as $charge)
                    <option value="{{ $charge->id }}" @if($state['charge_id']  == $charge->id) selected @endif>{{ $charge->name_charge }}</option>
                @endforeach
            </select>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Tus datos fueron actualizados') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>

<script>
    

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

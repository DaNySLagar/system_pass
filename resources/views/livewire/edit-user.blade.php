<div>
    <!-- <x-buttonR wire:click="$set('open', true)"> -->
    <a href="#" class="bg-green-800 text-white rounded flex p-2 w-8 h-8" wire:click="$set('open', true)" title="Editar Usuario">        
        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path
                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
            <path
                d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
        </svg>

    </a>

    <!-- </x-buttonR> -->
    <x-dialog-modal wire:model="open" class="w-auto">
        <x-slot name="title">
            Usuario {{ $user->id }}
        </x-slot>

        <x-slot name="content">

            <div class="flex max-w-7xl mx-auto">
                <div class="bg-white px-4 overflow-hidden sm:rounded-lg">

                    <form action="{{route('users.updatedate', ['user' => $user])}}" method="post">
                        @csrf
                        @method('PUT')
                        <label class="text-s font-semibold pt-2">Nombre:</label>
                        <input type="text" class="rounded py-1 w-full border-gray-400" id="name" name="name" value="{{ $user->name }}" required>

                        <label class="text-s font-semibold pt-2">Email:</label>
                        <input type="text" class="rounded py-1 w-full border-gray-400" id="email" name="email" value="{{ $user->email }}" required>

                        <label class="text-s font-semibold pt-2">N° Card:</label>
                        <input type="text" class="rounded py-1 w-full border-gray-400" id="ncard" name="ncard" value="{{ $user->ncard }}" required>

                        <label class="text-s font-semibold pt-2">Contraseña:</label>
                        <input type="text" class="rounded py-1 w-full border-gray-400" id="password" name="password" value="" placeholder="contraseña privada">
                        
                        <label class="text-s font-semibold pt-2">Dependencia</label>
                        <select class="rounded py-1 w-full border-gray-400" id="dependence_id" name="dependence_id" required> 
                            @foreach(\App\Models\Dependence::orderBy('name_dependence')->get() as $dependence)
                                <option value="{{$dependence->id}}" @if( $user->dependence_id  == $dependence->id) selected @endif>
                                    {{$dependence->name_dependence}}
                                </option>
                            @endforeach
                        </select>

                        <label class="text-s font-semibold pt-2">Cargo</label>
                        <select class="rounded py-1 w-full border-gray-400" id="charge_id" name="charge_id" required> 
                            @foreach(\App\Models\Charge::orderBy('name_charge')->get() as $charge)
                                <option value="{{$charge->id}}" @if($charge->id == $user->charge_id) selected @endif>
                                    {{$charge->name_charge}}
                                </option>
                            @endforeach
                        </select>

                        <div class="justify-right p-2">
                            <input type="submit" id="btnGuardar" class="bg-green-600 text-white rounded px-4 py-1" value="Guardar" onclick="desactivarBoton()">
                        </div>

                    </form>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>

    </x-dialog-modal>

</div>

<div>
    <!-- <x-buttonR wire:click="$set('open', true)"> -->
    <a href="#" class="bg-amber-700 text-white rounded flex p-2 w-8 h-8" wire:click="$set('open', true)" title="Editar Dependencia">        
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
            Dependencia 
            {{$dependence->id}}
        </x-slot>

        <x-slot name="content">

            <div class="flex max-w-7xl mx-auto">
                <div class="bg-white px-4 overflow-hidden sm:rounded-lg">

                    <form action="{{route('dependences.update', ['dependence'=>$dependence])}}" method="post">
                        @csrf
                        @method('PUT')
                        <label class="text-s font-semibold pt-2">Nombre:</label>
                        <input type="text" class="rounded py-1 w-full border-gray-400" id="name_dependence" name="name_dependence" value="{{ $dependence->name_dependence }}" required>

                        <label class="text-s font-semibold pt-2">pertenece a:</label>
                                         
                        

                        <select class="rounded py-1 w-full border-gray-400" id="belonging_to" name="belonging_to" required> 
                                <option value="">Seleccione</option>
                            @foreach(\App\Models\Dependence::orderBy('name_dependence')->get() as $depen)
                                <option value="{{$depen->id}}" @if( $depen->id  == $dependence->belonging_to) selected @endif>
                                    {{$depen->name_dependence}}
                                </option>
                            @endforeach
                        </select>



                        <label class="text-s font-semibold pt-2"></label>           

                        <div class="justify-right">
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
<div>

    <button wire:click="$set('open', true)" class="bg-teal-600 text-white rounded p-2 w-8 h-8 m-1" title="Visualizar">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
        </svg>
    </button>


    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex ">
                <div class="w-1/2 bg-blue-900 text-white p-4"> 
                    Información Personal
                </div>
                <div class="w-1/2 bg-blue-900 text-white p-4"> 
                    Información del Permiso
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex" >
                <div class="w-1/2 p-4 border border-blue-500 text-left"> 
                    <label class="block text-s font-semibold w-full text-black">Nombre: </label>{{ $pass->user->name }}
                    <label class="block text-s font-semibold w-full text-black">Codigo: </label>{{ $pass->user->ncard }}
                    <label class="block text-s font-semibold w-full text-black">Cargo: </label>{{ $pass->user->charge->name_charge }}
                    <label class="block text-s font-semibold w-full text-black">Dependencia: </label>{{ $pass->user->dependence->name_dependence }}
                    <label class="block text-s font-semibold w-full text-black">Motivo de salida: </label>{{ $pass->motive }}
                </div>
                <div class="w-1/2 p-4 border border-blue-500 text-left">
                    <p class="inline-block text-s font-semibold text-black" style="margin-bottom: 8px;">Lugar:&nbsp;</p><span>{{ $pass->place }}</span><br>
                    <p class="inline-block text-s font-semibold text-black" style="margin-bottom: 8px;">Tiempo autorizado:&nbsp;</p><span>{{ $pass->time->time_permision }}</span><br>
                    
    
                    <p class="inline-block text-s font-semibold text-black" style="margin-bottom: 8px;">Hora de Salida Registrada:&nbsp;</p>
                        @if ($departure->first() != null)
                            <span>{{ $departure->first()->hour_departure }}</span>
                        @else
                            <span>Sin hora de Salida</span>
                        @endif
                    
                    <br><p class="inline-block text-s font-semibold text-black" style="margin-bottom: 8px;">Hora de Retorno Registrada:&nbsp;</p>
                        @if ($return->first() != null)
                            @if ($return->first()->hour_return == '00:00:00')
                                <span>Sin hora de Retorno</span>
                            @else
                                <span>{{ $return->first()->hour_return }}</span>
                            @endif
                        @else
                            <span>Sin hora de Retorno</span>
                        @endif

                    <!--Seria posible que el guardar pueda registrar observaciones-->
                    
                    <br><p class="inline-block text-s font-semibold text-black" style="margin-bottom: 8px;">Fecha:&nbsp;</p><span>{{ $pass->date }}</span>

                    <div class="p-2 border border-blue-500 bg-blue-200">

                            <label class="block text-s font-semibold text-black">Observaciones: </label>
                            @if ($return->first() != null)
                                <span>{{ $return->first()->observation }}</span>
                            @else
                                <span>Sin observaciones </span>
                            @endif
                    
                    </div>
                </div>
            </div>
        </x-slot>


        <x-slot name="footer">
            {{ 'Información General de la Papeleta de Salida' }}
        </x-slot>
    </x-dialog-modal>
</div>


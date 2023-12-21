<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-2">
        
        <div class="max-w-7xl mx-auto sm:px-24 lg:px-24">
        <h1 class="font-bold text-center text-3xl mb-3">PAPELETA DE SALIDA N°{{$pass->id}}</h1>
            <div class="mx-auto md:flex md:justify-between p-3 bg-white shadow-xl sm:rounded-lg">
                
                <div class="pl-2 w-full text-gray-800">
                <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">DNI:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->user->ncard }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">CARGO:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->user->charge->name_charge }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">DEPENDENCIA/OFICINA:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->user->dependence->name_dependence }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">MOTIVO DE SALIDA:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->motive }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">LUGAR DE SALIDA:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->place }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">TIEMPO AUTORIZADO POR SU SUPERIOR:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->time->time_permision }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">HORA DE SALIDA:</label>
                            @if ($departure->first() != null)
                                <label class="block text-s text-gray-400 font-semibold">{{ $pass->departure_time->hour_departure }}</label>
                            @else
                                <span class="block text-s text-gray-400 font-semibold">Sin hora de Salida</span>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">HORA DE RETORNO:</label>
                            @if ($return->first() != null)
                                <label class="block text-s text-gray-400 font-semibold">{{ $pass->return_time->hour_return }}</label>
                            @else
                                <span class="block text-s text-gray-400 font-semibold">Sin hora de Retorno</span>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">OBSERVACIONES:</label>
                            @if ($return->first() != null)
                                <label class="block text-s text-gray-400 font-semibold">{{ $pass->return_time->observation }}</label>
                            @else
                                <span class="block text-s text-gray-400 font-semibold">Sin Observaciones</span>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">FECHA:</label>
                            <label class="block text-s text-gray-400 font-semibold">Puno, {{ \Carbon\Carbon::parse($pass->date)->locale('es')->format('j \d\e F \d\e Y') }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">INTERESADO:</label>
                            <label class="block text-s text-gray-400 font-semibold">{{ $pass->user->name }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">JEFE INMEDIATO:</label>
                            <label class="block text-s text-gray-400 font-semibold">Verificado por el jefe de {{ $pass->user->dependence->name_dependence }}</label>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <label class="block text-s font-semibold text-blue-500">VISTO BUENO DE ORRHH:</label>
                            <label class="block text-s text-gray-400 font-semibold"> Verificado por el JEFE DE LA OFICINA DE RECURSOS HUMANOS</label>
                        </div>
                    </div>

                <div class=" flex justify-end">
                    <a href="{{ route('archived.index') }}" class="bg-blue-800 text-white rounded px-3 py-2 mx-2 my-auto">Atras</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

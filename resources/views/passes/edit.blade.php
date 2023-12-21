<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Papeletas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-24 lg:px-24">
       
            <div class="bg-white pt-5 px-4 overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('passes.update', $pass) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="text-s font-semibold">Motivo de Salida:</label>
                    <input type="text" class="rounded py-1 w-full border-gray-400" name="motive" value="{{ $pass->motive }}">

                    <label class="text-s font-semibold">Lugar de Salida:</label>
                    <input type="text" class="rounded py-1 w-full border-gray-400" name="place" value="{{ $pass->place }}">

                    <div class="opacity-80 h-px mt-4 md:mb-4" style="background: linear-gradient(to right, rgba(200, 200, 200, 0) 0%, rgba(200, 200, 200, 1) 30%, rgba(200, 200, 200, 1) 70%, rgba(200, 200, 200, 0) 100%);"></div>
                    <div class="container px-5 gap-5 md:flex md:w-full">
                        <div class="container w-full">
                            <label class="text-s font-semibold">Tiempo Autorizado:</label>
                            <input type="time" class="rounded py-1 w-full border-gray-400" name="time" value="{{ $pass->time }}">

                            <label class="text-s font-semibold">Hora de Salida Registrada:</label>
                            <input type="time" class="rounded py-1 w-full border-gray-400 text-gray-500" name="input" value="{{ $pass->input}}">

                            <label class="text-s font-semibold">Hora de ingreso registros:</label>
                            <input type="time" class="rounded py-1 w-full border-gray-400 text-gray-500" name="output" value="{{ $pass->output }}">
                        </div>
            

                    </div>
                    <div class="opacity-80 h-px mt-4 md:mb-4" style="background: linear-gradient(to right, rgba(200, 200, 200, 0) 0%, rgba(200, 200, 200, 1) 30%, rgba(200, 200, 200, 1) 70%, rgba(200, 200, 200, 0) 100%);"></div>
                    <div class="flex px-5 justify-between items-center pb-5">
                        <div class="w-1/2">
                            <label class="text-s font-semibold">Fecha</label>
                            <input type="date" class="md:rounded py-1 w-full border-gray-400" name="date" value="{{ $pass->date }}">
                        </div>
                        <div class="justify-end">
                            <input type="submit" class="bg-green-600 text-white rounded px-4 py-1" value="Guardar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

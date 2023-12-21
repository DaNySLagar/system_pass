<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl leading-tight font-bold">
            Editar Dependencia
        </h2>
    </x-slot>

    <form action="{{ route('dependences.update', $dependence) }}" method="POST" class="max-w-md">
    @csrf 
    @method('PUT')
    <div class="pt-10 pl-10">
        <label for="" class="text-s font-semibold text-gray-900">Modifique la Dependencia:</label>
        <input type="text" name="name_dependence" class="md:rounded py-1 w-1/2 border-gray-400" value="{{ $dependence->name_dependence }}">
        <hr>
        <input type="submit" class="bg-green-600 text-white rounded px-4 py-1 mt-5" value="Guardar">
    </div>
    </form>  
</x-app-layout>
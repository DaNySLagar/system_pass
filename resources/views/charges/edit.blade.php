<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl leading-tight font-bold">Editar Cargo</h2>
    </x-slot>

    <form action="{{ route('charges.update', $charge) }}" method="POST" class="max-w-md">
    @csrf 
    @method('PUT')
    <div class="p-10">
        <label for="" class="text-s font-semibold text-gray-900">Modifique el Cargo:</label>
        <input type="text" name="name_charge" class="md:rounded py-1 w-1/2 border-gray-400" value="{{ $charge->name_charge }}">
        <hr>
        <input type="submit" class="bg-green-600 text-white rounded px-4 py-1 mt-5" value="Editar">
    </div>    
    </form>  
</x-app-layout>
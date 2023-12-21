<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 text-xl leading-tight font-bold">Editar Tiempo</h2>
    </x-slot>

    <form action="{{ route('times.update', $time) }}" method="POST" class="max-w-md">
    @csrf
    @method('PUT')
    <div class="p-10">
        <label for="" class="text-s font-semibold text-gray-900">Cambie el Tiempo:</label>
        <input type="text" name="time_permision" class="md:rounded py-1 w-1/2 border-gray-400" value="{{ $time->time_permision }}">
        <hr>
        <input type="submit" class="bg-green-600 text-white rounded px-4 py-1 mt-5" value="Editar">
    </div>
    </form>
</x-app-layout>

<div>
    <label class="text-s font-bold">Fecha: </label>
    <input
        type="date"
        name="date"
        class="rounded border-gray-400 w-full"
        min="{{ now()->format('Y-m-d') }}" required
        value="{{ \Carbon\Carbon::parse($currentDate)->format('Y-m-d') }}">
</div>

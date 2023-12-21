<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Asignar un rol
        </h2>
    </x-slot>

    <div class="overflow-x-auto  bg-white rounded-lg  p-2 m-2 ">

            <div class="overflow-hidden shadow-xl rounded-lg   mx-auto">

                @if (session('info'))
                    <div>
                        <strong>{{ session('info') }}</strong>
                    </div>
                @endif
                <div class="mx-auto">
                    <div class="px-5 py-2 mx-auto ms:px-10">
                        <p class="text-l text-blue-500 uppercase"> <strong>Nombre del personal</strong> </p>
                        <p class="text-black-500">{{ $user->name }}</p><br>
                        <h2 class="text-l text-blue-500 uppercase"><strong>Listado de Roles</strong></h2>
                        {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}
                        @foreach ($roles as $role)
                            <div>
                                <label>
                                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'checked:bg-principal rounded']) !!}
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach

                        {!! Form::submit('Asignar Rol', ['class' => 'my-2 bg-principal px-2 rounded text-gray-50']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>

    </div>
</x-app-layout>

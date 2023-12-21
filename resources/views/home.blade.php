<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- para el css/ en esta version de laravel con el archivo vite.config,js -->
    <title>Papeletas</title>
</head>
<body class="bg-gray-100 w-full h-full">
    <div class="bg-principal w-full">
        <div class="flex">
            <div class="py-3 mx-auto">
                <img src="{{ asset('images/LOGO-GORE2.png') }}" class="h-20" alt="logo">
            </div>
        </div>
    </div>
        <main class="w-full">
            <div class="w-full">
                <div class="w-1/2 flex mt-12 border-2 border-gray-400 rounded-lg mx-auto">
                    <div class="flex flex-col space-y-5 py-16 mx-10">
                        <a href="{{ url('login') }}" class="w-32 rounded-full text-xl text-gray-50 shadow-sm font-semibold pl-6 py-2 border border-gray-500 bg-principal hover:bg-white hover:text-principal">Ingresar</a>
                        <a href="{{ url('register') }}" class="w-32 rounded-full text-xl text-gray-50 shadow-sm font-semibold pl-6 py-2 border border-gray-500 bg-principal hover:bg-white hover:text-principal">Registro</a>
                    </div>
                    <div class="w-1/2 flex py-12">
                        <p class="text-gray-700 mx-auto">
                            <strong class="text-2xl text-principal">Pass</strong>
                            <br>
                            <strong>Sistema de Papeletas de Salida, agiliza tus permisos de salida.</strong>
                        </p>
                    </div>
                </div>

            </div>
        </main>
</body>
</html>

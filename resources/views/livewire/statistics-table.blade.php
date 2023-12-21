 <div class="">
        <div class="">
            
            <div class="bg-white overflow-hidden"><br>

                    @can('dashboard')

                    <div class="flex">

                        @if(in_array('Empleado', $roleNames) || in_array('JefeOficina', $roleNames) || in_array('JefeRrHh', $roleNames))

                            <select wire:model="roleName" class="rounded-lg border-none ml-2 mr-2 bg-gray-100" >

                                @if(in_array('Empleado', $roleNames))
                                    <option value="Empleado">Mi Estadística</option>
                                @endif

                                @if(in_array('JefeOficina', $roleNames))
                                    <option value="JefeOficina">Estadística de Oficina</option>
                                @endif

                                @if(in_array('JefeRrHh', $roleNames))
                                    <option value="JefeRrHh">Estadística de Empleados</option>
                                @endif
                                
                            </select>
                        @endif

                        
                        @livewire('reporte')

                    </div>   
                            

                        
            
                        
                
                        <div class="w-full mx-auto mt-2 p-2">
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">

                            @if($roleName == 'Empleado' || $roleName == 'JefeRrHh' || $roleName == 'JefeOficina')

                                <div class="bg-white rounded-lg border p-4 col-span-3">
                                    <canvas id="chart1">
                                    </canvas>
                                </div>

                                <div class="bg-white rounded-lg border p-4 col-span-1">

                                    @if($roleName == 'Empleado' || $roleName == 'JefeRrHh' || $roleName == 'JefeOficina')
                                            <h1 class="text-center text-blue-900 p-2">Cantidad de Horas Solicitadas</h1>
                                            <h2 class="text-center border rounded-lg border-gray-300 p-4"> {{ $sumaFormateada }} </h2>

                                    @endif

                                    @if ($roleName == 'JefeRrHh' || $roleName == 'JefeOficina')
                                            <h1 class="text-center text-blue-800 p-2">Personal Frecuente</h1>
                                            <div class="w-full max-w-md mx-auto bg-white p-4 rounded-lg border">
                                                <h3 class="text-center text-sm border-b-2 border-black">Cantidad de Papeletas</h3>

                                                <ol class="list-disc space-y-2 p-2">
                                                    @foreach ($usersData as $user)
                                                    <li>
                                                        <div class="flex justify-between items-center text-sm">
                                                            <span class="texto-emergente" data-texto-emergente="{{ $user->name_dependence }}">{{ $user->name }}</span>
                                                            <span class="text-blue-500">{{ $user->papeletas_solicitadas }}</span>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                    @endif

                                </div>
                            
                            @else
                                <div class="bg-white rounded-lg border p-6 col-span-4">
                                    <canvas id="chart1">
                                    </canvas>
                                </div>
                            
                            @endif

                            </div>
                        </div>
                        

                        <div class="full justify-center items-center" >
                            <div class="bg-gradient-to-r from-blue-700 to-sky-900 shadow-lg p-6">

                                <div class="px-2">
                                    <h2 class="text-white font-semibold mb-2 font-serif">ESTIMADO USUARIO</h2><br>
                                    <li class="text-white mb-4 font-sans">
                                        Si usted solicita una Papeleta de Salida antes de hacer uso o salir del lugar de trabajo es de crucial importancia
                                        que la papeleta cuente con la aprobación del Jefe de Oficina y Jefe de Recursos Humanos.
                                    </li>
                                    <li class="text-white mb-4 font-sans">
                                        Las observaciones que recibe su papeleta ya sea por Rechazo u otro podrá visualizarlo con las opciones que tienen los registros
                                        de papeletas que usted a generado.
                                    </li>
                        
                                    <div class="alert alert-secondary text-center" role="alert">
                                        <b>No se olvide de apersonarse al Guardian para su registro, Gracias por su comprensión.</b>
                                    </div>
                                

                                </div>
                            </div>
                        </div>  
       
                    
                    @else

                        <div class="w-3/2 mx-auto pt-4 pl-5 pr-5 pb-5 ">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                <div class="rounded-lg border ">
                                    
                                    <div class="flex justify-center items-center" >
                                        <div class="bg-gradient-to-r from-blue-700 to-sky-900 rounded-lg shadow-lg p-6 flex">

                                            <div class="px-2">
                                                <h2 class="text-white font-semibold mb-2 font-serif">ESTIMADO USUARIO</h2><br>
                                                <p class="text-white mb-4 font-sans">Si es la PRIMERA vez que ingresas al sistema, es necesario solicitar ACCESO
                                                    para Poder y Empezar a solictar las PAPELETAS de SALIDA
                                                </p>
                                                <p class="text-white mb-4 font-sans">
                                                    Para solicitar acceso apersónate a la OFICINA DE TECNOLOGIAS DE INFORMACIÓN Y COMUNICACIONES
                                                    ubicado en la Cede Central - 2° Piso
                                                </p>
                                    
                                                <div class="alert alert-secondary text-center" role="alert">
                                                    <b>Si tiene cosigo documentos que acrediten su labor no olvide de traerlos, Gracias por su comprensión.</b>
                                                </div>
                                            

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="bg-white rounded-lg border p-4">
                                    <h5 class="text-blue-500 font-bold"><i class="fa fa-map-marker"></i> Ubicación (Sede Central):</h5>
                                    <p class="mt-2">Jr Deustua Nº 356 - Puno</p>
                                    <p>Plaza de Armas</p>

                                    <h5 class="text-blue-500 font-bold mt-4"><i class="fa fa-clock-o"></i> Horario de Atención:</h5>
                                    <p class="mt-2">Lunes a Viernes de 8:30 am. a 4:30 pm.</p>

                                    <h5 class="text-blue-500 font-bold mt-4"><i class="fa fa-envelope-o"></i> Correo Electronico:</h5>
                                    <p class="mt-2">gobernacion@regionpuno.gob.pe</p>

                                    <h5 class="text-blue-500 font-bold mt-4"><i class="fa fa-address-card"></i> Número de contacto:</h5>
                                    <p class="mt-2">(051) 354000</p>
                                </div>

                            </div>
                        </div>

                
                    @endcan       


            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        
        <script>

    
            var ctx1 = document.getElementById('chart1').getContext('2d');
            var userChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!}
                },
            });

              
        </script>


        <style>
            .texto-emergente {
                position: relative;
                display: inline-block;
            }

            .texto-emergente:hover::after {
                content: attr(data-texto-emergente);
                position: absolute;
                background-color: #f0f0f0;
                padding: 5px;
                font-size: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
                top: 100%;
                left: 0;
                width: 200px;
                z-index: 1;
            }
        </style>


    </div>



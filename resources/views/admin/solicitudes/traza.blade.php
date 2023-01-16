<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modulo de Segumiento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="pdf" class="card">
                            <div class="card-header">
                                <p>Segumiento de Solicitude la Solicitud ID: <strong>{{ $solicitud_id }}</strong></p>
                                <p>Usuario: <strong>{{ $datos_usuario->nombre }}</strong></p>
                                <p>Email: <strong>{{ $datos_usuario->correo }}</strong></p>
                                <p>Cedula: <strong>{{ $datos_usuario->cedula }}</strong></p>
                                <p>Fecha de creacion del Usuario: <strong>{{ $datos_usuario->creado }}</strong>
                                @if($credencial !== null)
                                <p>Credencial: <strong>{{ $credencial->ncredencial }}</strong></p>
                                <p>Validad hasta: <strong>{{ $credencial->fcredencial }}</strong></p>
                                @else
                                <p><strong>Sin credencial</strong></p>
                                @endif
                            </div>
                        @if(count($trazas) <= 0)
                            <div class="card-header">
                                No se encontraron trazas de la solicitud
                            </div>
                        @else
                         <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Evaluador</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trazas as $traza)
                                <tr>
                                    <td>{{ $traza->created_at }}</td>
                                    <td>{{ $traza->estatus_name  }}</td>
                                    <td>{{ $traza->usuario_name  }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="flex space-x-2 justify-center mt-10">
                        <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Exportar traza</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

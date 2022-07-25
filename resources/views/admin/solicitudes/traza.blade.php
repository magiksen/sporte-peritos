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
                    <div class="card">
                        @if(count($trazas) <= 0)
                            <div class="card-header">
                                No se encontraron trazas de la solicitud
                            </div>
                        @else
                        <div class="card-header">
                            <p>Segumiento de Solicitude la Solicitud ID: <strong>{{ $solicitud_id }}</strong></p>
                            <p>Usuario: <strong>{{ $datos_usuario->nombre }}</strong></p>
                            <p>Email: <strong>{{ $datos_usuario->correo }}</strong></p>
                            <p>Cedula: <strong>{{ $datos_usuario->cedula }}</strong></p>
                            <p>Fecha: <strong>{{ $datos_usuario->creado }}</strong></p>
                        </div>

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
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

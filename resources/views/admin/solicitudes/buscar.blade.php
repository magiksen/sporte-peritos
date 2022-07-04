<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
                
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Solicitudes</div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Estatus Solicitud</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitudes as $solicitud)
                                <tr>
                                    <th scope="row">{{ $solicitud->id }}</th>
                                    <td>{{ $solicitud->nombe_usuario }}</td>
                                    <td>{{ $solicitud->descripcion }}</td>
                                    @if($solicitud->estado_solicitud == true)
                                    <td>Activo</td>
                                    @else
                                    <td>No activo</td>
                                    @endif
                                    <td>{{ Carbon\Carbon::parse($solicitud->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ url('solicitudes/estatus/'.$solicitud->id) }}" class="btn btn-warning">Cambia Estatus Solicitud</a>
                                        <a href="" class="btn btn-success">Cambia Estado
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

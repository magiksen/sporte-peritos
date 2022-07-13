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
                        @if(count($solicitudes) <= 0)
                        <div class="card-title">
                            No se encontraron solicitudes
                        </div>
                        @else
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
                                        <a href="{{ url('solicitudes/estatus/'.$solicitud->id) }}" class="btn btn-outline-primary">Estatus Solicitud</a>
                                        <a href="{{ url('solicitudes/profesion/'.$solicitud->id) }}" class="btn btn-outline-primary">Profesion </a>
                                        <a href="{{ url('solicitudes/especialidad/'.$solicitud->id) }}" class="btn btn-outline-primary">Especialidad </a>
                                        <a href="{{ url('solicitudes/recaudos/'.$solicitud->id) }}" class="btn btn-outline-primary">Recaudos</a>
                                    </td>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            <div class="row">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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
                                        <a href="{{ url('solicitudes/estatus/'.$solicitud->id) }}" class="btn btn-outline-primary mb-2">Estatus Solicitud</a>
                                        <a href="{{ url('solicitudes/profesion/'.$solicitud->id) }}" class="btn btn-outline-primary mb-2">Profesion </a>
                                        <a href="{{ url('solicitudes/experiencia/'.$solicitud->id) }}" class="btn btn-outline-primary mb-2">Experiencia </a>
                                        <a href="{{ url('solicitudes/especialidad/'.$solicitud->id) }}" class="btn btn-outline-primary mb-2">Especialidad </a>
                                        <a href="{{ url('solicitudes/recaudos/'.$solicitud->id) }}" class="btn btn-outline-primary mb-2">Recaudos</a>
                                        <a href="{{ route('solicitud.traza', $solicitud->id ) }}" class="btn btn-warning mb-2">Traza</a>
                                        <a href="{{ url('solicitudes/eliminar/'.$solicitud->id) }}" class="btn btn-danger mb-2">Eliminar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        <div class="card-footer">
                            <a href="{{ route('dashboard') }}" class="btn btn-danger">Volver</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

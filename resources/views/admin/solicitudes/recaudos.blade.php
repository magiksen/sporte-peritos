<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo Solicitudes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">Recaudos</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Recaudo</th>
                                <th scope="col">Aprobado</th>
                                <th scope="col">Corrección</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recaudos as $recaudo)
                                <tr>
                                    <td>{{ $recaudo->id }}</td>
                                    <th scope="row">{{ $recaudo->id_recaudo }}</th>
                                    <td>{{ $recaudo->descripcion }}</td>
                                    @if($recaudo->aprobado)
                                    <td>Si</td>
                                    @else
                                    <td>No</td>
                                    @endif
                                    <td>{{ $recaudo->correccion }}</td>
                                    <td>
                                        <a href="{{ url('solicitudes/recaudos/habilitar/'.$recaudo->id) }}" class="btn btn-info">Habilitar</a>
                                        <a href="{{ url('solicitudes/recaudos/eliminar/'.$recaudo->id) }}" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Agregar Recaudo</div>
                        <div class="card-body">
                            <form action="{{ route('store.recaudo') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <select class="form-select" name="recaudo" id="recaudo">
                                        @foreach($nombres_recaudos as $nrecaudo)
                                            <option value="{{ $nrecaudo->id }}">{{ $nrecaudo->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="solicitud" id="solicitud" value="{{ $id_solicitud }}">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="usuario" id="usuario" value="{{ $id_usuario->id_usuario }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

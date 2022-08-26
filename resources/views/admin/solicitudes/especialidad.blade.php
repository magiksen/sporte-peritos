<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo Solicitudes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row" style="margin-bottom: 50px;">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Editar Especialidades de la solicitud #{{ $id_solicitud }}</div>
                        <div class="card-body">
                            <div class="card-title">
                                @if($especialidades->isNotEmpty())
                                <p class="text-lg text-white bg-gray-900 py-2 px-2">Especialidades Actuales</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Especialidad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($especialidades as $especialidad)
                                        <tr>
                                            <th scope="row">{{ $especialidad->id_especialidad }}</th>
                                            <td>{{ $especialidad->especialidad_descripcion }}</td>
                                            <td>
                                                <a href="{{ url('solicitudes/especialidad/eliminar/'.$especialidad->id) }}" class="btn btn-danger">Eliminar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p class="text-lg text-white bg-red-900 py-2 px-2">No hay especialidades registradas para esta solicitud</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Volver</a>
                        </div>
                    </div>
                </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Agregar Nueva Especialidad</div>
                            <div class="card-body">
                                <form action="{{ url('solicitudes/especialidad/agregar/'.$id_solicitud) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nueva_especialidad_id" class="form-label">ID nueva Especialidad</label>
                                        <input type="text" class="form-control" name="nueva_especialidad_id" id="nueva_especialidad_id" required>
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

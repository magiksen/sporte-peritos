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

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Editar Especialidad de la solicitud #{{ $id_solicitud }}</div>
                        <div class="card-body">
                            <div class="card-title">Especialidad Actual: {{ $especialidad->id_especialidad }} - {{ $especialidad->especialidad_descripcion }}  </div>
                            <form action="{{ url('solicitudes/especialidad/cambiar/'.$especialidad->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nueva_especialidad_id" class="form-label">ID nueva Especialidad</label>
                                    <input type="text" class="form-control" name="nueva_especialidad_id" id="nueva_especialidad_id" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Cambiar</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Volver</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

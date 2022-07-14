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
                        <div class="card-header">Cambiar Estatus Solicitud #{{ $id_solicitud }}</div>
                        <div class="card-title">Estatus Actual: {{ $estatu->estatus_descripcion }}</div>
                        <div class="card-body">
                            <form action="{{ url('solicitudes/estatus/cambiar/'.$estatu->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nuevo_estatus" class="form-label">Nuevo Estatus</label>
                                    <select name="nuevo_estatus" id="nuevo_estatus">
                                        @foreach($estatus as $estatu)
                                            <option value="{{ $estatu->id }}">{{ $estatu->descripcion }}</option>
                                        @endforeach
                                    </select>
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

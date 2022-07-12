<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo Especialidades
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
                        <div class="card-header">Editar descripción de la especialidad</div>
                        <div class="card-body">
                            <div class="card-title">Especialidad ID: {{ $especialidades->id }} </div>
                            <form action="{{ url('especialidades/cambiar/'.$especialidades->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nueva_descripcion" class="form-label">Nueva Descripcion</label>
                                    <input type="text" class="form-control" name="nueva_descripcion" id="nueva_descripcion" value="{{ $especialidades->descripcion }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Cambiar</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Volver</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

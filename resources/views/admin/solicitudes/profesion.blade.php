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
                        <div class="card-header">Editar profesion de la solicitud</div>
                        <div class="card-body">
                            <div class="card-title">Profesión Actual: {{ $profesion->id_profesions }} - {{ $profesion->descripcion }}  </div>
                            <form action="{{ url('solicitudes/profesion/cambiar/'.$profesion->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nueva_profesion_id" class="form-label">ID nueva profesion</label>
                                    <input type="text" name="nueva_profesion_id" id="nueva_profesion_id" >
                                </div>
                                <div class="mb-3">
                                    <label for="nueva_profesion" class="form-label">Nueva Descripcion Profesion</label>
                                    <input type="text" name="nueva_profesion" id="nueva_profesion" >
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Especialidades Registradas
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
                        <div class="card-header">Especialidades</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($especialidades as $especialidad)
                                <tr>
                                    <th scope="row">{{ $especialidades->firstItem()+$loop->index }}</th>
                                    <td>{{ $especialidad->id }}</td>
                                    <td>{{ $especialidad->descripcion }}</td>
                                    @if($especialidad->activo)
                                        <td>Activo</td>
                                    @else
                                        <td>No activo</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('especialidades/editar/'.$especialidad->id) }}" class="btn btn-info">Editar</a>
                                        <a href="{{ url('especialidades/eliminar/'.$especialidad->id) }}" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $especialidades->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Agregar Especialidad</div>
                        <div class="card-body">
                            <form action="{{ route('store.especialidad') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="especialidad_nombre" class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" id="especialidad_nombre"
                                           name="especialidad_nombre">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

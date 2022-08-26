<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Profesiones Registradas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="px-4 mx-auto flex justify-center mt-10">
                    <form method="GET">
                        <div class="mb-3">
                            <input type="text" name="search" value="{{ request()->get('search') }}" class="rounded border-gray-800 mb-4"
                                   placeholder="Buscar..." aria-label="Search" aria-describedby="button-addon2">
                            <button class="bg-blue-800 text-white rounded px-4 py-2 inline" type="submit" id="button-addon2">Buscar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">Profesiones</div>
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
                            @foreach($profesiones as $profesion)
                                <tr>
                                    <th scope="row">{{ $profesiones->firstItem()+$loop->index }}</th>
                                    <td>{{ $profesion->id }}</td>
                                    <td>{{ $profesion->descripcion }}</td>
                                    @if($profesion->activo)
                                        <td>Activo</td>
                                    @else
                                        <td>No activo</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('profesiones/editar/'.$profesion->id) }}" class="btn btn-info">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $profesiones->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Agregar Profesion</div>
                        <div class="card-body">
                            <form action="{{ route('store.profesion') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="profesion_nombre" class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" id="profesion_nombre"
                                           name="profesion_nombre">
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

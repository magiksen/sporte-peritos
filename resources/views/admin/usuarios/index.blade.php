<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo Usuarios
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Buscar Usuario</div>
                        <div class="card-body">
                            <form action="{{ route('buscar.usuarios') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="buscar_name" class="form-label">Buscar por:</label>
                                    <select class="form-select" name="buscar_name" id="buscar_name">
                                        <option value="nombre">Nombre</option>
                                        <option value="cedula">Cedula</option>
                                        <option value="correo">Correo</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="usuario_name" class="form-label">Busquedad</label>
                                    <input type="text" class="form-control" id="usuario_name" name="usuario_name" placeholder="Ingrese la busquedad">
                                </div>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
                
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if($buscar == true)
                        <div class="card-header">Resultado de usuario</div>

                        {{-- <div>{{ var_dump($resultado) }}</div> --}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{-- @php($i = 1) --}}
                                @foreach($resultado as $usuario)
                                <tr>
                                    <th scope="row">{{ $usuario->id }}</th>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->username }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->cedula }}</td>
                                    <td>{{ Carbon\Carbon::parse($usuario->created_at)->format('d-m-Y') }}</td>
                                    @if($usuario->status == true)
                                    <td>Activo</td>
                                    @else
                                    <td>No activo</td>
                                    @endif
                                    <td>
                                        <a href="" class="btn btn-info">Solicitudes</a>
                                        @if($usuario->status == false)
                                        <a href="" class="btn btn-success">Activar</a>
                                        @endif
                                        <a href="{{ url('contrasena/'.$usuario->id) }}" class="btn btn-warning">Contraseña</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    @endif
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

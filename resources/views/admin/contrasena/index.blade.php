<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row" style="margin-bottom: 50px;">

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Cambiar Contraseña</div>
                        <div class="card-body">
                            <form action="{{ url('contrasena/update/'.$usuario->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nueva_contra" class="form-label">Contraseña</label>
                                    <input type="text" class="form-control" id="nueva_contra" name="nueva_contra" placeholder="Ingrese la nueva contraseña">
                                </div>
                                <button type="submit" class="btn btn-primary">Cambiar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

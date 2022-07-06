<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Profesiones Registradas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
                
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Profesiones</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($profesiones as $profesion)
                                <tr>
                                    <th scope="row">{{ $profesion->id }}</th>
                                    <td>{{ $profesion->descripcion }}</td>
                                    @if($profesion->activo == true)
                                    <td>Activo</td>
                                    @else
                                    <td>No activo</td>
                                    @endif
                                </tr>    
                                @endforeach
                            </tbody>
                        </table>
                        {{ $profesiones->links() }}
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

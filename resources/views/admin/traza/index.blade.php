<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modulo de Segumiento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Segumiento de Solicitudes</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID Solicitud</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Evaluador</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trazas as $traza)
                                    <tr>
                                        <th scope="row">{{ $traza->id_perito_solicitud }}</th>
                                        <td>{{ $traza->estatus_name  }}</td>
                                        <td>{{ $traza->usuario_name  }}</td>
                                        <td>{{ Carbon\Carbon::parse($traza->created_at)->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        {{ $trazas->links() }}
                     </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Reporte de Traza</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
        span {
            font-weight: bold;
        }
    </style>
</head>
<body>

<table class="order-details">
    <thead>
    <tr>
        <th width="40%" colspan="2">
            <h2 class="text-start">{{ $datos_usuario->nombre }}</h2>
        </th>
        <th width="60%" colspan="2" class="text-end company-data">
            <span>Solicitud Id: {{ $solicitud_id }}</span> <br>
            <span>Email: {{ $datos_usuario->correo }}</span> <br>
            <span>Cédula : {{ $datos_usuario->cedula }}</span> <br>
            <span>Fecha de creación del usuario: {{ $datos_usuario->creado }}</span> <br>
            @if($credencial !== null)
            <span>Credencial : {{ $credencial->ncredencial }}</span> <br>
            <span>Caducidad de la Credencial : {{ $credencial->fcredencial }}</span> <br>
            @else
                <p><strong>Sin credencial</strong></p>
            @endif
        </th>
    </tr>
    </thead>
</table>

<table>
    <thead>
    <tr>
        <th class="no-border text-start heading" colspan="5">
            Traza de la solicitud
        </th>
    </tr>
    <tr class="bg-blue">
        <th>Fecha</th>
        <th>Estado</th>
        <th>Evaluador</th>
    </tr>
    </thead>
    <tbody>

    @foreach($trazas as $traza)
        <tr>
            <td>{{ $traza->created_at }}</td>
            <td>{{ $traza->estatus_name }}</td>
            <td>{{ $traza->usuario_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<br>
<p class="text-center">
    <strong>Sistema de soporte de Peritos</strong>
</p>

</body>
</html>

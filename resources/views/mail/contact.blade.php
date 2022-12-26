<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table, th, td{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Contacto desde el sitio web</h2>
    <div>
        <p><strong>Nombre:</strong>  {{ $data['nombre'] }}  </p>
        <p><strong>Email:</strong>  {{ $data['email'] }} </p>
        @if (isset($data['telefono']))
            <p><strong>Teléfono:</strong>  {{ $data['telefono'] }} </p>
        @endif
        @if (isset($data['compania']))
            <p><strong>Empresa:</strong>  {{ $data['compania'] }} </p>
        @endif   
        <p><strong>Mensaje:</strong>  {{ $data['mensaje'] }} </p>    
    </div>    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Felicidades! Eres el ganador del concurso</title>
</head>
<body>
    <h1>¡Felicidades!</h1>
    <p>Eres el ganador del concurso. Aquí están tus detalles:</p>
    <ul>
        <li>Nombre: {{ $ganador->nombre }}</li>
        <li>Apellido: {{ $ganador->apellido }}</li>
        <li>Cédula: {{ $ganador->cedula }}</li>
        <li>Departamento: {{ $ganador->departamento }}</li>
        <li>Ciudad: {{ $ganador->ciudad }}</li>
        <li>Celular: {{ $ganador->celular }}</li>
        <li>Correo Electrónico: {{ $ganador->correo_electronico }}</li>
        <li>Habeas Data: {{ $ganador->habeas_data ? 'Sí' : 'No' }}</li>
    </ul>
    <p>¡Felicidades de nuevo y disfruta de tu premio!</p>
</body>
</html>

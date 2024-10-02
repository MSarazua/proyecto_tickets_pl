<!DOCTYPE html>
<html>
<head>
    <title>Nueva solicitud asignada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nueva solicitud asignada</h1>
        </div>
        <div class="content">
            <p>Se le ha asignado una nueva solicitud con el título: <strong>{{ $requirement->requirement_title }}</strong>.</p>
            <p>Descripción: {{ $requirement->description }}</p>
        </div>
        <div class="footer">
            <p>Este es un correo generado automáticamente, por favor no respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html>

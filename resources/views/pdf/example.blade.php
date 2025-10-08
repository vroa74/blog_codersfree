<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .content {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>
    
    <div class="content">
        <p>{{ $content }}</p>
        <p>Este PDF fue generado usando DomPDF en Laravel.</p>
    </div>
    
    <div class="footer">
        <p>Generado el: {{ $date }}</p>
    </div>
</body>
</html>

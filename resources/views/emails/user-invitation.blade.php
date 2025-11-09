<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #2c4a6b 0%, #1e3449 100%);
            color: white;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            background: #FCC200;
            color: #2c4a6b;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenido!</h1>
        </div>
        <div class="content">
            <p>Hola {{ $user->first_name }},</p>
            
            <p>Has sido invitado a unirte a <strong>{{ $cliente->name }}</strong> en nuestro sistema de gestión de obras.</p>
            
            <p>Para aceptar la invitación y establecer tu contraseña, haz clic en el siguiente botón:</p>
            
            <div style="text-align: center;">
                <a href="{{ $invitationUrl }}" class="button">Aceptar Invitación</a>
            </div>
            
            <p><small>O copia y pega este enlace en tu navegador:</small></p>
            <p style="word-break: break-all; color: #6b7280; font-size: 12px;">{{ $invitationUrl }}</p>
            
            <p><strong>⚠️ Este enlace expira en 60 minutos.</strong></p>
            
            <p>Si no esperabas esta invitación, puedes ignorar este correo.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Sistema de Gestión de Obras</p>
        </div>
    </div>
</body>
</html>
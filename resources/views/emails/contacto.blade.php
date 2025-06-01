<div style="max-width: 600px; margin: 30px auto; padding: 25px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); color: #333;">
    <h2 style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px;">Mensaje de Contacto</h2>

    <div style="margin-bottom: 15px;">
        <strong>Nombre:</strong>
        <span>{{ $name }}</span>
    </div>

    <div style="margin-bottom: 15px;">
        <strong>Email:</strong>
        <span><a href="mailto:{{ $email }}" style="color: #007bff; text-decoration: none;">{{ $email }}</a></span>
    </div>

    <div style="margin-bottom: 15px;">
        <strong>Asunto:</strong>
        <span>{{ $subject }}</span>
    </div>

    <div>
        <strong>Mensaje:</strong>
        <p style="background-color: #fff; border: 1px solid #ddd; padding: 15px; border-radius: 6px; line-height: 1.5; white-space: pre-wrap;">{{ $mensaje }}</p>
    </div>
</div>

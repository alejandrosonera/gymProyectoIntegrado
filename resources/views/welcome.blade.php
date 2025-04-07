<x-app-layout>
    <x-self.base>
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife Gym</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('/placeholder.svg?height=800&width=1600');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .section-padding {
            padding: 80px 0;
        }
        
        .bg-dark-gradient {
            background: linear-gradient(to right, #1a1a1a, #333333);
        }
        
        .trainer-card {
            transition: transform 0.3s;
        }
        
        .trainer-card:hover {
            transform: translateY(-10px);
        }
        
        .class-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .class-card:hover {
            transform: scale(1.03);
        }
        
        .testimonial-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 10px;
        }
        
        .price-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .price-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .price-card .card-header {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .footer {
            background-color: #212529;
            color: white;
            padding: 50px 0 20px;
        }
        
        .social-icons i {
            font-size: 1.5rem;
            margin-right: 15px;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .social-icons i:hover {
            color: #ff4500;
        }
        
        .btn-primary {
            background-color: #ff4500;
            border-color: #ff4500;
        }
        
        .btn-primary:hover {
            background-color: #e03d00;
            border-color: #e03d00;
        }
        
        .text-primary {
            color: #ff4500 !important;
        }
        
        .bg-primary {
            background-color: #ff4500 !important;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-4">TRANSFORMA TU CUERPO, <span class="text-primary">TRANSFORMA TU VIDA</span></h1>
                    <p class="lead mb-4">Únete a nuestra comunidad fitness y alcanza tus objetivos con entrenadores profesionales y equipamiento de última generación.</p>
                    <div class="d-flex gap-3">
                        <a href="#pricing" class="btn btn-primary btn-lg">Comenzar Ahora</a>
                        <a href="#about" class="btn btn-outline-light btn-lg">Conoce Más</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="/placeholder.svg?height=600&width=800" alt="Interior del gimnasio" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <div class="ps-md-4">
                        <h6 class="text-primary">SOBRE NOSOTROS</h6>
                        <h2 class="mb-4">Más que un gimnasio, somos una familia</h2>
                        <p class="lead">En FitLife Gym, nos dedicamos a ayudarte a alcanzar tu mejor versión física y mental a través del ejercicio y un estilo de vida saludable.</p>
                        <p>Fundado en 2010, nuestro gimnasio ha crecido hasta convertirse en un referente en la ciudad, ofreciendo instalaciones modernas, entrenadores certificados y una comunidad que te apoya en cada paso.</p>
                        <div class="row mt-4">
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2 fs-4"></i>
                                    <p class="mb-0">Equipamiento moderno</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2 fs-4"></i>
                                    <p class="mb-0">Entrenadores expertos</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2 fs-4"></i>
                                    <p class="mb-0">Variedad de clases</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2 fs-4"></i>
                                    <p class="mb-0">Abierto 24/7</p>
                                </div>
                            </div>
                        </div>
                        <a href="#contact" class="btn btn-primary mt-3">Contáctanos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section id="trainers" class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary">NUESTROS ENTRENADORES</h6>
                <h2>Profesionales certificados a tu servicio</h2>
                <p class="lead">Nuestro equipo de entrenadores está aquí para guiarte y motivarte en cada paso</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card trainer-card border-0 shadow h-100">
                        <img src="/placeholder.svg?height=400&width=300" class="card-img-top" alt="Entrenador Carlos">
                        <div class="card-body text-center">
                            <h5 class="card-title">Carlos Rodríguez</h5>
                            <p class="text-primary">Entrenador de CrossFit</p>
                            <p class="card-text">Certificado en CrossFit L3 con más de 8 años de experiencia en entrenamiento funcional.</p>
                            <div class="social-icons">
                                <i class="bi bi-facebook"></i>
                                <i class="bi bi-instagram"></i>
                                <i class="bi bi-twitter"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card trainer-card border-0 shadow h-100">
                        <img src="/placeholder.svg?height=400&width=300" class="card-img-top" alt="Entrenadora Laura">
                        <div class="card-body text-center">
                            <h5 class="card-title">Laura Martínez</h5>
                            <p class="text-primary">Instructora de Yoga</p>
                            <p class="card-text">Certificada en Hatha y Vinyasa Yoga con 10 años de práctica y 5 de enseñanza.</p>
                            <div class="social-icons">
                                <i class="bi bi-facebook"></i>
                                <i class="bi bi-instagram"></i>
                                <i class="bi bi-twitter"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card trainer-card border-0 shadow h-100">
                        <img src="/placeholder.svg?height=400&width=300" class="card-img-top" alt="Entrenador Miguel">
                        <div class="card-body text-center">
                            <h5 class="card-title">Miguel Sánchez</h5>
                            <p class="text-primary">Entrenador Personal</p>
                            <p class="card-text">Especialista en pérdida de peso y tonificación muscular con más de 12 años de experiencia.</p>
                            <div class="social-icons">
                                <i class="bi bi-facebook"></i>
                                <i class="bi bi-instagram"></i>
                                <i class="bi bi-twitter"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card trainer-card border-0 shadow h-100">
                        <img src="/placeholder.svg?height=400&width=300" class="card-img-top" alt="Entrenadora Ana">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ana López</h5>
                            <p class="text-primary">Nutricionista Deportiva</p>
                            <p class="card-text">Licenciada en Nutrición con especialidad en nutrición deportiva y planes alimenticios personalizados.</p>
                            <div class="social-icons">
                                <i class="bi bi-facebook"></i>
                                <i class="bi bi-instagram"></i>
                                <i class="bi bi-twitter"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary">NUESTROS PLANES</h6>
                <h2>Planes diseñados para todos los objetivos</h2>
                <p class="lead">Elige el plan que mejor se adapte a tus necesidades y presupuesto</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card price-card shadow h-100">
                        <div class="card-header text-center py-4 bg-light">
                            <h4>Básico</h4>
                        </div>
                        <div class="card-body text-center">
                            <h1 class="card-title pricing-card-title">
                                €29<small class="text-muted fw-light">/mes</small>
                            </h1>
                            <ul class="list-unstyled mt-4 mb-5">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Acceso a sala de musculación</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Horario: 7:00 - 22:00</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>2 clases grupales/semana</li>
                                <li class="mb-2"><i class="bi bi-x-circle-fill text-muted me-2"></i>Sin entrenador personal</li>
                                <li class="mb-2"><i class="bi bi-x-circle-fill text-muted me-2"></i>Sin evaluación nutricional</li>
                            </ul>
                            <button type="button" class="btn btn-outline-primary btn-lg w-100">Elegir Plan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card price-card shadow h-100 border-primary">
                        <div class="card-header text-center py-4 bg-primary text-white">
                            <h4>Premium</h4>
                            <span class="badge bg-warning text-dark">Más Popular</span>
                        </div>
                        <div class="card-body text-center">
                            <h1 class="card-title pricing-card-title">
                                €49<small class="text-muted fw-light">/mes</small>
                            </h1>
                            <ul class="list-unstyled mt-4 mb-5">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Acceso completo 24/7</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Clases grupales ilimitadas</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>1 sesión con entrenador/mes</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Evaluación física trimestral</li>
                                <li class="mb-2"><i class="bi bi-x-circle-fill text-muted me-2"></i>Sin evaluación nutricional</li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-lg w-100">Elegir Plan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card price-card shadow h-100">
                        <div class="card-header text-center py-4 bg-light">
                            <h4>Elite</h4>
                        </div>
                        <div class="card-body text-center">
                            <h1 class="card-title pricing-card-title">
                                €79<small class="text-muted fw-light">/mes</small>
                            </h1>
                            <ul class="list-unstyled mt-4 mb-5">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Acceso completo 24/7</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Clases grupales ilimitadas</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>4 sesiones con entrenador/mes</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Evaluación física mensual</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Plan nutricional personalizado</li>
                            </ul>
                            <button type="button" class="btn btn-outline-primary btn-lg w-100">Elegir Plan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary">TESTIMONIOS</h6>
                <h2>Lo que dicen nuestros miembros</h2>
                <p class="lead">Historias reales de personas que han transformado sus vidas con nosotros</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="/placeholder.svg?height=60&width=60" class="rounded-circle me-3" alt="Testimonio de Marta">
                            <div>
                                <h5 class="mb-0">Marta García</h5>
                                <small class="text-muted">Miembro desde 2020</small>
                            </div>
                        </div>
                        <p>"Después de probar varios gimnasios, finalmente encontré mi lugar en FitLife. Los entrenadores son increíbles y la comunidad me ha ayudado a mantenerme motivada. He perdido 15kg en 6 meses y me siento mejor que nunca."</p>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="/placeholder.svg?height=60&width=60" class="rounded-circle me-3" alt="Testimonio de Javier">
                            <div>
                                <h5 class="mb-0">Javier Ruiz</h5>
                                <small class="text-muted">Miembro desde 2021</small>
                            </div>
                        </div>
                        <p>"Las clases de CrossFit con Carlos han cambiado completamente mi condición física. He ganado fuerza, resistencia y confianza. El ambiente es inmejorable y siempre me siento motivado para dar lo mejor de mí."</p>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="/placeholder.svg?height=60&width=60" class="rounded-circle me-3" alt="Testimonio de Elena">
                            <div>
                                <h5 class="mb-0">Elena Moreno</h5>
                                <small class="text-muted">Miembro desde 2019</small>
                            </div>
                        </div>
                        <p>"El plan nutricional de Ana combinado con las sesiones de entrenamiento personal me han ayudado a alcanzar mis objetivos. He notado cambios no solo en mi físico sino también en mi energía y bienestar general."</p>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding bg-dark-gradient text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h6 class="text-primary">CONTACTO</h6>
                    <h2 class="mb-4">¿Tienes alguna pregunta? Contáctanos</h2>
                    <p class="lead">Estamos aquí para ayudarte. Ponte en contacto con nosotros y te responderemos lo antes posible.</p>
                    
                    <div class="mt-5">
                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5>Ubicación</h5>
                                <p>Calle Principal 123, 28001 Madrid, España</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <i class="bi bi-telephone-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5>Teléfono</h5>
                                <p>+34 912 345 678</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <i class="bi bi-envelope-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <p>info@fitlifegym.com</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="bi bi-clock-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5>Horario</h5>
                                <p>Lunes - Viernes: 6:00 - 23:00<br>
                                Sábados y Domingos: 8:00 - 20:00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 rounded-3">
                        <div class="card-body p-4 p-md-5">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" placeholder="Tu nombre">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Tu email">
                                    </div>
                                    <div class="col-12">
                                        <label for="subject" class="form-label">Asunto</label>
                                        <input type="text" class="form-control" id="subject" placeholder="Asunto">
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Mensaje</label>
                                        <textarea class="form-control" id="message" rows="5" placeholder="Tu mensaje"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 py-3">Enviar Mensaje</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12136.861105532872!2d-3.7037974!3d40.4167754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid%2C%20Spain!5e0!3m2!1sen!2sus!4v1616501324254!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h3 class="mb-4">FitLife<span class="text-primary">Gym</span></h3>
                    <p>Nuestro objetivo es ayudarte a alcanzar tu mejor versión física y mental a través del ejercicio y un estilo de vida saludable.</p>
                    <div class="social-icons mt-4">
                        <i class="bi bi-facebook"></i>
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-youtube"></i>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-white text-decoration-none">Inicio</a></li>
                        <li class="mb-2"><a href="#about" class="text-white text-decoration-none">Nosotros</a></li>
                        <li class="mb-2"><a href="#classes" class="text-white text-decoration-none">Clases</a></li>
                        <li class="mb-2"><a href="#trainers" class="text-white text-decoration-none">Entrenadores</a></li>
                        <li class="mb-2"><a href="#pricing" class="text-white text-decoration-none">Precios</a></li>
                        <li class="mb-2"><a href="#contact" class="text-white text-decoration-none">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Servicios</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Entrenamiento Personal</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Clases Grupales</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Nutrición</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Evaluación Física</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Fisioterapia</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h5 class="mb-4">Suscríbete a nuestro boletín</h5>
                    <p>Recibe noticias, consejos de entrenamiento y ofertas especiales directamente en tu bandeja de entrada.</p>
                    <form class="mt-4">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Tu email" aria-label="Email" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2">Suscribirse</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="mt-4 mb-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2023 FitLife Gym. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Política de Privacidad</a>
                    <a href="#" class="text-white text-decoration-none">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    </x-self.base>
</x-app-layout>
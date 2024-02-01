<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GERMAN R. GARCIA</title>
  <meta content="Portfolio personal, programador full-stack, actualmente desarrollando en Laravel PHP con MySql." name="description">
  <meta content="portfolio,full-stack,developer,programador,laravel,php,mysql,sql,java,javascript,desarrollador,docker,admin,adminlte,bootstrap" name="keywords">

    <!-- <link href="landing-assets/img/favicon.png" rel="icon">
    <link href="landing-assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <link rel="apple-touch-icon" sizes="57x57" href="landing-assets/img/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="landing-assets/img/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="landing-assets/img/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="landing-assets/img/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="landing-assets/img/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="landing-assets/img/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="landing-assets/img/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="landing-assets/img/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="landing-assets/img/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="landing-assets/img/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="landing-assets/img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="landing-assets/img/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="landing-assets/img/fav/favicon-16x16.png">
    <link rel="manifest" href="landing-assets/img/fav/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="landing-assets/img/fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <link href="landing-assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="landing-assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="landing-assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="landing-assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="landing-assets/css/style.css" rel="stylesheet">
</head>

<body>
  <header id="header">
    <div class="container">

      <h1><a href="/">Germán R. García</a></h1>
      <!-- <a href="index.html" class="mr-auto"><img src="landing-assets/img/logo.png" alt="" class="img-fluid"></a> -->
      <h2>Soy un apasionado de la <span>programación </span>. </h2>
        <h2>Full-Stack developer con una sólida experiencia <br>en el desarrollo de aplicaciones web.</h2>
      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link active" href="#header">Inicio</a></li>
            <li><a class="nav-link" href="#about">Sobre mi</a></li>
            <li><a class="nav-link" href="#resume">Currículum</a></li>
            <!-- <li><a class="nav-link" href="#clientes">Clientes</a></li> -->
            <li><a class="nav-link" href="#proyectos">Proyectos</a></li>
            <li><a class="nav-link" href="#contact">Contacto</a></li>
            @if (Route::has('login'))
                @auth
                    <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear"></i></a></li>
                @else
                    <li><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-person"></i></a></li>
                @endauth
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <div class="social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </header>

  <section id="about" class="about">
    <div class="about-me container">
      <div class="section-title">
        <h2>Sobre mi</h2>
        <p>Más sobre mi</p>
      </div>

      <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
          <img src="landing-assets/img/me.png" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
          <h3>Senior Developer</h3>
          <p class="fst-italic">
            Programador Full-Stack a tiempo completo, actualmente programando en PHP, utilizando el Framework de Laravel.
          </p>
          <div class="row">
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>F. Nacimiento:</strong> <span>25 Junio 1978</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Web:</strong> <span>www.germanraulgarcia.es</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Tel:</strong> <span>+34 676 980 401</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Ciudad:</strong> <span>Murcia, España</span></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Edad:</strong> <span>45</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>germansoy@gmail.com</span></li>
                <!-- <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span>Available</span></li> -->
              </ul>
            </div>
          </div>
          <p>
            Con una extendida formación en y años de experiencia en el desarrollo de software, he destacado por mi habilidad para traducir ideas creativas en productos funcionales y eficientes.
            A lo largo de mi carrera profesional he contribuido al éxito de diversos proyectos reflejando mi capacidad para abordar desafíos complejos y ofrecer soluciones que superan las expectativas.
          </p>
        </div>
      </div>

    </div>

    <div class="counts container">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-award"></i>
            <!-- <i class="bi bi-emoji-smile"></i> -->
            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
            <p>Eficiencia</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
          <div class="count-box">
            <i class="bi bi-award"></i>
            <!-- <i class="bi bi-journal-richtext"></i> -->
            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
            <p>Compromiso</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-award"></i>
            <!-- <i class="bi bi-headset"></i> -->
            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
            <p>Resolución</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-award"></i>
            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
            <p>Integridad</p>
          </div>
        </div>

      </div>

    </div>

    <div class="skills container">
        <div class="section-title d-none">
            <h2>Hbilidades</h2>
        </div>

        <div class="row skills-content d-none">

            <div class="col-lg-6">
            <div class="progress">
                <span class="skill">PHP <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="progress">
                <span class="skill">Laravel <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="progress">
                <span class="skill">MySQL <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            </div>

            <div class="col-lg-6">
            <div class="progress">
                <span class="skill">HTML <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="progress">
                <span class="skill">CSS <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="progress">
                <span class="skill">JavaScript <i class="val">90%</i></span>
                <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            </div>

        </div>

        <div class="row skills-content d-none">

            <div class="col-lg-6">
                <div class="progress">
                    <span class="skill">Java <i class="val">90%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">Postgres <i class="val">100%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">Swift <i class="val">80%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="progress">
                    <span class="skill">Flatter <i class="val">75%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">Cosmos <i class="val">100%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">Photoshop <i class="val">100%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- <div class="progress">
                    <span class="skill">JavaScript <i class="val">90%</i></span>
                    <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div> -->
            </div>

        </div>

    </div>

    <div class="interests container">
        <div class="section-title">
            <h2>Tecnologías</h2>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4">
            <div class="icon-box" style="margin-bottom: 5px;">
                <!-- <i class="ri-store-line" style="color: #ffbb2c;"></i> -->
                <img src="landing-assets/img/logos/laravel.png" alt="" style="height: 25px;">
                <h3>&nbsp; Laravel</h3>
            </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/php.png" alt="" style="height: 35px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; PHP</h3>
            </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/mysql.png" alt="" style="height: 45px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; MySQL</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/postgres.png" alt="" style="height: 45px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; PostgreSQL</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/java.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Java</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/docker.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Docker</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/flutter.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Flutter</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/swift.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Swift</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/asp_w.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; ASP</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/javascript.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Javascript</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/css.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Css</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/bootstrap.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Bootsrap</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/cosmos.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Cosmos</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                <img src="landing-assets/img/logos/photoshop.png" alt="" style="height: 25px;">
                <!-- <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i> -->
                <h3>&nbsp; Photoshop</h3>
                </div>
            </div>
      </div>

    </div>


    <div class="testimonials container">
      <div class="section-title">
        <h2>Clientes recientes</h2>
      </div>

      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Aplicación para gestión de proyectos y tareas. Control de tiempos, analisis y estadisticas, CRM, gestión documental, horarios, turnos, control de recursos...
                </p>
                <img src="landing-assets/img/customers/spm_t.png" class="testimonial-img" alt="">
                <h3>SPM</h3>
                <h4>Agencia Marqueting &amp; Publicidad</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Organización y difusión de información empresarial y recursos del pais. Administración de blogs y prensa sobre todos los sectores profesionales y empresas.
                </p>
                <img src="landing-assets/img/customers/procuba_t.png" class="testimonial-img" alt="">
                <h3>Procuba</h3>
                <h4>Ministerio de Comercio de Cuba</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Aplicación para la gestión de personal, turnos y horas de los trabajadores, gestión de invernaderos, control de gastos, mantenimiento de vehículos.
                </p>
                <img src="landing-assets/img/customers/plantiagro_t.png" class="testimonial-img" alt="">
                <h3>Semilleros Plantiagro</h3>
                <h4>Empresa agricola</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Control y organización de comerciales, generación de formularios personalizados, generación de pedidos, emision de presupuestos.
                </p>
                <img src="landing-assets/img/customers/frimaq_t.png" class="testimonial-img" alt="">
                <h3>Frimaq</h3>
                <h4>Diseño y Fabricación de maquinaria insdustrial</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Gestión de federaciones deportivas españolas. Gestión de deportistas y becas para los mismos. Diseño y generación de formularios personalizados...
                </p>
                <img src="landing-assets/img/customers/car_t.png" class="testimonial-img" alt="">
                <h3>CAR Murcia</h3>
                <h4>Centro de alto rendimiento de Murcia</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Control económico, trabajadores, enncargados, turnos, horarios, horas de trabajo, gastos, productos, parcelas, mantenimiento de vehículos...
                </p>
                <img src="landing-assets/img/customers/campolor_t.png" class="testimonial-img" alt="">
                <h3>Campolor</h3>
                <h4>Empresa Agrícola</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Partes de trabajo, control económico, tiempos de trabajo, gestión de servicios a clientes, control de trabajadores, material y maquinaria...
                </p>
                <img src="landing-assets/img/customers/almerimur_t.png" class="testimonial-img" alt="">
                <h3>Almerimur</h3>
                <h4>Movimientos de tierras y maquinaria</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; CRM, proyectos y tareas. Control de tiempos, analisis y estadisticas, gestión documental, horarios, turnos, control de recursos...
                </p>
                <img src="landing-assets/img/customers/cmolina_t.png" class="testimonial-img" alt="">
                <h3>Hnos. Molina</h3>
                <h4>Cárnicas Molina Embutidos &amp; Jamones</h4>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    <i class="bi bi-chat-text"></i>
                    &nbsp; Analisis y estadisticas, CRM, Gestión de proyectos y tareas. Control de tiempos, gestión documental, horarios, turnos, control de recursos...
                </p>
                <img src="landing-assets/img/customers/tofilm_t.png" class="testimonial-img" alt="">
                <h3>TOFILM</h3>
                <h4>Consumibles para envasado</h4>
                </div>
            </div>

        </div>
        <div class="swiper-pagination"></div>
      </div>

      <div class="owl-carousel testimonials-carousel">
      </div>
    </div>

    <div class="interests container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <!-- <i class="ri-store-line" style="color: #ffbb2c;"></i> -->
                    <img src="landing-assets/img/customers/electriloal_t.png" alt="" style="height: 45px;">
                    <h3>&nbsp; ELECTROLOAL</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/enerfrical_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; ENERFRICAL</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/gesproen_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; GESPROEN</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/gonzalbez_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; GRUPO GONZALBEZ</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/inprosystem_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; INPROSYSTEM</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/labascula_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; LA BASCULA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/monteazahar_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; MONTEAZAHAR</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/solideo_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; SOLIDEO FORMACION</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/tercilor_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; CONSTRUC. TERCILOR</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/spm_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; AGENCIA SPM</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/campolor_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; CAMPOLOR</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/almerimur_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; ALMERIMUR</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/CAR_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; CAR MURCIA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/procuba_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; PROCUBA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/plantiagro_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; PLANTIAGRO</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/cmolina_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; HERMANOS MOLINA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/frimaq_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; FRIMAQ</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/tofilm_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; TOFILM</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/kisko_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; CERRAJERIA KISKO</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/trescampanas_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; TRES CAMPANAS</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/electrocontrol_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; ELECTROCONTROL</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/escul_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; ESCUL</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/expertcandela_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; EXPERT CANDELA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/godzillamarketing_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; GODZILLA MARKETING</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/taboudesign_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; TABOU DESIGN</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/trazaterritoria_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; TRAZATERRITORIA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/wsilorca_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; WSI LORCA</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                <div class="icon-box" style="margin-bottom: 5px;">
                    <img src="landing-assets/img/customers/guirrete_t.png" alt="" style="height: 35px;">
                    <h3>&nbsp; GUIRRETE</h3>
                </div>
            </div>

        </div>

    </div>

    </section>

    <section id="resume" class="resume">
        <div class="container">
        <div class="section-title">
            <h2>Currículum</h2>
            <p>Mi currículum</p>
        </div>

        <div class="row">
            <div class="col-lg-6">

                <h3 class="resume-title">Resumen</h3>

                <div class="resume-item pb-0">
                    <h4>Germán R. García</h4>
                    <p>
                        <em>
                            Soy un apasionado informático programador con amplia experiencia en el desarrollo de aplicaciones.
                            Además de la programación, también cuento con mucha experiencia como técnico en soporte.
                            Hábil en la resolución de problemas de manera eficiente, brindando asistencia técnica y manteniendo sistemas en funcionamiento de manera óptima.
                        </em>
                    </p>
                    <p>
                        <ul>
                            <li>Puerto Lumbreras, Murcia, España</li>
                            <li>(+34) 676 980 401</li>
                            <li>germansoy@gmail.com</li>
                        </ul>
                    </p>
                </div>

                <h3 class="resume-title">Educación</h3>

                <div class="resume-item">
                        <h4>TÉCNICO EN GESTIÓN ADMINISTRATIVA</h4>
                        <h5>1996 - 1998</h5>
                        <p><em>I.E.S. RAMBLA DE NOGALTEI.E.S. RAMBLA DE NOGALTE</em></p>
                        <p>Técnico en Administración y Gestión de Empresas</p>
                </div>

                <div class="resume-item">
                    <h4>TÉCNICO ESPECIALISTA PROGRAMADOR</h4>
                    <h5>1998 - 2000</h5>
                    <p><em>I.E.S. SAN JUAN BOSCO</em></p>
                    <p>Técnico especialista Programador</p>
                </div>

                <h3 class="resume-title">Formación Adicional</h3>

                <div class="resume-item">
                    <h4>ASP.NET MVC</h4>
                    <!-- <h5>2019 - 2019</h5> -->
                    <!-- <p><em>Udemy</em></p> -->
                    <p>Curso Completo de Desarrollo ASP.NET MVC.</p>
                </div>

                <div class="resume-item">
                    <h4>FLUTTER</h4>
                    <!-- <h5>2019 - 2019</h5> -->
                    <!-- <p><em>Udemy</em></p> -->
                    <p>Legacy - Flutter: Tu guía completa para IOS y Android</p>
                </div>

                <div class="resume-item">
                    <h4>IOS y Swift</h4>
                    <!-- <h5>2019 - 2019</h5> -->
                    <!-- <p><em>Udemy</em></p> -->
                    <p>Curso Completo de Cero a Profesional</p>
                </div>

                <div class="resume-item">
                    <h4>Master SQL</h4>
                    <!-- <h5>2019 - 2019</h5> -->
                    <!-- <p><em>Udemy</em></p> -->
                    <p>Master en SQL. Desde Cero a Profesional</p>
                </div>

            </div>

            <div class="col-lg-6">
                <h3 class="resume-title">Experiencia Profesional</h3>

                <div class="resume-item">
                    <h4>Full-Stack Developer</h4>
                    <h5>2022 - Presente</h5>
                    <p><em>Agencia SPM, Lorca, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Full-Stack developer</li>
                            <li>Desarrollo de aplicaciones web</li>
                            <li>PHP, MySQL, Laravel, Javascript, Java, Docker, Bootstrap, CSS, Adobe Photoshop</li>
                            <li>Jornada completa, hibrido</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Ayudante Programador Backend</h4>
                    <h5>2021 - 2021</h5>
                    <p><em>Nivimu, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Backend developer</li>
                            <li>Desarrollo de aplicaciones web</li>
                            <li>PHP,SQL,Sinfony</li>
                            <li>Jornada completa, teletrabajo</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Full-Stack Developer</h4>
                    <h5>2020 - 2021</h5>
                    <p><em>Districam Licores, Lorca, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Full-Stack developer</li>
                            <li>Desarrollo de aplicaciones web</li>
                            <li>Diseño y creación de catalogos</li>
                            <li>ASP, PHP, SQL, Javascript, Bootstrap, CSS, Adobe Photoshop, Adobe Illustrator</li>
                            <li>Jornada completa, presencial.</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Técnico Informático</h4>
                    <h5>2016 - 2019</h5>
                    <p><em>OFILOGICA SL, Puerto Lumbreras, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Técnico informático para empresas</li>
                            <li>Help Desk</li>
                            <li>Instalación y mantenimiento de redes y servidores</li>
                            <li>Creación de páginas web</li>
                            <li>Jornada completa, presencial</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Responsable del departamento de informática</h4>
                    <h5>2014 - 2016</h5>
                    <p><em>GRUPO CURRO TELPLAY SOC. COOP, Puerto Lumbreras, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Responsable y coordinador del departamento de informática en cuatro delegaciones.</li>
                            <li>Jornada completa, presencial</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Gerente</h4>
                    <h5>2009 - 2014</h5>
                    <p><em>Avatar Informática, Puerto Lumbreras, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Gerente</li>
                            <li>Desarrollo de aplicaciones</li>
                            <li>Servicio técnico y mantenimiento, empresas y particulares</li>
                            <li>Venta de equipos informáticos, material y mobiliario de oficina</li>
                            <li>Help-Desk y asesoramiento</li>
                            <li>Jornada completa, presencial</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Desarrollador de Aplicaciones</h4>
                    <h5>2000 - 2009</h5>
                    <p><em>Sola y Vaillo SA, Lorca, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Desarrollador de aplicaciones. Ampliación y mantenimiento de la aplicación de gestión de la empresa</li>
                            <li>Creacion de pagina web de la empresa</li>
                            <li>Responsable del departamento de informática</li>
                            <li>Mantenimiento de equipos, red y servidores de la empresa</li>
                            <li>COSMOS, SQL, Javascript, Bootstrap, CSS, Adobe Photoshop, Adobe Illustrato</li>
                            <li>Jornada completa, presencial</li>
                        </ul>
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Servicio técnico y mantenimiento</h4>
                    <h5>1996 - 2000</h5>
                    <p><em>Mateofic, Lorca, Murcia, España </em></p>
                    <p>
                        <ul>
                            <li>Servicio técnico y mantenimiento de equipos informáticos a empresas y particulares</li>
                        </ul>
                    </p>
                </div>

            </div>
        </div>

        </div>
    </section><!-- End Resume Section -->

  <!-- ======= Clientes Section ======= -->
  <section id="clientes" class="services d-none">
    <div class="container">

      <div class="section-title">
        <h2>Clientes</h2>
        <p>Mis Clientes</p>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="icon-box" style="margin-bottom: 5px;">
            <div class="icon"><i class="bx bxl-dribbble"></i></div>
            <h4><a href="">Lorem Ipsum</a></h4>
            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
          <div class="icon-box" style="margin-bottom: 5px;">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4><a href="">Sed ut perspiciatis</a></h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box" style="margin-bottom: 5px;">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4><a href="">Magni Dolores</a></h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box" style="margin-bottom: 5px;">
            <div class="icon"><i class="bx bx-world"></i></div>
            <h4><a href="">Nemo Enim</a></h4>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box" style="margin-bottom: 5px;">
            <div class="icon"><i class="bx bx-slideshow"></i></div>
            <h4><a href="">Dele cardo</a></h4>
            <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box" style="margin-bottom: 5px;">
            <div class="icon"><i class="bx bx-arch"></i></div>
            <h4><a href="">Divera don</a></h4>
            <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box" style="margin-bottom: 5px;">
              <div class="icon"><i class="bx bx-arch"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box" style="margin-bottom: 5px;">
              <div class="icon"><i class="bx bx-arch"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

      </div>

    </div>
  </section><!-- End Clientes Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="proyectos" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Proyectos</h2>
        <p>Proyectos Destacados</p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-kordino">Kordino</li>
            <li data-filter=".filter-card">CRM</li>
            <li data-filter=".filter-web">Gestión de Proyectos</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">

        <div class="col-lg-4 col-md-6 portfolio-item filter-kordino">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Detalles">kordino</a></h4>
              <p>Aplicación Web Multiempresa</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Mas Proyectos"><i class="bx bx-plus"></i></a>
                <!-- <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a> -->
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>-->

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="landing-assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="landing-assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="landing-assets/img/portfolio/portfolio-10.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="landing-assets/img/portfolio/portfolio-10.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="landing-assets/img/portfolio/portfolio-11.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="landing-assets/img/portfolio/portfolio-11.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

      </div>

    </div>
  </section>


  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contacto</h2>
        <p>Contactame</p>
      </div>

      <div class="row mt-2">

        <div class="col-md-6 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-map"></i>
            <h3>Mi Dirección</h3>
            <p>Calle Gerardo Diego, 24, Puerto Lumbreras, Murcia</p>
          </div>
        </div>

        <div class="col-md-6 mt-4 mt-md-0 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-share-alt"></i>
            <h3>Perfiles Sociales</h3>
            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-envelope"></i>
            <h3>Mi email</h3>
            <p>germansoy@gmail.com</p>
          </div>
        </div>
        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-phone-call"></i>
            <h3>Llamame</h3>
            <p>+34 676 980 401</p>
          </div>
        </div>
      </div>

      <form action="/forms/contact.php" method="post" role="form" class="php-email-form mt-4">
        <div class="row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <div class="my-3">
          <div class="loading">Cargando</div>
          <div class="error-message"></div>
        </div>
        <div class="text-center"><button type="submit">Mandar</button></div>
      </form>

    </div>
  </section>

    <section id="login" class="login">
        <div class="container">

            <div class="section-title">
                <h2>Login</h2>
                <p>Administración</p>
            </div>


            {{-- <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4"> --}}
            <form id="form-login" name="form-login" method="POST" action="{{ route('login') }}" class="php-login-form mt-4" >
            @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="email" name="email" id="login-email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" placeholder="Your Email" required>
                        @error('email')
                            <div class="text-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        {{-- <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required> --}}
                        <input type="password" name="password" id="login-password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" placeholder="Your Password" required>
                        @error('password')
                            <span class="text-error">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="my-3">
                    <div class="loading">Cargando</div>
                    <div class="error-message"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="text-center"><button type="submit">Login</button></div>
                    </div>
                </div>
            </form>

        </div>
    </section>

  <div class="credits">
    Germán R. García <a href="https://germanraulgarcia.es/">Full-Stack Developer</a>. <small>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</small>
  </div>

  <!-- Vendor JS Files -->
  <script src="landing-assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="landing-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landing-assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="landing-assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="landing-assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="landing-assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="landing-assets/vendor/php-email-form/validate.js"></script>


  <script src="landing-assets/js/main.js"></script>

</body>

</html>

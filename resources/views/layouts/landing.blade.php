<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="">
        <meta name="author" content="TemplateMo">

        <title>CPSU KSCDSeaMS</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- fullCalendar -->
        <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

        <link href="{{ asset('landings/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('landings/css/bootstrap-icons.css') }}" rel="stylesheet">

        <link href="{{ asset('landings/css/magnific-popup.css') }}" rel="stylesheet">

        <link href="{{ asset('landings/css/templatemo-first-portfolio-style.css') }}" rel="stylesheet">
    </head>
    
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="index.html" class="navbar-brand mx-auto mx-lg-0">KSCDSeaMS</a>

                <div class="d-flex align-items-center d-lg-none">
                    <i class="navbar-icon bi-telephone-plus me-3"></i>
                    <a class="custom-btn btn" href="#section_5">
                        120-240-9600
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1" style="font-size: 12pt; font-weight: bold;">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2" style="font-size: 12pt; font-weight: bold;">Events</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3" style="font-size: 12pt; font-weight: bold;">Fitness Lab</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4" style="font-size: 12pt; font-weight: bold;">About Us</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <main>

            <section class="hero d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-7 col-12">
                            <div class="hero-text">
                                <div class="hero-title-wrap d-flex align-items-center mb-4">

                                    <h1 class="hero-title ms-3 mb-0">Hello User!</h1>
                                </div>

                                <h2 class="mb-4">Welcome to CPSU KSCD SeaMS.</h2>
                                <p class="mb-4"><a class="custom-btn btn custom-link" href="#section_2">Let's begin</a></p>
                            </div>
                        </div>

                        <div class="col-lg-5 col-12 position-relative">
                            <img src="{{ asset('dist/img/kscdlogo.png') }}" class="hero-image img-fluid" alt="">
                        </div>

                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#198754" fill-opacity="1" d="M0,160L24,160C48,160,96,160,144,138.7C192,117,240,75,288,64C336,53,384,75,432,106.7C480,139,528,181,576,208C624,235,672,245,720,240C768,235,816,213,864,186.7C912,160,960,128,1008,133.3C1056,139,1104,181,1152,202.7C1200,224,1248,224,1296,197.3C1344,171,1392,117,1416,90.7L1440,64L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z"></path>
                </svg>  
            </section>


            <section class="about section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div id="calendar"></div>
                        </div>

                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="about-thumb">

                                <div class="section-title-wrap d-flex justify-content-end align-items-center mb-4">
                                    <h2 class="text-white me-4 mb-0">KSCD Searvices and Management System</h2>
                                </div>

                                <h3 class="pt-2 mb-3">a little bit about our system</h3>

                                <p class="mb-4">The KSCD Searvices and Management System is a web-based application designed to streamline the management of various services offered by the institution. It provides a user-friendly interface for students, faculty, and staff to access information, make event reservations, and manage appointments efficiently.</p>

                                <p class="mb-4">The system includes features such as inventory tracking, event scheduling, fitness lab reservations, and a comprehensive database of services available to the community. It aims to enhance communication, improve service delivery, and promote a more organized approach to managing resources within the institution.</p>
                        </div>

                    </div>
                </div>
            </section>

            <section class="services section-padding" id="section_3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 justify-content-center">
                            <center> 
                                <h2>Fitness Lab Slots</h2>
                            </center>
                        </div>
                        <div class="col-lg-12 col-12 mt-5 mt-lg-0 d-flex justify-content-center">
                            <div class="about-thumb">
                                <div class="row">
                                    <div class="col-md-6 col-6 featured-border-bottom py-2">
                                        <strong class="featured-numbers" id="maximumSlot"></strong>

                                        <p class="featured-text">Maximum</p>
                                    </div>

                                    <div class="col-md-6 col-6 featured-border-start featured-border-bottom ps-5 py-2">
                                        <strong class="featured-numbers" id="availableSlot"></strong>

                                        <p class="featured-text">Available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="projects section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-md-8 col-12 ms-auto">
                            <div class="section-title-wrap d-flex justify-content-center align-items-center mb-4">
                                <img src="{{ asset('landings/images/white-desk-work-study-aesthetics.jpg') }}" class="avatar-image img-fluid" alt="">

                                <h2 class="text-white ms-4 mb-0">Team</h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">Project Leader</small>

                                    <h3 class="projects-title">Wela Mae T. Mongcal</h3>
                                </div>

                                <a href="{{ asset('landings/images/projects/wela.jpg') }}" class="popup-image">
                                    <img src="{{ asset('landings/images/projects/wela.jpg') }}" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">Programmer</small>

                                    <h3 class="projects-title">Vaughn Dominique S. Velasco</h3>
                                </div>

                                <a href="{{ asset('landings/images/projects/vaughn.jpg') }}" class="popup-image">
                                    <img src="{{ asset('landings/images/projects/vaughn.jpg') }}" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">Support</small>

                                    <h3 class="projects-title">Angela Mae G. Alberto</h3>
                                </div>

                                <a href="{{ asset('landings/images/projects/angel.jpg') }}" class="popup-image">
                                    <img src="{{ asset('landings/images/projects/angel.jpg') }}" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="contact section-padding" id="section_5">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-12 col-12">
                            <h3 class="text-center mb-5">Software Tools</h3>
                        </div>

                        <div class="col-lg-2 col-4 ms-auto clients-item-height">
                            <img src="{{ asset('landings/images/clients/xampplogo.png')}}" class="clients-image img-fluid" alt="" style="width: 290px;">
                        </div>

                        <div class="col-lg-2 col-4 clients-item-height">
                            <img src="{{ asset('landings/images/clients/laravellogo.png')}}" class="clients-image img-fluid" alt="">
                        </div>

                        <div class="col-lg-2 col-4 clients-item-height">
                            <img src="{{ asset('landings/images/clients/composerlogo.png')}}" class="clients-image img-fluid" alt="" style="width: 100px;">
                        </div>

                        <div class="col-lg-2 col-4 clients-item-height">
                            <img src="{{ asset('landings/images/clients/vscodelogo.png')}}" class="clients-image img-fluid" alt="" style="width: 200px;">
                        </div>

                        <div class="col-lg-2 col-4 me-auto clients-item-height">
                            <img src="{{ asset('landings/images/clients/gitlogo.png')}}" class="clients-image img-fluid" alt=""  style="width: 130px;">
                        </div>

                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="copyright-text-wrap">
                            <p class="mb-0">
                                <span class="copyright-text">CPSU KSCDSeAMs.</span>
                                Developed: 
                                <a rel="sponsored" href="#" target="_blank">BSIT 4-D</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="{{ asset('landings/js/jquery.min.js') }}"></script>
        <script src="{{ asset('landings/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('landings/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('landings/js/click-scroll.js') }}"></script>
        <script src="{{ asset('landings/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('landings/js/magnific-popup-options.js') }}"></script>
        <script src="{{ asset('landings/js/custom.js') }}"></script>

        <!-- fullCalendar 2.2.5 -->
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
    
        <!-- Toastr -->
        <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        
        <script>
            var fitnessShowRoute = "{{ route('getfitnessShowland') }}";
            var eventschedCalendarRoute = "{{ route('checkeventschedShow') }}";
        </script>
        <script src="{{ asset('js/fitnesslanding.js') }}"></script>
        <script src="{{ asset('js/checkeventcalen.js') }}"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KSCD Service and Management System</title>
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/login-style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">
    <style>.toast-top-center { top: 70px !important; }</style>
</head>
<body>
    <body style="background: linear-gradient(to right, green, yellow);">
        <div class="container" style="background: rgba(255, 255, 255, 0.8); border-radius: 15px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
            <div class="row gy-5 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-bg-success shadow-lg rounded-5">
                        <div class="col-12 col-xl-10">
                            <div class="d-flex justify-content-center mt-5 pt-5">
                                <img class="img-fluid rounded-5 mb-5" loading="lazy" src="{{ asset('dist/img/kscdlogo.png') }}" width="400" height="150" alt="BootstrapBrain Logo">
                            </div>
                            <hr class="border-primary-subtle mb-5 shadow-sm rounded-pill">
                            <h2 class="h1 mb-5 shadow-sm rounded-4">Welcome to KSCD Service and Management System.</h2>
                            <p class="lead mb-6 shadow-sm rounded-4">CPSU’s system for managing sports equipment, facility reservations, appointments, and events. Log in to get started.</p>
                            <div class="text-endx">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-grip-horizontal shadow-sm rounded-circle" viewBox="0 0 16 16">
                                    <path d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-5 shadow-lg">
                        <div class="card-body p-4 p-md-5 p-xl-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5"><h3>Log in</h3></div>
                                    @if(session('error'))
                                        <div class="alert alert-danger shadow-sm rounded-4" style="font-size: 14pt;">
                                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                                        </div>
                                    @endif
                                    @if(session('success'))
                                        <div class="alert alert-success shadow-sm rounded-4" style="font-size: 12pt;">
                                            <i class="fas fa-check"></i> {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('processLogin') }}" method="POST">
                                @csrf
                                <div class="row gy-4 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-4 shadow-sm rounded-4">
                                            <input type="email" class="form-control rounded-4" name="email" id="email" placeholder="name@example.com" required>
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-4 shadow-sm rounded-4">
                                            <input type="password" class="form-control rounded-4" name="password" id="password" placeholder="Password" required>
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check shadow-sm rounded-4">
                                            <input class="form-check-input rounded-4" type="checkbox" value="" name="remember_me" id="remember_me">
                                            <label class="form-check-label text-secondary" for="remember_me">Keep me logged in</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid shadow-sm rounded-4">
                                            <button class="btn btn-success btn-lg rounded-4" type="submit">Log in now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if(session('error'))
                toastr.error("{{ session('error') }}", "Error", { closeButton: true, progressBar: true, positionClass: "toast-top-center", timeOut: 5000 });
            @endif
            @if(session('success'))
                toastr.success("{{ session('success') }}", "Success", { closeButton: true, progressBar: true, positionClass: "toast-top-center", timeOut: 10000 });
            @endif
        });
    </script>
</body>
</html>

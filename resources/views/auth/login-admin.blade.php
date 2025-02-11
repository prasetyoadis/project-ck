<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS ICON --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="/css/icofont.min.css">
    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        footer a{
            color: #e1e1e1;
            text-decoration: none;
        }
        footer a:hover{
            color: white
        }
        *{
            margin: 0;
            padding: 0;
        }
        .bg-slider{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            transition: 5s;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url("https://www.southernliving.com/thmb/_DTHAquZBLEHKLIgPi_C3fFIhNo=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-929904308-aeeb687413714dacace50062cece530a.jpg");
        }
        footer{
            margin-top: auto;
            width: 100%;
        }
        .bg-shadow{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
        }
        .content{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width:100%;
        }
        .offcanvas-body a{
            padding: 10px;
            text-decoration: none;
            font-size: 12pt;
            color: black;
            display: block;
        }
        .offcanvas-body a:hover{
            background-color: #d9d9d9;
        }
        .card:hover{
            border-color: black;
        }
        .btn{
            padding: 0.4375rem 1.25rem !important;
            font-weight: 400;
            font-size: 0.9375rem !important;
            line-height: 1.53;
            border: 1px solid transparent;
            border-radius: 0.375rem !important;
            transition: all 0.2s ease-in-out;
        }
        .rounded{
            border-radius: 0.5rem !important;
        }
        .btn-primary{
            background-color: #696cff;
            border-color: #696cff;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(105, 108, 255, 0.4);

        }
        .btn-primary:hover{
            background-color: #5f61e6;
            border-color: ##5f61e6;
            transform: translateY(-1px);
        }
        a{
            color:#696cff;
            text-decoration: none;
        }
        a:hover{
            color: #787bff;
        }
        .form-control{
            padding: 0.4375rem 0.875rem 0.4375rem 35px !important;
            border-radius: 0.375rem !important;
        }
    </style>
    
    <title>{{ $title }} | {{ config('app.name') }}</title>
</head>
<body>
    <div class="bg-slider">
        <div class="bg-shadow">
            {{-- <header style="height: 10%">
                
            </header> --}}
            <main class="mt-4 content">
                <div class="row d-flex justify-content-center align-content-center p-0 m-0">
                    <div class="col-9 col-sm-7 col-md-5 col-lg-4 col-xl-3 p-0 m-0">
                        <div class="bg-light w-100 p-4 rounded">
                            <div class="text-center">
                                <img src="/favicon.ico" alt="logo-undangan" class="rounded-circle" width="20%" height="20%">
                                <h3 class="fw-bold">Login</h3>
                                <h3 class="fw-bold">Staff CeritaKita</h3>
                            </div>
                            {{-- Alert jika salah data login atau sukses ganti password--}}
                            @if (session()->has('success'))
                                <div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
                                    <div class="d-flex align-items-center">
                                        <span class="material-symbols-rounded me-2">check_circle</span>
                                        <span class="align-middle"><strong> Sukses: </strong> {{ session('success') }}</span>
                                        <button type="button" class="btn-close" style="top:15%" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="d-flex align-items-center">
                                        <span class="material-symbols-rounded me-2">warning</span>
                                        <span class="align-middle"><strong> Error: </strong> {{ session('error') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            {{-- Form Login Admin --}}
                            <form action="/admin" method="POST" class="mt-4 mb-3">
                                @csrf
                                <div class="position-relative mb-3">
                                    <label for="username" class="form-label" hidden>Username</label>
                                    <span class="position-absolute material-symbols-rounded" style="top: 8px; left:7px">account_box</span>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" style="padding-left: 35px" placeholder="Username" required autofocus value="{{ old('username') }}">
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="password" class="form-label" hidden>Password</label>
                                    <span class="position-absolute material-symbols-rounded" style="top: 8px; left:7px">lock</span>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" style="padding-left: 35px" placeholder="Password" required>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="/forgot-password">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="bg-dark">
                {{-- Footer --}}
                {{-- @include('partials.footer') --}}
            </footer>
        </div>
    </div>
</body>
</html>
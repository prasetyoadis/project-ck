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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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
    </style>
    
    <title>{{ $title }} | Login Ceritakita</title>
</head>
<body>
    <div class="bg-slider">
        <div class="bg-shadow">
            {{-- <header style="height: 10%">
                
            </header> --}}
            <main class="mt-4 content">
                <div class="row d-flex justify-content-center align-content-center p-0 m-0">
                    <div class="col-9 col-sm-7 col-md-5 col-lg-4 col-xl-3 p-0 m-0">
                        <div class="bg-light w-100 p-3 rounded">
                            <div class="text-center">
                                <img src="/assets/img/illustrations/send-email.png" alt="logo-Surat" class="rounded-circle w-25">
                                <h3 class="fw-bold">Verifikasi</h3>
                                <h3 class="fw-bold">Email Ulang</h3>
                            </div>
                            
                            @if (session()->has('success'))
                                <div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
                                    <span class="material-symbols-rounded align-middle">check_circle</span>
                                    <span class="align-middle">{{ session('message') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="text-center">
                                <p>Jika Anda tidak menerima atau melihat email dari kami, tolong cek pada spam. Apabila masih belum menemukan email kami. Silahkan klik tombol dibawah:</p>
                                <form action="{{ route('verification.send') }}" method="POST" id="form-action">
                                    @csrf
                                    <div class="form-group form-button">
                                        <input type="submit" class="form-submit btn btn-primary" id="form-submit" value="Kirim Kembali Verifikasi Email" onclick="updateButton()"/>
                                    </div>
                                </form>
                            </div>
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

     <!-- JS -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
        // const button = document.getElementById('submitButton');
        // const timerDisplay = document.getElementById('cooldownTimer');
        // const cooldownTime = 60; // cooldown time in seconds

        // button.addEventListener('click', () => {
        //     button.disabled = true;
        //     let remainingTime = cooldownTime;

        //     const interval = setInterval(() => {
        //         remainingTime--;
        //         timerDisplay.textContent = `Please wait ${remainingTime} seconds...`;

        //         if (remainingTime <= 0) {
        //             clearInterval(interval);
        //             button.disabled = false;
        //             timerDisplay.textContent = '';
        //         }
        //     }, 1000);

        var countdown = 60;

        function updateButton() {
            if (countdown > 0) {
                $('#form-submit').prop('type', 'button');
                $('#form-action').prop('action', '');
                $('#form-submit').val('Tunggu ' + countdown + ' detik');
                $('#form-submit').prop('disabled', true); // Tambahkan agar tombol dinonaktifkan
                countdown--;
                setTimeout(updateButton, 1000); // Berikan fungsi, bukan hasil fungsi
            } else {
                $('#form-action').prop('action', '{{ route('verification.send') }}');
                $('#form-submit').prop('type', 'submit');
                $('#form-submit').val('Kirim Ulang Verifikasi Email');
                $('#form-submit').prop('disabled', false); // Aktifkan kembali tombol
            }
        }

        $(document).ready(function() {
            updateButton();
        });

     </script>
</body>
</html>
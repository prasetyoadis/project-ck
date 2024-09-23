<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CeritaKita || {{ $title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      * {
          font-family: "Anek Devanagari", sans-serif;
      }
      body{
        background-color: #FFF5EE;
      }
      div.cover-image img{
        width: 100%;
        height: 100vh;
        object-fit: cover;
        margin-bottom: 0%;
      }
      .bg-shadow{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.25);
        display: flex;
        flex-direction: column;
      }
      div.button-center{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%)
      }
      .button-center a{
        font-size: 1.2rem;
        color: black;
        background-color: white;
        opacity: 0.8;
      }
      .button-center a:hover{
        background-color:burlywood;
        color: white;
  }
      div.container-fluid{
        position: absolute
        top: 0;
        left: 0;
        padding-left: 4%;
        padding-right: 4%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
      h2{
        text-align: center;
        margin-top: 0; 
      }
      .card-title{
        text-align: center;
      }
      nav{
        opacity: 0.7;
        background-color:	#FFF5EE;
    }
    .btn a {
        font-size: 1.1em;
        color: white;
        background-color: black;
        opacity: 0.8;
      }
      /*Laptop*/
  @media (max-width: 992px){
    html{
      font-size: 75%;
    }
  }
  /*Tablet*/
  @media (max-width: 768px){
    html{
      font-size: 65%;
    }
  }
  /*Handphone*/
  @media (max-width: 576px){
    html{
      font-size: 55%;
    }
  }
    </style>
  </head>
  <body>
  <!---Navbar -->
    @include('partials/navbar')

  <!---Body -->  
     @yield('container')
      

  <!---Footer -->
    @include('partials.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
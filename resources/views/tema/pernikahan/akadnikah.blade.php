<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $title }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/simplyCountdown.theme.default.css"/>
    <script src="../asset/js/simplyCountdown.min.js"></script>
  </head>

<style>
  :root{
    --bg : #0a0a0a;
    --grey : #BEBEBE;
    --shadow: 0 2px 2px rgb(0 0 0 / 0.5);
  }
  body{
    font-size: 1.2rem;
    font-family: "Work Sans", sans-serif;
    min-height: 2000px;
  }
  .hero{
    min-height: 100vh;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-image: url("../img/undangan/undangan1.jpeg");
  }

  .hero h1{
    font-family: "Sacramento", cursive;
    font-size: 4rem;
  }
  .hero h4{
    font-size: 1.6rem;
  }
  .hero p{
    font-size: 1.4rem;
  }
  .hero a{
    font-size: 1.2rem;
    color: #9f407f;
    background-color: white;
    box-shadow: var(--shadow);
    opacity: 0.6;
  }
  .hero a:hover{
    background-color: var(--grey);
    color: black;
  }
  .hero h1, .hero h4, .hero p{
    text-shadow: var(--shadow);
  }
  /*Laptop*/
  @media (max-width: 992px){
    html{
      font-size: 75%;
    }
    .simply-countdown>.simply-section{
      padding: 70px;
    }
  }
  /*Tablet*/
  @media (max-width: 768px){
    html{
      font-size: 65%;
    }
    .simply-countdown>.simply-section{
      padding: 60px;
      margin: 5px;
    }
  }
  /*Handphone*/
  @media (max-width: 576px){
    html{
      font-size: 55%;
    }
    .simply-countdown>.simply-section{
      padding: 45px;
      margin: 3px;
    }

  }
</style>
  <body>

    <section id="hero" class="hero w-100 h-100 p-3 mx-auto text-center d-flex justify-content-center align-items-center text-white">
        <main>
            <h4>Kepada Bapak/Ibu/Saudara/i</h4>
            <h1>Axel Giovanno & Michelle San</h1>
            <p>Akan Melangsungkan Akad Nikah dan Resepsi dalam:</p>
            <div class="simply-countdown">

            </div>
            <a href="#undangan" class="btn btn-lg mt-4 rounded-pill"></i>Lihat Undangan</a>
        </main>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>simplyCountdown('.simply-countdown', {
      year: 2025, // required
      month: 5, // required
      day: 25, // required
      hours: 8, // Default is 0 [0-23] integer
      words: { //words displayed into the countdown
          days: { singular: 'Hari', plural: 'Hari' },
          hours: { singular: 'Jam', plural: 'Jam' },
          minutes: { singular: 'Menit', plural: 'Menit' },
          seconds: { singular: 'Detik', plural: 'Detik' }
      },
});

// Also, you can init with already existing Javascript Object.
let myElement = document.querySelector('.my-countdown');
simplyCountdown(myElement, { /* options */ });

let multipleElements = document.querySelectorAll('.my-countdown');
simplyCountdown(multipleElements, { /* options */ });
</script>
  </body>
</html>
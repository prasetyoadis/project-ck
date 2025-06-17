<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ucwords(str_replace("-", " & ", $undangan->slug)) }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/simplyCountdown.theme.default.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="/assets/js/simplyCountdown.min.js"></script>
    <link rel="stylesheet" href="/assets/css/akad.css">
  </head>

  <body>

    <section id="hero" class="hero w-100 h-100 p-3 mx-auto text-center d-flex justify-content-center align-items-center text-white">
        <main>
            <h4>Kepada Bapak/Ibu/Saudara/i</h4>
            <h1>{{ str_replace("-", " ", $to) }}</h1>
            <p>Akan Melangsungkan Akad Nikah dan Resepsi dalam:</p>
            <div class="simply-countdown">

            </div>
            <a href="#home" class="btn btn-lg mt-4 rounded-pill" onclick="enableScroll()">Lihat Undangan</a>
        </main>
    </section>
    
    <nav class="navbar navbar-expand-md bg-transparent sticky-top mynavbar">
      <div class="container">
        <a class="navbar-brand" href="#">{{ ucwords(str_replace("-", " & ", $undangan->slug)) }} Wedding's</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">{{ $undangan->couple->nama_pria }} & {{ $undangan->couple->nama_wanita }} Wedding's</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="navbar-nav ms-auto">
              <a class="nav-link" href="#home">Home</a>
              <a class="nav-link" href="#info">Info</a>
              <a class="nav-link" href="#story">Story</a>
              <a class="nav-link" href="#gallery">Gallery</a>
              <a class="nav-link" href="#gifts">Gifts</a>
              <a class="nav-link" href="#ucapan">Greetings</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <section id="home" class="home">
     
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 text-center">
              <h2>Acara Pernikahan</h2>
              <h3>Diselenggarakan pada {{ date("l, d F Y", strtotime($undangan->events[0]->tgl_acara)) }} di Pati, Jawa Tengah</h3>
              <p>Oleh karena itu, dengan segala hormat, kami bermaksud untuk mengundang Bapak/Ibu, Saudara/i, untuk hadir pada acara pernikahan kami.</p>
            </div>
          </div>
          <div class="row couple">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-8 text-end">
                    <h3>{{ $undangan->couple->nama_pria }}</h3>
                    <p>Putra Pertama dari</p>
                    <p>Bpk {{ $undangan->couple->ayah_pria }} dan Ibu {{ $undangan->couple->ibu_pria }} </p>
                  </div>
                  <div class="col-4">
                    <img src="/assets/img/undangan/akad-nikah/boy.jpg" alt="Axel Giovani" width="300px" height="250px" class="img-responsive rounded-circle">
                  </div>
                </div>
              </div>

              <span class="heart"><i class="bi bi-heart-fill"></i></span>

              <div class="col-lg-6">
                <div class="row">
                  <div class="col-4">
                    <img src="/assets/img/undangan/akad-nikah/girl.jpg" alt="Michelle San" width="300px" height="250px" class="img-responsive rounded-circle">
                  </div>
                  <div class="col-8">
                    <h3>{{ $undangan->couple->nama_wanita }}</h3>
                    <p>Putri Pertama dari</p>
                    <p>Bapak {{ $undangan->couple->ayah_wanita }} dan Ibu {{ $undangan->couple->ibu_wanita }}</p>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>

    <section id="info" class="info">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-10 text-center">
            <h2>Informasi Acara</h2>
            <p class="alamat">Alamat: Rumah Mempelai Wanita <br> Desa Kertomulyo RT 03 RW 01 Kec Trangkil Kab Pati</p>
            <a href="https://maps.app.goo.gl/r6P89Tdv6vmy8J6f9" target="_blank" class="btn btn-light btn-sm">Klik Untuk membuka Alamat</a>
            <p class="description">Notes: Diharapkan untuk tidak salah alamat dan salah tanggal</p>
            </div>        
          </div>
      </div>
      <div class="row justify-content-center mt-4">
          @foreach ($undangan->events as $event)
          <div class="col-md-5 col-10">
            <div class="card text-center text-bg-light mb-5">
              <div class="card-header">
                {{ Str::upper($event->nama_acara) }}
              </div>
              <div class="card-body">
               <div class="row justify-content-center">
                <div class="col-md-6">
                  <i class="bi bi-clock d-block"></i>
                  <span>{{ date("H:i", strtotime($event->tgl_acara)) }} - SELESAI</span>
                </div>
                <div class="col-md-6">
                  <i class="bi bi-calendar3 d-block"></i>
                  <span>{{ date("l, d F Y", strtotime($event->tgl_acara)) }}</span>
                </div>
               </div>
              </div>
              <div class="card-footer">
                <i class="bi bi-geo-alt-fill"></i>
               {{ $event->lokasi }}
              </div>
            </div>
          </div>
          @endforeach
      </div>
    </section>
    <section id="story" class="story">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-10 text-center">
            <span>Bagaimana Kisah Kami Bersemi?</span>
            <h2>Cerita Kita</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, voluptatibus. Itaque veniam ipsam quasi, voluptate quam deleniti consequuntur ea eligendi.</p>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <ul class="timeline">
              @foreach ($undangan->stories as $key => $story)
              <li class="@if ($key%2) timeline-inverted @endif">
                <div class="timeline-image" style="background-image: url('/{{ $story->gambar }}')"></div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h3>{{ $story->judul }}</h3>
                    <span>1 September 2019</span>
                  </div>
                    <div class="timeline-body">
                      <p>{{ $story->deskripsi }}</p>
                    </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </section>
<section id="gallery" class="gallery">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-10 text-center">
        <h2>Momen Kita</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, voluptatibus. Itaque veniam ipsam quasi, voluptate quam deleniti consequuntur ea eligendi.</p>
      </div>
    </div>
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 justify-content-center">
      @foreach ($undangan->galleries as $key => $gallery )
      <div class="col mt-3">
        <a href="/{{ $gallery->slug }}" data-toggle="lightbox" data-caption="{{ ucwords(str_replace("-", " & ", $undangan->slug)) }} {{ ($key+1) }}" data-gallery="gallery-{{ $undangan->slug }}">
        <img src="/{{ $gallery->slug }}" alt="{{ ucwords(str_replace("-", " & ", $undangan->slug)) }} {{ ($key+1) }}" class="img-fluid w-100 rounded"></a>
      </div>
      @endforeach
    </div>
  </div>
</section>
<section class="gifts" id="gifts">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-10 text-center">
        <span>Ungkapan Tanda Kasih</span>
        <h2>Kirim Hadiah</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, voluptatibus. Itaque veniam ipsam quasi, voluptate quam deleniti consequuntur ea eligendi.</p>
      </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-md-6">
          <ul class="list-group">
            @foreach ($undangan->donations as $donasi)
            <li class="list-group-item">
              <div class="fw-bold">{{ $donasi->bank->nama_bank }}</div>
              {{ $donasi->no_rek }} - {{ $donasi->nama_pemilik }} 
            </li>
            @endforeach
          </ul>
        </div>
    </div>
  </div>
</section>
<section class="ucapan" id="ucapan">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-10 text-center">
        <h2>Ucapan Selamat</h2>
        <p>Ungkapkan Kebahagian dari orang terdekat:</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <form>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama">
      </div>
      <div class="mb-3">
        <label for="ucapan" class="form-label">Ucapan Bahagia</label>
        <textarea class="form-control" id="ucapan" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
  </div>
</section>

<footer>
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <small class="block"> &copy; 2024 {{ ucwords(str_replace("-", " - ", $undangan->slug)) }} Wedding. All Rights Reserved</small>
        <small class="block">Design by <a href="ceritakita.web.id">CeritaKita</a></small>
        <ul class="mt-3">
          <li><a href="https://instagram.com/axelgiovanni"><i class="bi bi-instagram"></i></a></li>
          <li><a href="https://instagram.com/axelgiovanni"><i class="bi bi-youtube"></i></a></li>
          <li><a href="https://instagram.com/axelgiovanni"><i class="bi bi-whatsapp"></i></a></li>
          <li><a href="https://instagram.com/axelgiovanni"><i class="bi bi-tiktok"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<div id="audio-container">
  <audio id="song" autoplay loop>
    <source src="assets/audio/teman-hidup.mp3" type="audio/mp3">
  </audio>

  <div class="audio-icon-wrapper" style="display:none;">
    <i class="bi bi-disc"></i>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    <script>
    simplyCountdown('.simply-countdown', {
      year: {!! json_encode(date("Y", strtotime($undangan->events[0]->tgl_acara))) !!}, // required
      month: {!! json_encode(date("m", strtotime($undangan->events[0]->tgl_acara))) !!}, // required
      day: {!! json_encode(date("d", strtotime($undangan->events[0]->tgl_acara))) !!}, // required
      hours: {!! json_encode(date("H", strtotime($undangan->events[0]->tgl_acara))) !!}, // Default is 0 [0-23] integer
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
<script>
  const stickyTop = document.querySelector('.sticky-top');
  const offcanvas = document.querySelector('offcanvas');

  offcanvas.addEventListener('show.bs.offcanvas', function(){
    stickyTop.style.overflow = 'visible';
  })

  offcanvas.addEventListener('hidden.bs.offcanvas', function() {
    stickyTop.style.overflow = 'hidden';
  })
</script>
<script>
  const audioIconWrapper = document.querySelector('.audio-icon-wrapper');
  function disableScroll() {
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

    window.onscroll = function (){
      window.scrollTo(scrollTop, scrollLeft);
    }
      const rootElement = querySelector(':root');
      rootElement.style.scrollBehavior = 'auto';
  }
  function enableScroll(){
    window.onscroll = function (){}
      const rootElement = querySelector(':root');
      rootElement.style.scrollBehavior = 'smooth';
      playAudio();
      return false;
      // locaStorage.setItem('opened', 'true');
  }

  function playAudio() {
    const song = document.querySelector('#song');
    song.volume = 0.1;
    audioIconWrapper.style.display = 'flex';
    song.play();
  }

  disableScroll();
  // if(!locaStorage.getItem('opened')){
  //   disableScroll();
  // }
</script>

  </body>
</html>
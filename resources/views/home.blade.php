@extends('layout/main')
<style>

  div.cover-image img{
    width: 100%;
    height: 100vh;
    object-fit: cover;
  }
  div.button-center{
    position: absolute;
    top: 50%;
    left: 40%;
  }
  div.container-fluid{
    background-color:	#FFF5EE;
    position: absolute
    top: 0;
    left: 0;
    padding-left: 4%;
    padding-right: 4%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }
  button{
    width: 150px;
    height: 50px;
    border: 3px solid burlywood;
  }
  h2{
    text-align: center;
    margin-top: 0; 
  }
  .card-title{
    text-align: center;
  }
</style>

<!---image--->
<div class="cover-image">
  <img src="img/akad1.jpeg">
  <div class="button-center">
    <h2>CeritaKita~</h2>
      <a href="/"><button>Konsultasi</button></a>
      <a href="/"><button>Pesan Sekarang</button></a>
  </div>
</div>
<hr>
@section('container')
    <div class="container-fluid">
      <h2>Katalog</h2>
        <div class="row">
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Wedding Gereja</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Lihat Tema</a>
                <a href="#" class="btn btn-secondary">Pesan Tema</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Wedding Akad</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Lihat Tema</a>
                <a href="#" class="btn btn-secondary">Pesan Tema</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Black & White</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Lihat Tema</a>
                <a href="#" class="btn btn-secondary">Pesan Tema</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Bunga</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Lihat Tema</a>
                <a href="#" class="btn btn-secondary">Pesan Tema</a>
              </div>
            </div>
          </div>
        </div>
        <hr>

        <div class="row mt-4">
          <h2>Kata Mereka</h2>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Review 1</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Review 2</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Review 3</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Review 4</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Review 5</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Review 6</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
        <hr>

        <div class="row">
          <h2>Ruang Baca</h2>
          <div class="col-md-4 mb-5 mt-4">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Konsep Pernikahan</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5 mt-4">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Pernikahan dalam Katolik</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5 mt-4">
            <div class="card">
              <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Pernikahan dalam Islam</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>

    </div>
@endsection




    
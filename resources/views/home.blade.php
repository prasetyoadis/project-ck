@extends('layout/main')

@section('container')
<div class="cover-image">
  <img src="img/wedding2.jpg">
  <div class="bg-shadow"></div>
  <div class="button-center">
    <h2>CeritaKita</h2>
      <a href="#undangan" class="btn btn-lg"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000"><path d="M763-145q-121-9-229.5-59.5T339-341q-86-86-135.5-194T144-764q-2-21 12.29-36.5Q170.57-816 192-816h136q17 0 29.5 10.5T374-779l24 106q2 13-1.5 25T385-628l-97 98q20 38 46 73t57.97 65.98Q422-361 456-335.5q34 25.5 72 45.5l99-96q8-8 20-11.5t25-1.5l107 23q17 5 27 17.5t10 29.5v136q0 21.43-16 35.71Q784-143 763-145ZM255-600l70-70-17.16-74H218q5 38 14 73.5t23 70.5Zm344 344q35.1 14.24 71.55 22.62Q707-225 744-220v-90l-75-16-70 70ZM255-600Zm344 344Z"/></svg> Pesan Sekarang</a>
      <a href="#undangan" class="btn btn-lg"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000"><path d="M480-312q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Zm0-72q-40 0-68-28t-28-68q0-40 28-68t68-28q40 0 68 28t28 68q0 40-28 68t-68 28Zm0 192q-130 0-239-69.5T68-445q-5-8-7-16.77t-2-18Q59-489 61-498t7-17q64-114 173-183.5T480-768q130 0 239 69.5T892-515q5 8 7 16.77t2 18q0 9.23-2 18.23t-7 17q-64 114-173 183.5T480-192Zm0-288Zm0 216q112 0 207-58t146-158q-51-100-146-158t-207-58q-112 0-207 58T127-480q51 100 146 158t207 58Z"/></svg> Lihat Katalog</a>
  </div>
  <hr>
</div>
    <div class="container-fluid">
      <h2>Katalog</h2>
        <div class="row mt-1">
          <div class="col-md-3 mb-1 mt-1">
            <div class="card">
              <img src="/img/ring.jpeg" width="100" height="250" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Party Wedding</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="/akad-nikah" class="btn"><i class='bx bx-edit-alt'></i> Lihat Tema</a>
                <a href="#" class="btn"><i class='bx bx-cart'></i>Pesan Tema</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="/img/weddingakad.jpeg" width="100" height="250" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Akad Nikah Sederhana</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn"><i class='bx bx-edit-alt'></i> Lihat Tema</a>
                <a href="#" class="btn"><i class='bx bx-cart'></i> Pesan Tema</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="/img/wedding_gereja.jpeg" width="100" height="250" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Pemberkatan Gereja</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn"><i class='bx bx-edit-alt'></i>Lihat Tema</a>
                <a href="#" class="btn"><i class='bx bx-cart'></i> Pesan Tema</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2 mt-2">
            <div class="card">
              <img src="/img/adat-jawa2.jpeg" width="100" height="250" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Adat Jawa</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn"><i class='bx bx-edit-alt'></i>Lihat Tema</a>
                <a href="#" class="btn"><i class='bx bx-cart'></i>Pesan Tema</a>
              </div>
            </div>
          </div>
        </div>
        <hr>

        <div class="row mt-2">
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
              <img src="/img/weddingakad.jpeg" width="100" height="400" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Konsep Pernikahan</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5 mt-4">
            <div class="card">
              <img src="/img/weddingakad.jpeg" width="100" height="400" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Pernikahan dalam Katolik</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5 mt-4">
            <div class="card">
              <img src="/img/weddingakad.jpeg" width="100" height="400" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Pernikahan dalam Islam</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>

    </div>
@endsection




    
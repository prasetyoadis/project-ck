@extends('layouts.main-dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Orders</h4>

<!-- Hoverable Table rows -->
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="/admin/orders/create">
          <div class="d-flex align-item-center">
              <span class="material-symbols-rounded me-1">add_notes</span>
              <span>Create Order</span>
          </div>
        </a>
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mb-0 mt-3" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible mb-0 mt-3" role="alert">
          {{ session('fail') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
    </div>
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="d-flex flex-grow-1">
                <p class="align-self-center m-0">Show</p>
                <select class="form-select mx-2" style="width: 4.5em" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">25</option>
                </select>
               <p class="align-self-center m-0">entries</p>
            </div>
            <div>
                <form action="">
                    @csrf
                    <div class="input-group">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Search.."
                          aria-label="Search.."
                          aria-describedby="Search box"
                        />
                        <button class="btn btn-icon btn-outline-primary" type="submit" id="button-addon2">
                            <span class="material-symbols-rounded">search</span>
                        </button>
                      </div>
                </form>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Nama Client</th>
                  <th>Tanggal Order</th>
                  <th>Bukti</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @if ($orders->count())
                    @foreach ($orders as $order)
                <tr>
                  <td class="fw-bold">{{ $order->uuid }}</td>
                  <td class="fw-bold">{{ $order->nama }}</td>
                  <td>{{ $order->tgl_order }}</td>
                  <td>
                    <button
                      type="button"
                      onclick="setBuktiDP('@if ($order->payment->count()){{ $order->payment[0]->bukti_bayar }}@endif')"
                      class="btn btn-sm btn-info"
                      data-bs-toggle="modal"
                      data-bs-target="#modalBukti"
                    >
                      Tampilkan
                    </button>
                  </td>
                  <td>
                    <span class="badge bg-label-warning me-1">{{ $order->status }}</span>
                </td>
                  <td class="w-25">
                    <button 
                      type="button"
                      onclick=" window.open('https://wa.me/62{{ $order->no_hp }}?text=Selamat ','_blank')"
                      class="btn btn-sm btn-info"
                    >
                      <div class="d-flex">
                        <i class='bx bxl-whatsapp align-self-center me-1'></i>
                        <span class="align-self-center">Hubungi Client</span>
                      </div>
                  </button>
                    <button type="button" class="btn btn-sm btn-primary">
                        <div class="d-flex">
                            <span class="material-symbols-rounded me-1" style="font-size: 20px">post_add</span>
                            <span class="align-self-center">Post Undangan</span>
                        </div>
                    </button>
                    <button type="button" class="d-none btn btn-sm btn-warning">
                      <div class="d-flex">
                          <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                          <span class="align-self-center">Edit Undangan</span>
                      </div>
                    </button>
                    
                  <br>
                  <button type="button" onclick="setOrderId('{{ $order->uuid }}')" class="btn btn-sm btn-success mt-1" data-bs-toggle="modal" data-bs-target="#modalLunas">
                    <div class="d-flex">
                        <span class="material-symbols-rounded me-1" style="font-size:20px">check_circle</span>
                        <span class="align-self-center">Lunas</span>
                    </div>
                  </button>
                  <form action="/admin/orders/{{ $order->uuid }}" method="post" class="d-inline">
                      @csrf
                      @method('put')
                      <input type="hidden" name="req" value="pembatalan">
                      <button type="submit" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Yakin Membatalkan Data Order Ini?')">
                          <div class="d-flex">
                              <span class="material-symbols-rounded me-1" style="font-size:20px">cancel</span>
                              <span class="align-self-center">Batal</span>
                          </div>
                      </button>
                  </form>
                    </div>
                  </td>
                </tr>
                    @endforeach
                @else
                    <tr>
                        <td scope="row" colspan="5" class="text-center">Data Order Tidak Ditemukan..</td>
                    </tr>
                @endif
              </tbody>
            </table>
        <div class="mt-2">
            {{ $orders->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
</div>
<!-- Modal -->
<div class="modal fade" id="modalLunas" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Lunas</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      
      <div class="modal-body">
        <form method="post" id="formUUID" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="req" value="pelunasan">
          <div class="mb-3">
              <label for="tgl_bayar" class="form-label">Tanggal</label>
              <input class="form-control" name="tgl_bayar" type="datetime-local" value="{{ date('Y-m-d\TH:i') }}" />
          </div>
          <div class="mb-3">
            <label for="buktibayar" class="from-label">Upload Bukti Pelunasan</label>
            <input 
                name="bukti_bayar"
                class="form-control"
                type="file"
                accept="image/png, image/jpeg"
            />
        </div>
        
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Bukti DP</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body text-center">
          <img id="bukti-dp" src="/" alt="bukti dp" class="img-fluid w-75" style="max-height: 71vh">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  function setBuktiDP(imgSRC) {
    var img = document.getElementById('bukti-dp');
    img.src = '/' + imgSRC;
  }

  function setOrderId(orderId) {
    var formUUID = document.getElementById('formUUID');
    formUUID.action = '/admin/orders/' + orderId;
  }

  function previewFoto() {
    const gambar = document.querySelector('#foto');
    const imgPreview = document.querySelector('.img-preview');

    const oFReader = new FileReader();
      oFReader.readAsDataURL(gambar.files[0]);
      oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>
@endsection
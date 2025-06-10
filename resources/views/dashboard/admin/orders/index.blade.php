@extends('dashboard.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<!-- Breadcrumb -->
    <h4 class="fw-bold py-3 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-muted fw-light">
                    <a href="/admin/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

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
                    @include('dashboard.partials.limit-table-entries')
                </div>
                <div>
                    @include('dashboard.partials.search')
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Nama Client</th>
                            <th>Tanggal Order</th>
                            <th>Status</th>
                            <th>Bukti</th>
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
                                    <td><span class="badge bg-label-warning me-1">{{ $order->status }}</span>
                                    <td>
                                        <button
                                            type="button"
                                            onclick="setBuktiDP('{{ ($order->payment->count()) ? $order->payment[0]->bukti_bayar : 'assets/img/elements/no-receipt.jpg' }}')"
                                            class="btn btn-sm btn-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalBukti"
                                        >
                                        Tampilkan
                                        </button>
                                    </td>
                                        
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
                                        @if ($order->undangan == null || $order->undangan->iscomplete == 0)
                                        <a href="/admin/invitations/create?oid={{ $order->uuid }}@php if($order->undangan != null){echo "&uid=".$order->undangan->slug;}else{ echo "";} @endphp" class="btn btn-sm @php if($order->undangan != null){echo "btn-warning";}else{ echo "btn-primary";} @endphp">
                                            <div class="d-flex">
                                                <span class="material-symbols-rounded me-1" style="font-size: 20px">@php if($order->undangan != null){echo "edit_document";}else{ echo "post_add";} @endphp</span>
                                                <span class="align-self-center">@php if($order->undangan != null){echo "Lengkapi Data";}else{ echo "Post Undangan";} @endphp</span>
                                            </div>
                                        </a>
                                        @endif
                                        
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
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td scope="row" colspan="6" class="text-center">Data Order Tidak Ditemukan..</td>
                                </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $orders->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->
<!-- Modal Pelunasan -->
<div class="modal fade" id="modalLunas" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalLabel1">Lunas</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    onclick="resetInput()"
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
                        <div class="row">
                            <div class="col-img col-6 d-none" style="max-height: 130px; overflow-y:auto">
                                <img class="img-preview-lunas img-fluid mt-1 border rounded" alt="" style="width:100%; overflow-y:scroll;">
                            </div>
                            <div class="col-input col-12">
                                <label for="buktibayar" class="from-label">Upload Bukti Pelunasan</label>
                                <input 
                                    name="bukti_bayar"
                                    id="bukti-lunas"
                                    class="form-control"
                                    type="file"
                                    accept="image/png, image/jpeg"
                                    onchange="previewGambar()"
                                />
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bukti DP-->
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
    function previewGambar() {
        const bukti = document.querySelector('#bukti-lunas');
        const imgPreview = document.querySelector('.img-preview-lunas');
        const colIN = document.querySelector('.col-input');
        const colIMG = document.querySelector('.col-img');

        colIN.classList.remove("col-12");
        colIN.classList.add("col-6");
        colIMG.classList.remove("d-none");

        const oFReader = new FileReader();
        oFReader.readAsDataURL(bukti.files[0]);
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
    function resetInput(){
        const bukti = document.querySelector('#bukti-lunas');
        const imgPreview = document.querySelector('.img-preview-lunas');
        const colIN = document.querySelector('.col-input');
        const colIMG = document.querySelector('.col-img');

        colIN.classList.remove("col-6");
        colIN.classList.add("col-12");
        colIMG.classList.add("d-none");

        bukti.value = ""
        imgPreview.src = ""
    }
</script>
@endsection
@extends('layouts.main-dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Breadcrumb -->
        <h4 class="fw-bold py-3 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item text-muted fw-light">
                        <a href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-muted fw-light">
                        <a href="/admin/orders">Orders</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </h4>
        <!--/ End Breadcrumb -->

        <!-- Hoverable Table rows -->
        <div class="card">
            <div class="card-body">
                <form action="/admin/orders" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="uuid" class="form-label">Order ID</label>
                                    <input name="uuid" type="text"
                                        class="form-control @error('uuid') is-invalid @enderror"
                                        value="{{ substr(strtoupper(uniqid('CKOI')), 0, 16) }}" readonly />
                                    @error('uuid')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_order" class="form-label">Tanggal</label>
                                    <input name="tgl_order" class="form-control @error('tgl_order') is-invalid @enderror"
                                        type="datetime-local" value="{{ date('Y-m-d\TH:i') }}" />
                                    @error('tgl_order')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Client</label>
                                <input name="nama" type="text" id="name"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="{{ auth()->user()->name }}" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="name@email.com" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Wa</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text @error('no_hp') border border-danger @enderror">
                                        <i class="bx bx-phone me-1"></i>
                                        +62
                                    </span>
                                    <input name="no_hp" type="tel" id="no_hp"
                                        class="form-control @error('no_hp') is-invalid rounded-end @enderror"
                                        placeholder="8..." @error('no_hp')style="border-right: 1px solid #ff3e1d"@enderror
                                        onkeyup="numberOnly(this)" />
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-img col-4 d-none mb-3" style="max-height: 130px; overflow-y:auto">
                                    <img class="img-preview img-fluid mt-1 border rounded" alt=""
                                        style="width:100%; overflow-y:scroll;">
                                </div>
                                <div class="col-input col-12 mb-3">
                                    <label for="bukti_bayar" class="form-label">Upload Bukti DP</label>
                                    <input name="bukti_bayar" id="bukti-bayar"
                                        class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti-bayar"
                                        type="file" accept="image/png, image/jpeg" onchange="previewGambar()" />
                                    @error('bukti_bayar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="/admin/orders" class="btn btn-danger me-2">Batal</a>
                                <div id="clearform" onclick="clearForm()" class="btn btn-warning me-2">Hapus</div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card alert-warning text-dark mt-3 mt-lg-0 mb-3">
                                <div class="card-header fw-semibold">Note:</div>
                                <div class="card-body">
                                    <span class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
                                        culpa hic est optio natus officiis aut sint neque, quae sequi, qui quis ipsum
                                        perspiciatis ab a at quaerat magnam aperiam.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function clearForm() {
            $('#name').val('');
            $('#bukti-bayar').val('');
            $('.img-preview').attr('src', '');
            $('#email').val('');
            $('#no_hp').val('');
        }

        function previewGambar() {
            const bukti = document.querySelector('#bukti-bayar');
            const imgPreview = document.querySelector('.img-preview');
            const colIN = document.querySelector('.col-input');
            const colIMG = document.querySelector('.col-img');

            colIN.classList.remove("col-12");
            colIN.classList.add("col-8");
            colIMG.classList.remove("d-none");

            const oFReader = new FileReader();
            oFReader.readAsDataURL(bukti.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function numberOnly(input) {
            var regex = /[^0-9\n\t]/gi;
            input.value = input.value.replace(regex, "");
        }
    </script>
@endsection

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
                <li class="breadcrumb-item text-muted fw-light">
                    <a href="/admin/banks">Banks</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <form action="/admin/banks" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="code" class="form-label">Bank Code</label>
                                <input
                                    name="code"
                                    type="text"
                                    class="form-control @error('code') is-invalid @enderror"
                                    placeholder="Bank Code"
                                    onkeyup="numOnly(this)"
                                />
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}        
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="isactive" class="form-label">Status</label><br>
                                <div style="margin: 7px 0">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="isactive"
                                            id="aktif"
                                            value="1"
                                            checked
                                        />
                                        <label class="form-check-label" for="aktif">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="isactive"
                                            id="nonaktif"
                                            value="0"
                                            disabled
                                        />
                                        <label class="form-check-label" for="nonaktif">Nonaktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_bank" class="form-label">Nama Bank</label>
                            <input
                                name="nama_bank"
                                type="text"
                                id="nama-tag"
                                class="form-control @error('nama_bank') is-invalid @enderror"
                                placeholder="Nama Bank"
                                onkeyup="noSymbol(this)"
                            />
                            @error('nama_bank')
                                <div class="invalid-feedback">
                                    {{ $message }}        
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    function numOnly(input) {
        var regex = /[^0-9\n\t-]/gi;
        input.value = input.value.replace(regex, "");
    }

    function noSymbol(input) {
        var regex = /[^a-zA-Z\n\t-]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>
@endsection
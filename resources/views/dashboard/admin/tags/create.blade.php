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
                    <a href="/admin/tag-themes">Tag Themes</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <form action="/admin/tag-themes/" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_tema" class="form-label">Nama Tag</label>
                                <input
                                    name="nama_tag"
                                    type="text"
                                    id="nama-tag"
                                    class="form-control @error('nama_tema') is-invalid @enderror"
                                    placeholder="Nama Tag"
                                    onkeyup="noSymbol(this)"
                                />
                                @error('nama_tema')
                                    <div class="invalid-feedback">
                                        {{ $message }}        
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input 
                                    name="slug" 
                                    type="text" 
                                    id="slug" 
                                    class="form-control @error('slug') is-invalid @enderror"
                                    style="cursor: default;"
                                    placeholder="Slug"
                                    value="{{ old('slug') }}" 
                                    onfocus="this.blur()" 
                                    readonly
                                >
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}        
                                    </div>
                                @enderror         
                            </div>
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
    $('#nama-tag').change(function() {
        $('#slug').val($('#nama-tag').val().toLowerCase().replaceAll(' ', '-'));
    });

    function noSymbol(input) {
        var regex = /[^a-zA-Z0-9 \n\t]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>
@endsection
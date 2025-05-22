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
                    <a href="/admin/category-themes">Category Themes</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <form action="/admin/category-themes/{{ $category->slug }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_category" class="form-label">Nama Tag</label>
                                <input
                                    name="nama_category"
                                    type="text"
                                    id="nama-category"
                                    class="form-control @error('nama_category') is-invalid @enderror"
                                    placeholder="Nama Category"
                                    value="{{ old('slug') ?? $category->nama_category }}"
                                    onkeyup="noSymbol(this)"
                                />
                                @error('nama_category')
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
                                    value="{{ old('slug') ?? $category->slug }}"
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
    $('#nama-category').change(function() {
        $('#slug').val($('#nama-category').val().toLowerCase().replaceAll(' ', '-'));
    });

    function noSymbol(input) {
        var regex = /[^a-zA-Z0-9 \n\t]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>
@endsection
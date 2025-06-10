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
                    <a href="/admin/songs">Songs</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <form action="/admin/songs" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_lagu" class="form-label">Nama Lagu</label>
                                <input
                                    name="nama_lagu"
                                    type="text"
                                    id="nama-tag"
                                    class="form-control @error('nama_lagu') is-invalid @enderror"
                                    placeholder="Nama Lagu"
                                    onkeyup="noSymbol(this)"
                                />
                                @error('nama_lagu')
                                    <div class="invalid-feedback">
                                        {{ $message }}        
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="slug" class="form-label">Upload Lagu</label>
                                        <input 
                                            name="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            type="file"
                                            accept="audio/mp3"
                                            onchange="previewSong(this)"
                                        />
                                        @error('slug')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror 
                                    </div>
                                    <div id="col-preview" class="d-none col-12">
                                        <span class="form-label d-block">Preview Lagu</span>
                                        <audio
                                            id="audio-preview"
                                            class=""
                                            style="height:41px;"
                                            preload="none"
                                            controls
                                        >
                                            <source id="audio-source" type="audio/mpeg" src="">
                                        </audio>
                                    </div>
                                </div>
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
        var regex = /[^a-zA-Z0-9 \n\t-]/gi;
        input.value = input.value.replace(regex, "");
    }
    function previewSong(el) {
        const audio = document.getElementById("audio-preview");
        const audioSrc = document.getElementById("audio-source");
        const colPreview = document.getElementById("col-preview");

        const oFReader = new FileReader();
        oFReader.readAsDataURL(el.files[0]);
        oFReader.onload = function(oFREvent){
            colPreview.classList.remove('d-none')
            audioSrc.src = oFREvent.target.result;
            audio.volume = 0.5;
            audio.load()
        }
    }
</script>
@endsection
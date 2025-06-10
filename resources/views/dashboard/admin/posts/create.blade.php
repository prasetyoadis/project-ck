@extends('dashboard.layouts.main')

@section('stylecss')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">  --}}
    <style>
        html {
            scroll-behavior: smooth;
        }
        .multi-step ul.progress-steps {
            display: flex;
            /* flex-direction: row; */
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: center;
            gap: 1em;
            list-style: none;
        }
        .multi-step ul.progress-steps li {
            position: relative;
            display: flex;
            width: 22.5%;
            flex-direction: column;
            align-items: flex-start;
        }
        @media (min-width: 576px) {
            .multi-step ul.progress-steps li {
                width: 22.5%;
            }
            .multi-step ul.progress-steps li:not(:last-child)::before{
                width: 75% !important;
            }
        }
        @media (min-width: 768px) {
            .multi-step ul.progress-steps li {
                width: 15.5%;
            }
        }
        @media (min-width: 992px) {
            .multi-step ul.progress-steps li {
                width: 12%;
            }
        }
        @media (min-width: 1200px) {
            .multi-step ul.progress-steps li {
                width: 10.5%;
            }
        }

        .multi-step ul.progress-steps li > span{
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1em;
            border-radius: 50%;
            background-color:#a1acb8;
            z-index: 1;
        }
        .multi-step ul.progress-steps li.active > span {
            color: white;
            background-color: #696cff;
            z-index: 1;
        }

        .multi-step ul.progress-steps li p {
            width: 100px;
        }
        .multi-step ul.progress-steps li:not(:last-child)::before{
            content: '';
            position: absolute;
            left: 40px;
            top: 20px;
            width: 75px;
            height: 2px;
            background-color: #a1acb8;
        }
        .select2-selection__arrow{
            display: none;
        }
        .select2{
            max-width: 100%;
        }
        .select2-container .select2-selection--single{
            height: inherit !important;
        }
        .select2-container--default .select2-selection--single{
            border: 1px solid #d9dee3;
            border-radius: 0.375rem;
        }
        .select2-container .select2-selection--single .select2-selection__rendered{
            padding: 0.4375rem 1.875rem 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            line-height: 1.53;
            color: #697a8d;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%2867, 89, 113, 0.6%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.875rem center;
            background-size: 17px 12px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            appearance: none;
        }
        .select2-results__option{
            padding: 6px 0.875rem 6px 0.875rem;
        }
        .select2-search--dropdown {
            padding: 4px 0.875rem;
        }
        .select2-search--dropdown .select2-search__field{
            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            background-color: #fff;
            background-clip: padding-box;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960'%3e%3cpath fill='currentColor' stroke='rgba%2867, 89, 113, 0.6%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M380-320q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l224 224q11 11 11 28t-11 28q-11 11-28 11t-28-11L532-372q-30 24-69 38t-83 14Zm0-80q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.875rem center;
            background-size: 20px;
            border: 1px solid #d9dee3;
            border-color: 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            border-radius: 0.375rem;
        }
        .select2-search--dropdown .select2-search__field:focus {
            border: 1px solid #696cff;
            outline: none;
        }
        #uploadzone{
            border: 1px solid #d9dee3;
            padding: 4px;
            border-radius: 0.375rem;
        }
        .dropzone{
            border: 1px solid white;
            border: none;
            border-radius: 0.375rem;
        }
        .dropzone .dz-preview .dz-image{
            border-radius: 0.375rem;
            border: 1px solid #d9dee3;
        }
        .dropzone .dz-preview .dz-details .dz-size{
            margin-bottom: 2rem;
        }
        .dropzone .dz-preview .dz-details .dz-size, .dropzone .dz-preview .dz-details .dz-filename{
            border-radius: 0.375rem;
        }
        .dropzone .dz-preview .dz-details{
            padding: 1em 1em;
        }
        .dropzone .dz-preview .dz-progress{
            top: 80%;
        }
        .dropzone .dz-preview .dz-remove{
            position: absolute;
            z-index: 999;
            top: -7px;
            right: -7px;
            /* background: red;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold; */
            width: 25px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            border-radius: 50%;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dropzone .dz-preview .dz-remove:hover{
            /* background: darkred; */
            text-decoration: none;
        }
        .dropzone.drag-over {
            border: 2px dashed #696cff;
            background-color: rgba(105, 108, 255, 0.05); /* Efek highlight */
            transition: all 0.05s linear;
            padding: 18px 18px
        }
    </style>
@endsection

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
            <div class="row">
            <!-- Content Of Page-->
                <div class="col-md-9">
                    <div class="row">
                        <div class="multi-step col-sm-12">
                            <ul class="progress-steps">
                                <li class="step active ">
                                    <span>1</span>
                                    <p><small>Create <br>Undangan</small></p>
                                </li>
                                <li class="step @if (session()->has('step')) @if(session('step') >= 2) active @endif @else @endif">
                                    <span>2</span>
                                    <p><small>Complate <br>Data Event <br>Acara</small></p>
                                </li>
                                <li class="step @if (session()->has('step')) @if(session('step') >= 3) active @endif @else @endif">
                                    <span>3</span>
                                    <p><small>Complate <br>Data Story</small></p>
                                </li>
                                <li class="step @if (session()->has('step')) @if(session('step') >= 4) active @endif @else @endif">
                                    <span>4</span>
                                    <p><small>Complate <br>Data Gallery</small></p>
                                </li>
                                <li class="step @if (session()->has('step')) @if(session('step') >= 5) active @endif @else @endif">
                                    <span>5</span>
                                    <p><small>Complate <br>Data Donasi</small></p>
                                </li>
                                <li class="step @if (session()->has('step')) @if(session('step') >= 6) active @endif @else @endif">
                                    <span>Final</span>
                                    <p><small>Konfirmasi</small></p>
                                </li>
                            </ul>
                        </div>
                        @if (session()->has('success'))
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible mb-0 mb-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="form-step @php if (session()->has('step')){ echo "d-none";} else { } @endphp">
                                <div class="d-flex">
                                    <span class="material-symbols-rounded me-1">post</span>
                                    <h4>Create Undangan</h4>
                                </div>
                                <form action="/admin/invitations" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label for="oid" class="form-label">Order ID</label>
                                            <input
                                                name="uuid"
                                                type="text"
                                                class="form-control @error('uuid') is-invalid @enderror"
                                                value="{{ request('oid') }}"
                                                style="cursor: default"
                                                onfocus="this.blur()"
                                                readonly
                                            />
                                            @error('uuid')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label for="slug" class="form-label">Slug Undangan</label>
                                            <input
                                                name="slug"
                                                type="text"
                                                onchange="filterSlug()"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                value="{{ old('slug') }}"
                                                placeholder="pria-dan-wanita"
                                            />
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="fs-5 my-2" style="font-weight: 500">Data Mempelai</div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <div class="mb-3">
                                                <label for="nama_pria" class="form-label">Nama Mempelai Pria</label>
                                                <input
                                                    name="nama_pria"
                                                    type="text"
                                                    class="form-control @error('nama_pria') is-invalid @enderror"
                                                    placeholder="Nama Pria"
                                                    value="{{ old('nama_pria') }}"
                                                />
                                                @error('nama_pria')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="ayah_pria" class="form-label">Nama Ayah Pria</label>
                                                <input
                                                    name="ayah_pria"
                                                    type="text"
                                                    class="form-control @error('ayah_pria') is-invalid @enderror"
                                                    placeholder="Ayah Pria"
                                                    value="{{ old('ayah_pria') }}"
                                                />
                                                @error('ayah_pria')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="ibu_pria" class="form-label">Nama Ibu Pria</label>
                                                <input
                                                    name="ibu_pria"
                                                    type="text"
                                                    class="form-control @error('ibu_pria') is-invalid @enderror"
                                                    placeholder="Ibu Pria"
                                                    value="{{ old('ibu_pria') }}"
                                                />
                                                @error('ibu_pria')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="mb-3">
                                                <label for="namaWanita" class="form-label">Nama Mempelai Wanita</label>
                                                <input
                                                    name="nama_wanita"
                                                    type="text"
                                                    class="form-control @error('nama_wanita') is-invalid @enderror"
                                                    placeholder="Nama Wanita"
                                                    value="{{ old('nama_wanita') }}"
                                                />
                                                @error('nama_wanita')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="ayah_wanita" class="form-label">Nama Ayah Wanita</label>
                                                <input
                                                    name="ayah_wanita"
                                                    type="text"
                                                    class="form-control @error('ayah_wanita') is-invalid @enderror"
                                                    placeholder="Ayah Wanita"
                                                    value="{{ old('ayah_wanita') }}"
                                                />
                                                @error('ayah_wanita')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="ibuWanita" class="form-label">Nama Ibu Wanita</label>
                                                <input
                                                    name="ibu_wanita"
                                                    type="text"
                                                    class="form-control @error('ibu_wanita') is-invalid @enderror"
                                                    placeholder="Ibu Wanita"
                                                    value="{{ old('ibu_wanita') }}"
                                                />
                                                @error('ibu_wanita')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label for="theme_id" class="form-label">Tema</label>
                                        <select name="theme_id" class="form-select select-search @error('theme_id') is-invalid @enderror">
                                            @if ($themes->count())
                                                <option>-- Pilih Tema --</option>
                                            @foreach ($themes as $theme)
                                                <option value="{{ $theme->id }}">{{ $theme->nama_tema }}</option>
                                            @endforeach
                                            @else
                                                <option>-- Data Tidak Ada --</option>
                                            @endif
                                        </select>
                                        @error('theme_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="song_id" class="form-label">Lagu</label>
                                        <select name="song_id" class="form-select select-search @error('song_id') is-invalid @enderror">
                                            @if ($songs->count())
                                                <option>-- Pilih Lagu --</option>
                                            @foreach ($songs as $song)
                                                <option value="{{ $song->id }}">{{ $song->nama_lagu }}</option>
                                            @endforeach
                                            @else
                                                <option>-- Data Tidak Ada --</option>
                                            @endif
                                        </select>
                                        @error('song_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Simpan & Next</button>
                                    </div>
                                </form>

                            </div>
                            
                            <div class="form-step @php if (session()->has('step')){ if (session('step')==2) { } else { echo "d-none";} } else { echo "d-none"; } @endphp">
                                <div class="d-flex mb-3 align-items-center">
                                    <span class="material-symbols-rounded me-1">event</span>
                                    <span class="fs-4 me-3 align-middle" style="font-weight: 500">Data Event Acara</span>
                                    <button id="event" class="btn btn-sm btn-outline-primary" onclick="addField(this.id)">
                                        <div class="d-flex align-item-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M444-444H276q-15.3 0-25.65-10.29Q240-464.58 240-479.79t10.35-25.71Q260.7-516 276-516h168v-168q0-15.3 10.29-25.65Q464.58-720 479.79-720t25.71 10.35Q516-699.3 516-684v168h168q15.3 0 25.65 10.29Q720-495.42 720-480.21t-10.35 25.71Q699.3-444 684-444H516v168q0 15.3-10.29 25.65Q495.42-240 480.21-240t-25.71-10.35Q444-260.7 444-276v-168Z"/></svg>
                                            <span>Add Field</span>
                                        </div>
                                    </button>
                                </div>
                                <form action="/admin/invitations/events" method="POST">
                                    @csrf
                                    <input type="hidden" name="oid" value="{{ request('oid') }}">
                                    <input type="hidden" name="uid" value="{{ request('uid') }}">
                                    <div id="form-event">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-3">
                                                <label for="namaAcara[0]" class="form-label">Nama Acara #1</label>
                                                <input
                                                    name="namaAcara[0]"
                                                    type="text"
                                                    class="form-control @error('namaAcara[0]') is-invalid @enderror"
                                                    placeholder="Nama Acara"
                                                />
                                                @error('namaAcara[0]')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6 mb-3">
                                                <label for="tgl_acara[0]" class="form-label">Tanggal Acara</label>
                                                <input
                                                    name="tgl_acara[0]"
                                                    class="form-control @error('tgl_acara[0]') is-invalid @enderror"
                                                    type="datetime-local"
                                                    value="{{ date('Y-m-d\TH:i') }}"
                                                />
                                                @error('tgl_acara[0]')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasi[0]" class="form-label">Lokasi</label>
                                            <input
                                                name="lokasi[0]"
                                                type="text"
                                                class="form-control @error('lokasi[0]') is-invalid @enderror"
                                                placeholder="Lokasi"
                                            />
                                            @error('lokasi[0]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gmap[0]" class="form-label">Link Google Maps</label>
                                            <input
                                                name="gmap[0]"
                                                type="text"
                                                class="form-control @error('gmap[0]') is-invalid @enderror"
                                                placeholder="Link Gmaps"
                                            />
                                            @error('gmap[0]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Simpan & Next</button>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="form-step @php if (session()->has('step')){ if (session('step')==3) { } else { echo "d-none";} } else { echo "d-none"; } @endphp">
                                <div class="d-flex mb-3 align-items-center">
                                    <span class="material-symbols-rounded me-1">history_edu</span>
                                    <span class="fs-4 me-3 align-middle" style="font-weight: 500">Complate Data Story</span>
                                    <button type="button" id="story" class="btn btn-sm btn-outline-primary" onclick="addField(this.id)">
                                        <div class="d-flex align-item-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M444-444H276q-15.3 0-25.65-10.29Q240-464.58 240-479.79t10.35-25.71Q260.7-516 276-516h168v-168q0-15.3 10.29-25.65Q464.58-720 479.79-720t25.71 10.35Q516-699.3 516-684v168h168q15.3 0 25.65 10.29Q720-495.42 720-480.21t-10.35 25.71Q699.3-444 684-444H516v168q0 15.3-10.29 25.65Q495.42-240 480.21-240t-25.71-10.35Q444-260.7 444-276v-168Z"/></svg>
                                            <span>Add Field</span>
                                        </div>
                                    </button>
                                </div>
                                <form action="/admin/invitations/stories" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="oid" value="{{ request('oid') }}">
                                    <input type="hidden" name="uid" value="{{ request('uid') }}">
                                    <div id="form-story">
                                        <div class="row">
                                            <div id="col-img0" class="col-6 d-none mb-3" style="max-height: 130px; overflow-y:auto">
                                                <img id="img-preview0" class="img-fluid mt-1 border rounded" alt="" style="width:100%; overflow-y:scroll;">
                                            </div>
                                            <div id="col-input0" class="col-12 mb-3">
                                                <label for="gambar[0]" class="form-label">Upload Gambar Story #1</label>
                                                <input 
                                                    name="gambar[0]"
                                                    class="input-img-story form-control @error('gambar[0]') is-invalid @enderror"
                                                    id="0"
                                                    type="file"
                                                    accept="image/png, image/jpeg"
                                                    onchange="previewGambar(this)"
                                                />
                                                @error('gambar[0]')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="judul[0]" class="form-label">Judul</label>
                                            <input
                                                name="judul[0]"
                                                type="text"
                                                class="form-control @error('judul[0]') is-invalid @enderror"
                                                placeholder="Nama Acara"
                                            />
                                            @error('judul[0]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi[0]" class="form-label">Deskripsi</label>
                                            <textarea
                                                name="deskripsi[0]"
                                                type="text"
                                                class="form-control @error('deskripsi[0]') is-invalid @enderror"
                                                placeholder="Deskripsi Event"
                                            ></textarea>
                                            @error('deskripsi[0]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Simpan & Next</button>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="form-step @php if (session()->has('step')){ if (session('step')==4) { } else { echo "d-none";} } else { echo "d-none"; } @endphp">
                                <div class="d-flex">
                                    <span class="material-symbols-rounded me-1">photo_library</span>
                                    <h4>Complate Data Galleries</h4>
                                </div>
                                <label for="no_rek" class="form-label">Upload Galleries</label>
                                <div id="uploadzone" class="position-relative" style="cursor: pointer">
                                    <form 
                                        id="my-awesome-dropzone"
                                        class="dropzone"
                                        action="/admin/invitations/galleries"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        <input type="hidden" name="oid" value="{{ request('oid') }}">
                                        <input type="hidden" name="uid" value="{{ request('uid') }}">
                                    </form>
                                    <div class="dz-default dz-message">
                                        <button id="browse-img" class="btn btn-sm btn-primary dz-button shadow position-absolute start-50 translate-middle" style="top: 65%">Browse Images</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" id="save-galleries" class="btn btn-success">Simpan & Next</button>
                                </div>
                            </div>
                            
                            <div class="form-step @php if (session()->has('step')){ if (session('step')==5) { } else { echo "d-none";} } else { echo "d-none"; } @endphp">
                                <div class="d-flex mb-3 align-items-center">
                                    <span class="material-symbols-rounded me-1">credit_card</span>
                                    <span class="fs-4 me-3 align-middle" style="font-weight: 500">Complate Data Donasi</span>
                                    <button type="button" id="donasi" class="btn btn-sm btn-outline-primary" onclick="addField(this.id)">
                                        <div class="d-flex align-item-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M444-444H276q-15.3 0-25.65-10.29Q240-464.58 240-479.79t10.35-25.71Q260.7-516 276-516h168v-168q0-15.3 10.29-25.65Q464.58-720 479.79-720t25.71 10.35Q516-699.3 516-684v168h168q15.3 0 25.65 10.29Q720-495.42 720-480.21t-10.35 25.71Q699.3-444 684-444H516v168q0 15.3-10.29 25.65Q495.42-240 480.21-240t-25.71-10.35Q444-260.7 444-276v-168Z"/></svg>
                                            <span>Add Field</span>
                                        </div>
                                    </button>
                                </div>
                                <form action="/admin/invitations/donations" method="POST">
                                    @csrf
                                    <input type="hidden" name="oid" value="{{ request('oid') }}">
                                    <input type="hidden" name="uid" value="{{ request('uid') }}">
                                    <div id="form-donasi">
                                        <div class="mb-3 mt-2">
                                            <label for="bank_id[0]" class="form-label">Bank #1</label>
                                            <select name="bank_id[0]" class="form-select select-search @error('bank_id') is-invalid @enderror">
                                                @if ($banks->count())
                                                    <option>-- Pilih Bank --</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                                @endforeach
                                                @else
                                                    <option>-- Data Tidak Ada --</option>
                                                @endif
                                            </select>
                                            @error('bank_id[0]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label for="nama_pemilik[0]" class="form-label">Nama Pemilik</label>
                                                <input
                                                    name="nama_pemilik[0]"
                                                    type="text"
                                                    class="form-control @error('nama_pemilik[0]') is-invalid @enderror"
                                                    placeholder="Nama Pemilik"
                                                />
                                                @error('nama_pemilik[0]')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="no_rek[0]" class="form-label">No Rekening</label>
                                                <input
                                                    name="no_rek[0]"
                                                    type="text"
                                                    class="form-control @error('no_rek[0]') is-invalid @enderror"
                                                    placeholder="Nomer Rekening"
                                                />
                                                @error('no_rek[0]')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Simpan & Next</button>
                                    </div>
                                </form>
                            </div>
                            {{-- @php if (){ if () { } else { echo "d-none";} } else { echo "d-none"; } @endphp --}}
                            @if (session()->has('step'))
                                @if (session('step')==6)
                                <div class="form-step">
                                    <div class="d-flex">
                                        <span class="fs-3 material-symbols-rounded me-1">list_alt_check</span>
                                        <h3>Konfirmasi Data</h3>
                                    </div>
                                <!-- KONFIRMASI DATA Undangan -->
                                    <div id="undangan" class="d-flex mb-1 align-items-center">
                                        <span class="material-symbols-rounded me-1">post</span>
                                        <span class="fs-4 me-3 align-middle" style="font-weight: 500">Data Undangan</span>
                                        <button 
                                            class="btn btn-sm btn-outline-primary" 
                                            data-size="large" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            onclick="setModel('undangan', 0)"
                                        >
                                            <div class="d-flex align-item-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                                                <span class="ms-1">Edit Data</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug Undangan</label>
                                        <div class="form-control" style="background-color: #eceef1; opacity: 1;">
                                            {{ $undangan[0]->slug }}
                                        </div>
                                    </div>
                                <!-- KONFIRMASI DATA MEMPELAI -->
                                    <div id="couples" class="my-2" style="font-weight: 500">
                                        <span class="fs-5 me-3 align-middle" style="font-weight: 500">Data Mempelai</span>
                                        <button 
                                            class="btn btn-sm btn-outline-primary" 
                                            data-size="large" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            onclick="setModel('mempelai', 0)"
                                        >
                                            <div class="d-flex align-item-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                                                <span class="ms-1">Edit Data</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Mempelai Pria</label>
                                                <div class="form-control">
                                                    {{ $undangan[0]->couple->nama_pria }}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Ayah Pria</label>
                                                <div class="form-control">
                                                    {{ $undangan[0]->couple->ayah_pria }}
                                                </div>
                                            </div>
                                            <div>
                                                <label class="form-label">Nama Ibu Pria</label>
                                                <div class="form-control">
                                                    {{ $undangan[0]->couple->ibu_pria }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Mempelai Wanita</label>
                                                <div class="form-control">
                                                    {{ $undangan[0]->couple->nama_wanita }}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Ayah Wanita</label>
                                                <div class="form-control">
                                                    {{ $undangan[0]->couple->ayah_wanita }}
                                                </div>
                                            </div>
                                            <div>
                                                <label class="form-label">Nama Ibu Wanita</label>
                                                <div class="form-control">
                                                    {{ $undangan[0]->couple->ibu_wanita }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label">Tema</label>
                                        <div class="form-control">
                                            {{ $undangan[0]->theme->nama_tema }}
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 2rem">
                                        <label class="form-label">Lagu</label>
                                        <div class="form-control">
                                            {{ $undangan[0]->song->nama_lagu }}
                                        </div>
                                    </div>
                                <!-- KONFIRMASI DATA EVENTS -->
                                    <div id="events" class="d-flex mb-1 align-items-center">
                                        <span class="material-symbols-rounded me-1">event</span>
                                        <span class="fs-4 me-3 align-middle" style="font-weight: 500">Data Event</span>
                                    </div>
                                    @foreach ($events as $key => $event)
                                    <div class="my-2" style="font-weight: 500">
                                        <span class="fs-5 me-3 align-middle" style="font-weight: 500">Data Event #{{ ($key+1) }}</span>
                                        <button 
                                            class="btn btn-sm btn-outline-primary" 
                                            data-size="large" data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            onclick="setModel('event', {{ $key }})"
                                        >
                                            <div class="d-flex align-item-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                                                <span class="ms-1">Edit Data</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="form-label">Nama Acara</label>
                                            <div class="form-control">
                                                {{ $event->nama_acara }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label class="form-label">Tanggal Acara</label>
                                            <div class="position-relative">
                                                <input
                                                    class="form-control"
                                                    type="datetime-local"
                                                    value="{{ $event->tgl_acara }}"
                                                    disabled
                                                />
                                                <svg class="position-absolute" style="bottom: 27%; right: 15.4px;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="transform: ;msFilter:;"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi</label>
                                        <div class="form-control">
                                            {{ $event->lokasi }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Link Google Maps</label>
                                        <div class="form-control">
                                            {{ $event->link_gmaps }}
                                        </div>
                                    </div>    
                                    @endforeach
                                <!-- KONFIRMASI DATA STORIES -->
                                    <div id="stories" class="d-flex mb-1 align-items-center">
                                        <span class="material-symbols-rounded me-1">history_edu</span>
                                        <span class="fs-4 me-3 align-middle" style="font-weight: 500">Data Story</span>
                                    </div>
                                    @foreach ($stories as $key => $story)
                                    <div class="my-2" style="font-weight: 500">
                                        <span class="fs-5 me-3 align-middle" style="font-weight: 500">Data Story #{{ ($key+1) }}</span>
                                        <button 
                                            class="btn btn-sm btn-outline-primary" 
                                            data-size="large" data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            onclick="setModel('story', {{ $key }})"
                                        >
                                            <div class="d-flex align-item-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                                                <span class="ms-1">Edit Data</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3" style="overflow-y:auto;">
                                            <img src="/{{ $story->gambar }}" class="img-fluid border rounded" alt="" style="width:100%; object-fit: cover; aspect-ratio: 2/1.175">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">Judul</label>
                                                    <div class="form-control">
                                                        {{ $story->judul }}
                                                    </div>
                                                </div>
                                                <div class="col-12 d-none d-sm-block">
                                                    <label class="form-label">Deskripsi</label>
                                                    <div class="form-control" style="max-height: 6.577rem; overflow-y:scroll;">
                                                        {{ $story->deskripsi }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mb-3 d-sm-none">
                                            {{-- <div class="mb-3">
                                                <label class="form-label">Judul</label>
                                                <div class="form-control">
                                                    {{ $story->judul }}
                                                </div>
                                            </div> --}}
                                            <div>
                                                <label class="form-label">Deskripsi</label>
                                                <div class="form-control" style="max-height: 6.577rem; overflow-y:scroll;">
                                                    {{ $story->deskripsi }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                <!-- KONFIRMASI DATA GALLERIES -->
                                    <div id="galleries" class="d-flex mb-2 align-items-center">
                                        <span class="material-symbols-rounded me-1">photo_library</span>
                                        <span class="fs-4 me-3 align-middle" style="font-weight: 500">Data Galleries</span>
                                    </div>
                                    <div class="border rounded boder-secondary w-100 mb-3">
                                        <div class="row row-cols-2 row-cols-md-4 m-2">
                                        @foreach ($galleries as $key => $img)
                                            <div class="position-relative col p-2" style="aspect-ratio: 1/1">
                                                <img src="/{{ $img->slug }}" alt="gambar-{{ ($key+1) }}" class="rounded w-100" style="height: 100%; object-fit: cover;">

                                                <button 
                                                    type="button" 
                                                    class="btn btn-sm rounded-pill btn-icon btn-primary position-absolute" 
                                                    style="top: 0px; right: 2.15rem;"
                                                    data-size="large" data-bs-toggle="modal" 
                                                    data-bs-target="#modalEdit"
                                                    onclick="setModel('gallery', {{ $key }})"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" width="16px" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                                                </button>
                                                <form class="d-none" action="/admin/invitations/del-img" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-sm rounded-pill btn-icon btn-danger position-absolute" 
                                                        style="top: 0px; right: 0px;" 
                                                        onclick="return confirm('Yakin Ingin Menghapus Gambar Ini?')"  
                                                    >
                                                        ✖
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                        @if ($galleries->count() <8)
                                            <div class="col p-2" style="aspect-ratio: 1/1">
                                                <form action="">
                                                    <div class="position-relative border-primary rounded" style="aspect-ratio: 1/1; border: 3px dashed;">
                                                        <label for="img" style="width:100%; height:100%; cursor: pointer;">
                                                            <input class="d-none" type="file" id="img" name="img" accept="image/png, image/jpeg" >
                                                            <div class="position-absolute top-50 start-50 translate-middle btn btn-sm btn-primary">Add New Image</div>
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                <!-- KONFIRMASI DATA DONATIONS -->
                                    <div id="donations" class="d-flex mb-1 align-items-center">
                                        <span class="material-symbols-rounded me-1">credit_card</span>
                                        <span class="fs-4 me-3 align-middle" style="font-weight: 500">Data Donasi</span>
                                    </div>
                                    @foreach ($donations as $key => $donasi)
                                    <div class="my-2" style="font-weight: 500">
                                        <span class="fs-5 me-3 align-middle" style="font-weight: 500">Data Donasi #{{ ($key+1) }}</span>
                                        <button 
                                            class="btn btn-sm btn-outline-primary" 
                                            data-size="large" data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            onclick="setModel('donasi', {{ $key }})"
                                        >
                                            <div class="d-flex align-item-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                                                <span class="ms-1">Edit Data</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="form-control">
                                                {{ $donasi->bank->nama_bank }}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label class="form-label">Nama Pemilik</label>
                                                    <div class="form-control">
                                                        {{ $donasi->nama_pemilik }}
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label class="form-label">No Rekening</label>
                                                    <div class="form-control">
                                                        {{ $donasi->no_rek }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <form action="/admin/invitations/{{ request('uid') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <input type="text" name="type" value="complete" hidden>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Selesaikan</button>
                                    </div>
                                </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            <!-- Aside Note Page -->
                <div class="col-md-3">
                    <div class="card mt-3 mt-lg-0 mb-3" style="background-color: rgb(255, 244, 230); border: 1 solid rgb(246, 210, 176)">
                        <div class="card-header fw-semibold">Note:</div>
                        <div class="card-body">
                            <span class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam culpa hic est optio natus officiis aut sint neque, quae sequi, qui quis ipsum perspiciatis ab a at quaerat magnam aperiam.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalLabel">Edit Data</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
            
                <div class="modal-body">
                    <form method="post" id="formEdit" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="body-form">
                            <!-- append at javascript -->
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--/ End Modal Edit -->

@endsection

@section('js')
@if (session()->has('step'))
    @if (session('step')==6)
        <script>
            let formedit = document.getElementById('formEdit');
            let modalLabel = document.getElementById('backDropModalLabel');
            function setModel(caseEdit, i){
                switch (caseEdit) {
                    case "undangan":
                        var data = {!! json_encode($undangan) !!};
                        var data = data[i];
                        modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data Undangan';
                        formedit.action = '/admin/invitations/' + data.slug;
                        $('.body-form').append(
                            `<div class="child-body-form">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug Undangan</label>
                                    <input
                                        name="slug"
                                        type="text"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug') ?? "`+ data.slug+`" }}"
                                        placeholder="pria-wanita"
                                        onkeyup="noSymbol(this)"
                                    />
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="theme_id" class="form-label d-block">Tema</label>
                                    <select name="theme_id" id="select-edit-theme" class="form-select select-search @error('theme_id') is-invalid @enderror" style="width: 100%">
                                        @if ($themes->count())
                                            <option>-- Pilih Tema --</option>
                                        @foreach ($themes as $id => $theme)
                                            <option value="{{ $theme->id }}">{{ $theme->nama_tema }}</option>
                                        @endforeach
                                        @else
                                            <option>-- Data Tidak Ada --</option>
                                        @endif
                                    </select>
                                    @error('theme_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="song_id" class="form-label d-block">Lagu</label>
                                    <select name="song_id" id="select-edit-song" class="form-select select-search @error('song_id') is-invalid @enderror" style="width: 100%">
                                        @if ($songs->count())
                                            <option>-- Pilih Lagu --</option>
                                        @foreach ($songs as $song)
                                            <option value="{{ $song->id }}">{{ $song->nama_lagu }}</option>
                                        @endforeach
                                        @else
                                            <option>-- Data Tidak Ada --</option>
                                        @endif
                                    </select>
                                    @error('song_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                            </div>`
                        );
                        $(document).ready(function(){
                            var old = {!! json_encode(["song_id" => old('song_id'), "theme_id" => old('theme_id')]) !!}
                            $('.select-search').each(function () {
                                $(this).select2({
                                    dropdownParent: $(this).parent(),// fix select2 search input focus bug
                                })
                            });
                            // Set Selected data to el Select2
                            $('#select-edit-song').val(old.song_id ?? data.song_id).trigger("change");
                            $('#select-edit-theme').val(old.theme_id ?? data.theme_id).trigger("change");
                        });
                    break;
                    case "mempelai":
                        data = {!! json_encode($undangan) !!};
                        data = data[i].couple;
                        modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data Mempelai';
                        formedit.action = '/admin/invitations/couples/'+data.id
                        $('.body-form').append(
                            `<div class="child-body-form">
                                <input type="hidden" name="oid" value="{{ request('oid') }}">
                                <input type="hidden" name="uid" value="{{ request('uid') }}">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label for="nama_pria" class="form-label">Nama Mempelai Pria</label>
                                            <input
                                                name="nama_pria"
                                                type="text"
                                                class="form-control @error('nama_pria') is-invalid @enderror"
                                                placeholder="Nama Pria"
                                                value="{{ old('nama_pria', "`+data.nama_pria+`") }}"
                                            />
                                            @error('nama_pria')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ayah_pria" class="form-label">Nama Ayah Pria</label>
                                            <input
                                                name="ayah_pria"
                                                type="text"
                                                class="form-control @error('ayah_pria') is-invalid @enderror"
                                                placeholder="Ayah Pria"
                                                value="{{ old('ayah_pria', "`+data.ayah_pria+`") }}"
                                            />
                                            @error('ayah_pria')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="ibu_pria" class="form-label">Nama Ibu Pria</label>
                                            <input
                                                name="ibu_pria"
                                                type="text"
                                                class="form-control @error('ibu_pria') is-invalid @enderror"
                                                placeholder="Ibu Pria"
                                                value="{{ old('ibu_pria', "`+data.ibu_pria+`") }}"
                                            />
                                            @error('ibu_pria')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label for="namaWanita" class="form-label">Nama Mempelai Wanita</label>
                                            <input
                                                name="nama_wanita"
                                                type="text"
                                                class="form-control @error('nama_wanita') is-invalid @enderror"
                                                placeholder="Nama Wanita"
                                                value="{{ old('nama_wanita', "`+data.nama_wanita+`") }}"
                                            />
                                            @error('nama_wanita')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ayah_wanita" class="form-label">Nama Ayah Wanita</label>
                                            <input
                                                name="ayah_wanita"
                                                type="text"
                                                class="form-control @error('ayah_wanita') is-invalid @enderror"
                                                placeholder="Ayah Wanita"
                                                value="{{ old('ayah_wanita', "`+data.ayah_wanita+`") }}"
                                            />
                                            @error('ayah_wanita')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="ibuWanita" class="form-label">Nama Ibu Wanita</label>
                                            <input
                                                name="ibu_wanita"
                                                type="text"
                                                class="form-control @error('ibu_wanita') is-invalid @enderror"
                                                placeholder="Ibu Wanita"
                                                value="{{ old('ibu_wanita', "`+data.ibu_wanita+`") }}"
                                            />
                                            @error('ibu_wanita')
                                                <div class="invalid-feedback">
                                                    {{ $message }}        
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        );
                    break;
                    case "event":
                        var data = {!! json_encode($events) !!};
                        var data = data[i];
                        modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data Event #'+(i+1);
                        formedit.action = '/admin/invitations/events/'+data.id
                        $('.body-form').append(
                            `<div class="child-body-form">
                                <input type="hidden" name="oid" value="{{ request('oid') }}">
                                <input type="hidden" name="uid" value="{{ request('uid') }}">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="nama_acara" class="form-label">Nama Acara #1</label>
                                        <input
                                            name="nama_acara"
                                            type="text"
                                            class="form-control @error('nama_acara') is-invalid @enderror"
                                            placeholder="Nama Acara"
                                            value="{{ old('nama_acara', "`+data.nama_acara+`") }}"
                                        />
                                        @error('nama_acara')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="tgl_acara" class="form-label">Tanggal Acara</label>
                                        <input
                                            name="tgl_acara"
                                            class="form-control @error('tgl_acara') is-invalid @enderror"
                                            type="datetime-local"
                                            value="{{ old('tgl_acara', "`+data.tgl_acara+`") }}"
                                        />
                                        @error('tgl_acara')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input
                                        name="lokasi"
                                        type="text"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        placeholder="Lokasi"
                                        value="{{ old('lokasi', "`+data.lokasi+`") }}"
                                    />
                                    @error('lokasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="link_gmaps" class="form-label">Link Google Maps</label>
                                    <input
                                        name="link_gmaps"
                                        type="text"
                                        class="form-control @error('link_gmaps') is-invalid @enderror"
                                        placeholder="Link Gmaps"
                                        value="{{ old('link_gmaps', "`+data.link_gmaps+`") }}"
                                    />
                                    @error('link_gmaps')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                            </div>`
                        );
                    break;
                    case "story":
                        var data = {!! json_encode($stories) !!};
                        var data = data[i];
                        modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data Story #'+(i+1);
                        formedit.action = '/admin/invitations/stories/'+data.id;
                        $('.body-form').append(
                            `<div class="child-body-form">
                                <input type="hidden" name="oid" value="{{ request('oid') }}">
                                <input type="hidden" name="uid" value="{{ request('uid') }}">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3" style="max-height: 130px; overflow-y:auto">
                                        <img src="/`+data.gambar+`" id="modal-img-preview" class="img-fluid mt-1 border rounded" alt="" style="width:100%; overflow-y:scroll;">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="gambar" class="form-label">Upload Gambar Story #1</label>
                                        <input 
                                            name="gambar"
                                            class="form-control @error('gambar') is-invalid @enderror"
                                            id="0"
                                            type="file"
                                            accept="image/png, image/jpeg"
                                            onchange="previewModalGambar(this)"
                                        />
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input
                                        name="judul"
                                        type="text"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Nama Acara"
                                        value="{{ old('judul', "`+data.judul+`") }}"
                                    />
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea
                                        name="deskripsi"
                                        type="text"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        style="max-height:12rem; height:8rem"
                                        placeholder="Deskripsi Event"
                                    >{{ old('deskripsi', "`+data.deskripsi+`") }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                            </div>`
                        );
                    break;
                    case "gallery":
                        var data = {!! json_encode($galleries) !!};
                        var data = data[i];
                        modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data Gallery #'+(i+1);
                        formedit.action = '/admin/invitations/galleries/'+data.id;
                        $('.body-form').append(
                            `<div class="child-body-form">
                                <input type="hidden" name="oid" value="{{ request('oid') }}">
                                <input type="hidden" name="uid" value="{{ request('uid') }}">
                                <div class="mb-3">
                                    <img src="/`+data.slug+`" id="modal-img-preview" class="img-fluid border rounded" alt="" style="width:100%; object-fit: cover; aspect-ratio: 2/1.175">
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Upload Gambar Gallery</label>
                                    <input 
                                        name="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        type="file"
                                        accept="image/png, image/jpeg"
                                        onchange="previewModalGambar(this)"
                                    />
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                            </div>`
                        );
                    break;
                    case "donasi":
                        var data = {!! json_encode($donations) !!};
                        var data = data[i];
                        modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data Donasi #'+(i+1);
                        formedit.action = '/admin/invitations/donations/'+data.id;
                        $('.body-form').append(
                            `<div class="child-body-form">
                                <input type="hidden" name="oid" value="{{ request('oid') }}">
                                <input type="hidden" name="uid" value="{{ request('uid') }}">
                                <div class="mb-3 mt-2">
                                    <label for="bank_id" class="form-label">Bank #0</label>
                                    <select name="bank_id" id="select-edit-bank" class="form-select select-search @error('bank_id') is-invalid @enderror" style="width: 100%">
                                        @if ($banks->count())
                                            <option>-- Pilih Bank --</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                        @endforeach
                                        @else
                                            <option>-- Data Tidak Ada --</option>
                                        @endif
                                    </select>
                                    @error('bank_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                        <input
                                            name="nama_pemilik"
                                            type="text"
                                            class="form-control @error('nama_pemilik') is-invalid @enderror"
                                            placeholder="Nama Pemilik"
                                            value="{{ old('nama_pemilik', "`+data.nama_pemilik+`") }}"
                                        />
                                        @error('nama_pemilik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="no_rek" class="form-label">No Rekening</label>
                                        <input
                                            name="no_rek"
                                            type="text"
                                            class="form-control @error('no_rek') is-invalid @enderror"
                                            placeholder="Nomer Rekening"
                                            value="{{ old('no_rek', "`+data.no_rek+`") }}"
                                        />
                                        @error('no_rek')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            
                            </div>`
                        );
                        $(document).ready(function(){
                            var old = {!! json_encode(["bank_id" => old('bank_id')]) !!}
                            $('.select-search').each(function () {
                                $(this).select2({
                                    dropdownParent: $(this).parent(),// fix select2 search input focus bug
                                })
                            });
                            // Set Selected data to el Select2
                            $('#select-edit-bank').val(old.bank_id ?? data.bank_id).trigger("change");
                        });
                    break;
                    default:
                        formedit.action = ''
                        break;
                }
                
            };
            $(document).on('hidden.bs.modal', '#modalEdit', function () {
                $('.child-body-form').remove();
                modalLabel.innerHTML = modalLabel.innerText = modalLabel.textContent = 'Edit Data';
                formedit.action = '';
            });
            $(document).on('select2:close', '.select-search', function (e) {
                var evt = "scroll.select2"
                $(e.target).parents().off(evt)
                $(window).off(evt)
            })
        </script>
    @endif
@endif
<script>
    window.onload = function () {
        //change selectboxes to selectize mode to be searchable
        $(".select-search").select2({});
        $('.select-search').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Search..');
        });
    };

    // $("#formEdit").on('submit', function(evt){
    //     evt.target.preventDefault();
    //     evt.target.stopPropagation();
    //     $('#formEdit').modal('show');
    // });
    
    var dropzone = new Dropzone("#my-awesome-dropzone", {
        url: '/admin/invitations/galleries',
        required:true,
        method: 'post',
        paramName: 'images',
        uploadMultiple: true,
        autoProcessQueue: false,
        parallelUploads: 8,
        addRemoveLinks: true,
        thumbnailWidth: 200,
        maxFilesize: 5,
        maxFiles: 8,
        timeout: 6000,
        acceptedFiles: 'image/*',
        dictDefaultMessage: 'Drag & Drop image here to upload',
        clickable: '#uploadzone',
        dictRemoveFile: "✖",
        // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        successmultiple: function(file, xhr){
            if(xhr) {
                var response = JSON.parse(xhr);
            }
            window.location.href = '/admin/invitations/galleries/return?oid='+ response.oid+ '&uid='+ response.uid;
        },
        init: function () {
            let btnBrowse = document.getElementById("browse-img");
            let dropzoneElement = document.getElementById("my-awesome-dropzone");
            let dragCounter = 0;
            // Update selector to match your button
            $("#save-galleries").click(function (e) {
                e.preventDefault();
                dropzone.processQueue();
            });

            this.on("addedfile", function (file) {
                let btnRemove = file.previewElement.querySelector(".dz-remove");
                if (btnBrowse) {
                    btnBrowse.style.display = "none";
                }
                if (btnRemove) {
                    btnRemove.innerHTML = "✖"; // Ganti teks dengan ikon silang
                    btnRemove.classList.add("btn-danger") 
                }
            });

            this.on("removedfile", function () {
                if (dropzone.files.length === 0 && btnBrowse) {
                    btnBrowse.style.display = "block";
                }
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#my-awesome-dropzone').serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });
            });

            // Tambahkan class saat file masuk ke area Dropzone
            dropzoneElement.addEventListener("dragenter", function () {
                dragCounter++;
                dropzoneElement.classList.add("drag-over");
            });

            // Hapus class saat file keluar dari area Dropzone
            dropzoneElement.addEventListener("dragleave", function () {
                dragCounter--;
                if (dragCounter === 0) {
                    dropzoneElement.classList.remove("drag-over");
                }
            });

            // Hapus class ketika file benar-benar dijatuhkan
            this.on("drop", function () {
                dragCounter = 0;
                dropzoneElement.classList.remove("drag-over");
            });
        }
    });
    
    var i = j = k = l = 0;

    function addField(btn_id) {
        switch (btn_id) {
            case "event":
                ++i;
                if (i<2){
                    $('#form-event').append(
                        `<div class="row mt-4 event">
                            <div class="col-10 col-sm-11">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="namaAcara[`+i+`]" class="form-label">Nama Acara #`+(i+1)+`</label>
                                        <input
                                            name="namaAcara[`+i+`]"
                                            type="text"
                                            class="form-control @error('namaAcara[`+i+`]') is-invalid @enderror"
                                            placeholder="Nama Acara"
                                        />
                                        @error('namaAcara[`+i+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="tgl_acara[`+i+`]" class="form-label">Tanggal Acara</label>
                                        <input
                                            name="tgl_acara[`+i+`]"
                                            class="form-control @error('tgl_acara[`+i+`]') is-invalid @enderror"
                                            type="datetime-local"
                                            value="{{ date('Y-m-d\TH:i') }}"
                                        />
                                        @error('tgl_acara[`+i+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi[`+i+`]" class="form-label">Lokasi</label>
                                    <input
                                        name="lokasi[`+i+`]"
                                        type="text"
                                        class="form-control @error('lokasi[`+i+`]') is-invalid @enderror"
                                        placeholder="Lokasi"
                                    />
                                    @error('lokasi[`+i+`]')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gmap[`+i+`]" class="form-label">Link Google Maps</label>
                                    <input
                                        name="gmap[`+i+`]"
                                        type="text"
                                        class="form-control @error('gmap[`+i+`]') is-invalid @enderror"
                                        placeholder="Link Gmaps"
                                    />
                                    @error('gmap[`+i+`]')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-btn col-2 col-sm-1 align-self-center">
                                <button type="button" id="remove-event" class="btn btn-icon btn-outline-danger remove-row-event">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </div>
                        </div>`
                    );
                    $("#event").attr('disabled','disabled');
                }
                break;
            case "story":
                ++j; ++k;
                if (k>3) {
                    $("#story").attr('disabled','disabled');
                }
                if (k<5) {
                    $('#form-story').append(
                        `<div class="row mt-4 story">
                            <div class="col-10 col-sm-11">
                                <div class="row">
                                    <div id="col-img`+j+`" class="col-6 d-none mb-3" style="max-height: 130px; overflow-y:auto">
                                        <img id="img-preview`+j+`" class="img-fluid mt-1 border rounded" alt="" style="width:100%; overflow-y:scroll;">
                                    </div>
                                    <div id="col-input`+j+`" class="col-12 mb-3">
                                        <label for="gambar[`+j+`]" class="form-label">Upload Gambar Story #`+(j+1)+`</label>
                                        <input 
                                            name="gambar[`+j+`]"
                                            class="input-img-story form-control @error('gambar[`+j+`]') is-invalid @enderror"
                                            id="`+j+`"
                                            type="file"
                                            accept="image/png, image/jpeg"
                                            onchange="previewGambar(this)"
                                        />
                                        @error('gambar[`+j+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="mb-3">
                                        <label for="judul[`+j+`]" class="form-label">Judul</label>
                                        <input
                                            name="judul[`+j+`]"
                                            type="text"
                                            class="form-control @error('judul[`+j+`]') is-invalid @enderror"
                                            placeholder="Nama Acara"
                                        />
                                        @error('judul[`+j+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi[`+j+`]" class="form-label">Deskripsi</label>
                                        <textarea
                                            name="deskripsi[`+j+`]"
                                            type="text"
                                            class="form-control @error('deskripsi[`+j+`]') is-invalid @enderror"
                                            placeholder="Deskripsi Event"
                                        ></textarea>
                                        @error('deskripsi[`+j+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}        
                                            </div>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-2 col-sm-1 align-self-center">
                                <button type="button" id="remove-story" class="btn btn-icon btn-outline-danger remove-row-event">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </div>
                        </div>`
                    );
                }
            break;
            case "donasi":
                l++;
                if (l<2){
                    $('#form-donasi').append(
                        `<div class="row mt-4 donasi">
                            <div class="col-10 col-sm-11">
                                <div class="mb-3 mt-2">
                                    <label for="bank_id[`+l+`]" class="form-label">Bank #`+(l+1)+`</label>
                                    <select name="bank_id[`+l+`]" class="form-select select-search @error('bank_id') is-invalid @enderror">
                                        @if ($banks->count())
                                            <option>-- Pilih Bank --</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                        @endforeach
                                        @else
                                            <option>-- Data Tidak Ada --</option>
                                        @endif
                                    </select>
                                    @error('bank_id[`+l+`]')
                                        <div class="invalid-feedback">
                                            {{ $message }}        
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="nama_pemilik[`+l+`]" class="form-label">Nama Pemilik</label>
                                        <input
                                            name="nama_pemilik[`+l+`]"
                                            type="text"
                                            class="form-control @error('nama_pemilik[`+l+`]') is-invalid @enderror"
                                            placeholder="Nama Pemilik"
                                        />
                                        @error('nama_pemilik[`+l+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="no_rek[`+l+`]" class="form-label">No Rekening</label>
                                        <input
                                            name="no_rek[`+l+`]"
                                            type="text"
                                            class="form-control @error('no_rek[`+l+`]') is-invalid @enderror"
                                            placeholder="Nomer Rekening"
                                        />
                                        @error('no_rek[`+l+`]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-sm-1 align-self-center">
                                <button type="button" id="remove-donasi" class="btn btn-icon btn-outline-danger remove-row-event">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </div>
                        </div>`
                    );
                    $("#donasi").attr('disabled','disabled');
                }
            break;
            default:
            break;
        }
    }

    $(document).on('click','.remove-row-event', function(){
        var prnt = $(this).parent();
        prnt.parent().remove();
        switch (this.id) {
            case "remove-event":
                $("#event").removeAttr('disabled');
                i=0;
            break;
            case "remove-story":
                $("#story").removeAttr('disabled');
                --k;
            break;
            case "remove-donasi":
                $("#donasi").removeAttr('disabled');
                l=0;
            break;
            default:
            break;
        }
    });

    function numberOnly(input) {
        var regex = /[^0-9\n\t]/gi;
        input.value = input.value.replace(regex, "");
    }

    function noSymbol(input) {
        var regex = /[^a-zA-Z-\n\t]/gi;
        input.value = input.value.replace(regex, "");
    }

    function previewModalGambar(el) {
        // const gambarEvent = document.getElementsByClassName("input-img-story")[id];
        const imgPreview = document.getElementById("modal-img-preview");

        // console.log(gambarEvent.files[0])
        const oFReader = new FileReader();
        oFReader.readAsDataURL(el.files[0]);
        oFReader.onload = function(oFREvent){
            // console.log(oFREvent.target.result);
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewGambar(el) {
        // const gambarEvent = document.getElementsByClassName("input-img-story")[id];
        const imgPreview = document.getElementById("img-preview"+el.id);
        const colIN = document.getElementById("col-input"+el.id);
        const colIMG = document.getElementById("col-img"+el.id);
        // console.log(el);
        colIN.classList.remove("col-12");
        colIN.classList.add("col-6");
        colIMG.classList.remove("d-none");

        // console.log(gambarEvent.files[0])
        const oFReader = new FileReader();
        oFReader.readAsDataURL(el.files[0]);
        oFReader.onload = function(oFREvent){
            // console.log(oFREvent.target.result);
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
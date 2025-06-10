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
            <a class="btn btn-primary" href="/admin/songs/create">
                <div class="d-flex align-item-center">
                    <span class="material-symbols-rounded me-1">music_note_add</span>
                    <span>Add Song</span>
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
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th style="width: 30%">Nama Lagu</th>
                                    <th style="width: 10%">Play</th>
                                    <th style="width: 25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if ($songs->count())
                                    @foreach ($songs as $song)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td class="fw-bold">{{ $song->nama_lagu }}</td>
                                            <td class="d-flex align-self-center">
                                                <audio
                                                    id="song{{ $loop->iteration }}"
                                                    style="height:41px;"
                                                    preload="none"
                                                    onplay="setVolume(this)"
                                                    controls
                                                >
                                                    <source src="/{{ $song->slug }}" type="audio/mpeg">
                                                </audio>
                                                {{-- <span class="material-symbols-rounded me-1">music_note</span>
                                                <button
                                                    type="button"
                                                    onclick="playPause()"
                                                    id="song"
                                                    class="btn btn-icon btn-sm btn-info"
                                                >
                                                <audio
                                                    src="/{{ $song->slug }}"
                                                    autoplay
                                                    loop
                                                ></audio>
                                                <span id="play-pause" class="material-symbols-rounded">play_arrow</span>
                                                </button> --}}
                                            </td>
                                            <td>
                                                <a href="/admin/songs/{{ $song->uuid }}/edit" class="btn btn-sm btn-warning">
                                                    <div class="d-flex">
                                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                                                        <span class="align-self-center">Edit Data</span>
                                                    </div>
                                                </a>
                                                <form action="/admin/songs/{{ $song->uuid }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="req" value="pembatalan">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Membatalkan Data Lagu Ini?\nPastikan data lagu ini tidak berelasi dengan undangan manapun.')">
                                                        <div class="d-flex">
                                                            <span class="material-symbols-rounded me-1" style="font-size:20px">delete</span>
                                                            <span class="align-self-center">Hapus</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td scope="row" colspan="4" class="text-center">Data Lagu Tidak Ditemukan..</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $songs->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->
@endsection

@section('js')
<script>
    // window.onload = function () {
        
        
    // }

    function setVolume(el){
        el.volume = 0.5;
    }
</script>
@endsection
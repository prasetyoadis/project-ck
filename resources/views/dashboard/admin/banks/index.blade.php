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
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

<!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="/admin/banks/create">
                <div class="d-flex align-item-center">
                    <span class="material-symbols-rounded me-1">assured_workload</span>
                    <span>Add Bank</span>
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
            <div class="row">
                <div class="col-sm-9">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th style="width: 10%">Bank Code</th>
                                    <th style="width: 30%">Nama Bank</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if ($banks->count())
                                    @foreach ($banks as $bank)
                                        <tr>
                                            <td scope="row" class="fw-bold">{{ $loop->iteration }}</td>
                                            <td>{{ $bank->code }}</td>
                                            <td>{{ $bank->nama_bank }}</td>
                                            <td>
                                                <span class="badge @if ($bank->isactive == '1') bg-label-success @else bg-label-danger @endif me-1">
                                                    @if ($bank->isactive == '1')
                                                        Aktif
                                                    @else
                                                        Nonaktif
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <a  href="/admin/banks/{{ $bank->code }}/edit" type="button" action="" class="btn btn-sm btn-warning">
                                                    <div class="d-flex">
                                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                                                        <span class="align-self-center">Edit Data</span>
                                                    </div>
                                                </a>
                                                
                                                <form action="/admin/banks/{{ $bank->code }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="req" value="status">
                                                    <button type="submit" class="btn btn-sm @if ($bank->isactive=="0") btn-success @else btn-danger @endif" onclick="return confirm('Yakin @php if ($bank->isactive=='0'){echo 'Mengaktifkan';}else{echo 'Menonaktifkan';} @endphp Bank Ini?')">
                                                        <div class="d-flex">
                                                            <span class="material-symbols-rounded me-1" style="font-size:20px">@if ($bank->isactive=="0") check_circle @else unpublished @endif</span>
                                                            <span class="align-self-center">@if ($bank->isactive=="0") Aktifkan @else Nonaktifkan @endif</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td scope="row" colspan="5" class="text-center">Data Bank Tidak Ditemukan..</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $banks->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->

<script>
    var aud = document.getElementById("song").children[0];
    let btnPlayPause = document.querySelector('#play-pause');
    var isPlaying = false;
    aud.pause();
  
    function playPause() {
      if (isPlaying) {
        aud.pause();
        btnPlayPause.innerHTML = btnPlayPause.innerText = btnPlayPause.textContent = 'play_arrow';
    } else {
        aud.play();
        btnPlayPause.innerHTML = btnPlayPause.innerText = btnPlayPause.textContent = 'pause';
      }
      isPlaying = !isPlaying;
    }
  </script>
@endsection
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
    
        {{-- <span class="text-muted fw-light">
            <a href="/admin/dashboard">Dashboard</a> / 
        </span>
        {{ $title }} --}}
    

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header">
            <a class="btn btn-warning" href="/admin/{{ '@'. auth()->user()->username }}/edit">
                <div class="d-flex align-item-center">
                    <span class="material-symbols-rounded me-1">edit_square</span>
                    <span>Edit Profile</span>
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
            <div class="m-auto" style="max-width: 500px">
                <div class="d-flex justify-content-center mb-3">
                    <img 
                        src="/{{ auth()->user()->foto }}" 
                        alt="foto profile" 
                        class="img-thumbnail rounded-circle" 
                        style="width: 150px; height: 150px; object-fit:cover; object-position: center;"
                    >
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h6 class="mb-2"><small>NAMA:</small></h6>
                        <div class="border border-secondary rounded p-2">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <h6 class="mb-2"><small>USERNAME:</small></h6>
                        <div class="border border-secondary rounded p-2">
                            {{ auth()->user()->username }}
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <h6 class="mb-2"><small>EMAIL:</small></h6>
                        <div class="border border-secondary rounded p-2">
                            {{ auth()->user()->email }}
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <h6 class="mb-2"><small>NO WA:</small></h6>
                        <div class="border border-secondary rounded p-2">
                            +62{{ auth()->user()->no_hp }}
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <h6 class="mb-2"><small>JENIS KELAMIN:</small></h6>
                        <div class="border border-secondary rounded p-2">
                            @if (auth()->user()->gender == 'l')
                                Laki-Laki
                            @else
                                Perempuan
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-3">
                            <div class="col-8">
                                <h6 class="mb-2"><small>JABATAN:</small></h6>
                                <div class="border border-secondary rounded p-2">
                                    @if (auth()->user()->role == 'kaadmin')
                                        Super Admin
                                    @else
                                        Admin Staff
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <h6 class="mb-2"><small>STATUS:</small></h6>
                                <span class="badge my-2 @if (auth()->user()->isactive==='1') bg-label-success @else bg-label-danger @endif">
                                    @if (auth()->user()->isactive=='1')
                                        Aktif
                                    @else
                                        Nonaktif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Hoverable Table rows -->
</div>       

@endsection
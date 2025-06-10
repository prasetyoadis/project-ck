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
            <a class="btn btn-primary" href="/admin/staff/create">
                <div class="d-flex align-item-center">
                    <span class="material-symbols-rounded me-1">person_add</span>
                    <span>Add New Staff</span>
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
                            <th style="min-width: 105px">Foto</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th class="w-25">Kontak</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th class="w-25">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @if ($users->count())
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="/{{ $user->foto }}" 
                                alt="foto-{{ $user->username }}" 
                                class="img-thumbnail rounded-circle" 
                                style="width: 64px; height: 64px; object-fit:cover; object-position: center;">
                            </td>
                            <td class="fw-bold">{{ $user->name }}</td>
                            <td class="fw-bold">{{ $user->username }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-12 mb-1 px-0 ">
                                        <button 
                                            type="button"
                                            onclick=" window.open('https://wa.me/?text=Selamat ','_blank')"
                                            class="btn btn-sm btn-info px-0 py-1 ps-1 rounded-circle"
                                        >
                                            <div class="d-flex">
                                                <i class='bx bx-envelope align-self-center me-1'></i>
                                                
                                            </div>
                                        </button>
                                        {{ $user->email }}
                                    </div>
                                    <div class="col-12 px-0">
                                        <button 
                                            type="button"
                                            onclick=" window.open('https://wa.me/62{{ $user->no_hp }}?text=Selamat {{ $salam }}, Kami menginformasikan ','_blank')"
                                            class="btn btn-sm btn-success px-0 py-1 ps-1 rounded-circle"
                                        >
                                            <div class="d-flex">
                                                <i class='bx bxl-whatsapp align-self-center me-1'></i>
                                                
                                            </div>
                                        </button>
                                        +62{{ $user->no_hp }}
                                    </div>
                                </div>
                            </td>
                            <td>
                            @if ($user->role=="staff")
                                Admin Staff   
                            @else
                                Super Admin
                            @endif</td>
                            <td>
                                <span class="badge @if ($user->isactive==='1') bg-label-success @else bg-label-danger @endif me-1">
                                @if ($user->isactive=='1')
                                    Aktif
                                @else
                                    Nonaktif
                                @endif
                                </span>
                            </td>
                            <td>
                                <a  href="/admin/staff/{{ $user->username }}/edit" type="button" action="" class="btn btn-sm btn-warning">
                                    <div class="d-flex">
                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                                        <span class="align-self-center">Edit Staff</span>
                                    </div>
                                </a>
                                <form action="/admin/staff/{{ $user->username }}" method="post" class="d-inline">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="req" value="resetPass">
                                    {{-- <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Yakin Reset Password Staff Ini?')">
                                        <div class="d-flex">
                                            <span class="material-symbols-rounded me-1" style="font-size: 20px">lock_reset</span>
                                            <span class="align-self-center">Reset Password</span>
                                        </div>
                                    </button> --}}
                                    <button type="submit" class="btn btn-sm btn-primary position-relative" onclick="return confirm('Yakin Reset Password Staff Ini?')">
                                        <div class="d-flex">
                                            <span class="material-symbols-rounded me-1" style="font-size: 20px">lock_reset</span>
                                            <span class="align-self-center">Reset Password</span>
                                        </div>
                                        @if ($user->isreqreset==1)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fw-bold" style="padding-left: 0.44rem; padding-right: 0.44rem ">
                                                !
                                            </span>
                                        @endif
                                    </button>
                                </form>
                                <br>
                                <form action="/admin/staff/{{ $user->username }}" method="post" class="d-inline">
                                @csrf
                                @method('put')
                                    <input type="hidden" name="req" value="status">
                                    <button type="submit" class="btn btn-sm @if ($user->isactive=="0") btn-success @else btn-danger @endif mt-1" onclick="return confirm('Yakin @if ($user->isactive=="0") Mengaktifkan @else Menonaktifkan @endif Staff Ini?')">
                                        <div class="d-flex">
                                            <span class="material-symbols-rounded me-1" style="font-size:20px">@if ($user->isactive=="0") account_circle @else account_circle_off @endif</span>
                                            <span class="align-self-center">@if ($user->isactive=="0") Aktifkan @else Nonaktifkan @endif</span>
                                        </div>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td scope="row" colspan="7" class="text-center">Data Staff Tidak Ditemukan..</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $users->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
            <a class="btn btn-primary" href="/admin/themes/create">
                <div class="d-flex align-item-center">
                    <span class="material-symbols-rounded me-1">add</span>
                    <span>Add Theme</span>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="w-25">Nama Tema</th>
                                    <th>Category</th>
                                    <th class="w-25">Tags</th>
                                    <th style="width: 30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if ($themes->count())
                                    @foreach ($themes as $theme)
                                        <tr>
                                            <td scope="row">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="fw-bold">{{ $theme->nama_tema }}</td>
                                            <td>
                                                <a class="badge bg-label-secondary" href="/admin/themes?category={{ $theme->category->slug }}{{ (request('tag')) ? "&tag=". request('tag') : "" }}">{{ $theme->category->nama_category }}</a>
                                            </td>
                                            <td>
                                                @php
                                                    $arrayName = array('primary', 'secondary', 'warning', 'danger', 'info', 'success', 'dark');
                                                @endphp
                                                @foreach ($theme->tags as $tag)
                                                    <a class="badge secondary @php $value = $arrayName[array_rand($arrayName)]; echo 'bg-label-'. $value @endphp" href="/admin/themes?{{ (request('category') ? "category=". request('category'). "&" : "") }}tag={{ $tag->slug }}">{{ $tag->nama_tag }}</a>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="/admin/themes/{{ $theme->slug }}" class="btn btn-sm btn-info">
                                                    <div class="d-flex">
                                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">visibility</span>
                                                        <span class="align-self-center">Preview Tema</span>
                                                    </div>
                                                </a>
                                                <a href="/admin/themes/{{ $theme->slug }}/edit" class="btn btn-sm btn-warning">
                                                    <div class="d-flex">
                                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                                                        <span class="align-self-center">Edit Data</span>
                                                    </div>
                                                </a>
                                                <form action="/admin/banks/{{ $theme->slug }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="req" value="status">
                                                    <button type="submit" class="btn btn-sm mt-1 @if ($theme->isactive=="0") btn-success @else btn-danger @endif" onclick="return confirm('Yakin @php if ($theme->isactive=='0'){echo 'Mengaktifkan';}else{echo 'Menonaktifkan';} @endphp theme Ini?')">
                                                        <div class="d-flex">
                                                            <span class="material-symbols-rounded me-1" style="font-size:20px">@if ($theme->isactive=="0") check_circle @else unpublished @endif</span>
                                                            <span class="align-self-center">@if ($theme->isactive=="0") Aktifkan @else Nonaktifkan @endif</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td scope="row" colspan="5" class="text-center">Data Tema Tidak Ditemukan..</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $themes->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->

@endsection
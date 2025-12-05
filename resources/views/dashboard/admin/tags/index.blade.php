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
            <a class="btn btn-primary" href="/admin/tag-themes/create">
                <div class="d-flex align-item-center">
                    <span class="material-symbols-rounded me-1">new_label</span>
                    <span>Add Tag</span>
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
                <div class="col-sm-9">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th>Nama Tag</th>
                                    <th style="width: 25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if ($tags->count())
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td class="fw-bold">{{ $tag->nama_tag }}</td>
                                            <td>
                                                <a href="/admin/tag-themes/{{ $tag->slug }}/edit" class="btn btn-sm btn-warning">
                                                    <div class="d-flex">
                                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                                                        <span class="align-self-center">Edit Data</span>
                                                    </div>
                                                </a>
                                                <form action="/admin/tag-themes/{{ $tag->slug }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Membatalkan Data Tag Ini?\nPastikan data tag ini tidak berelasi dengan tema manapun.')">
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
                                            <td scope="row" colspan="3" class="text-center">Data Tag Tidak Ditemukan..</td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $tags->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->

@endsection
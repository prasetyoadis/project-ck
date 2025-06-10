@extends('dashboard.layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Posts</h4>

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header">
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
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Slug</th>
                            <th>Tema</th>
                            <th>Tgl Acara</th>
                            <th>Preview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($posts->isNotEmpty())
                        @foreach ($posts as $post)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $post->order->uuid }}</td>
                            <td class="fw-bold">{{ $post->slug }}</td>
                            <td>{{ $post->theme->nama_tema }}</td>
                            <td>{{ $post->events[0]->tgl_acara }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="/{{ $post->slug }}?to={{ str_replace(' ', '-', auth()->user()->name) }}">Tampilkan</a></td>
                            <td class="w-25">
                                <button 
                                    type="button"
                                    onclick=" window.open('https://wa.me/{{ $post->order->no_hp }}?text=Selamat ','_blank')"
                                    class="btn btn-sm btn-primary"
                                >
                                    <div class="d-flex">
                                        <i class='bx bxl-whatsapp align-self-center me-1'></i>
                                        <span class="align-self-center">Hubungi Client</span>
                                    </div>
                                </button>
                                
                                <button type="button" class="btn btn-sm btn-warning">
                                    <div class="d-flex">
                                        <span class="material-symbols-rounded me-1" style="font-size: 20px">edit_square</span>
                                        <span class="align-self-center">Edit Undangan</span>
                                    </div>
                                </button>
                                <br>
                                
                                <form action="/admin/invitations/{{ $post->slug }}" method="post" class="d-inline">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="req" value="pembatalan">
                                    <button type="submit" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Yakin Menghapus assets Data Undangan Ini?\nSemua assets akan di gantikan dengan sample default.')">
                                        <div class="d-flex">
                                            <span class="material-symbols-rounded me-1" style="font-size:20px">delete</span>
                                            <span class="align-self-center">Hapus Asets Data</span>
                                        </div>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td scope="row" colspan="7" class="text-center">Data Undangan Tidak Ditemukan..</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $posts->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
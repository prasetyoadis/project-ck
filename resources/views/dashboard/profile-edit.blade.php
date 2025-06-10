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
                    <a href="/admin/{{ '@'. auth()->user()->username }}">My Profile</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </h4>
<!--/ End Breadcrumb -->

<!-- Hoverable Table rows -->
    <div class="card">
        {{-- <div class="card-body border-bottom border-secondary">
            <div class="m-auto" style="width: 500px">
                
            </div>
        </div> --}}
        <div class="card-body">
            <div class="m-auto" style="max-width: 500px">
                <form action="/admin/{{ '@'. $user->username }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
                        <img
                            src="/{{ auth()->user()->foto }}"
                            alt="user-avatar"
                            id="uploadedAvatar"
                            class="img-thumbnail rounded-circle"
                            style="width: 150px; height: 150px; object-fit:cover; object-position: center;"
                        />
                        <div class="button-wrapper">
                            <label for="foto" class="btn btn-sm btn-primary me-2 mb-3" tabindex="0">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-upload d-block me-1"></i>
                                    <span class="d-sm-block">Upload New Photo</span>
                                </div>
                                <input
                                    name="foto"
                                    id="foto"
                                    class="account-file-input @error('foto') is-invalid @enderror"
                                    type="file"
                                    accept="image/png, image/jpeg"
                                    hidden
                                />
                            </label>
                            <button type="button" class="btn btn-sm btn-outline-secondary account-image-reset mb-3">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                            @error('foto')
                                <div class="w-100 text-danger">
                                    <small>{{ $message }}</small>        
                                </div>
                            @enderror
                            <p class="@error('foto') d-none @enderror text-muted mb-0"><small>Allowed JPG or PNG. Max size of 1024KB</small></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                name="username"
                                type="text"
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="{{ auth()->user()->username }}"
                                value="{{ auth()->user()->username }}"
                            />
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}        
                                </div>
                            @enderror
                        </div>
                            
                        <div class="col-12 mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input
                                name="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ auth()->user()->name }}"
                                value="{{ $user->name }}"
                            />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}        
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label><br>
                            <div style="margin: 7px 0">
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="gender"
                                        id="lakilaki"
                                        value="l"
                                        @if ($user->gender=='l') checked @endif
                                    />
                                    <label class="form-check-label" for="lakilaki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="gender"
                                        id="perempuan"
                                        value="p"
                                        @if ($user->gender=='p') checked @endif
                                    />
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                                
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Kontak No WA</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text @error('no_hp') border-danger @enderror">+62</span>
                                    <input
                                        name="no_hp"
                                        type="tel"
                                        class="form-control @error('no_hp') is-invalid rounded-end @enderror"
                                        @error('no_hp')style="border-right: 1px solid #ff3e1d"@enderror
                                        placeholder="8..."
                                        value="{{ $user->no_hp }}"
                                        onkeyup="numberOnly(this)"
                                    />
                                    @error('no_hp')
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
                </form>
            </div>
        </div>
    </div>
<!--/ Hoverable Table rows -->
</div>

<script>
    function numberOnly(input) {
        var regex = /[^0-9\n\t]/gi;
        input.value = input.value.replace(regex, "");
    }
</script>
@endsection

@section('js')
    <script src="/assets/js/pages-account-settings-account.js"></script>
@endsection
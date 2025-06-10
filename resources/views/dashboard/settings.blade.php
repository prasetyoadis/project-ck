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
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible mb-3" role="alert">
            {{ session('fail') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<!-- Custom content with heading -->
    
    <div class="row">
        <div class="col-md-2 col-12 mb-3 mb-md-0">
            <div class="list-group card">
                <a
                    class="list-group-item list-group-item-action active"
                    id="list-home-list"
                    data-bs-toggle="list"
                    href="#setting-my-profile"
                >
                    My Profile
                </a>
                <a
                    class="list-group-item list-group-item-action disabled"
                    id="list-profile-list"
                    data-bs-toggle="list"
                    href="#setting-notifications"
                >
                    Notifications
                    
                </a>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="setting-my-profile">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <span class="fw-bold fs-5 me-3">Email</span>
                            <button onclick="setFormEditEmail()" class="btn btn-sm btn-warning d-flex align-items-center me-2"><i class='bx bx-edit me-1' ></i> Ubah Email</button>
                            <button onclick="btnReset()" type="button" class="btn btn-sm btn-outline-secondary" id="reset-edit-email">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                            @if (session()->has('successEmail'))
                                <div class="alert alert-success alert-dismissible mb-0 mt-3" role="alert">
                                    {{ session('successEmail') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('failEmail'))
                                <div class="alert alert-danger alert-dismissible mb-3 mt-3" role="alert">
                                    {{ session('failEmail') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body" id="card-email-user">
                            <div class="row">
                                <div class="col-sm-12 col-md-7 col-lg-6">
                                    <div class="row mb-3">
                                        <span class="col-sm-2 col-md-3 form-label">Email</span>
                                        <div class="col-sm-10 col-md-9">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">
                                                    <i class="bx bx-envelope"></i>
                                                </span>
                                                <div class="form-control">{{ auth()->user()->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 d-none" id="card-edit-email">
                            <div class="row">
                                <div class="col-sm-12 col-md-7 col-lg-6">
                                    <form method="post" id="form-edit-email">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-2 col-md-3 form-label">Email</label>
                                            <div class="col-sm-10 col-md-9">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-envelope"></i>
                                                    </span>
                                                    <input
                                                        name="email"
                                                        type="email"
                                                        {{-- id="input-email" --}}
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="name@gmail.com"
                                                        value="{{ auth()->user()->email }}"
                                                        {{-- onfocus="this.setSelectionRange(this.value.length, this.value.length);" --}}
                                                        
                                                    />
                                                </div>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}        
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-success" id="btn-submit-edit-email">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <span class="fw-bold fs-5 me-3 align-middle">Password</span>
                                <button onclick="setFormEditPass()" class="btn btn-sm btn-warning d-flex align-items-center me-2"><i class='bx bx-edit me-1' ></i> Ubah Password</button>
                                <button onclick="btnReset()" type="button" class="btn btn-sm btn-outline-secondary" id="reset-edit-pass">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </div>
                            @if (session()->has('successPass'))
                                <div class="alert alert-success alert-dismissible mb-0 mt-3" role="alert">
                                    {{ session('successPass') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('failPass'))
                                <div class="alert alert-danger alert-dismissible mb-0 mt-3" role="alert">
                                    {{ session('failPass') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body @if (session()->has('isConfirm')) @if (session('isConfirm') == true) d-none @elseif (session('isConfirm') == false) d-none @endif @else @error('confirmPass') d-none @enderror @endif " 
                        id="card-pass-user">
                            <div class="row">
                                <div class="col-sm-12 col-md-7 col-lg-6">
                                    <div class="row mb-3">
                                        <span class="col-sm-2 col-md-3 form-label">Password</span>
                                        <div class="col-sm-10 col-md-9">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">
                                                    <i class="bx bx-lock"></i>
                                                </span>
                                                <div class="form-control">
                                                    <span>&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div 
                            class="card-body pt-0 @if (session()->has('isConfirm')) @if (session('isConfirm') == true) d-none @elseif (session('isConfirm') == false) d-block @endif @elseif(!session()->has('confirmPass')) d-none @endif " 
                            id="card-edit-pass">
                            <div class="row">
                                <div class="col-sm-12 col-md-7 col-lg-6">
                                    <form method="post" id="form-edit-pass">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="confirmPass" class="col-sm-2 col-md-3 form-label">Password</label>
                                            <div class="col-sm-10 col-md-9">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text @if (session()->has('failPass')) border-danger @else @error('confirmPass') border-danger @enderror @endif">
                                                        <i class="bx bx-lock"></i>
                                                    </span>
                                                    <input 
                                                        name="confirmPass"
                                                        type="password"
                                                        class="password form-control @if (session()->has('failPass')) is-invalid @else @error('confirmPass') is-invalid @enderror @endif"
                                                        {{-- @error('confirmPass')style="border-right: 1px solid #ff3e1d"@enderror --}}
                                                        placeholder="Password Sekarang"
                                                        @if (session()->has('failPass')) autofocus @else @error('confirmPass') autofocus @enderror @endif
                                                    />
                                                    <button 
                                                        id="1"
                                                        class="input-group-text px-2 px-2 @if (session()->has('failPass')) rounded-end @else @error('confirmPass') rounded-end @enderror @endif"
                                                        type="button"
                                                        onclick="passVisibility(this.id)"
                                                        onMouseOver="this.style.color='#696cff'"
                                                        onMouseOut="this.style.color='#000'"
                                                    >
                                                        <span class="visibility material-symbols-rounded" style="font-size: 20px">visibility</span>
                                                    </button>
                                                    @error('confirmPass')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}        
                                                        </div>
                                                    @enderror
                                                    @if (session()->has('failPass'))
                                                        <div class="invalid-feedback">
                                                            {{ session('failPass') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" id="btn-submit-edit-pass">Lanjutkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if (session('isConfirm') == true)
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-12 col-md-7 col-lg-6">
                                        <form action="/admin/settings/pass-edit" method="post">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="newPass" class="col-sm-2 col-md-3 form-label">Password Baru:</label>
                                                <div class="col-sm-10 col-md-9">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text @if (session()->has('failPass')) border-danger @else @error('newPass') border-danger @enderror @endif">
                                                            <i class="bx bx-lock"></i>
                                                        </span>
                                                        <input
                                                            name="newPass"
                                                            type="password"
                                                            class="password form-control @if (session()->has('failPass')) is-invalid @else @error('newPass') is-invalid @enderror @endif"
                                                            placeholder="Password Baru"
                                                            value="{{ old('newPass') }}"
                                                            onfocus="this.setSelectionRange(this.value.length, this.value.length);"
                                                            @if ($errors->has('email')) @else autofocus @endif
                                                        />
                                                        <button 
                                                            id="2"
                                                            class="input-group-text px-2 px-2 @if (session()->has('failPass')) rounded-end @else @error('newPass') rounded-end @enderror @endif"
                                                            type="button"
                                                            onclick="passVisibility(this.id)"
                                                            onMouseOver="this.style.color='#696cff'"
                                                            onMouseOut="this.style.color='#000'"
                                                        >
                                                            <span class="visibility material-symbols-rounded" style="font-size: 20px">visibility</span>
                                                        </button>
                                                        @error('newPass')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}        
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="repeatPass" class="col-sm-2 col-md-3 form-label">Ulang Password Baru:</label>
                                                <div class="col-sm-10 col-md-9">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text @if (session()->has('failPass')) border-danger @else @error('repeatPass') border-danger @enderror @endif">
                                                            <i class="bx bx-lock"></i>
                                                        </span>
                                                        <input
                                                            name="repeatPass"
                                                            type="password"
                                                            class="password form-control @if (session()->has('failPass')) is-invalid @else @error('repeatPass') is-invalid @enderror @endif"
                                                            placeholder="Ulang Password Baru"
                                                            @if (session()->has('failPass')) autofocus @else @error('repeatPass') autofocus @enderror @endif
                                                        />
                                                        <button 
                                                            id="3"
                                                            class="input-group-text px-2 px-2 @if (session()->has('failPass')) rounded-end @else @error('repeatPass') rounded-end @enderror @endif"
                                                            type="button"
                                                            onclick="passVisibility(this.id)"
                                                            onMouseOver="this.style.color='#696cff'"
                                                            onMouseOut="this.style.color='#000'"
                                                        >
                                                            <span class="visibility material-symbols-rounded" style="font-size: 20px">visibility</span>
                                                        </button>
                                                        @error('repeatPass')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}        
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="setting-notifications">
                    <div class="card">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam similique dolor autem, ipsum est architecto, consequatur accusantium asperiores quia, consequuntur quas deleniti dolorem necessitatibus error cupiditate quo nulla nostrum quod maiores aperiam excepturi. Vero laborum ducimus culpa ratione laudantium totam vitae facere aliquam. Amet, modi? Illo dignissimos pariatur, quam iste error enim praesentium ipsum beatae eveniet quaerat nam. Repellat repellendus odio, optio laudantium ea hic. Deserunt eos vero quam tempore deleniti. Officia nisi veniam ab quasi soluta nobis consequatur cum molestias in ea, perferendis optio possimus est accusamus nostrum inventore architecto, sit vel debitis, itaque voluptas odio harum totam? Quaerat eligendi obcaecati saepe cumque beatae, sequi pariatur. Nulla nemo dolorum modi cumque ullam reprehenderit facere accusantium sit fuga, eligendi provident sed quibusdam. Beatae harum expedita repellendus eligendi quae cum similique accusantium fuga voluptatem, quaerat nisi libero obcaecati nihil officia voluptates veritatis culpa natus distinctio quis repellat? Corrupti facilis facere saepe.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>         
<!--/ Custom content with heading -->
        
<!--/ Hoverable Table rows -->
</div>

<script>
    let isEdit = false;
    let formPassword = document.querySelector('#form-edit-pass');
    let cardDisplayPass2 = document.querySelector('#card-edit-pass');
    let cardDisplayPass1 = document.querySelector('#card-pass-user');
    let btnSubmitPass = document.querySelector('#btn-submit-edit-pass');

    let formEmail = document.querySelector('#form-edit-email');
    let cardDisplayEmail2 = document.querySelector('#card-edit-email');
    let cardDisplayEmail1 = document.querySelector('#card-email-user');
    let btnSubmitEmail = document.querySelector('#btn-submit-edit-email');
    

    function passVisibility(btn_id) {
        var pass = document.getElementsByClassName('password');
        var visi = document.getElementsByClassName('visibility');
        
        switch (btn_id) {
            case "1":
                if (pass[0].type == 'password') {
                    pass[0].type = 'text';
                    visi[0].innerHTML = visi[0].innerText = visi[0].textContent = 'visibility_off';
                } else {
                    pass[0].type = 'password';
                    visi[0].innerHTML = visi[0].innerText = visi[0].textContent = 'visibility';
                }
                break;
            case "2":
                if (pass[1].type == 'password') {
                    pass[1].type = 'text';
                    visi[1].innerHTML = visi[1].innerText = visi[1].textContent = 'visibility_off';
                } else {
                    pass[1].type = 'password';
                    visi[1].innerHTML = visi[1].innerText = visi[1].textContent = 'visibility';
                }
                break;
            case "3":
                if (pass[2].type == 'password') {
                    pass[2].type = 'text';
                    visi[2].innerHTML = visi[2].innerText = visi[2].textContent = 'visibility_off';
                } else {
                    pass[2].type = 'password';
                    visi[2].innerHTML = visi[2].innerText = visi[2].textContent = 'visibility';
                }
                break;
            default:
                break;
        }
    }

    function setFormEditEmail(){
        if (!isEdit) {
            isEdit = true;

            formEmail.action = "/admin/settings/email-edit";
            cardDisplayEmail1.classList.add("d-none");
            cardDisplayEmail2.classList.remove("d-none");
            btnSubmitEmail.type = "submit";
        }
    }
    function setFormEditPass() {
        if (!isEdit) {
            isEdit = true;

            formPassword.action = "/admin/settings/pass-confirm";
            cardDisplayPass1.classList.add("d-none");
            cardDisplayPass2.classList.remove("d-none");
            btnSubmitPass.type = "submit";
        }
    }
    function resetFormEditEmail() {
            isEdit = false;

            formEmail.action = "";
            cardDisplayEmail1.classList.remove("d-none");
            cardDisplayEmail2.classList.add("d-none");
            btnSubmitEmail.type = "button";
    }
    function btnReset() {
        location.reload();
    }
</script>
@if (session()->has('isConfirm'))
    @if (session('isConfirm') == true)
        <script>
            isEdit = true;
        </script>
    @elseif (session('isConfirm') == false)
        <script>
            isEdit = true;

            formPassword.action = "/admin/settings/pass-confirm";
            btnSubmitPass.type = "submit";
        </script>
    @endif
@else
    @error('confirmPass')
        <script>
            isEdit = true;

            cardDisplayPass2.classList.remove("d-none");
            formPassword.action = "/admin/settings/pass-confirm";
            btnSubmitPass.type = "submit";
        </script>
    @enderror
    @error('newPass')
        <script>
            isEdit = true;

            cardDisplayPass2.classList.remove("d-none");
            formPassword.action = "/admin/settings/pass-confirm";
            btnSubmitPass.type = "submit";
        </script>
    @enderror

@endif  

@endsection
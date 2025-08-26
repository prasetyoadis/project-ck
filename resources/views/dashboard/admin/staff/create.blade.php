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
                    <li class="breadcrumb-item text-muted fw-light">
                        <a href="/admin/staff">Users</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </h4>
        <!--/ End Breadcrumb -->

        <!-- Hoverable Table rows -->
        <div class="card">
            <div class="card-body">
                <form action="/admin/staff/" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input name="username" type="text" id="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="{{ auth()->user()->username }}" onkeyup="usernameCheck(this)" />
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input name="password" type="password" id="password"
                                            class="form-control @error('username') is-invalid @enderror"
                                            style="cursor: default;" onclick="document.activeElement.blur();"
                                            value="{{ substr(str_shuffle('!@#$%^&*()-_+=<>?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=<>?'), 0, 10) }}"
                                            readonly />
                                        <button class="input-group-text px-2 px-2" type="button" onclick="passVisibility()"
                                            onMouseOver="this.style.color='#696cff'" onMouseOut="this.style.color='#000'">
                                            <span class="material-symbols-rounded" id="visibility"
                                                style="font-size: 20px">visibility</span>
                                        </button>
                                        <button id="btn-copy-cliboard" class="input-group-text px-2 px-2" type="button"
                                            onclick="copyClipboard()" {{-- onmouseout="outFunc()" --}}
                                            onMouseOver="this.style.color='#696cff'; this.style.backgroundColor='rgba(67, 89, 113, 0.1)'"
                                            onMouseOut="this.style.color='#000'; this.style.backgroundColor='#fff'"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to Clipboard"
                                            {{-- data-clipboard-text="" --}}>
                                            <span class="material-symbols-rounded" id="copy"
                                                style="font-size: 20px">content_copy</span>
                                        </button>
                                        <button class="input-group-text px-2 mx-0" type="button" onclick="resetPass()"
                                            onMouseOver="this.style.color='#696cff'; this.style.backgroundColor='rgba(67, 89, 113, 0.1)'"
                                            onMouseOut="this.style.color='#000'; this.style.backgroundColor='#fff'">
                                            <span class="material-symbols-rounded" style="font-size: 20px">lock_reset</span>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input name="name" type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ auth()->user()->name }}" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label><br>
                                    <div style="margin: 7px 0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="lakilaki"
                                                value="l" checked />
                                            <label class="form-check-label" for="lakilaki">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="perempuan"
                                                value="p" />
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="name@example@com" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Nomor WhatsApp</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text @error('no_hp') border-danger @enderror">+62 | </span>
                                    <input name="no_hp" type="tel" id="no_hp"
                                        class="form-control @error('no_hp') is-invalid rounded-end @enderror"
                                        @error('no_hp')style="border-right: 1px solid #ff3e1d"@enderror placeholder="8..."
                                        onkeyup="numberOnly(this)" />
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role"
                                    class="form-select @error('role') is-invalid @enderror">
                                    <option>-- Pilih Role --</option>
                                    <option value="staff">Admin Staff</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                {{-- <a href="/admin/staff" class="btn btn-danger me-2">Batal</a> --}}
                                <button type="button" onclick="window.location.href='/admin/staff'"
                                    class="btn btn-danger me-2">Batal</button>
                                <button id="clearform" type="button" onclick="clearForm()"
                                    class="btn btn-warning me-2">Hapus</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                        <div class="col-md-3 pt-3 pt-md-0">
                            <div class="card bg-info text-white mb-3">
                                <div class="card-header">Note:</div>
                                <div class="card-body">
                                    <span class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Aliquam culpa hic est optio natus officiis aut sint neque, quae sequi, qui quis
                                        ipsum perspiciatis ab a at quaerat magnam aperiam.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function clearForm() {
            $('#username').val('');
            $('#name').val('');
            $('#email').val('');
            $('#no_hp').val('');
            $('#role').val('');
        }

        function resetPass() {
            var pass = document.getElementById('password');

            function str_shuffle(str) {
                var newStr = [];

                if (arguments.length < 1) {
                    throw 'str_shuffle : Parameter str not specified';
                }

                if (typeof str !== 'string') {
                    throw 'str_shuffle : Parameter str ( = ' + str + ') is not a string';
                }

                str = str.split('');
                while (str.length) {
                    newStr.push(str.splice(Math.floor(Math.random() * (str.length - 1)), 1)[0]);
                }

                return newStr.join('');
            }
            pass.value = '';
            pass.value = str_shuffle(
                    '!@#$%^&*()-_+=<>?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=<>?')
                .substr(0, 10);
        }

        function numberOnly(input) {
            var regex = /[^0-9\n\t]/gi;
            input.value = input.value.replace(regex, "");
        }

        function usernameCheck(input) {
            var regex = /[^a-zA-Z0-9._\n\t]/gi;
            input.value = input.value.replace(regex, "");
        }

        function passVisibility() {
            var pass = document.getElementById('password');
            var visi = document.getElementById('visibility');

            if (pass.type == 'password') {
                pass.type = 'text';
                visi.innerHTML = visi.innerText = visi.textContent = 'visibility_off';
            } else {
                pass.type = 'password';
                visi.innerHTML = visi.innerText = visi.textContent = 'visibility';
            }
        }

        function copyClipboard() {
            document.activeElement.blur();
            var btnCopy = document.getElementById("btn-copy-cliboard");
            const tooltip = bootstrap.Tooltip.getInstance('#btn-copy-cliboard') // Returns a Bootstrap tooltip instance

            var pass = document.getElementById('password');
            var copy = document.getElementById('copy');
            navigator.clipboard.writeText(pass.value);

            tooltip.setContent({
                '.tooltip-inner': 'Copied!'
            })
            copy.innerHTML = copy.innerText = copy.textContent = 'check';

            setTimeout(function() {
                copy.innerHTML = copy.innerText = copy.textContent = 'content_copy';
                tooltip.setContent({
                    '.tooltip-inner': 'Copy to Clipboard'
                })
            }, 800);
        }
    </script>
@endsection

@section('js')
@endsection

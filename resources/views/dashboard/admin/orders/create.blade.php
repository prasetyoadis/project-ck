@extends('layouts.main-dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Orders / </span>Create Order</h4>

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <form action="/admin/orders" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="uuid" class="form-label">Order ID</label>
                                <input
                                    name="uuid"
                                    type="text"
                                    class="form-control"
                                    value="{{ substr(strtoupper(uniqid('CKOI')), 0,16) }}"
                                    readonly
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_order" class="form-label">Tanggal</label>
                                <input
                                    name="tgl_order"
                                    class="form-control"
                                    type="datetime-local"
                                    value="{{ date('Y-m-d\TH:i') }}"
                                />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Client</label>
                            <input
                                name="nama"
                                type="text"
                                class="form-control"
                                placeholder="{{ auth()->user()->name }}"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control"
                                placeholder="name@email.com"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Wa</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+62</span>
                                <input
                                    name="no_hp"
                                    type="tel"
                                    class="form-control"
                                    placeholder="8..."
                                />
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bukti_bayar" class="form-label">Upload Bukti DP</label>
                            <input 
                                name="bukti_bayar"
                                class="form-control"
                                type="file"
                                accept="image/png, image/jpeg"
                            />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white mb-3">
                            <div class="card-header">Note:</div>
                            <div class="card-body">
                                <span class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam culpa hic est optio natus officiis aut sint neque, quae sequi, qui quis ipsum perspiciatis ab a at quaerat magnam aperiam.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
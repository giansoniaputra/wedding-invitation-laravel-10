@extends('layouts.main')
@section('container')
<nav>
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item active" aria-current="page">Data Mempelai</li>
    </ol>
</nav>
<div class="card" id="data-card">
    <form action="/mempelai/update-data" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="nama_pria" class="form-label">Nama Pria</label>
                        <input type="text" class="form-control @error('nama_pria') is-invalid @enderror"
                            name="nama_pria" id="nama_pria" value="{{ old('nama_pria',$data->nama_pria) }}">
                        @error('nama_pria')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="nama_wanita" class="form-label">Nama Wanita</label>
                        <input type="text" class="form-control @error('nama_wanita') is-invalid @enderror"
                            name="nama_wanita" id="nama_wanita" value="{{ old('nama_wanita',$data->nama_wanita) }}">
                        @error('nama_wanita')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $data->slug }}"
                            readonly>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="ibu_pria" class="form-label">Nama Ibu Pria</label>
                        <input type="text" class="form-control @error('ibu_pria') is-invalid @enderror" name="ibu_pria"
                            id="ibu_pria" value="{{ old('ibu_pria',$data->ibu_pria) }}">
                        @error('ibu_pria')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="bapak_pria" class="form-label">Nama Bapak Pria</label>
                        <input type="text" class="form-control @error('bapak_pria') is-invalid @enderror"
                            name="bapak_pria" id="bapak_pria" value="{{ old('bapak_pria',$data->bapak_pria) }}">
                        @error('bapak_pria')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="ibu_wanita" class="form-label">Nama Ibu Wanita</label>
                        <input type="text" class="form-control @error('ibu_wanita') is-invalid @enderror"
                            name="ibu_wanita" id="ibu_wanita" value="{{ old('ibu_wanita',$data->ibu_wanita) }}">
                        @error('ibu_wanita')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="bapak_wanita" class="form-label">Nama Bapak Wanita</label>
                        <input type="text" class="form-control @error('bapak_wanita') is-invalid @enderror"
                            name="bapak_wanita" id="bapak_wanita" value="{{ old('bapak_wanita',$data->bapak_wanita) }}">
                        @error('bapak_wanita')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-end">
                    <a href="/mempelai" class="btn btn-warning btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-backward"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-split ml-2" id="save-data">
                        <span class="icon text-white-50">
                            <i class="fas fa-forward"></i>
                        </span>
                        <span class="text">Selanjutnya</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

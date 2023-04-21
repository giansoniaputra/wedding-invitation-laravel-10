@extends('layouts.main')
@section('container')
<div class="flash-data" data-flashdata="{{ session('success') }}"></div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark text-white">
        <li class="breadcrumb-item active text-white" aria-current="page">Photo Mempelai</li>
        <li class="breadcrumb-item"><a href="/gallery/{{ $data->slug }}">Gallery</a></li>
    </ol>
</nav>
<div class="card" id="data-card">
    <form action="/updatePhoto" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <label for="photo_pria" class="form-label">Photo Pria</label>
                    <input type="file" class="form-control @error('photo_pria') is-invalid @enderror" name="photo_pria" id="photo_pria">
                    <input type="text" name="fotoPria" id="fotoPria" value="{{ old('fotoPria') }}">
                    @error('photo_pria')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center" id="show-foto-pria">
                <img src="{{ old('fotoPria', $data->photo_pria) }}" alt="" class="img-fluid show-foto-pria" width="200px">
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <label for="photo_wanita" class="form-label">Photo Wainta</label>
                    <input type="file" class="form-control @error('photo_wanita') is-invalid @enderror" name="photo_wanita" id="photo_wanita">
                    <input type="text" name="fotoWanita" id="fotoWanita" value="{{ old('fotoWanita') }}">
                    @error('photo_wanita')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center" id="show-foto-wanita">
                <img src="{{ old('fotoWanita', $data->photo_wanita) }}" alt="" class="img-fluid show-foto-wanita" width="200px">
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center">
                <button type="submit" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="text">Upload</span>
                </button>
            </div>
        </div>
    </form>
    <hr>
    <div class="row mt-2 mb-3 ml-1">
        <div class="col-sm-12 d-flex justify-content-start">
        <a href="/mempelai" class="btn btn-warning btn-icon-split" id="btn-back-1">
            <span class="icon text-white-50">
                <i class="fas fa-backward"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
</div>
<!-- Modal Cropper -->
<div class="modal fade" id="modal-cropper" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cropper</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <img id="image" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary crop_pria">Crop</button>
                <button type="button" class="btn btn-primary crop_wanita">Crop</button>
            </div>
        </div>
    </div>
</div>
<script src="/js/page-script/photo-mempelai.js"></script>
@endsection

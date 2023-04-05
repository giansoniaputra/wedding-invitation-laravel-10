@extends('layouts.main')
@section('container')
<style>
    #image {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red
    }

</style>
<nav>
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="/mempelai/{{ $data->slug }}/edit" id="data" class="text-white">Data
                Mempelai</a></li>
        <li class="breadcrumb-item active" aria-current="page">Photo Mempelai</li>
    </ol>
</nav>
<div class="card" id="data-card">
    <form action="/mempelai/update-data" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <label for="photo_pria" class="form-label">Foto Pria</label>
                    <input type="file" class="form-control" name="photo_pria" id="photo_pria">
                    <textarea name="fotoPria" id="fotoPria" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <img src="{{ $data->photo_pria }}" alt="" class="img-fluid show-foto-pria" width="200px">
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <label for="photo_wanita" class="form-label">Foto Wanita</label>
                    <input type="file" class="form-control" name="photo_wanita" id="photo_wanita"
                        onchange="photoWanita(this)">
                    <input type="hidden" name="fotoWanita" id="fotoWanita" value="{{ $data->photo_wanita }}">
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center" id="show-foto-wanita">
                <img src="{{ $data->photo_wanita }}" alt="" class="img-fluid show-foto-wanita" width="200px">
            </div>
        </div>
    </form>
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
<script src="/js/update/update-photo.js"></script>
@endsection

@extends('layouts.main')
@section('container')
<div class="flash-data" data-flashdata="{{ session('success') }}"></div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark text-white">
        <li class="breadcrumb-item"><a href="/editPhotoMempelai/{{ $data->slug }}">Photo Mempelai</a></li>
        <li class="breadcrumb-item active text-white" aria-current="page">Gallery</li>
        <li class="breadcrumb-item"><a href="/cover/{{ $data->slug }}">Cover Undangan</a></li>
    </ol>
</nav>
<div class="card" id="gallery-card">
    <form action="/upload-gallery/{{ $data->slug }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Name</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo">
                        <input type="hidden" id="base64img" name="base64img">
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-icon-split ml-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="text">Upload</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row" id="refresh-gallery">
        <div class="col">
            <div class="card m-4">
                <h1 class="h1 text-center">Gallery</h1>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach($photos as $photo)
                                <img width="200px" class="img-fluid" src="/storage/post-images/gallery/{{ $photo->photo }}" alt="gallery">
                                <form action="/delete-photo/{{ $photo->id }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $photo->id }}">
                                    <input type="hidden" name="photo" value="{{ 'post-images/gallery/'.$photo->photo }}">
                                    <button type="submit" class="btn btn-danger btn-sm btn-hapus-foto"><i class="fas fa-trash"></i></button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <button type="button" class="btn btn-primary crop_gallery">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/page-script/photo-mempelai.js"></script>
    @endsection

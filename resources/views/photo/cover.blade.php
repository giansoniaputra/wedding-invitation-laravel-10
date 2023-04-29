@extends('layouts.main')
@section('container')
<div class="flash-data" data-flashdata="{{ session('success') }}"></div>
<div class="flash-data" data-flashdata="{{ session('success') }}"></div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark text-white">
        <li class="breadcrumb-item"><a href="/editPhotoMempelai/{{ $data->slug }}">Photo Mempelai</a></li>
        <li class="breadcrumb-item"><a href="/gallery/{{ $data->slug }}">Gallery</a></li>
        <li class="breadcrumb-item active text-white" aria-current="page">Cover Undangan</li>
    </ol>
</nav>
<div class="card" id="data-card">
    <form action="/updateCover" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="hidden" name="oldImageCover" value="{{ $data->cover }}">
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <label for="cover" class="form-label">Photo Pria</label>
                    <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" id="cover"
                        onchange="imagePreview()">
                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center mt-5" id="show-foto-cover">
                <img src="/storage/{{ $data->cover }}" alt="" class="img-fluid show-foto-pria" width="500px">
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
    <script>
        function imagePreview() {
            const imgPre = document.querySelector('#cover');
            const foto = document.querySelector('.show-foto-pria');
            const oFReader = new FileReader();
            oFReader.readAsDataURL(imgPre.files[0]);
            oFReader.onload = function (oFREvent) {
                foto.src = oFREvent.target.result;
            }
        }
        // Sweet-Alert
        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            Swal.fire(
                'Good job!',
                flashData,
                'success'
            )
        }

    </script>
    @endsection

@extends('layouts.main')
@section('container')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="javascript:;" id="data" class="text-white">Data Mempelai</a></li>
        <li class="breadcrumb-item"><a href="javascript:;" id="akad" class="text-info">Akad dan Resepsi</a></li>
        <li class="breadcrumb-item"><a href="javascript:;" id="gallery" class="text-info">Gallery</a></li>
        <li class="breadcrumb-item"><a href="javascript:;" id="other" class="text-info">Lainnya</a></li>
    </ol>
</nav>

<div class="card" id="data-card">
    <form action="javascript:void(0)" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="nama_pria" class="form-label">Nama Pria</label>
                        <input type="text" class="form-control" name="nama_pria" id="nama_pria"
                            value="{{ $data->nama_pria }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="nama_wanita" class="form-label">Nama Wanita</label>
                        <input type="text" class="form-control" name="nama_wanita" id="nama_wanita"
                            value="{{ $data->nama_wanita }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <label for="photo_pria" class="form-label">Foto Pria</label>
                    <input type="file" class="form-control" name="photo_pria" id="photo_pria"
                        onchange="photoPria(this)">
                    <input type="hidden" name="fotoPria" id="fotoPria" value="{{ $data->photo_pria }}">
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <img src="{{ $data->photo_pria }}" alt="" class="img-fluid show-foto-pria" width="200px">
            </div>
            <script>
                function photoPria(obj) {
                    let reader = new FileReader();
                    reader.readAsDataURL(obj.files[0]);
                    reader.onload = function () {
                        document.getElementById('fotoPria').value = reader.result;
                    }

                    const imgPre = document.querySelector('.show-foto-pria');
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(obj.files[0]);
                    oFReader.onload = function (oFREvent) {
                        imgPre.src = oFREvent.target.result;
                    }
                }

            </script>
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
            <script>
                function photoWanita(obj) {
                    let reader = new FileReader();
                    reader.readAsDataURL(obj.files[0]);
                    reader.onload = function () {
                        document.getElementById('fotoWanita').value = reader.result;
                    }

                    const imgPre = document.querySelector('.show-foto-wanita');
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(obj.files[0]);
                    oFReader.onload = function (oFREvent) {
                        imgPre.src = oFREvent.target.result;
                    }
                }

            </script>
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
                        <input type="text" class="form-control" name="ibu_pria" id="ibu_pria"
                            value="{{ $data->ibu_pria }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="bapak_pria" class="form-label">Nama Bapak Pria</label>
                        <input type="text" class="form-control" name="bapak_pria" id="bapak_pria"
                            value="{{ $data->bapak_pria }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="ibu_wanita" class="form-label">Nama Ibu Wanita</label>
                        <input type="text" class="form-control" name="ibu_wanita" id="ibu_wanita"
                            value="{{ $data->ibu_wanita }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="bapak_wanita" class="form-label">Nama Bapak Wanita</label>
                        <input type="text" class="form-control" name="bapak_wanita" id="bapak_wanita"
                            value="{{ $data->bapak_wanita }}">
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

<div class="card d-none" id="akad-card">
    <form action="javascript:void(0)">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="tanggal_akad" class="form-label">Tanggal Akad</label>
                            <input type="date" class="form-control" name="tanggal_akad" id="tanggal_akad"
                                value="{{ $data->tanggal_akad }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="waktu_akad" class="form-label">Waktu Akad</label>
                            <input type="time" autocomplete="off" class="form-control" name="waktu_akad" id="waktu_akad"
                                value="{{ date('H:i',strtotime($data->waktu_akad)) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="alamat_akad" class="form-label">Alamat Akad</label>
                        <input type="text" class="form-control" name="alamat_akad" id="alamat_akad"
                            value="{{ $data->alamat_akad }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="map_akad" class="form-label">Sematan Map Akad (Google Maps)</label>
                        <textarea id="map_akad" class="form-control" name="map_akad">{{ $data->map_akad }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="link_akad" class="form-label">Link Map Akad (Google Maps)</label>
                        <input type="text" class="form-control" name="link_akad" id="link_akad"
                            value="{{ $data->link_akad }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="tanggal_resepsi" class="form-label">Tanggal Resepsi</label>
                            <input type="date" class="form-control" name="tanggal_resepsi" id="tanggal_resepsi"
                                value="{{ $data->tanggal_resepsi }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="waktu_resepsi" class="form-label">Waktu Resepsi</label>
                            <input type="time" class="form-control" name="waktu_resepsi" id="waktu_resepsi"
                                value="{{ date('H:i',strtotime($data->waktu_resepsi)) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="alamat_resepsi" class="form-label">Alamat Resepsi</label>
                        <input type="text" class="form-control" name="alamat_resepsi" id="alamat_resepsi"
                            value="{{ $data->alamat_resepsi }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="map_resepsi" class="form-label">Sematan Map Resepsi (Google Maps)</label>
                        <textarea id="map_resepsi" class="form-control"
                            name="map_resepsi">{{ $data->map_resepsi }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="link_resepsi" class="form-label">Link Map Resepsi (Google Maps)</label>
                        <input type="text" class="form-control" name="link_resepsi" id="link_resepsi"
                            value="{{ $data->link_resepsi }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-end">
                    <button class="btn btn-warning btn-icon-split" id="btn-back-1">
                        <span class="icon text-white-50">
                            <i class="fas fa-backward"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </button>
                    <button type="submit" class="btn btn-primary btn-icon-split ml-2" id="save-akad">
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
<div class="card d-none" id="gallery-card">
    <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Name</label>
                        <input type="file" class="form-control" name="photo" id="photo" onchange="base64(this)">
                        <input type="hidden" id="base64img" name="base64img">
                    </div>
                    <button type="button" class="btn btn-success btn-icon-split ml-2" id="save-photo">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row" id="refresh-gallery">
            <div class="col">
                <div class="card m-4">
                    <h1 class="h1 text-center">Gallery</h1>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @foreach($photos as $photo)
                                    <img width="200px" class="img-fluid" src="{{ $photo->photo }}" alt="gallery">
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus-foto"
                                        data-id="{{ $photo->id }}" data-mempelai_id="{{ $photo->mempelai_id }}"><i
                                            class="fas fa-trash"></i></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function base64(obj) {
        let reader = new FileReader();
        reader.readAsDataURL(obj.files[0]);
        reader.onload = function () {
            document.getElementById('base64img').value = reader.result;
        }
    }

</script>
<div class="card d-none" id="other-card">
    <div class="card-body">
        <form action="javascript:void(0)">
            <div class="row">
                <div class="col-12">
                    <label for="invited" class="form-label">Turut Mengundang</label>
                </div>
                <div class="col-sm-4">
                    <div class="form-group mb-1">
                        @csrf
                        <input type="hidden" name="id" id="id_mempelai" value="{{ $data->id }}">
                        <input type="text" class="form-control " name="invited" id="invited" placeholder="Ketik disini">
                        <small><i class="text-success">Contoh: Keluarga Besar Bapak Muhaimin</i></small>
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <button type="submit" class="btn btn-success btn-icon-split ml-2" id="save-invite">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Table Mempelai</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Invited</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-end">
                <button class="btn btn-warning btn-icon-split" id="btn-back-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-backward"></i>
                    </span>
                    <span class="text">Kembali</span>
                </button>
                <a href="/doneProses" class="btn btn-primary btn-icon-split ml-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-forward"></i>
                    </span>
                    <span class="text">Done</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-invited" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Tamu Undangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)">
                    @csrf
                    <input type="hidden" name="id" id="id_edit_mempelai">
                    <div class="form-group">
                        <label for="invited">Tamu Undangan</label>
                        <input type="text" class="form-control" id="edit_invited" name="invited">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-update-tamu">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/page-script/edit-mempelai.js"></script>
@endsection

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
        <li class="breadcrumb-item" id="data"><span class="text-white">Data Mempelai</span></li>
        <li class="breadcrumb-item d-none" id="akad"><span class="text-info">Akad dan Resepsi</span></li>
        <li class="breadcrumb-item d-none" id="other"><span class="text-info">Lainnya</span></li>
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
                    <label for="putra_ke">Putra Ke-</label>
                    <select class="form-control" id="putra_ke" name="putra_ke">
                        <option value="">Pilih...</option>
                        <option value="Pertama" {{ ($data->putra_ke == 'Pertama') ? 'selected' : ''  }}>Pertama</option>
                        <option value="Kedua" {{ ($data->putra_ke == 'Kedua') ? 'selected' : ''  }}>Kedua</option>
                        <option value="Ketiga" {{ ($data->putra_ke == 'Ketiga') ? 'selected' : ''  }}>Ketiga</option>
                        <option value="Keempat" {{ ($data->putra_ke == 'Keempat') ? 'selected' : ''  }}>Keempat</option>
                        <option value="Kelima" {{ ($data->putra_ke == 'Kelima') ? 'selected' : ''  }}>Kelima</option>
                        <option value="Keenam" {{ ($data->putra_ke == 'Keenam') ? 'selected' : ''  }}>Keenam</option>
                        <option value="Ketujuh" {{ ($data->putra_ke == 'Ketujuh') ? 'selected' : ''  }}>Ketujuh</option>
                        <option value="Kedelapan" {{ ($data->putra_ke == 'Kedelapan') ? 'selected' : ''  }}>Kedelapan</option>
                        <option value="Kesembilan" {{ ($data->putra_ke == 'Kesembilan') ? 'selected' : ''  }}>Kesembilan</option>
                        <option value="Kesepuluh" {{ ($data->putra_ke == 'Kesepuluh') ? 'selected' : ''  }}>Kesepuluh</option>
                        <option value="Kesebelas" {{ ($data->putra_ke == 'Kesebelas') ? 'selected' : ''  }}>Kesebelas</option>
                    </select>
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
            <div class="row d-flex flex-column align-items-center text-center mb-3">
                <div class="col-sm-4">
                    <label for="putri_ke">Putri Ke-</label>
                    <select class="form-control" id="putri_ke" name="putri_ke">
                        <option value="">Pilih...</option>
                        <option value="Pertama" {{ ($data->putri_ke == 'Pertama') ? 'selected' : ''  }}>Pertama</option>
                        <option value="Kedua" {{ ($data->putri_ke == 'Kedua') ? 'selected' : ''  }}>Kedua</option>
                        <option value="Ketiga" {{ ($data->putri_ke == 'Ketiga') ? 'selected' : ''  }}>Ketiga</option>
                        <option value="Keempat" {{ ($data->putri_ke == 'Keempat') ? 'selected' : ''  }}>Keempat</option>
                        <option value="Kelima" {{ ($data->putri_ke == 'Kelima') ? 'selected' : ''  }}>Kelima</option>
                        <option value="Keenam" {{ ($data->putri_ke == 'Keenam') ? 'selected' : ''  }}>Keenam</option>
                        <option value="Ketujuh" {{ ($data->putri_ke == 'Ketujuh') ? 'selected' : ''  }}>Ketujuh</option>
                        <option value="Kedelapan" {{ ($data->putri_ke == 'Kedelapan') ? 'selected' : ''  }}>Kedelapan</option>
                        <option value="Kesembilan" {{ ($data->putri_ke == 'Kesembilan') ? 'selected' : ''  }}>Kesembilan</option>
                        <option value="Kesepuluh" {{ ($data->putri_ke == 'Kesepuluh') ? 'selected' : ''  }}>Kesepuluh</option>
                        <option value="Kesebelas" {{ ($data->putri_ke == 'Kesebelas') ? 'selected' : ''  }}>Kesebelas</option>
                    </select>
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
            @if (auth()->user()->roles == 'admin')
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="map_akad" class="form-label">Sematan Map Akad (Google Maps)</label>
                        <textarea id="map_akad" class="form-control" name="map_akad"
                            style="height:400px">{{ $data->map_akad }}</textarea>
                    </div>
                </div>
            </div>
            @endif
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
            @if (auth()->user()->roles == 'admin')
            <div class="row d-flex flex-column align-items-center text-center d-flex">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="map_resepsi" class="form-label">Sematan Map Resepsi (Google Maps)</label>
                        <textarea id="map_resepsi" class="form-control" name="map_resepsi"
                            style="height:400px">{{ $data->map_resepsi }}</textarea>
                    </div>
                </div>
            </div>
            @endif
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
                <button type="button" class="btn btn-primary crop_gallery">Crop</button>
            </div>
        </div>
    </div>
</div>
<script src="/js/page-script/edit-mempelai.js"></script>
@endsection

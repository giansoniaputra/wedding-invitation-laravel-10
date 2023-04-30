@extends('layouts.main')
@section('container')
<div id="success-update" data-flash="{{ session('success') }}"></div>
<input type="hidden" id="id" value="{{ $mempelai->id }}">
<div class="row mb-2">
    <div class="col">
        <button type="button" id="btn-tambah" class="btn btn-primary btn-icon-split" data-toggle="modal"
            data-target="#modal-gift">
            <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
            </span>
            <span class="text">Tambah Cara Pembayaran</span>
        </button>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Payment</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nomor Rek/E-Wallet</th>
                                <th>Atas Nama</th>
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



{{-- Form Modal --}}
<div class="modal fade" id="modal-gift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-modal">Tambah Cara Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn-x" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-gift">
                    <input type="hidden" name="slug" id="slug" value="{{ $mempelai->slug }}">
                    <div class="current-id"></div>
                    <div class="method"></div>
                    <input type="hidden" name="mempelai_id" id="mempelai_id" value="{{ $mempelai->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                        <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran">
                            <option value=""><span class="text-grey">Pilih Cara Pembayaran</span></option>
                            <option value="BRI">BRI</option>
                            <option value="BCA">BCA</option>
                            <option value="MANDIRI">MANDIRI</option>
                            <option value="BNI">BNI</option>
                            <option value="DANA">DANA</option>
                            <option value="OVO">OVO</option>
                            <option value="SHOPEE PAY">SHOPEE PAY</option>
                            <option value="GOPAY">GOPAY</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor">Nomor E-Wallet/Rekening</label>
                        <input type="text" class="form-control" id="nomor" name="nomor"
                            placeholder="Masukan Nomor E-Wallet/Rekening">
                    </div>
                    <div class="form-group">
                        <label for="atas_nama">Atas Nama</label>
                        <input type="text" class="form-control" id="atas_nama" name="atas_nama"
                            placeholder="Masukan Nama Yang Terkait di E-Wallet/Rekening">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
                <div class="btn-action"></div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="/js/page-script/gift.js"></script>
<script>
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

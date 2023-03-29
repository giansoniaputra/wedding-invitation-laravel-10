@extends('layouts.main')
@section('container')
<div class="row mb-2">
    <div class="col">
        <button type="button" id="btn-tambah" class="btn btn-primary btn-icon-split" data-toggle="modal"
            data-target="#modal-mempelai">
            <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
            </span>
            <span class="text">Tambah Data Mempelai</span>
        </button>
    </div>
</div>
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
                                <th>Nama Pria</th>
                                <th>Nama Wanita</th>
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
<div class="modal fade" id="modal-mempelai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-modal">Tambah Data Mempelai</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn-x" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)">
                    <div class="current-id"></div>
                    <div class="method"></div>
                    @csrf
                    <div class="form-group">
                        <label for="nama_pria">Nama Pria</label>
                        <input type="text" class="form-control" id="nama_pria" name="nama_pria">
                    </div>
                    <div class="form-group">
                        <label for="nama_wanita">Nama Wanita</label>
                        <input type="text" class="form-control" id="nama_wanita" name="nama_wanita">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="template">Template Wedding</label>
                        <select class="form-control" id="template" name="template">
                            <option value="">...</option>
                            @foreach ($templates as $row)
                                <option value="{{ $row->id }}">{{ $row->template }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
                <button type="button" class="btn btn-primary btn-save">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- DataTables --}}
<script>
    feather.replace()
</script>
<script src="js/datatables/mempelai.js"></script>
@endsection

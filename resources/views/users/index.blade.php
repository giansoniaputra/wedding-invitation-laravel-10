@extends('layouts.main')
@section('container')
<div class="row mb-2">
    <div class="col">
        <button type="button" id="btn-tambah" class="btn btn-primary btn-icon-split" data-toggle="modal"
            data-target="#modal-user">
            <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
            </span>
            <span class="text">Tambah Data User</span>
        </button>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
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
<div class="modal fade" id="modal-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-modal">Tambah Data User</h5>
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
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="roles">Pilih Roles</label>
                        <select class="form-control" id="roles" name="roles">
                            <option value="">...</option>
                            <option value="admin">ADMIN</option>
                            <option value="reseller">RESELLER</option>
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
                <button type="button" class="btn btn-primary btn-update">Update</button>
                <button type="button" class="btn btn-primary btn-save">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- DataTables --}}
<script src="js/datatables/users.js"></script>
@endsection

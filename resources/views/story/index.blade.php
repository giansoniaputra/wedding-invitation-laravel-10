@extends('layouts.main')
@section('container')
<div class="row mb-2">
    <div class="col">
        @if($data->story == 0)
            <a href="/status/story-aktif/{{ $data->slug }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Aktifkan Story</span>
            </a>
        @elseif($data->story == 1)
        <a href="/status/story-aktif/{{ $data->slug }}" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-times"></i>
                </span>
                <span class="text">Non-Aktif Story</span>
            </a>
            <div class="row mt-2">
                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" id="btn-tambah" class="btn btn-primary btn-icon-split"
                                data-toggle="modal" data-target="#modal-story">
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Tambah Story</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Kisah</th>
                                            <th>Kisah</th>
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
        @endif
    </div>
</div>
{{-- Form Modal --}}
<div class="modal fade" id="modal-story" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-modal">Tambah Kisah</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn-x" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)">
                    <div class="current-id"></div>
                    <div class="method"></div>
                    @csrf
                    <input type="hidden" id="slug" name="slug" value="{{ $data->slug }}">
                    <input type="hidden" id="id_mempelai" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Kisah</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="story">Kisah</label>
                        <textarea type="text" class="form-control" id="story" name="story" style="height: 350px"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
                <button type="button" class="btn btn-primary btn-update">Update</button>
                <button type="button" class="btn btn-primary btn-add">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="/js/datatables/story.js"></script>
@endsection

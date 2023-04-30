<?php

namespace App\Http\Controllers;

use App\Models\Kado;
use App\Models\Mempelai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mempelai $mempelai)
    {
        $data = [
            'title' => 'Gift | Gian Wedding',
            'badge' => 'Gift(Hadiah)',
            'mempelai' => $mempelai,
        ];

        return view('kado.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    public function add_payment(Request $request)
    {
        $rules = [
            'jenis_pembayaran' => 'required',
            'nomor' => 'required',
            'atas_nama' => 'required',
        ];
        $pesan = [
            'jenis_pembayaran.required' => 'Tidak Boleh Kosong',
            'nomor.required' => 'Tidak Boleh Kosong',
            'atas_nama.required' => 'Tidak Boleh Kosong',
        ];

        $validate = Validator::make($request->all(), $rules , $pesan);

        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $data = [
                'mempelai_id' => $request->mempelai_id,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'nomor' => $request->nomor,
                'atas_nama' => $request->atas_nama,
            ];

            Kado::create($data);
            return response()->json(['success' => 'Pembayaran Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kado $kado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kado $kado)
    {
        //
    }

    public function get_payment(Request $request)
    {
        $query = Kado::where('id', $request->id)->first();
        return response()->json(['data' => $query]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kado $kado)
    {
        //
    }

    public function update_payment(Request $request)
    {
        $rules = [
            'jenis_pembayaran' => 'required',
            'nomor' => 'required',
            'atas_nama' => 'required',
        ];
        $pesan = [
            'jenis_pembayaran.required' => 'Tidak Boleh Kosong',
            'nomor.required' => 'Tidak Boleh Kosong',
            'atas_nama.required' => 'Tidak Boleh Kosong',
        ];

        $validate = Validator::make($request->all(), $rules , $pesan);

        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $data = [
                'mempelai_id' => $request->mempelai_id,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'nomor' => $request->nomor,
                'atas_nama' => $request->atas_nama,
            ];

            Kado::where('id', $request->current_id)->update($data);
            return response()->json(['success' => 'Pembayaran Berhasil Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kado $kado)
    {
        // Kado::where('id', $kado)->delete();
        // return response()->json(['success' => 'Data Berhasil Dihapus']);
    }

    public function delete_payment(Request $request)
    {
        Kado::where('id', $request->id)->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        if($request->ajax()){
            $query = Kado::where('mempelai_id', $request->id)->get();

            return DataTables::of($query)->addColumn('action', function($row){
                $actionBtn = 
                '<button class="btn btn-warning btn-sm edit-payment-button" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="d-inline form-delete">
                    <button type="button" class="btn btn-danger btn-sm delete-payment-button" data-token="'.csrf_token().'" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                </form>';
                return $actionBtn;
            })->make(true);
        }
    }
}

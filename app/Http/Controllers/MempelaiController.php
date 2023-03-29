<?php

namespace App\Http\Controllers;

use App\Models\Mempelai;
use App\Models\Template;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class MempelaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Mempelai | Gian Wedding',
            'badge' => 'Data Mempelai',
            'data' => Mempelai::all(),
            'templates' => Template::all(),
        ];

        return view('mempelai.index',$data);
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
        $rules = [
            'nama_pria' => 'required',
            'nama_wanita' => 'required',
            'template' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'nama_pria' => $request->nama_pria,
                'nama_wanita' => $request->nama_wanita,
                'template_id' => $request->template,
            ];

            Mempelai::create($data);
            return response()->json(['success' => 'Data User Berhasil Ditambahkan!']);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Mempelai $mempelai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mempelai $mempelai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mempelai $mempelai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mempelai $mempelai)
    {
        //
    }

    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Mempelai::class, 'slug', $request->title ,['unique' => true]);
        return response()->json(['slug' => $slug]);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $query = Mempelai::select('*');
            $data = $query->get();

            foreach ($data as $row){
                $row->pria = ucwords(strtolower($row->nama_pria));
                $row->wanita = ucwords(strtolower($row->nama_wanita));
            }
    
            return DataTables::of($data)->addColumn('action', function($row){
                $actionBtn = 
                '<button class="btn btn-info btn-sm view-button" data-id="'.$row->id.'"><i class="fas fa-eye"></i></button>
                <button class="btn btn-warning btn-sm edit-button" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="d-inline form-delete">
                    <button type="button" class="btn btn-danger btn-sm delete-button" data-method="DELETE" data-token="'.csrf_token().'" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                </form>';
                return $actionBtn;
            })->make(true);
        }
    }
}

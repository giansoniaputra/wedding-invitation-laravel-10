<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Mempelai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mempelai $mempelai)
    {
        $data = [
            'title' => 'Story | Gian Wedding',
            'badge' => 'Story Mempelai',
            'data' => $mempelai,
        ];

        return view('story.index',$data);
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
            'tanggal' => 'required',
            'story' => 'required',
        ];
        $pesan = [
            'tanggal.required' => 'Tidak Boleh Kosong',
            'story.required' => 'Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'tanggal' => $request->tanggal,
                'story' => $request->story,
                'mempelai_id' => $request->id,
            ];

            Story::create($data);
            return response()->json(['success' => 'Kisah Berhasil Ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story)
    {
    }
    
    public function update_2(Request $request)
    {

        $rules = [
            'tanggal' => 'required',
            'story' => 'required',
        ];
        $pesan = [
            'tanggal.required' => 'Tidak Boleh Kosong',
            'story.required' => 'Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'tanggal' => $request->tanggal,
                'story' => $request->story,
                'mempelai_id' => $request->id,
            ];

            Story::where('id', $request->id_story)->update($data);
            return response()->json(['success' => 'Kisah Berhasil Diupdate!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        //
    }
    
    public function delete(Request $request)
    {
        Story::where('id', $request->id)->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }

    public function aktif(Mempelai $mempelai)
    {
        if ($mempelai->story == 0)
        {
            Mempelai::where('id', $mempelai->id)->update(['story' => 1]);
            $data = [
                'title' => 'Story | Gian Wedding',
                'badge' => 'Story Mempelai',
                'data' => $mempelai,
            ];

            return redirect()->back();
        } else {
            Mempelai::where('id', $mempelai->id)->update(['story' => 0]);
            $data = [
                'title' => 'Story | Gian Wedding',
                'badge' => 'Story Mempelai',
                'data' => $mempelai,
            ];
    
            return redirect()->back();
        }
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $query = Story::where('mempelai_id', $request->id)->select('*');
            $data = $query->get();

            foreach ($data as $row){
                $row->tgl_kisah = date('l, d-m-Y', strtotime($row->tanggal));
            }
            
            return DataTables::of($data)->addColumn('action', function($row){
                if($row->activation == 0){
                    $actionBtn =
                    '<button class="btn btn-warning btn-sm edit-button" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>
                    <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="d-inline form-delete">
                        <button type="button" class="btn btn-danger btn-sm delete-button" data-token="'.csrf_token().'" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $actionBtn;
                };
            })->make(true);
        }
    }

    public function getIdStory(Story $story) 
    {
    
        $data = Story::where('id', $story->id)->first();

        return response()->json(['success' => $data]);

    }
}

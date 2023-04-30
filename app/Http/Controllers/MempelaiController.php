<?php

namespace App\Http\Controllers;

use App\Models\Kado;
use App\Models\Photo;
use App\Models\Story;
use App\Models\Ucapan;
use App\Models\Invited;
use App\Models\Mempelai;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                'slug' => $request->slug,
                'activation' => 0,
                'story' => 0,
                'user_id' => auth()->user()->id,
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
    public function name(Mempelai $mempelai, $anything)
    {
        $name = explode('-', $anything);
        $data = [
            'mempelai' => $mempelai,
            'nama' => ucwords(strtolower(implode(' ', $name))),
        ];
        $templates = Template::where('id', $mempelai->template_id)->first();
        if($templates->template == 'flower-pink'){
            return view('front-end.cover-flower-pink', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mempelai $mempelai)
    {
        $p = explode(" ", $mempelai->nama_pria);
        $w = explode(" ", $mempelai->nama_wanita);
        $pria = $p[0];
        $wanita = $w[0];
        $data = [
            'title' => 'Mempelai | Gian Wedding',
            'badge' => 'Data Mempelai '.$pria.' dan '.$wanita,
            'data' => $mempelai,
            'templates' => Template::all(),
            'invited' => Invited::where('mempelai_id', $mempelai->id)->get(),
            'photos' => Photo::where('mempelai_id', $mempelai->id)->orderBy('id', 'DESC')->get(),
        ];

       return view('mempelai.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mempelai $mempelai)
    {
        //
    }

    public function updateData(Request $request)
    {
        $rules = [
            'nama_pria' =>   'required',
            'nama_wanita' => 'required',
            'ibu_pria' => 'required',
            'bapak_pria' => 'required',
            'ibu_wanita' => 'required',
            'bapak_wanita' => 'required',
        ];
        $pesan = [
            'nama_pria.required' => 'Tidak Boleh Kosong!',
            'nama_wanita.required' => 'Tidak Boleh Kosong!',
            'ibu_pria.required' => 'Tidak Boleh Kosong!.',
            'bapak_pria.required' => 'Tidak Boleh Kosong!.',
            'ibu_wanita.required' => 'Tidak Boleh Kosong!',
            'bapak_wanita.required' => 'Tidak Boleh Kosong!',
        ];
        $validateData = $request->validate($rules, $pesan);

        Mempelai::where('id', $request->id)->update($validateData);

        $p = explode(" ", $request->nama_pria);
        $w = explode(" ", $request->nama_wanita);
        $pria = $p[0];
        $wanita = $w[0];
        $data = [
            'title' => 'Mempelai | Gian Wedding',
            'badge' => 'Data Mempelai '.$pria.' dan '.$wanita,
            'data' => Mempelai::where('id', $request->id)->first(),
        ];
        return view('mempelai.update-photo', $data);
    }

    public function updateDataPhoto(Request $request)
    {
    //     return $request;
    //     $p = explode(" ", $mempelai->nama_pria);
    //     $w = explode(" ", $mempelai->nama_wanita);
    //     $pria = $p[0];
    //     $wanita = $w[0];
    //     $data = [
    //         'title' => 'Mempelai | Gian Wedding',
    //         'badge' => 'Data Mempelai '.$pria.' dan '.$wanita,
    //         'data' => $mempelai,
    //         'templates' => Template::all(),
    //         'invited' => Invited::where('mempelai_id', $mempelai->id)->get(),
    //         'photos' => Photo::where('mempelai_id', $mempelai->id)->get(),
    //     ];

    //    return view('mempelai.update-photo',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mempelai $mempelai)
    {
        $data = Mempelai::where('id', $mempelai->id)->first();
        Mempelai::where('id',$data->id)->delete();
        Invited::where('mempelai_id', $data->id)->delete();
        Photo::where('mempelai_id', $data->id)->delete();
        Ucapan::where('mempelai_id', $data->id)->delete();
        Story::where('mempelai_id', $data->id)->delete();

        return redirect('/mempelai')->with(['success' => 'Data Berhasil Dihapus']);

    }

    public function updateDataMempelai(Request $request)
    {
        $rules = [
            'nama_pria' =>   'required',
            'nama_wanita' => 'required',
            'ibu_pria' => 'required',
            'bapak_pria' => 'required',
            'ibu_wanita' => 'required',
            'bapak_wanita' => 'required',
            'putra_ke' => 'required',
            'putri_ke' => 'required',
        ];
        $pesan = [
            'nama_pria.required' => 'Tidak Boleh Kosong!',
            'nama_wanita.required' => 'Tidak Boleh Kosong!',
            'ibu_pria.required' => 'Tidak Boleh Kosong!.',
            'bapak_pria.required' => 'Tidak Boleh Kosong!.',
            'ibu_wanita.required' => 'Tidak Boleh Kosong!',
            'bapak_wanita.required' => 'Tidak Boleh Kosong!',
            'putra_ke.required' => 'Tidak Boleh Kosong!',
            'putri_ke.required' => 'Tidak Boleh Kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'nama_pria' =>   $request->nama_pria,
                'nama_wanita' => $request->nama_wanita,
                'slug' => $request->slug,
                'ibu_pria' => $request->ibu_pria,
                'bapak_pria' => $request->bapak_pria,
                'ibu_wanita' => $request->ibu_wanita,
                'bapak_wanita' => $request->bapak_wanita,
                'putra_ke' => $request->putra_ke,
                'putri_ke' => $request->putri_ke,
            ];

            Mempelai::where('id', $request->id)->update($data);
            return response()->json(['success' => $data]);
        }
    }
    public function updateAkadMempelai(Request $request)
    {
        $rules = [
            'tanggal_akad' =>   'required',
            'alamat_akad' => 'required',
            'tanggal_resepsi' => 'required',
            'alamat_resepsi' => 'required',
            'waktu_akad' => 'required',
            'waktu_resepsi' => 'required',
            'link_akad' => 'required',
            'link_resepsi' => 'required',
        ];
        $pesan = [
            'tanggal_akad.required' => 'Tidak Boleh Kosong!',
            'alamat_akad.required' => 'Tidak Boleh Kosong!',
            'tanggal_resepsi.required' => 'Tidak Boleh Kosong!.',
            'alamat_resepsi.required' => 'Tidak Boleh Kosong!',
            'waktu_akad.required' => 'Tidak Boleh Kosong!',
            'waktu_resepsi.required' => 'Tidak Boleh Kosong!',
            'link_akad.required' => 'Tidak Boleh Kosong!',
            'link_resepsi.required' => 'Tidak Boleh Kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'tanggal_akad' =>   $request->tanggal_akad,
                'alamat_akad' => $request->alamat_akad,
                'map_akad' => $request->map_akad,
                'tanggal_resepsi' => $request->tanggal_resepsi,
                'alamat_resepsi' => $request->alamat_resepsi,
                'map_resepsi' => $request->map_resepsi,
                'link_akad' => $request->link_akad,
                'link_resepsi' => $request->link_resepsi,
                'waktu_akad' => $request->waktu_akad,
                'waktu_resepsi' => $request->waktu_resepsi,
            ];

            Mempelai::where('id', $request->id)->update($data);
            return response()->json(['success' => $data]);
        }
    }

    public function updateInviteMempelai(Request $request)
    {
        $rules = [
            'invited' => 'required'
        ];
        $pesan = [
            'invited.required' => 'Tidak Boleh Kosong!'
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'mempelai_id' => $request->id,
                'invited' => $request->invited,
            ];

            Invited::create($data);
            return response()->json(['success' => $data]);
        }
    }

    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Mempelai::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            if(auth()->user()->roles == 'admin') {
                $query = DB::table('mempelai as a')->join('users as b', 'a.user_id', '=', 'b.id')->select('a.*','b.name');
                $data = $query->get();

                foreach ($data as $row){
                    $row->pria = ucwords(strtolower($row->nama_pria));
                    $row->wanita = ucwords(strtolower($row->nama_wanita));
                }
            
                return DataTables::of($data)->addColumn('action', function($row){
                    if($row->activation == 0){
                        $actionBtn = 
                        '<a href="/'.$row->slug.'" target="_blank" class="btn btn-info btn-sm view-button"><i class="fas fa-eye"></i></a>
                        <a href="/mempelai/'.$row->slug.'/edit" class="btn btn-warning btn-sm edit-button ml-1"><i class="fas fa-edit"></i></a>
                        <a href="/editPhotoMempelai/'.$row->slug.'" class="btn btn-dark btn-sm view-button ml-1" style="background-color: rgb(89, 98, 117)"><i class="fas fa-images"></i></a>
                        <a href="/mempelai/'.$row->slug.'/story" class="btn btn-primary btn-sm edit-button ml-1"><i class="fas fa-heart"></i></a>
                        <a href="/mempelai/'.$row->slug.'/kado" class="btn btn-success btn-sm ml-1"><i class="fas fa-money-bill-wave"></i></a>
                        <form action="/activasi" method="post" class="d-inline ml-1">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="submit" class="btn btn-success btn-sm delete-button"><i class="fas fa-check"></i></button>
                        </form>
                        <form action="/mempelai/'.$row->slug.'" method="post" class="d-inline ml-1">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="'.$row->id.'">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda Yakin?\')"><i class="fas fa-trash"></i></button>
                            </form>
                        ';
                    }else {
                        $actionBtn = 
                        '<a href="/'.$row->slug.'" target="_blank" class="btn btn-info btn-sm view-button"><i class="fas fa-eye"></i></a>
                        <a href="/mempelai/'.$row->slug.'/edit" class="btn btn-warning btn-sm edit-button ml-1"><i class="fas fa-edit"></i></a>
                        <a href="/editPhotoMempelai/'.$row->slug.'" class="btn btn-dark btn-sm view-button ml-1" style="background-color: rgb(89, 98, 117)"><i class="fas fa-images"></i></a>
                        <a href="/mempelai/'.$row->slug.'/story" class="btn btn-primary btn-sm edit-button ml-1"><i class="fas fa-heart"></i></a>
                        <a href="/mempelai/'.$row->slug.'/kado" class="btn btn-success btn-sm ml-1"><i class="fas fa-money-bill-wave"></i></a>
                        <form action="/activasi" method="post" class="d-inline ml-1">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="submit" class="btn btn-danger btn-sm delete-button"><i class="fas fa-ban"></i></button>
                        </form>
                        <form action="/mempelai/'.$row->slug.'" method="post" class="d-inline ml-1">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="'.$row->id.'">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash" onclick="return confirm(\'Apakah Anda Yakin?\')"></i></button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })->addColumn('status', function ($row){
                    if($row->activation == 0){
                        $status = 'Not Activated';
                    } else {
                        $status = 'Activated';
                    }
                    return $status;
                })
                ->make(true);
            } else if(auth()->user()->roles == 'reseller'){
                $query = DB::table('mempelai as a')->join('users as b', 'a.user_id', '=', 'b.id')->select('a.*','b.name')->where('user_id', auth()->user()->id);
                $data = $query->get();
                
                foreach ($data as $row){
                    $row->pria = ucwords(strtolower($row->nama_pria));
                    $row->wanita = ucwords(strtolower($row->nama_wanita));
                }
            
                return DataTables::of($data)->addColumn('action', function($row){
                    $actionBtn = 
                    '<a href="/'.$row->slug.'" target="_blank" class="btn btn-info btn-sm view-button"><i class="fas fa-eye"></i></a>
                    <a href="/mempelai/'.$row->slug.'/edit" class="btn btn-warning btn-sm edit-button ml-1"><i class="fas fa-edit"></i></a>
                    <a href="/editPhotoMempelai/'.$row->slug.'" class="btn btn-dark btn-sm view-button ml-1" style="background-color: rgb(89, 98, 117)"><i class="fas fa-images"></i></a>
                     <a href="/mempelai/'.$row->slug.'/story" class="btn btn-primary btn-sm edit-button ml-1"><i class="fas fa-heart"></i></a>
                     <a href="/mempelai/'.$row->slug.'/kado" class="btn btn-success btn-sm ml-1"><i class="fas fa-money-bill-wave"></i></a>
                     <form action="/mempelai/'.$row->slug.'" method="post" class="d-inline ml-1">
                         <input type="hidden" name="_token" value="'.csrf_token().'">
                         <input type="hidden" name="_method" value="DELETE">
                         <input type="hidden" name="id" value="'.$row->id.'">
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda Yakin?\')"><i class="fas fa-trash"></i></button>
                    </form>
                     ';
                    return $actionBtn;
                })->addColumn('status', function ($row){
                    if($row->activation == 0){
                        $status = 'Not Activated';
                    } else {
                        $status = 'Activated';
                    }
                    return $status;
                })->make(true);
            }
        }
    }

    public function uploadPhoto(Request $request)
    {
        $rules = [
            'base64img' => 'required',
        ];
        $pesan = [
            'base64img.required' => 'Tidak Boleh Kosong!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'mempelai_id' => $request->id,
                'photo' => $request->base64img,
            ];

            Photo::create($data);
            return response()->json(['success' => $data]);
        }
    }

    public function editInvited(Request $request)
    {
        $invited = Invited::where('id', $request->id)->first();

        $data = [
            'id' => $invited->id,
            'invited' => $invited->invited,
        ];

        return response()->json(['invited' => $data]);
    }

    public function updateInvited(Request $request)
    {
        $rules = [
            'invited' => 'required'
        ];
        $pesan = [
            'invited.required' => 'Tidak Boleh Kosong!'
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'invited' => $request->invited,
            ];

            Invited::where('id', $request->id)->update($data);
            return response()->json(['success' => 'Data Tamu Berhasil Diupdate']);
        }
    }

    public function destroyInvited(Request $request)
    {
        Invited::destroy($request->id);
        return response()->json(['success' => 'Data Tamu Berhasil Dihapus!']);
    }

    public function doneProses()
    {
        return redirect('/mempelai')->with('success', 'Data Mempelai Berhasil Diupdate');
    }

    public function reloadGallery(Request $request)
    {
        $photos = Photo::where('mempelai_id', $request->id)->orderBy('id', 'DESC')->get();
        echo '
        <div class="col">
        <div class="card m-4">
            <h1 class="h1 text-center">Gallery</h1>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        ';
                        foreach ($photos as $photo) {
                            echo '
                                    <img width="200px" class="img-fluid" src="'.$photo->photo.'" alt="gallery">
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus-foto" data-id="'.$photo->id.'" data-mempelai_id="'. $photo->mempelai_id .'"><i class="fas fa-trash"></i></button>
                                ';
                            }
                            echo '
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                <button type="button" class="btn btn-warning btn-icon-split mb-4" id="btn-back-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-backward"></i>
                    </span>
                    <span class="text">Kembali</span>
                </button>
                <button type="submit" class="btn btn-primary btn-icon-split ml-2 mr-4 mb-4" id="save-gallery">
                    <span class="icon text-white-50">
                        <i class="fas fa-forward"></i>
                    </span>
                    <span class="text">Selanjutnya</span>
                </button>
            </div>
            ';
    }

    public function deletePhoto(Request $request)
    {
        $data = [
            'id' => $request->id,
            'mempelai_id' => $request->mempelai_id,
        ];
        Photo::destroy($request->id);
        return response()->json(['success' => $data]);
    }

    public function dataTablesInvited(Request $request)
    {
        if ($request->ajax()) {
                $query = Invited::where('mempelai_id', $request->id)->select('*');
                $data = $query->get();

                foreach ($data as $row){
                    $row->terundang = ucwords(strtolower($row->invited));
                }
            
                return DataTables::of($data)->addColumn('action', function($row){
                    $actionBtn = 
                    '<button class="btn btn-warning btn-sm edit-invited-button" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>
                    <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="d-inline form-delete">
                        <button type="button" class="btn btn-danger btn-sm delete-invited-button" data-token="'.csrf_token().'" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $actionBtn;
                })->make(true);
        }
    }


    // FRONT END
    public function front_end(Mempelai $mempelai)
    {
        $template = Template::where('id', $mempelai->template_id)->first();
        $daftar_hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );
        $daftar_bulan = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        );
        if($mempelai->activation){
            $data = [
                'mempelai' => $mempelai,
                'invited' => Invited::where('mempelai_id', $mempelai->id)->get(),
                'photos' => Photo::where('mempelai_id', $mempelai->id)->get(),
                'ucapan' => Ucapan::where('mempelai_id', $mempelai->id)->orderBy('id', 'DESC')->get(),
                'hari' => $daftar_hari,
                'bulan' => $daftar_bulan,
                'stories' => Story::where('mempelai_id', $mempelai->id)->get(),
                'payment' => Kado::where('mempelai_id', $mempelai->id)->get(),
            ];
            return view('front-end.'.$template->template, $data);
        } else {
            return view('not-activeted');
        }
    }

    // UCAPAN
    public function kirimUcapan(Request $request)
    {
        $rules = [
            'nama_pengirim' => 'required',
            'pesan' => 'required',
            'kehadiran' => 'required',
        ];
        $pesan = [
            'nama_pengirim.required' => 'Silahkan Isi Nama Anda.',
            'pesan.required' => 'Silahkan Isi Ucapan Anda.',
            'kehadiran.required' => 'Silahkan Isi Ucapan Anda.',
        ];

        $validator = Validator::make($request->all(),$rules,$pesan);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'mempelai_id' => $request->id,
                'ucapan' => $request->pesan,
                'pengirim' => $request->nama_pengirim,
                'kehadiran' => $request->kehadiran,
            ];

            $pesan_json = [
                'pesan' => 'Pesan Anda Sudah Terkirim',
                'id' => $request->id,
            ];

            Ucapan::create($data);
            return response()->json(['success' => $pesan_json]);
        }
    }

    public function reloadUcapan(Request $request) {
        $ucapan = Ucapan::where('mempelai_id',$request->id)->orderBy('id', 'DESC')->get();
        foreach ($ucapan as $row) {
            echo '
            <div class="row mb-2">
                <div class="col d-flex align-items-center">
                    <img src="/front-end/img/icon/poster.png" alt="" class="img-fluid rounded-circle" width="30px">
                    <p class="ms-3 mb-0 ml-1 text-white">
                        '.$row->pengirim; if($row->kehadiran == "Hadir") { echo ' (<small class="text-success"><b> Hadir </b></small>)'; } elseif($row->kehadiran == "Belum Pasti") { echo ' (<small class="text-warning"><b> Belum Pasti </b></small>)'; } elseif($row->kehadiran == "Tidak Bisa Hadir") { echo ' (<small class="text-danger"><b> Tidak Bisa Hadir </b></small>)'; }
                    echo '</p>
                </div>
            </div>
            <div class="row mb-2 ms-3">
                <div class="col d-flex">
                    <img src="/front-end/img/pojok.png" alt="" width="15px" height="9px" class="d-inline border-0">
                    <div class="card border-0" style="border-radius:0 7px 7px 7px; background-color:#202C33;">
                        <div class="card-body p-2">
                            <small class="mb-0 ml-1 fst-italic text-white">
                            '.$row->ucapan.'</small>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }

    // Aktivasi
    public function activasiUndangan(Request $request)
    {
        $data = Mempelai::where('id', $request->id)->first();
        if($data->activation == 0){
            Mempelai::where('id', $request->id)->update(['activation' => 1]);
            return redirect('/mempelai')->with(['success' => 'Undangan Berhasil Di Aktivasi']);
        } else {
            Mempelai::where('id', $request->id)->update(['activation' => 0]);
            return redirect('/mempelai')->with(['success' => 'Undangan Di Non-Aktifkan']);
        }
        
    }
}

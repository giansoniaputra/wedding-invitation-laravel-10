<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Mempelai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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

    public function edit_photo_mempelai($slug)
    {
        $data = [
            'title' => 'Photo | Gian Wedding',
            'badge' => 'Photo Mempelai',
            'data' => Mempelai::where('slug', $slug)->first(),
        ];

        return view('photo.index',$data);
    }

    public function update_photo(Request $request)
    {
        
        if($request->fotoPria || $request->fotoWanita){
            $rules = $request->validate([
                'photo_pria' => 'image|file|max:2048',
                'photo_wanita' => 'image|file|max:2048',
            ],[
                'photo_pria.image' => 'File Harus Berupa Gambar',
                'photo_wanita.image' => 'File Harus Berupa Gambar',
                'photo_pria.max' => 'Gambar Minimal Berukuran 2MB',
                'photo_wanita.max' => 'Gambar Minimal Berukuran 2MB',
            ]);
        } else if(!$request->fotoPria || !$request->fotoWanita) {
            $rules = $request->validate([
                'photo_pria' => 'required|image|file|max:2048',
                'photo_wanita' => 'required|image|file|max:2048',
            ],[
                'photo_pria.required' => 'Gambar Tidak Boleh Kosong',
                'photo_wanita.required' => 'Gambar Tidak Boleh Kosong',
                'photo_pria.image' => 'File Harus Berupa Gambar',
                'photo_wanita.image' => 'File Harus Berupa Gambar',
                'photo_pria.max' => 'Gambar Minimal Berukuran 2MB',
                'photo_wanita.max' => 'Gambar Minimal Berukuran 2MB',
            ]);
        }
        $slug = Mempelai::where('id', $request->id)->first();
        Mempelai::where('slug', $slug->slug)->update(['photo_pria' => $request->fotoPria, 'photo_wanita' => $request->fotoWanita]);
        return redirect('editPhotoMempelai/'.$slug->slug)->with('success', 'Gambar Berhasil Diperbaharui');
    }

    public function page_gallery($slug)
    {
        $mempelai = Mempelai::where('slug', $slug)->first();
        $data = [
            'title' => 'Gallery | Gian Wedding',
            'badge' => 'Photo Mempelai',
            'data' => $mempelai,
            'photos' => Photo::where('mempelai_id', $mempelai->id)->orderBy('id', 'DESC')->get(),
        ];

        return view('photo.gallery',$data);
    }

    public function page_upload(Request $request)
    {
        $rules = $request->validate([
            'photo' => 'required|image|file|max:2048',
        ],[
            'photo.required' => 'Gambar Tidak Boleh Kosong',
            'photo.image' => 'File Harus Berupa Gambar',
            'photo.max' => 'Gambar Minimal Berukuran 2MB',
        ]);
        $slug = Mempelai::where('id', $request->id)->first();
        $data = [
            'mempelai_id' => $request->id,
            'photo' => $request->base64img,
        ];
        Photo::create($data);
        return redirect('gallery/'.$slug->slug)->with('success', 'Gambar Berhasil Ditambahkan ke Gallery');
    }

    public function delete_photo(Request $request)
    {
        Photo::where('id', $request->id)->delete();
        return back()->with('success', 'Gambar Berhasil Dihapus');
    }
}

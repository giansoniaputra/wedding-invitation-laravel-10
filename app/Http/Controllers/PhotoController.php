<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Mempelai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
                'photo_pria' => 'image|file|max:5120',
                'photo_wanita' => 'image|file|max:5120',
            ],[
                'photo_pria.image' => 'File Harus Berupa Gambar',
                'photo_wanita.image' => 'File Harus Berupa Gambar',
                'photo_pria.max' => 'Gambar Minimal Berukuran 5MB',
                'photo_wanita.max' => 'Gambar Minimal Berukuran 5MB',
            ]);
        } else if(!$request->fotoPria || !$request->fotoWanita) {
            $rules = $request->validate([
                'photo_pria' => 'required|image|file|max:5120',
                'photo_wanita' => 'required|image|file|max:5120',
            ],[
                'photo_pria.required' => 'Gambar Tidak Boleh Kosong',
                'photo_wanita.required' => 'Gambar Tidak Boleh Kosong',
                'photo_pria.image' => 'File Harus Berupa Gambar',
                'photo_wanita.image' => 'File Harus Berupa Gambar',
                'photo_pria.max' => 'Gambar Minimal Berukuran 5MB',
                'photo_wanita.max' => 'Gambar Minimal Berukuran 5MB',
            ]);
        }

        $slug = Mempelai::where('id', $request->id)->first();

        $imagePria = $request->fotoPria;  // your base64 encoded
        $imagePria = str_replace('data:image/png;base64,', '', $imagePria);
        $imagePria = str_replace(' ', '+', $imagePria);
        $imageNamePria = Str::random(40).'.'.'png';
        File::put(storage_path(). '/app/public/post-images/mempelai/' . $imageNamePria, base64_decode($imagePria));

        $imageWanita = $request->fotoWanita;  // your base64 encoded
        $imageWanita = str_replace('data:image/png;base64,', '', $imageWanita);
        $imageWanita = str_replace(' ', '+', $imageWanita);
        $imageNameWanita = Str::random(40).'.'.'png';
        File::put(storage_path(). '/app/public/post-images/mempelai/' . $imageNameWanita, base64_decode($imageWanita));

        $data2 = [
            'photo_pria' => $imageNamePria,
            'photo_wanita' => $imageNameWanita,
        ];

        if($slug->photo_pria != 'post-images/mempelai/' && $slug->photo_wanita != 'post-images/mempelai/')
        {
            // if(file_exists($request->photo_pria) && file_exists($request->photo_wanita)){
            //     unlink(public_path().'/img/mempelai/'.$request->oldImagePria);
            //     unlink(public_path().'/img/mempelai/'.$request->oldImageWanita);
            // }
            Storage::delete($request->oldImagePria);
            Storage::delete($request->oldImageWanita);
        }
        Mempelai::where('slug', $slug->slug)->update($data2);
        
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
            'photo' => 'required|image|file|max:5120',
        ],[
            'photo.required' => 'Gambar Tidak Boleh Kosong',
            'photo.image' => 'File Harus Berupa Gambar',
            'photo.max' => 'Gambar Minimal Berukuran 5MB',
        ]);
        $slug = Mempelai::where('id', $request->id)->first();

        $imageGallery = $request->base64img;  // your base64 encoded
        $imageGallery = str_replace('data:image/png;base64,', '', $imageGallery);
        $imageGallery = str_replace(' ', '+', $imageGallery);
        $imageNameGallery = Str::random(40).'.'.'png';
        File::put(storage_path(). '/app/public/post-images/gallery/' . $imageNameGallery, base64_decode($imageGallery));

        $data = [
            'mempelai_id' => $request->id,
            'photo' => $imageNameGallery,
        ];
        Photo::create($data);
        return redirect('gallery/'.$slug->slug)->with('success', 'Gambar Berhasil Ditambahkan ke Gallery');
    }

    public function page_cover($slug)
    {
        $mempelai = Mempelai::where('slug', $slug)->first();
        $data = [
            'title' => 'Cover | Gian Wedding',
            'badge' => 'Cover Undangan',
            'data' => $mempelai,
            'photos' => Photo::where('mempelai_id', $mempelai->id)->orderBy('id', 'DESC')->get(),
        ];

        return view('photo.cover',$data);
    }

    public function update_cover(Request $request)
    {
        $rules = $request->validate([
            'cover' => 'required|image|file|max:5120',
        ],[
            'cover.required' => 'Gambar Tidak Boleh Kosong',
            'cover.image' => 'File Harus Berupa Gambar',
            'cover.max' => 'Gambar Minimal Berukuran 5MB',
        ]);
        $slug = Mempelai::where('id', $request->id)->first();
        if($request->oldImageCover == ''){
            $rules['cover'] = $request->file('cover')->store('post-images/cover');
            Mempelai::where('id', $request->id)->update($rules);

            return redirect('cover/'.$slug->slug)->with('success', 'Cover Berhasil Ditambahkan');
        } else {
            Storage::delete($request->oldImageCover);
            $rules['cover'] = $request->file('cover')->store('post-images/cover');
            Mempelai::where('id', $request->id)->update($rules);

            return redirect('cover/'.$slug->slug)->with('success', 'Cover Berhasil Diubah');
        }
    }

    public function delete_photo(Request $request)
    {
        
        Photo::where('id', $request->id)->delete();
        Storage::delete($request->photo);
        return back()->with('success', 'Gambar Berhasil Dihapus');
    }
}

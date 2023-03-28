<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'badge' => 'users',
            'title' => 'User | Gian Wedding',
            'users' => Users::all()
        ];
        return view('users.index', $data);

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
            'name' =>   'required',
            'username' => 'required|unique:users|min:8',
            'password' => 'required|min:7|confirmed',
            'password_confirmation' => 'required',
            'email' => 'required|email',
            'roles' => 'required',
        ];
        $pesan = [
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.unique' => 'Username Sudah Terdaftar. Silahkan Masukan Username Lain!.',
            'username.min' => 'Username Harus Mempunyai Minimal 8 Karakter!',
            'password|required' => 'Password Tidak Boleh Kosong!.',
            'password|min' => 'Password Harus Mempunyai Minimal 8 Karakter!.',
            'password|confirmed' => 'Password Yang Sama!.',
            'password_confirmation|required' => 'Konfirmasi Password Tidak Boleh Kosong!.',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email (contoh: namalengkap@gmail.com)',
            'roles.required' => 'Roles Harus Dipilih',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'roles' => $request->roles,
            ];

            Users::create($data);
            return response()->json(['success' => 'Data User Berhasil Ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $user)
    {
        
        if($request->username == $user->username){
            $rules = [
                'name' =>   'required',
                'username' => 'required|min:8',
                'password' => 'required|min:7|confirmed',
                'password_confirmation' => 'required',
                'email' => 'required|email',
                'roles' => 'required',
            ];
            $pesan = [
                'name.required' => 'Nama Tidak Boleh Kosong!',
                'username.required' => 'Username Tidak Boleh Kosong!',
                'username.min' => 'Username Harus Mempunyai Minimal 8 Karakter!',
                'password|required' => 'Password Tidak Boleh Kosong!.',
                'password|min' => 'Password Harus Mempunyai Minimal 8 Karakter!.',
                'password|confirmed' => 'Password Yang Sama!.',
                'password_confirmation|required' => 'Konfirmasi Password Tidak Boleh Kosong!.',
                'email.required' => 'Email Tidak Boleh Kosong!',
                'email.email' => 'Email Harus Berupa Email (contoh: namalengkap@gmail.com)',
                'roles.required' => 'Roles Harus Dipilih',
            ];
        } else {
            $rules = [
                'name' =>   'required',
                'username' => 'required|unique:users|min:8',
                'password' => 'required|min:7|confirmed',
                'password_confirmation' => 'required',
                'email' => 'required|email',
                'roles' => 'required',
            ];
            $pesan = [
                'name.required' => 'Nama Tidak Boleh Kosong!',
                'username.required' => 'Username Tidak Boleh Kosong!',
                'username.unique' => 'Username Sudah Terdaftar. Silahkan Masukan Username Lain!.',
                'username.min' => 'Username Harus Mempunyai Minimal 8 Karakter!',
                'password|required' => 'Password Tidak Boleh Kosong!.',
                'password|min' => 'Password Harus Mempunyai Minimal 8 Karakter!.',
                'password|confirmed' => 'Password Yang Sama!.',
                'password_confirmation|required' => 'Konfirmasi Password Tidak Boleh Kosong!.',
                'email.required' => 'Email Tidak Boleh Kosong!',
                'email.email' => 'Email Harus Berupa Email (contoh: namalengkap@gmail.com)',
                'roles.required' => 'Roles Harus Dipilih',
            ];
        }
        
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            // Jika validasi gagal, mengembalikan
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'roles' => $request->roles,
            ];

            Users::where('id', $request->id)->update($data);
            return response()->json(['success' => 'Data User Berhasil Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $user)
    {
        Users::destroy($user->id);
        return response()->json(['success' => 'Data User Berhasil Dihapus!']);
    }

    // DataTables
    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $query = Users::select('*')->where('username', '!=', 'giansonia');
            $data = $query->get();
    
            return DataTables::of($data)->addColumn('action', function($row){
                $actionBtn = 
                '<button class="btn btn-warning btn-sm edit-button" data-id="'.$row->id.'"><i class="fas fa-exclamation-triangle"></i></button>
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="d-inline form-delete">
                    <button type="button" class="btn btn-danger btn-sm delete-button" data-method="DELETE" data-token="'.csrf_token().'" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                </form>';
                return $actionBtn;
            })->make(true);
        }
    }

    // Ambil data User
    public function editUser(Request $request)
    {
        $user = Users::where('id', $request->id)->first();
        return $user;
    }
}

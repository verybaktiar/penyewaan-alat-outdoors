<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255|min:3',
            'email' => 'required|email:dns',
            'password' => 'required|min:5',
            'password_confirm' => 'required|same:password'
        ]);

        $id_user = DB::select('SELECT id_user FROM users ORDER BY LENGTH(id_user) DESC, id_user DESC LIMIT 1');
        $id_userbaru = (int)substr($id_user[0]->id_user,3)+(int)1;
        
        $user = User::create([
            'id_user' => 'USR'.$id_userbaru,
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'pelanggan',
            'password' => bcrypt($request->password)
        ]);

        if($user){
           $id_pelanggan = Pelanggan::orderBy('id_pelanggan', 'DESC')->first();
        
            if($id_pelanggan){
                $pelanggan = Pelanggan::create([
                    'id_pelanggan' => 'PLG'.(int)substr($id_pelanggan->id_pelanggan,3)+(int)1,
                    'id_user' => 'USR'.$id_userbaru,
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'jenis_kelamin'=>$request->jenis_kelamin
                ]);
            }
            else{
                $pelanggan=Pelanggan::create([
                    'id_pelanggan' => 'PLG1',
                    'id_user' => 'USR'.$id_userbaru,
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'jenis_kelamin'=>$request->jenis_kelamin
                ]);
            }
        }

        return redirect('/login');
    }
  
}

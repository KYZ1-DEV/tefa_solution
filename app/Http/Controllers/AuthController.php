<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view(view: 'auth.login');
    }

    public function auth() {
        if (Auth::check()) {
            $user = Auth::user();
            // Redirect sesuai dengan role user
            if ($user && $user->role === 'industri') {
                return redirect('/industries');
            } else if ($user && $user->role === 'sekolah') {
                return redirect('/schools');
            } else {
                $url = "/" . $user->role;
                return redirect($url);
            }
        }
        return redirect('/home');
    }

    public function login(Request $request) {

            $request->validate([
            'email' => 'required',
            'password' => 'required'
            ],[
                'email.required' => 'Email wajib diisi',
                'password.required' => 'password wajib diisi'
            ]
            );

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success','Halo Admin, Anda Berhasil Login');
            }elseif (Auth::user()->role === 'industri') {
                return redirect()->route(route: 'industries.index')->with('success','Berhasil Login');
            }elseif (Auth::user()->role === 'sekolah') {
                return redirect()->route(route: 'schools.index')->with('success','Berhasil Login');
            }

        }else {
            return redirect()->route('login')->with('error','Email atau Password salah !');
        }
    }




    public function register(Request  $request){

        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required',
            'role' => 'required'
        ],
        [
            'name.required' => 'Name wajib diisi',
            'name.min' => 'Name minimal 5 karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.same' => 'Konfirmasi password tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'role.required' => 'Pilih role',
        ]);

        $infoRegister = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role' => $request->role
        ];

        User::create($infoRegister);


        return redirect()->route(route: 'login')->with('success','Registrasi Berhasil');
}

    public function registrasi() {
        return view('auth.registrasi');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}

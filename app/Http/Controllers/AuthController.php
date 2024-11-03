<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekolah;
use App\Models\Industri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view(view: 'auth.login');
    }

    public function auth(Request $request) {
        // dd($request->all());
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

        if($request->auth === 'logout'){
            return redirect('/home')->with('success','Log out Berhasil');
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
                $industri = Industri::where('id_user', Auth::user()->id)->first();
                if(is_null($industri)){
                    return redirect()->route('industries.index')
                    ->with([
                        'info' => 'Selamat datang di halaman industri!, Tolong lengkapi Profile Terlebih dahulu !',
                        'success' => 'Berhasil Login'
                    ]);
                }
                return redirect()->route(route: 'industries.index')->with('success','Berhasil Login');
            }elseif (Auth::user()->role === 'sekolah') {
                $sekolah = Sekolah::where('id_user', Auth::user()->id)->first();
                if(is_null($sekolah)){
                    return redirect()->route('schools.index')
                    ->with([
                        'info' => 'Selamat datang di halaman Sekolah!, Tolong lengkapi Profile Terlebih dahulu !',
                        'success' => 'Berhasil Login'
                    ]);
                }
                return redirect()->route(route: 'schools.index')->with('success','Berhasil Login');
            }

        }else {
            return redirect()->route('login')->with('error','Email atau Password salah !');
        }
    }




    public function schoolRegister(Request $request){

        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email|same:email_confirmation',
            'email_confirmation' => 'required',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required',
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
            'email.same' => 'Konfirmasi email tidak cocok',
            'email_confirmation.required' => 'Konfirmasi email wajib diisi',
        ]);

        $infoRegister = [
        'name' => strtoupper( $request->name),
        'email' => $request->email,
        'password' => $request->password,
        'role' => 'sekolah'
        ];

        User::create($infoRegister);

        return redirect()->route(route: 'login')->with('success','Registrasi Berhasil');
    }

    public function industriRegister(Request  $request){

        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email|same:email_confirmation',
            'email_confirmation' => 'required',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required',
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
            'email.same' => 'Konfirmasi email tidak cocok',
            'email_confirmation.required' => 'Konfirmasi email wajib diisi',
        ]);

        $infoRegister = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role' => 'industri'
        ];

        User::create($infoRegister);


        return redirect()->route(route: 'login')->with('success','Registrasi Berhasil');
    }
    
    public function registrasi() {
        return view('auth.registrasi');
    }
    public function registrasiSekolah() {
        return view('auth.sekolahRegister');
    }
    public function registrasiIndustri() {
        return view('auth.industriRegister');
    }

    public function logout() {
        Auth::logout();
        return redirect('/?auth=logout');
    }

}

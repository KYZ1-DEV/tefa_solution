<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UserAkses;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // Get index
    public function index(){
        return view("pointakses.admin.index");
    }


    // Get Profile
    public function profile(){
        return view(view: "admin.profile.index");
    }

    // Action
    public function editProfile(){
        return view("sdasd");
    }



    // Get Profile
    public function password(){
        return view("admin.profile.password");
    }



    // Action
    public function editPassword(){
        return view("sdasd");
    }


    // Get User
    public function user(){

        $users = User::all();
        return view('admin.kelola_user.index',compact('users'));


    }

    public function tambahUser(){
        return view("admin.kelola_user.tambah");
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view("admin.kelola_user.edit",compact('user'));
    }



    // Action User
    public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->route('user')->with('success', 'User berhasil dihapus');
    }

    public function createUser(Request $request){

         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6', // Include password validation
            'role' => 'required',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => $request->role,
        ]);

        // Redirect back to the user index with success message
        return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
        return view("admin.kelola_user.tambah");

    }


    public function updateUser(Request $request){

    $user = User::findOrFail($request->id);

    $user->name = $request->name;
    $user->email = $request->email;
    if (isset($request->password)) {
        $user->password = bcrypt($request->password);
    }

    $user->role = $request->role;
    // Save the updated data
    $user->save();

    return redirect()->route('user')->with('success', 'User berhasil diupdate');

    }



    // Get Sekolah
    public function dataSekolah(){
        return view("admin.data_sekolah.index");
    }

    public function tambahDataSekolah(){
        return view("");
    }
    public function editDataSekolah(){
        return view("");
    }


    // Action Sekolah
    public function createSekolah(){
        return view("");
    }

    public function updateSekolah(){
        return view("");
    }

    public function deleteSekolah(){
        return view("");
    }



    // Get Industri
    public function dataIndustri(){
        return view("admin.data_industri.index");
    }
    public function tambahDataIndustri(){
        return view("");
    }
    public function editDataIndustri(){
        return view("");
    }

    // Action Industri
    public function createIndustri(){
        return view("");
    }

    public function updateIndustri(){
        return view("");
    }

    public function deleteIndustri(){
        return view("");
    }


    // Get Mitra
    public function dataMitra(){
        return view("admin.data_mitra.index");
    }
    public function tambahDataMitra(){
        return view("");
    }
    public function editDataMitra(){
        return view("");
    }


    // Action Mitra
    public function createMitra(){
        return view("");
    }

    public function updateMitra(){
        return view("");
    }

    public function deleteMitra(){
        return view("");
    }


}

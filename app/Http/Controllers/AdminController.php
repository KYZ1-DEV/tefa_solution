<?php

namespace App\Http\Controllers;

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
        return view("admin.kelola_user.index");
    }

    public function tambahUser(){
        return view("admin.kelola_user.tambah");
    }

    public function editUser(){
        return view("admin.kelola_user.edit");
    }



    // Action User
    public function deleteUser(){
        return view("sdasd");
    }

    public function createUser(){
        return view("sdasd");
    }

    public function updateUser(){
        return view("sdasd");
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

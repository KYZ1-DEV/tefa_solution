<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index(){
        return view("pointakses.sekolah.index");
    }
    
    // Get Profile
    public function profile(){
        return view(view: "sekolah.profile.index");
    }

    // Action
    public function editProfile(){
        return view("sdasd");
    }
    
    // Get Profile
    public function password(){
        return view("sekolah.profile.password");
    }

    // Action
    public function editPassword(){
        return view("sdasd");
    }

    
        // Get Monitoring Bantuan
            public function monitoringBantuan(){
                return view("sekolah.monitoring_bantuan.index");
            }

            public function progress0Persen(){
                return view("sekolah.laporan.progress0Persen");
            }
            public function progress50Persen(){
                return view("sekolah.laporan.progress50Persen");
            }
            public function progress100Persen(){
                return view("sekolah.laporan.progress100Persen");
            }
}

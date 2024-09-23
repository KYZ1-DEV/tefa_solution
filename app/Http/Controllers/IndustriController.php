<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndustriController extends Controller
{
    public function index(){
        return view("pointakses.industri.index");
    }

    
    // Get Profile
    public function profile(){
        return view(view: "industri.profile.index");
    }

    // Action
    public function editProfile(){
        return view("sdasd");
    }
    
    // Get Profile
    public function password(){
        return view("industri.profile.password");
    }

    // Action
    public function editPassword(){
        return view("sdasd");
    }

    
        // Get Monitoring Bantuan
            public function monitoringBantuan(){
                return view("industri.monitoring_bantuan.index");
            }

            public function listSekolah(){
                return view("industri.list_sekolah.index");
            }

            public function laporan(){
                return view("industri.laporan.index");
            }

            


    
}

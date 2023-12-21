<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pass;
use App\Models\User;
use App\Models\Time;
use App\Models\Dependence;

class ChartController extends Controller
{
    public function useChart1(){
        
        return view('dashboard');
        
    }

}

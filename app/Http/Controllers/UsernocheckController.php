<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsernocheckController extends Controller
{
    public function index() {
        return view('usernocheck.index', [
            'passes' => auth()
                        ->user()
                        ->passes()
                        ->where('estado',0)
                        ->paginate(5),
        ]);
    }
}

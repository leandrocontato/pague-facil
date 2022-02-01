<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('dashboard.home.index', [
            'bodyClass' => 'home'
        ]);
    }
}

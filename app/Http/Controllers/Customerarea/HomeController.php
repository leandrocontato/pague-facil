<?php

namespace App\Http\Controllers\Customerarea;

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
        return view('customerarea.home.index', [
            'bodyClass' => 'home'
        ]);
    }
}

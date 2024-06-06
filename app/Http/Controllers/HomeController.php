<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function data_loker() {
        $data_loker = Loker::all();
        return view('admin.data_loker', compact('data_loker'));
    }
    public function data_pelamar() {
        return view('admin.data_pelamar');
    }
}

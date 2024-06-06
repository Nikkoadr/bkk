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

public function edit_loker($id){
    $data = Loker::find($id);
    return view('admin.edit_loker', compact('data'));
}

public function update_loker(Request $request, $id)
{
    $request->validate([
        'nama_loker' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'status_loker' => 'required|string|max:255',
        'grup_wa' => 'required|string',
    ]);

    $loker = Loker::findOrFail($id);
    $loker->update($request->only(['nama_loker', 'deskripsi', 'status_loker', 'grup_wa']));

    return redirect()->route('data_loker')->with('success', 'Loker updated successfully');
}

    public function data_pelamar() {
        return view('admin.data_pelamar');
    }
}

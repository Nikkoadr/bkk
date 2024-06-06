<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;

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

    public function tambah_loker(Request $request)
    {
        $request->validate([
            'nama_loker' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status_loker' => 'required|string|max:255',
            'grup_wa' => 'required|string',
        ]);

        Loker::create($request->all());

        return redirect()->back()->with('success', 'Loker has been added successfully');
    }

    public function edit_loker($id){
        $data = Loker::find($id);
        return view('admin.edit_loker', compact('data'));
    }

    public function update_loker(Request $request, $id)
    {
        $request->validate([
            'nama_loker' => 'required|string|max:255',
            'deskripsi' => 'required|string|',
            'status_loker' => 'required|string|max:255',
            'grup_wa' => 'required|string',
        ]);

        $loker = Loker::findOrFail($id);
        $loker->update($request->only(['nama_loker', 'deskripsi', 'status_loker', 'grup_wa']));

        return redirect()->route('data_loker')->with('success', 'Loker updated successfully');
    }

    public function hapus_loker($id)
    {
        $loker = Loker::findOrFail($id);
        Pendaftaran::where('id_loker', $id)->delete();
        $loker->delete();
        return redirect()->back()->with('success', 'Loker has been deleted successfully');
    }

    public function data_pelamar() {
        return view('admin.data_pelamar');
    }
}

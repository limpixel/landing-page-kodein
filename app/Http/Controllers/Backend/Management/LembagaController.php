<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $lembaga = Lembaga::get();
        return view('backend.management.lembaga.index', compact('lembaga'));
    }

    public function create(){
        $lembaga = Lembaga::get();
        return view('backend.management.lembaga.create', compact('lembaga'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama_lembaga'              => 'required',
            'alamat_lembaga'              => 'required',
            'kode_pos'              => 'required',
        ]);
        
        Lembaga::create([
            'nama_lembaga'   => $request->nama_lembaga,
            'alamat_lembaga'   => $request->alamat_lembaga,
            'kode_pos'   => $request->kode_pos,
        ]);
            // return $request;
        return redirect()->route('backend.lembaga')->with('success', 'Item Created Successfully');
    }

    public function edit($id){
        $lembaga = Lembaga::find($id);
    
        if ($lembaga) {
            return view('backend.management.lembaga.edit', compact('lembaga'));
        } else {
            return redirect()->route('backend.lembaga')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'nama_lembaga'              => 'required',
            'alamat_lembaga'              => 'required',
            'kode_pos'              => 'required',
        ]);

        Lembaga::where('id', $request->id)
            ->update(([
                'nama_lembaga'   => $request->nama_lembaga,
                'alamat_lembaga'   => $request->alamat_lembaga,
                'kode_pos'   => $request->kode_pos,
            ]));

        return redirect()->route('backend.lembaga')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $lembaga = Lembaga::find($id);

        $lembaga->delete();

        return redirect()->route('backend.lembaga')->with('success', 'Item Deleted Successfully');
    }
}

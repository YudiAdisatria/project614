<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('search')){
            $mahasiswa = Mahasiswa::where('nim', 'like', '%'. request('search') . '%')
                ->orWhere('nama', 'like', '%'. request('search') . '%')
                ->paginate(15);
            
            return view('nilai.index', [
                'mahasiswa' => $mahasiswa
            ]);
        }

        $mahasiswa = Mahasiswa::paginate(15);
        $nilai = DB::table('mahasiswas')
                ->join('nilais', 'mahasiswas.nim', '=', 'nilais.nim')
                ->join('matkuls', 'nilais.kode_matkul', '=', 'matkuls.kode_matkul')
                ->select('mahasiswas.*', 'nilais.nilai', 'matkuls.kode_matkul')
                ->groupBy('mahasiswas.nim')
                ->get();

        return view('nilai.index', [
            'mahasiswa' => $mahasiswa,
            'nilai' => $nilai
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::get();
        $matkul = Matkul::get();

        return view('nilai.create',[
            'mahasiswa' => $mahasiswa,
            'matkul' => $matkul
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $value) {
            Nilai::create($value);
        }

        return redirect()->route('matkul.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        $mahasiswa = Mahasiswa::get();
        $matkul = Matkul::get();

        return view('nilai.edit',[
            'nilai' => $nilai,
            'mahasiswa' => $mahasiswa,
            'matkul' => $matkul
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        $data = $request->all();
        
        $nilai->update($data);

        return redirect()->route('nilai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index');
    }
}

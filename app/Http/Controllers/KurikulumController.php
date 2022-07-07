<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\Kurikulum;
use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('search')){
            $kurikulum = Kurikulum::where('kode_kurikulum', 'like', '%'. request('search') . '%')
                ->orWhere('nama_kurikulum', 'like', '%'. request('search') . '%')
                ->paginate(15);
            
            return view('kurikulum.index', [
                'kurikulum' => $kurikulum
            ]);
        }

        $kurikulum = Kurikulum::paginate(15);
        return view('kurikulum.index', [
            'kurikulum' => $kurikulum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kurikulum.create');
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
        
        Kurikulum::create($data);

        return redirect()->route('kurikulum.index');
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
    public function edit(Kurikulum $kurikulum)
    {
        return view('kurikulum.edit', [
            'kurikulum' => $kurikulum
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $data = $request->all();
        
        $kurikulum->update($data);

        return redirect()->route('kurikulum.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();

        return redirect()->route('kurikulum.index');
    }

    public function mataKuliah(Kurikulum $kurikulum)
    {
        $matkul = Matkul::with(['kompetensi'])
                ->where('kode_kurikulum', $kurikulum->kode_kurikulum)
                ->orderBy('kode_matkul')->get();
        $kompetensi = Kompetensi::get();
        
        return view('kurikulum.mataKuliah', [
            'kurikulum' => $kurikulum,
            'matkul' => $matkul,
            'kompetensi' => $kompetensi
        ]);
    }
}

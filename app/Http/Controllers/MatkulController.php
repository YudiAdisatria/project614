<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\Kurikulum;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Http\Requests\MatkulRequest;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('search')){
            $matkul = Matkul::where('kode_matkul', 'like', '%'. request('search') . '%')
                ->orWhere('nama_matkul', 'like', '%'. request('search') . '%')
                ->paginate(15);
            $kurikulum = Kurikulum::get();
            return view('matkul.index', [
                'matkul' => $matkul,
                'kurikulum' => $kurikulum
            ]);
        }

        $matkul = Matkul::with(['kompetensi'])->paginate(15);
        $kurikulum = Kurikulum::get();
        return view('matkul.index', [
            'matkul' => $matkul,
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
        $kompetensi = Kompetensi::get();
        $kurikulum = Kurikulum::get();

        return view('matkul.create',[
            'kompetensi' => $kompetensi,
            'kurikulum' => $kurikulum
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatkulRequest $request)
    {
        $data = $request->all();

        Matkul::create($data);

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
    public function edit(Matkul $matkul)
    {   
        $kompetensi = Kompetensi::get();
        $kompmatkul = Kompetensi::where('id', $matkul->id_kompetensi)->get();
        $kurikulum = Kurikulum::get();

        return view('matkul.edit', [
            'matkul' => $matkul,
            'kompetensi' => $kompetensi,
            'kompmatkul' => $kompmatkul[0],
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
    public function update(Request $request, Matkul $matkul)
    {
        $data = $request->all();
        
        $matkul->update($data);

        return redirect()->route('matkul.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matkul $matkul)
    {
        $matkul->delete();

        return redirect()->route('matkul.index');
    }

    public function matkulUpdate(Request $request)
    {
        $data = $request->all();
    
        for($i = 0; $i < count($data['kode_matkul']); $i++){
            Matkul::updateOrCreate(
                ['kode_kurikulum' => $data['kode_kurikulum'], 'kode_matkul' => $data['kode_matkul'][$i]],
                ['nama_matkul' => $data['nama_matkul'][$i], 'sks' => $data['sks'][$i], 'id_kompetensi' => $data['id_kompetensi'][$i]]
            );
        }

        return redirect()->route('kurikulum.index');
    }
}

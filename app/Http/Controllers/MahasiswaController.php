<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurikulum = Kurikulum::get();
        if(request('search')){
            $mahasiswa = Mahasiswa::where('nim', 'like', '%'. request('search') . '%')
                ->orWhere('nama', 'like', '%'. request('search') . '%')
                ->orWhere('ttl', 'like', '%'. request('search') . '%')
                ->orWhere('nirl', 'like', '%'. request('search') . '%')
                ->orWhere('tahun_masuk', 'like', '%'. request('search') . '%')
                ->orWhere('tanggal_lulus', 'like', '%'. request('search') . '%')
                ->paginate(15);

            if(request('kurikul')){
                $kurikul = request('kurikul');

                return view('mahasiswa.index', [
                    'mahasiswa' => $mahasiswa,
                    'kurikulum' => $kurikulum,
                    'kurikul' => $kurikul
                ]);
            }
            return view('mahasiswa.index', [
                'mahasiswa' => $mahasiswa,
                'kurikulum' => $kurikulum
            ]);
        }

        $mahasiswa = Mahasiswa::paginate(15);

        if(request('kurikul')){
            $kurikul = request('kurikul');

            return view('mahasiswa.index', [
                'mahasiswa' => $mahasiswa,
                'kurikulum' => $kurikulum,
                'kurikul' => $kurikul
            ]);
        }

        return view('mahasiswa.index', [
            'mahasiswa' => $mahasiswa,
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
        return view('mahasiswa.create');
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
        $data['ttl'] = $data['tempat']. ', '.$data['tanggal'];
        unset($data['tempat']);
        unset($data['tanggal']);

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa.index');
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
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->all();

        $data['ttl'] = $data['tempat']. ', '.$data['tanggal'];
        unset($data['tempat']);
        unset($data['tanggal']);
        return $data['ttl'];

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index');
    }

    public function import(Request $request){
        $file = $request->file('importMahasiswa');
        
        Excel::import(new MahasiswaImport, $file);

        return redirect()->route('mahasiswa.index');
    }
}

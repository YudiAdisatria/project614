<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('search')){
            $kompetensi = Kompetensi::where('profil', 'like', '%'. request('search') . '%')
                ->orWhere('deskripsi', 'like', '%'. request('search') . '%')
                ->paginate(15);
            
            return view('kompetensi.index', [
                'kompetensi' => $kompetensi
            ]);
        }

        $kompetensi = Kompetensi::paginate(15);
        return view('kompetensi.index', [
            'kompetensi' => $kompetensi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kompetensi.create');
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
        
        Kompetensi::create($data);

        return redirect()->route('kompetensi.index');
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
    public function edit(Kompetensi $kompetensi)
    {
        return view('kompetensi.edit', [
            'kompetensi' => $kompetensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kompetensi $kompetensi)
    {
        $data = $request->all();
        
        $kompetensi->update($data);

        return redirect()->route('kompetensi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kompetensi $kompetensi)
    {
        $kompetensi->delete();

        return redirect()->route('kompetensi.index');
    }
}

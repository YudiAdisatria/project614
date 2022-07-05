<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NilaiController;

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
            $nilai = DB::table('mahasiswas')
                ->rightJoin('nilais', 'mahasiswas.nim', '=', 'nilais.nim')
                ->join('matkuls', 'nilais.kode_matkul', '=', 'matkuls.kode_matkul')
                ->select('mahasiswas.id','mahasiswas.nama','mahasiswas.nim', DB::raw('sum(nilais.nilai*matkuls.sks)/sum(matkuls.sks) AS ipk'))
                ->groupBy('mahasiswas.id','mahasiswas.nama','mahasiswas.nim')
                ->where('mahasiswas.nim', 'like', '%'. request('search') . '%')
                ->orWhere('mahasiswas.nama', 'like', '%'. request('search') . '%')
                ->paginate(15);
            
            return view('nilai.index', [
                'nilai' => $nilai
            ]);
        }

        $nilai = DB::table('mahasiswas')
                ->rightJoin('nilais', 'mahasiswas.nim', '=', 'nilais.nim')
                ->join('matkuls', 'nilais.kode_matkul', '=', 'matkuls.kode_matkul')
                ->select('mahasiswas.id','mahasiswas.nama','mahasiswas.nim', DB::raw('sum(nilais.nilai*matkuls.sks)/sum(matkuls.sks) AS ipk'))
                ->groupBy('mahasiswas.id','mahasiswas.nama','mahasiswas.nim')
                ->paginate(15);
        
        return view('nilai.index', [
            'nilai' => $nilai
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mahasiswa = Mahasiswa::where('nim', $request['nim'])->get();
        $nilai = Nilai::where('nim', $request['nim'])->get();

        if(count($nilai) === 0){
            for($i = 0; $i < count($nilai); $i++){
                $nilai[$i]['nilai'] = NilaiController::dekonversi($nilai[$i]['nilai']);
            }
            $matkul = Matkul::get();
    
            return view('nilai.create',[
                'mahasiswa' => $mahasiswa[0],
                'matkul' => $matkul,
                'nilai' => $nilai
            ]);
        }
        return redirect()->route('mahasiswa.index')->with('message', 'Nilai sudah ada!');;
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
        //return $data['nilai'][0];
        // return $data;

        for($i = 0; $i < count($data['kode_matkul']); $i++){
            if(is_null($data['nilai'][$i])){
                continue;
            }
            $data['nilai'][$i] = NilaiController::konversi($data['nilai'][$i]);
            //return $data['nilai'][$i];
            // https://laravel.com/docs/8.x/eloquent#upserts
            Nilai::updateOrCreate(
                ['nim' => $data['nim'], 'kode_matkul' => $data['kode_matkul'][$i]],
                ['nilai' => $data['nilai'][$i]]
            );
        }

        return redirect()->route('nilai.index');
    }

    public function konversi($nilai){
        switch ($nilai){
            case "A":
                $nilai = 4;
                return $nilai;
            case "AB":
                $nilai = 3.5;
                return $nilai;
            case "B":
                $nilai = 3;
                return $nilai;
            case "BC":
                $nilai = 2.5;
                return $nilai;
            case "C":
                $nilai = 2;
                return $nilai;
            case "CD":
                $nilai = 1.5;
                return $nilai;
            case "D":
                $nilai = 1;
                return $nilai;
            case "E":
                $nilai = 0;
                return $nilai;
            case "null":
                $nilai = NULL;
                return $nilai;
        }
    }

    public function dekonversi($nilai){
        switch ($nilai){
            case "4":
                $nilai = "A";
                return $nilai;
            case "3.5":
                $nilai = "AB";
                return $nilai;
            case "3":
                $nilai = "B";
                return $nilai;
            case "2.5":
                $nilai = "BC";
                return $nilai;
            case "2":
                $nilai = "C";
                return $nilai;
            case "1.5":
                $nilai = "CD";
                return $nilai;
            case "1":
                $nilai = "D";
                return $nilai;
            case "0":
                $nilai = "E";
                return $nilai;
            case "null":
                $nilai = NULL;
                return $nilai;
        }
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
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        $nilai = Nilai::where('nim', $nilai->nim);
        $nilai->delete();

        return redirect()->route('nilai.index');
    }
}

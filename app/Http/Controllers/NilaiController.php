<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\Kurikulum;
use App\Models\Mahasiswa;
use App\Imports\NilaiImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
        $kurikulum = Kurikulum::get();

        if(request('search')){
            $nilai = DB::table('mahasiswas')
                ->rightJoin('nilais', 'mahasiswas.nim', '=', 'nilais.nim')
                ->join('matkuls', 'nilais.kode_matkul', '=', 'matkuls.kode_matkul')
                ->select('mahasiswas.id','mahasiswas.nama','mahasiswas.nim', DB::raw('sum(nilais.nilai*matkuls.sks)/sum(matkuls.sks) AS ipk'))
                ->groupBy('mahasiswas.nama','mahasiswas.nim')
                ->where('mahasiswas.nim', 'like', '%'. request('search') . '%')
                ->orWhere('mahasiswas.nama', 'like', '%'. request('search') . '%')
                ->paginate(20);
            
            return view('nilai.index', [
                'nilai' => $nilai,
                'kurikulum' => $kurikulum
            ]);
        }

        $nilai = DB::table('mahasiswas')
                ->join('nilais', 'mahasiswas.nim', '=', 'nilais.nim')
                ->join('matkuls', 'nilais.kode_matkul', '=', 'matkuls.kode_matkul')
                ->select('mahasiswas.nama','nilais.nim', DB::raw('sum(nilais.nilai*matkuls.sks)/sum(matkuls.sks) AS ipk'))
                ->groupBy('nilais.nim', 'mahasiswas.nama')
                ->paginate(20);
        
        return view('nilai.index', [
            'nilai' => $nilai,
            'kurikulum' => $kurikulum
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
            $matkul = Matkul::groupBy('kode_matkul')->orderBy('kode_matkul')->get();
    
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
    public function destroy($nim)
    {
        return $nim;
        $nilai = Nilai::where('nim', $nim);
        $nilai->delete();

        return redirect()->route('nilai.index');
    }

    public function import(Request $request){
        $file = $request->file('importNilai');
        
        Excel::import(new NilaiImport, $file);

        return redirect()->route('nilai.index');
    }

    public function nilaiKompetensi(Request $request){
        $kurikulum = $request->kurikulum;
        $nim = $request->nim;
        $report = [];
        for($i = 0; $i < count($nim); $i++){
            $nilai = DB::table('mahasiswas')
                ->join('nilais', 'mahasiswas.nim', '=', 'nilais.nim')
                ->join('matkuls', 'nilais.kode_matkul', '=', 'matkuls.kode_matkul')
                ->join('kompetensis', 'matkuls.id_kompetensi', '=', 'kompetensis.id')
                ->select('kompetensis.profil', 'kompetensis.deskripsi', 'nilais.nim', DB::raw('sum(nilais.nilai * matkuls.sks)/sum(matkuls.sks) AS presentase'))
                ->where('mahasiswas.nim', '=', $nim[$i])
                ->where('matkuls.kode_kurikulum', '=', $kurikulum)
                ->groupBy('nilais.nim', 'mahasiswas.nama', 'kompetensis.profil', 'kompetensis.deskripsi')
                ->get();

            $mahasiswa = Mahasiswa::where("nim", "=", $nim[$i])->get();

            $report[$i]['kompetensi'] = clone $nilai;
            $report[$i]['mahasiswa'] = clone $mahasiswa[0];
        }
        $admin = User::whereIn("jabatan", ["dekan", "Dekan", "DEKAN"])->get();
        // return $report[1]['kompetensi'][0];

        /* $pdf = PDF::loadView('nilai.report', [
            'admin' => $admin[0],
            'kurikulum' => $kurikulum,
            'report' => $report
        ]);
        // return public_path('\css\app.css');
        return $pdf->download('itsolutionstuff.pdf'); */

        return view('nilai.report', [
            'admin' => $admin[0],
            'kurikulum' => $kurikulum,
            'report' => $report
        ]);
        return redirect()->route('nilai.index');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matkul;
use App\Models\Kurikulum;
use App\Models\Mahasiswa;
use App\Models\Kompetensi;
use App\Models\Kurimatkul;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'Andy',
            'username' => 'andy123',
            'roles' => 'SUPER_ADMIN',
            'jabatan' => 'Dekan',
            'password' => Hash::make('qwerty123')
        ]);
        Mahasiswa::create([
            'nim' => '19.E1.0001',
            'nama' => 'Bernadine Charlie Danny',
            'ttl' => 'Kota Bogor, 1990-12-07',
            'nirl' => '16.40.2.082',
            'tahun_masuk' => '2012',
            'tanggal_lulus' => '2016-08-18'
        ]);
        Mahasiswa::create([
            'nim' => '20.E1.0001',
            'nama' => 'Densy Elia',
            'ttl' => 'Semarang, 1990-06-01',
            'nirl' => '20.50.2.082',
            'tahun_masuk' => '2014',
            'tanggal_lulus' => '2017-06-13'
        ]);


        Kompetensi::create([
            'profil' => 'Konselor',
            'deskripsi' => 'Kompeten mendapingi pasien, menangani stress, menangani problematika seksualitas, mendampingi anak berkebutuhan khusus'
        ]);
        Kompetensi::create([
            'profil' => 'Asisten Psikolog',
            'deskripsi' => 'Kompeten membantu psikolog dalam menangani pemulihan trauma, melakukan deteksi dini, administrasi pengukuran psikologis dan asesmen'
        ]);


        Kurikulum::create([
            'kode_kurikulum' => '2020',
            'nama_kurikulum' => 'Kurikulum 2020'
        ]);
        Kurikulum::create([
            'kode_kurikulum' => '2021',
            'nama_kurikulum' => 'Kurikulum 2021'
        ]);
        Kurikulum::create([
            'kode_kurikulum' => '2022',
            'nama_kurikulum' => 'Kurikulum 2022'
        ]);
        

        Matkul::create([
            'kode_matkul' => 'PSM104',
            'nama_matkul' => 'Teori Belajar',
            'sks' => 2,
            'id_kompetensi' => '1',
            'kode_kurikulum' => '2020'
        ]);
        Matkul::create([
            'kode_matkul' => 'PSM106',
            'nama_matkul' => 'Psikologi Pendidikan',
            'sks' => 3,
            'id_kompetensi' => '1',
            'kode_kurikulum' => '2020'
        ]);
        Matkul::create([
            'kode_matkul' => 'PSM108',
            'nama_matkul' => 'Statistik',
            'sks' => 3,
            'id_kompetensi' => '2',
            'kode_kurikulum' => '2021'
        ]);


        Nilai::create([
            'nim' => '19.E1.0001',
            'kode_matkul' => 'PSM104',
            'nilai' => 2.5
        ]);
        Nilai::create([
            'nim' => '19.E1.0001',
            'kode_matkul' => 'PSM106',
            'nilai' => 4
        ]);
        Nilai::create([
            'nim' => '19.E1.0001',
            'kode_matkul' => 'PSM108',
            'nilai' => 3.5
        ]);

        Nilai::create([
            'nim' => '20.E1.0001',
            'kode_matkul' => 'PSM104',
            'nilai' => 1
        ]);
        Nilai::create([
            'nim' => '20.E1.0001',
            'kode_matkul' => 'PSM106',
            'nilai' => 2
        ]);
        Nilai::create([
            'nim' => '20.E1.0001',
            'kode_matkul' => 'PSM108',
            'nilai' => 3
        ]);

        Kurimatkul::create([
            'kode_kurikulum' => '2020',
            'kode_matkul' => 'PSM104'
        ]);
        Kurimatkul::create([
            'kode_kurikulum' => '2020',
            'kode_matkul' => 'PSM106'
        ]);
        Kurimatkul::create([
            'kode_kurikulum' => '2020',
            'kode_matkul' => 'PSM108'
        ]);

        Kurimatkul::create([
            'kode_kurikulum' => '2021',
            'kode_matkul' => 'PSM104'
        ]);
        Kurimatkul::create([
            'kode_kurikulum' => '2021',
            'kode_matkul' => 'PSM106'
        ]);

        // Kompetensi import;
        Kompetensi::truncate();
  
        $csvFile = fopen(base_path("db_event\kompetensi.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Kompetensi::create([
                    "profil" => $data['0'],
                    "deskripsi" => $data['1']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);

        // Matkul import;
        Matkul::truncate();
  
        $csvFile = fopen(base_path("db_event\matkul.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Matkul::create([
                    "kode_matkul" => $data['0'],
                    "nama_matkul" => $data['1'],
                    "sks" => $data['2'],
                    "id_kompetensi" => $data['3'],
                    "kode_kurikulum" => $data['4']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);

        // Matkul import;
        $csvFile = fopen(base_path("db_event\TALUMNI.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Mahasiswa::create([
                    "nim" => $data['0'],
                    "nama" => $data['6'],
                    "ttl" => $data['5']. ", ". $data['3'],
                    "nirl" => $data['4'],
                    "tahun_masuk" => $data['2'],
                    "tanggal_lulus" => $data['6']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}

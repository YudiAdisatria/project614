<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!!__('Nilai Mahasiswa &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!--Error-->
                @if($errors->any())
                <div class="mb-5" role="alert">
                    <div class="bg-red-500 text-white font-bold rounded">
                        There's Something Wrong
                    </div>
                    <div class="border border-t-0 border-red-400 rounded bg-red-100 px-4 py-3 text-red-700">
                        <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
                @endif
                <!--Error-->
                
                <form action="{{ route('nilai.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap"> 
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                NIM
                            </label>
                            <input value="{{ old('nim') ?? $mahasiswa->nim }}" name="nim" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="NIM" disabled>
                            <input value="{{ old('nim') ?? $mahasiswa->nim }}" name="nim" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="hidden" placeholder="NIM">
                        
                        </div>

                        <div class="w-full px-3 mt-2 self-end lg:w-1/2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Nama
                            </label>
                            <input value="{{ old('nama') ?? $mahasiswa->nama }}" name="nama" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nama User" disabled>
                            <input value="{{ old('nama') ?? $mahasiswa->nama }}" name="nama" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="hidden" placeholder="Nama User">
                        </div>       
                    </div>

                    @forelse ($matkul as $item)
                    <div class="flex flex-wrap">
                        <div class="w-full self-center mt-2 px-3 lg:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Kode Mata Kuliah
                            </label>
                            <input value="{{ old('kode_matkul') ?? $item->kode_matkul  }}" name="kode_matkul[]" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 id="grid-last-name" type="text" disabled>
                            <input value="{{ old('kode_matkul') ?? $item->kode_matkul  }}" name="kode_matkul[]" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 id="grid-last-name" type="hidden">
                        </div>
                        
                        <div class="w-full self-center mt-2 px-3 lg:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Mata Kuliah
                            </label>
                            <input value="{{ old('nama_matkul') ?? $item->nama_matkul  }}" name="nama_matkul[]" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 id="grid-last-name" type="text" disabled>
                            <input value="{{ old('nama_matkul') ?? $item->nama_matkul  }}" name="nama_matkul[]" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 id="grid-last-name" type="hidden">
                        </div>
    
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Nilai
                            </label>
                            <select name="nilai[]" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                @forelse ($nilai as $nil)
                                    @if ($nil->kode_matkul ==  $item->kode_matkul)
                                        <option value="{{ $nil->nilai }}">{{ $nil->nilai }}</option>
                                    @endif
                                @empty
                                
                                @endforelse
                                <option value="">Pilih Nilai</option>
                                <option value="A">A</option>
                                <option value="AB">AB</option>
                                <option value="B">B</option>
                                <option value="BC">BC</option>
                                <option value="C">C</option>
                                <option value="CD">CD</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>   
                    </div>
                    @empty
                        
                    @endforelse

                    <div class="flex flex-wrap mt-10 ">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Nilai
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

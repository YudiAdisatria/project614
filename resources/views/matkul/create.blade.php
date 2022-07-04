<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!!__('Mata Kuliah &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
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
                <form action="{{ route('matkul.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap">
                            <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Kode Mata Kuliah
                                </label>
                                <input value="{{ old('kode_matkul') }}" name="kode_matkul" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Kode Mata Kuliah" required>
                            </div>
                        
                            <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Nama Mata Kuliah
                                </label>
                                <input value="{{ old('nama_matkul') }}" name="nama_matkul" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nama Mata Kuliah" required>
                            </div>
                    </div>

                    <div class="flex flex-wrap mt-10">
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    SKS Mata Kuliah
                            </label>
                            <input value="{{ old('sks') }}" name="sks" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="numeric" placeholder="SKS">
                        </div>
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Kompetensi
                            </label>
                            <select name="id_kompetensi" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                @forelse ( $kompetensi as $komp)
                                    <option value="{{ $komp->id }}">{{ $komp->profil }}</option>
                                @empty
                                    
                                @endforelse    
                            </select>
                        </div>
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Kurikulum
                            </label>
                            <select name="kode_kurikulum" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                @forelse ( $kurikulum as $kur)
                                    <option value="{{ $kur->kode_kurikulum }}">{{ $kur->nama_kurikulum }}</option>
                                @empty
                                    
                                @endforelse    
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap mt-10">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Mata Kuliah
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

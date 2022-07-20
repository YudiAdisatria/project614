<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Mahasiswa') }}
        </h2>
    </x-slot>
    @if(session()->has('message'))
    <div class="flex items-center bg-red-500 text-black text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
        <p>{{ session()->get('message') }}</p>
    </div>
    @endif
    <section class="pt-8 pb-8 bg-gray-200">
        <div class="container relative">
            <div class="flex flex-wrap">
                <button class="bg-green-500 hover:bg-white text-white font-bold hover:text-green-500 py-1 px-3 border border-transparent hover:border-green-500 rounded mb-5" >
                    <a href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
                </button>
                <p class="py-1 px-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atau</p>
                <form method="POST" action="{{ route('mahasiswa.import') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="importMahasiswa" class="ml-10" required="required">    
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"> 
                        Import Mahasiswa
                    </button>
                </form>
            </div>
            
            <div class="flex flex-wrap">
                <div class="w-full self-center px-4 lg:w-1/2">
                    <h1 class="text-2xl font-bold mb-2 mr-3">List Mahasiswa</h1>
                </div>
                <div class="self-end px-2 lg:w-1/2">
                    <form action="{{ route('mahasiswa.index') }}" class="mb-3 flex">
                        <input type="text" placeholder="Search ..." name=search class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm mr-4">
                        <button type="submit" class="bg-black text-white py-1 px-3 border border-black hover:border-white rounded">
                            search
                        </button>
                    </form>
                </div>
            </div>

            <div>
                <select name="kurikul" id="kurikul" onchange="setKurikulum()"
                class="mx-4 mb-4"
                >
                    <?php $kurikul = "";?>
                    <option value="">Pilih Kurikulum</option>
                    @forelse ($kurikulum as $kuri)
                    <option value="{{ $kuri->kode_kurikulum }}">{{ $kuri->nama_kurikulum }}</option>
                    @empty
                    <option value="">Belum ada kurikulum</option> 
                    @endforelse
                </select>
            </div>
            

            <div class="overflow-auto rounded-lg shadow hidden md:block">
                <table class="w-full" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left"></th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">NIM</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Nama</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Tempat Tanggal Lahir</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">NIRL</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Tahun Masuk</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Tanggal Lulus</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mahasiswa as $item)
                        <tr class="odd:bg-white even:bg-slate-100">
                            <td class="p-3 text-sm text-blue-500 font-bold ">{{ $item->id }}</td>
                            <td class="text-center">{{ $item->nim }}</td>
                            <td class="p-3">{{ $item->nama }}</td>
                            <td>{{ $item->ttl }}</td>
                            <td class="text-center">{{ $item->nirl }}</td>
                            <td class="text-center">{{ $item->tahun_masuk }}</td>
                            <td class="text-center">{{ $item->tanggal_lulus }}</td>
                            <td class="text-sm">
                                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded mb-1">
                                    <a href="{{ route('mahasiswa.edit', $item->id) }}">Edit</a>
                                </button>

                                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded mb-1">
                                    <a href="{{ route('nilai.create', ['nim' => $item->nim, 'kurikulum' => $kurikul]) }}">Tambah Nilai</a>
                                </button>

                                @can('manage-user')
                                <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" class="inline-block">
                                    {!! method_field('delete') . csrf_field() !!} 
                                    <button type="submit" class="bg-transparent hover:bg-red-600 text-red-500 font-semibold hover:text-white py-1 px-5  border border-red-600 hover:border-transparent rounded">
                                        Delete
                                    </button>
                                </form>  
                                @endcan
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

                <!-- small -->
            @forelse ($mahasiswa as $item)
            <div class="bg-gray-200">
                <div class="grid grid-cols-1 gap-4 md:hidden">
                    <div class="bg-white p-4 rounded-lg shadow mb-5">
                        <div class= "flex justify-center space-x-2 text-sm">
                            <div class="p-3 text-sm text-blue-700 font-bold text-center ">{{ $item->id }}</div>
                            <div class=" font-semibold p-3 text-sm text-black text-center">{{ $item->nama }}</div>
                        </div>

                        <div class="flex justify-center items-center text-sm text-center">
                            <div class=" font-semibold p-3 text-sm text-black text-center">{{ $item->username }}</div>
                        </div>

                        <div class="flex justify-center items-center text-sm text-center">
                            <div class=" font-semibold p-3 text-sm text-black text-center">{{ $item->jabatan }}</div>
                            <div class=" font-semibold p-3 text-sm text-black text-center">{{ $item->roles }}</div>
                        </div>

                        <div class="flex items-center space-x-2 text-sm justify-center">
                            <div class="text-sm text-black">
                                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded mb-1"> 
                                    <a href="{{ route('mahasiswa.edit', $item->id) }}">
                                    Edit</button></a>

                                    @can('manage-user')
                                    <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!} 
                                        <button type="submit" class="bg-transparent hover:bg-red-600 text-red-500 font-semibold hover:text-white py-1 px-5  border border-red-600 hover:border-transparent rounded">
                                            Delete
                                        </button>
                                    </form>   
                                    @endcan               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            <!-- small stop -->
            <p class="pt-4"></p>
            {{ $mahasiswa->links() }}
        </div>
    </section>

    <script>
        function setKurikulum(){
            var kurikulum = document.getElementById('kurikul').value;
            $kurikul = kurikulum;
            console.log($kurikul);
        }
    </script>
</x-app-layout>
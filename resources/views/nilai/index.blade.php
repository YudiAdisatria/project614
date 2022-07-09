<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Nilai') }}
        </h2>
    </x-slot>

    <section class="pt-8 pb-8 bg-gray-200">
        <div class="container relative">
            <div class="flex flex-wrap">
                <div class="w-full self-center px-4 lg:w-1/2">
                    <h1 class="text-2xl font-bold mb-2 mr-3">List Nilai</h1>
                </div>
                <div class="self-end px-2 lg:w-1/2">
                    <form action="{{ route('nilai.index') }}" class="mb-3 flex">
                        <input type="text" placeholder="Search ..." name=search class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm mr-4">
                        <button type="submit" class="bg-black text-white py-1 px-3 border border-black hover:border-white rounded">
                            search
                        </button>
                    </form>
                </div>
            </div>

            <form method="POST" action="{{ route('nilai.import') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="importNilai" required="required">    
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded mb-1"> 
                    Import Nilai
                </button>
            </form>

            <form id="reportKompetensi" action="{{ route('nilai.nilaiKompetensi') }}" class="w-full" method="POST" enctype="multipart/form-data">
                @csrf
                <select name="kurikulum">
                    @forelse ($kurikulum as $kuri)
                    <option value="{{ $kuri->kode_kurikulum }}">{{ $kuri->nama_kurikulum }}</option>
                    @empty
                    <option value="">Belum ada kurikulum</option> 
                    @endforelse
                </select>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Buat Laporan
                </button>
            </form>

            <div class="overflow-auto rounded-lg shadow hidden md:block">
                <table class="w-full" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left"></th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">NIM</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Nama</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">IPK</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($nilai as $item)
                        <tr class="odd:bg-white even:bg-slate-100">
                            <td><input type="checkbox" form="reportKompetensi" name="nim[]" value="{{ $item->nim }}"></td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->ipk }}</td>
                            <td class="text-sm">

                                @can('manage-user')
                                <form action="{{ route('nilai.destroy', ['nilai' => $item->nim]) }}" method="POST" class="inline-block">
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

            <p class="pt-4"></p>
            {{ $nilai->links() }}
        </div>
    </section>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kurikulum &raquo; {!! $kurikulum->nama_kurikulum !!} &raquo; Edit
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
                <form action="{{ route('kurikulum.update', $kurikulum->id) }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap">                      
                            <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Kode Kurikulum
                                </label>
                                <input disabled value="{{ old('kode_kurikulum') ?? $kurikulum->kode_kurikulum }}" name="kode_kurikulum" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Kode Kurikulum">
                                <input value="{{ old('kode_kurikulum') ?? $kurikulum->kode_kurikulum }}" name="kode_kurikulum" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="hidden" placeholder="Kode Kurikulum">
                            </div>
                        
                        
                            <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Nama Kurikulum
                                </label>
                                <input value="{{ old('nama_kurikulum') ?? $kurikulum->nama_kurikulum }}" name="nama_kurikulum" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nama Kurikulum">
                            </div>
                    </div>

                    <div class="flex flex-wrap mt-10">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Keterangan
                            </label>
                            <input value="{{ old('keterangan') ?? $kurikulum->keterangan }}" name="keterangan" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Keterangan">
                        </div>
                    </div>

                    <div class="flex flex-wrap mt-10">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Kurikulum
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

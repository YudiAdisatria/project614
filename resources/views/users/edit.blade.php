<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {!! $item->nama !!} &raquo; Edit
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


                <form action="{{ route('users.update', $item->id) }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap">
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Username
                            </label>
                            <input value="{{ old('username') ?? $item->username }}" name="username" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Username" required>
                        </div>
                    
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Nama
                            </label>
                            <input value="{{ old('nama') ?? $item->nama }}" name="nama" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nama User">
                        </div>  
                    </div>

                    <div class="flex flex-wrap mt-2">      
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Jabatan
                            </label>
                            <input value="{{ old('jabatan') ?? $item->jabatan }}" name="jabatan" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 id="grid-last-name" type="text" placeholder="Jabatan">
                        
                        </div>
                                    
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Roles
                            </label>
                            <select name="roles" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                <option value="{{ $item->roles}}">{{ $item->roles }}</option>
                                <option value="USER">User</option>
                                <option value="ADMIN">Admin</option>
                            </select>
                        </div> 
                    </div>

                    @can('manage-user')
                    <div class="flex flex-wrap mt-2">
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs mb-2" for="grid-last-name">
                                Password dan Password Confirmation digunakan untuk reset password saja
                            </label>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Password
                            </label>
                            <input value="{{ old('password') }}" name="password" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password" placeholder="User Password">
                        </div>
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-200 text-xs mb-2" for="grid-last-name">
                                &nbsp;
                            </label>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Password Confirmation
                            </label>
                            <input value="{{ old('password_confirmation') }}" name="password_confirmation" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password" placeholder="User Password Confirmation">
                        </div>
                    </div>      
                    @endcan

                    <div class="flex flex-wrap mt-10">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Update User
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

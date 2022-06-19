<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!!__('User &raquo; Create') !!}
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
                
                <form action="{{ route('users.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap"> 
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Username
                            </label>
                            <input value="{{ old('username') }}" name="username" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Username">
                        
                        </div>
                        

                        <div class="w-full px-3 mt-2 self-end lg:w-1/2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Nama
                            </label>
                            <input value="{{ old('nama') }}" name="nama" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nama User">
                        </div>       
                    </div>

                    <div class="flex flex-wrap">
                        
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Jabatan
                            </label>
                            <input value="{{ old('jabatan') }}" name="jabatan" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 id="grid-last-name" type="text" placeholder="Jabatan">
                        </div>
                        

                        
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Roles
                            </label>
                            <select name="roles" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                <option value="ADMIN">Admin</option>
                                <option value="SUPER_ADMIN">Super Admin</option>
                            </select>
                        </div>   
                    </div>

                    <div  class="flex flex-wrap">
                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Password
                            </label>
                            <input value="{{ old('password') }}" name="password" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password" placeholder="User Password">
                        </div>

                        <div class="w-full  self-center mt-2 px-3 lg:w-1/2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Password Confirmation
                            </label>
                            <input value="{{ old('password_confirmation') }}" name="password_confirmation" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password" placeholder="User Password Confirmation">
                        </div>
                    </div>
                    

                    <div class="flex flex-wrap mt-2">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Image
                            </label>
                            <input name="profile_photo_path" class="appearance-none block w-full bg-white text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="foto-upload" type="file" placeholder="User Image">
                        </div>
                    </div>

                    <div class="flex flex-wrap mt-10 ">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save aset
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

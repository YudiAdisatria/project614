<x-app-layout>
    <div class="container my-10">
        <!-- 1 Card -->
        <div class="m-10 justify-center">
            <h2 class="font-bold text-blue-600 text-center text-3xl mb-4 sm:text-4xl lg:text-5xl">Template Format CSV</h2>
            <p class="font-medium text-center text-md text-dark md:text-lg">Download template untuk import mahasiswa dan nilai untuk mempermudah input data</p>
        </div>
        <div class="flex flex-wrap justify-center">
            <div class="w-full px-4 lg:w-1/2 xl:w-1/3">
                <div class="bg-blue-600 rounded-xl shadow-lg overflow-hidden mb-10">
                    <div class="py-8 px-6">
                        <h3 class="mb-3 font-bold text-xl text-white text-center">Template Import Mahasiswa</h3>
                        <p class="text-center"><a href="{{ asset('storage\Template Alumni.csv') }}" class="items-center font-bold text-sm text-dark bg-white py-2 px-4 rounded-lg hover:opacity-80 mr-50">Download di Sini</a></p>
                    </div>
                </div>
            </div>

            <div class="w-full px-4 lg:w-1/2 xl:w-1/3">
                <div class="bg-blue-600 rounded-xl shadow-lg overflow-hidden mb-10">
                    <div class="py-8 px-6">
                        <h3 class="mb-3 font-bold text-xl text-white text-center">Template Import Nilai</h3>
                        <p class="text-center"><a href="{{ asset('storage\Nilai Import Template.csv') }}" class="items-center font-bold text-sm text-dark bg-white py-2 px-4 rounded-lg hover:opacity-80 mr-50">Download di Sini</a></p>
                    </div>
                </div>
            </div>

            <div class="w-full px-4 lg:w-1/2 xl:w-1/3">
                <div class="bg-blue-600 rounded-xl shadow-lg overflow-hidden mb-10">
                    <div class="py-8 px-6">
                        <h3 class="mb-3 font-bold text-xl text-white text-center">Manual Book Website</h3>
                        <p class="text-center"><a href="{{ asset('storage') }}" class="items-center font-bold text-sm text-dark bg-white py-2 px-4 rounded-lg hover:opacity-80 mr-50">Download di Sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<div x-show="showImportModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm no-print">
    
    <div @click.away="showImportModal = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="p-8 text-center">
            
            <!-- ICON -->
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-[#00712D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <!-- TITLE -->
            <h3 class="text-xl font-black text-slate-800 mb-2 uppercase">
                Import Data Excel
            </h3>

            <p class="text-sm text-slate-500 mb-6 font-medium">
                Gunakan file Excel untuk mengisi banyak label sekaligus secara otomatis.
            </p>
            
            <!-- FILE INPUT -->
            <div class="space-y-4">
                
                <input 
                    type="file" 
                    @change="selectedFile = $event.target.files[0]"
                    class="hidden"
                    id="excelUpload">

                <label 
                    for="excelUpload"
                    class="inline-block bg-green-700 text-white px-6 py-3 rounded-xl cursor-pointer hover:bg-green-800 transition">
                    Choose File
                </label>

                <!-- NAMA FILE -->
                <div x-show="selectedFile" class="text-sm text-slate-600">
                    File: <span x-text="selectedFile?.name"></span>
                </div>

                <!-- BUTTON IMPORT -->
                <button 
                    @click="importExcel()"
                    :disabled="!selectedFile"
                    class="w-full bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
                    Import Data
                </button>
                
                <!-- DOWNLOAD TEMPLATE -->
                <button 
                    @click="downloadTemplate()" 
                    class="text-blue-600 text-sm font-semibold hover:underline">
                    Belum punya format? Download Contoh Excel
                </button>

                <!-- CANCEL -->
                <button 
                    @click="showImportModal = false" 
                    class="mt-2 px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition uppercase">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        /* Memaksa ukuran kertas A4 Landscape hanya saat editor ini aktif */
        @page { 
            size: A4 landscape !important; 
            margin: 0 !important; 
        }

        /* Reset tampilan body untuk print */
        html, body { 
            height: auto !important; 
            margin: 0 !important; 
            padding: 0 !important; 
            overflow: visible !important; 
            background: white !important;
        }

        /* Sembunyikan elemen dashboard yang tidak perlu */
        .no-print, aside, header, footer, [role="dialog"], .fixed { 
            display: none !important; 
        }

        /* Tampilkan container print */
        .print-only-container {
            display: block !important;
            position: static !important;
            width: 100% !important;
            background: white !important;
        }

        /* Pengaturan halaman per produk */
        .print-page {
            height: 210mm !important;
            width: 297mm !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            page-break-after: always !important;
            break-after: page !important;
            overflow: hidden;
            background: white !important;
        }

        .print-page:last-child { 
            page-break-after: avoid !important; 
            break-after: avoid !important; 
        }

        /* Style visual label saat diprint */
        .shelf-talker {
            box-shadow: none !important;
            border: none !important;
            background-image: url('/images/template-label.jpg') !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            /* Scale sedikit agar pas dengan margin printer umum */
            transform: scale(1.02);
        }

        * { 
            -webkit-print-color-adjust: exact !important; 
            print-color-adjust: exact !important; 
        }
    }
</style>

<div class="flex flex-col gap-6 h-full">
    <div class="glass-card p-4 rounded-2xl flex flex-wrap items-center justify-between gap-4 no-print">
        <div class="flex items-center gap-2">
            <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
                <svg class="w-5 h-5 text-[#00712D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <div>
                <h2 class="text-sm font-black text-slate-800 uppercase tracking-tighter leading-none">Editor FRESH KAYU</h2>
                <p class="text-[9px] font-bold text-green-600 uppercase tracking-[0.2em] mt-1">Sistem Visual Buah</p>
            </div>
            
            <div class="h-8 w-[1px] bg-slate-200 mx-2"></div>

            <button @click="showImportModal = true" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Import Excel
            </button>
            <button @click="addItem()" class="flex items-center gap-2 px-4 py-2 bg-[#00712D] text-white rounded-xl text-xs font-bold hover:bg-green-800 transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Item
            </button>
        </div>

        <div class="flex items-center gap-2">
            <button @click="saveToCloud()" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition shadow-md uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan ke Cloud
            </button>
            <button @click="printAll()" class="flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-xl text-xs font-bold hover:bg-amber-600 transition shadow-md uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v7h10z"/>
                </svg>
                Print Semua
            </button>
            <button @click="clearAll()" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition" title="Reset">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="glass-card rounded-3xl overflow-hidden border border-white shadow-xl flex-grow flex flex-col">
        <div class="overflow-x-auto overflow-y-auto max-h-[calc(100vh-280px)] custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 bg-slate-50 z-20 shadow-sm">
                    <tr>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b text-center">Member</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">Header / Promo</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">Produk / Deskripsi</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">Harga (Nor/Pro/Non)</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">Detail</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, index) in items" :key="index">
                        <tr class="hover:bg-green-50/30 transition-colors border-b border-slate-50">
                            <td class="p-4 text-center">
                                <input type="checkbox" x-model="item.isMember" :disabled="!item.isEditing" class="w-5 h-5 text-green-600 rounded-lg border-slate-300 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            </td>

                         <td class="p-4 min-w-[150px]">
  <select x-model="item.header" :key="item.header"

        class="w-full bg-white border border-slate-200 rounded-lg px-2 py-1.5 text-[10px] font-bold text-slate-700 focus:ring-2 focus:ring-green-500 transition-all uppercase disabled:bg-slate-100 disabled:text-slate-500 disabled:opacity-70 disabled:cursor-not-allowed" :disabled="!item.isEditing">

    <template x-for="preset in presets" :key="preset">
        <option :value="preset" x-text="preset"></option>
    </template>

</select>

</td>


                            <td class="p-4 min-w-[220px] space-y-1">
                                <label class="text-[8px] font-black text-slate-400 uppercase block ml-1">Nama Barang</label>
                                <input type="text" x-model="item.name" :disabled="!item.isEditing" placeholder="PRODUK" class="w-full bg-white/50 border border-slate-200 rounded-lg px-2 py-1 text-xs font-bold uppercase focus:ring-2 focus:ring-green-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                <label class="text-[8px] font-black text-slate-400 uppercase block ml-1">Varian / Berat</label>
                                <input type="text" x-model="item.sub" :disabled="!item.isEditing" placeholder="Deskripsi" class="w-full bg-white/50 border border-slate-200 rounded-lg px-2 py-1 text-[10px] focus:ring-2 focus:ring-green-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                            </td>

                            <td class="p-4 min-w-[180px] space-y-1">
                                <div class="flex gap-1 items-center">
                                    <span class="text-[9px] w-12 font-bold text-red-400">NORMAL</span>
                                    <input type="text" x-model="item.oldPrice" :disabled="!item.isEditing" class="w-full px-2 py-0.5 text-xs rounded border border-slate-200 focus:ring-1 focus:ring-red-500 transition-all font-bold disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                </div>
                                <div class="flex gap-1 items-center">
                                    <span class="text-[9px] w-12 font-bold uppercase" :class="item.isMember ? 'text-amber-600' : 'text-green-600'" x-text="item.isMember ? 'Member' : 'Promo'"></span>
                                    <input type="text" x-model="item.newPrice" :disabled="!item.isEditing" class="w-full px-2 py-0.5 text-xs rounded border border-green-200 bg-green-50 focus:ring-1 focus:ring-green-500 transition-all font-bold text-green-700 disabled:bg-slate-100 disabled:text-slate-500 disabled:border-slate-200 disabled:cursor-not-allowed">
                                </div>
                                <div x-show="item.isMember" class="flex gap-1 items-center" x-transition>
                                    <span class="text-[9px] w-12 font-bold text-amber-600 uppercase">Non Member</span>
                                    <input type="text" x-model="item.nonMemberPrice" :disabled="!item.isEditing" class="w-full px-2 py-0.5 text-xs rounded border border-amber-200 bg-amber-50 focus:ring-1 focus:ring-amber-500 transition-all font-bold text-amber-700 disabled:bg-slate-100 disabled:text-slate-500 disabled:border-slate-200 disabled:cursor-not-allowed">
                                </div>
                            </td>

                            <td class="p-4 min-w-[150px] space-y-1">
                                <label class="text-[8px] font-black text-slate-400 uppercase block ml-1">Periode</label>
                                <input type="text" x-model="item.period" :disabled="!item.isEditing" class="w-full text-[10px] px-2 py-1 rounded border border-slate-200 uppercase font-bold focus:ring-1 focus:ring-slate-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                <label class="text-[8px] font-black text-slate-400 uppercase block ml-1">Satuan</label>
                                <select x-model="item.unit" :disabled="!item.isEditing" class="w-full text-[10px] px-1 py-1 rounded border border-slate-200 font-bold focus:ring-1 focus:ring-slate-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                    <option>PER 100 GR</option>
                                    <option>PER PC</option>
                                    <option>PER EKOR</option>
                                    <option>PER PACK</option>
                                    <option>PER KG</option>
                                </select>
                            </td>

                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <button @click="toggleEdit(index)" class="flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition shadow-sm text-[10px] font-bold uppercase" title="Edit Baris">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </button>
                                    <button @click="item.isEditing ? saveRow(index) : null" 
                                            :disabled="!item.isEditing"
                                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl transition shadow-sm text-[10px] font-bold uppercase" 
                                            :class="item.isEditing ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-slate-100 text-slate-300 cursor-not-allowed'"
                                            title="Simpan Baris Ini">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                        </svg>
                                        Simpan
                                    </button>
                                    <button @click="openSinglePreview(index)" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm" title="Preview Visual">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button @click="printSingle(index)" class="p-2 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm" title="Cetak Label Ini">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v7h10z"/>
                                        </svg>
                                    </button>
                                    <button @click="removeItem(index)" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm" title="Hapus Baris">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    /* Style UI Input */
    .input-dark { background: #1e293b; border: 1px solid #334155; color: white; padding: 10px 14px; border-radius: 12px; width: 100%; font-size: 14px; }
    .text-shadow-strong { text-shadow: 0 10px 20px rgba(0,0,0,0.6); }

    /* Style Canvas Visual A3 */
    .a3-canvas {
        width: 29.7cm; height: 42cm;
        background-color: #1a1a1a;
        background-image: url('/images/bg-pop-a3.jpg'); 
        background-size: cover; background-position: center;
        position: relative; overflow: hidden; flex-shrink: 0;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); color: white;
    }

    @media print {
        /* PAKSA KERTAS A3 PORTRAIT */
        @page { size: A3 portrait !important; margin: 0 !important; }
        
        .no-print, aside, header, footer, [role="dialog"], .fixed { display: none !important; }
        body { background: white !important; overflow: visible !important; }
        
        /* Container khusus A3 */
        .print-only-container { display: block !important; position: static !important; }
        .preview-container-a3 { 
            display: block !important; page-break-after: always;
            width: 29.7cm !important; height: 42cm !important;
        }
        
        .a3-canvas { 
            box-shadow: none !important; filter: none !important;
            background-color: #1a1a1a !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            width: 29.7cm !important; height: 42cm !important;
        }
    }
</style>

<div class="flex flex-col gap-6 h-full">
    <div class="glass-card p-4 rounded-2xl flex flex-wrap items-center justify-between gap-4 no-print">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center text-[#00712D]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-black text-slate-800 uppercase tracking-tighter leading-none">Editor A3 LED</h2>
                <p class="text-[9px] font-bold text-green-600 uppercase tracking-[0.2em] mt-1">Sistem Visual Buah</p>
            </div>
            <div class="h-8 w-[1px] bg-slate-200 mx-2"></div>
        </div>

        <div class="flex items-center gap-2">
           <button @click="addItem()" class="flex items-center gap-2 px-4 py-2 bg-[#00712D] text-white rounded-xl text-xs font-bold hover:bg-green-800 transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Item
            </button>
            <button @click="saveToCloud()" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition shadow-md uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan ke Cloud
            </button>
            <button @click="printItems = [...items]; $nextTick(() => { setTimeout(() => { window.print() }, 1000) })" 
        class="flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-xl text-xs font-bold hover:bg-amber-600 transition shadow-md uppercase">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v7h10z"/></svg>
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
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b text-center w-16">Produk</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">Nama & Varian</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">Manfaat & Gambar</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b w-64">Harga (Nor/Pro/Non)</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, index) in items" :key="index">
                        <tr class="hover:bg-green-50/30 transition-colors border-b border-slate-50">
                            <td class="p-4 text-center">
                                <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-400 mx-auto" x-text="index + 1"></span>
                            </td>

                            <td class="p-4 min-w-[200px] space-y-2">
                                <div>
                                    <label class="text-[8px] font-black text-slate-400 uppercase mb-0.5 block">Nama Buah</label>
                                    <input type="text" x-model="item.name" :disabled="!item.isEditing" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs font-bold uppercase focus:ring-2 focus:ring-green-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                </div>
                                <div>
                                    <label class="text-[8px] font-black text-slate-400 uppercase mb-0.5 block">Deskripsi / Varian</label>
                                    <input type="text" x-model="item.sub" :disabled="!item.isEditing" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-[10px] font-bold uppercase focus:ring-2 focus:ring-green-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                </div>
                            </td>

                            <td class="p-4 min-w-[250px] space-y-2">
                                <div>
                                    <label class="text-[8px] font-black text-slate-400 uppercase mb-0.5 block">Manfaat Kesehatan</label>
                                    <textarea x-model="item.benefit" rows="1" :disabled="!item.isEditing" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-[10px] italic focus:ring-2 focus:ring-green-500 transition-all disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed"></textarea>
                                </div>

                                <div>
                                    <label class="text-[8px] font-black text-slate-400 uppercase mb-0.5 block">Foto Produk (A3)</label>
                                    <div class="flex items-center gap-3">
                                        <template x-if="item.image">
                                            <div class="relative group flex-shrink-0">
                                                <img :src="item.image.startsWith('data:') ? item.image : '/storage/' + item.image" 
                                                     class="w-10 h-10 object-cover rounded-lg border border-slate-200 shadow-sm">
                                            </div>
                                        </template>
                                        <input type="file" @change="handleUpload($event, index)" :disabled="!item.isEditing" class="text-[9px] text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[9px] file:font-black file:bg-green-50 file:text-[#00712D] cursor-pointer w-full disabled:opacity-50 disabled:cursor-not-allowed">
                                    </div>
                                </div>
                            </td>

                            <td class="p-4 space-y-1">
                                <div class="flex items-center justify-between mb-1 px-1">
                                    <span class="text-[9px] font-black text-slate-400 uppercase">Promo Member</span>
                                    <input type="checkbox" x-model="item.isMember" :disabled="!item.isEditing" class="w-4 h-4 text-green-600 rounded focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                </div>
                                <div class="flex gap-1 items-center">
                                    <span class="text-[8px] w-12 font-black text-red-400">NORMAL</span>
                                    <input type="text" x-model="item.oldPrice" :disabled="!item.isEditing" class="w-full px-2 py-1 text-xs rounded border border-slate-200 font-bold text-red-500 disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed">
                                </div>
                                <div class="flex gap-1 items-center">
                                    <span class="text-[8px] w-12 font-black" :class="item.isMember ? 'text-amber-600' : 'text-green-600'" x-text="item.isMember ? 'MEMBER' : 'PROMO'"></span>
                                    <input type="text" x-model="item.newPrice" :disabled="!item.isEditing" class="w-full px-2 py-1 text-xs rounded border border-green-200 bg-green-50 font-bold text-green-700 disabled:bg-slate-100 disabled:text-slate-500 disabled:border-slate-200 disabled:cursor-not-allowed">
                                </div>
                                <div x-show="item.isMember" x-transition class="flex gap-1 items-center">
                                    <span class="text-[8px] w-12 font-black text-amber-600">NON MEMBER</span>
                                    <input type="text" x-model="item.nonMemberPrice" :disabled="!item.isEditing" class="w-full px-2 py-1 text-xs rounded border border-amber-200 bg-amber-50 font-bold text-amber-700 disabled:bg-slate-100 disabled:text-slate-500 disabled:border-slate-200 disabled:cursor-not-allowed">
                                </div>
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
                                    <button @click="openSinglePreview(index)" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm" title="Preview">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                    
                                    <!--
                                    //buttin pdf file ( next fitur bisa download file pdf nya)
                                    <button @click="previewItem = JSON.parse(JSON.stringify(items[index])); $nextTick(() => { 
                                        const opt = { 
                                            margin: 0, 
                                            filename: 'POP-A3-'+items[index].name+'.pdf', 
                                            image: { type: 'jpeg', quality: 1 }, 
                                            html2canvas: { scale: 2, useCORS: true }, 
                                            jsPDF: { unit: 'cm', format: 'a3', orientation: 'portrait' } 
                                        };
                                        html2pdf().set(opt).from(document.getElementById('canvas-print-target')).save();
                                    })" class="p-2 bg-orange-50 text-orange-600 rounded-xl hover:bg-orange-600 hover:text-white transition shadow-sm" title="Download PDF">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                                    </button>
                                    -->
                                   <button
                                   
                                   
                                   
@click="(() => {
let data = {
    ...JSON.parse(JSON.stringify(items[index])),
    printKey: 'single-' + index + '-' + Date.now()
};

printItems = [];

$nextTick(() => {
    printItems = [data];

    $nextTick(() => {
        requestAnimationFrame(() => {
            window.print();
        });
    });
});
})()"
class="p-2 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm"
title="Cetak">

    <!-- ICON PRINTER (TIDAK BERUBAH) -->
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
    </svg>

</button>

                                    
                                    <button @click="removeItem(index)" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
<div class="flex flex-col gap-6 h-full">
    <div class="glass-card p-4 rounded-2xl flex flex-wrap items-center justify-between gap-4 no-print">
        <div class="flex items-center gap-2">
            <button @click="showImportModal = true" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Import Excel
            </button>
            <button @click="addItem()" class="flex items-center gap-2 px-4 py-2 bg-[#00712D] text-white rounded-xl text-xs font-bold hover:bg-green-800 transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Tambah Item
            </button>
        </div>

        <div class="flex items-center gap-2">
            <button @click="printAll()" class="flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-xl text-xs font-bold hover:bg-amber-600 transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v7h10z"/></svg>
                Print Semua
            </button>
            <button @click="clearAll()" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition" title="Reset">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
                                <input type="checkbox" x-model="item.isMember" class="w-5 h-5 text-green-600 rounded-lg border-slate-300 focus:ring-green-500">
                            </td>

                            <td class="p-4 min-w-[150px]">
                                <select x-model="item.header" class="w-full bg-white border border-slate-200 rounded-lg px-2 py-1.5 text-[10px] font-bold text-slate-700 focus:ring-2 focus:ring-green-500 transition-all uppercase">
                                    <template x-for="preset in presets">
                                        <option :value="preset" x-text="preset"></option>
                                    </template>
                                </select>
                            </td>

                            <td class="p-4 min-w-[220px] space-y-1">
                                <input type="text" x-model="item.name" placeholder="Nama Barang" class="w-full bg-white/50 border border-slate-200 rounded-lg px-2 py-1 text-xs font-bold uppercase focus:ring-2 focus:ring-green-500 transition-all">
                                <input type="text" x-model="item.sub" placeholder="Deskripsi" class="w-full bg-white/50 border border-slate-200 rounded-lg px-2 py-1 text-[10px] focus:ring-2 focus:ring-green-500 transition-all">
                            </td>

                            <td class="p-4 min-w-[180px] space-y-1">
                                <div class="flex gap-1 items-center">
                                    <span class="text-[9px] w-12 font-bold text-red-400">NORMAL</span>
                                    <input type="text" x-model="item.oldPrice" class="w-full px-2 py-0.5 text-xs rounded border border-slate-200 focus:ring-1 focus:ring-red-500 transition-all font-bold">
                                </div>
                                <div class="flex gap-1 items-center">
                                    <span class="text-[9px] w-12 font-bold text-green-600">PROMO</span>
                                    <input type="text" x-model="item.newPrice" class="w-full px-2 py-0.5 text-xs rounded border border-green-200 bg-green-50 focus:ring-1 focus:ring-green-500 transition-all font-bold text-green-700">
                                </div>
                                <div x-show="item.isMember" class="flex gap-1 items-center" x-transition>
                                    <span class="text-[9px] w-12 font-bold text-amber-600 uppercase">Non Member</span>
                                    <input type="text" x-model="item.nonMemberPrice" class="w-full px-2 py-0.5 text-xs rounded border border-amber-200 bg-amber-50 focus:ring-1 focus:ring-amber-500 transition-all font-bold text-amber-700">
                                </div>
                            </td>

                            <td class="p-4 min-w-[150px] space-y-1">
                                <input type="text" x-model="item.period" class="w-full text-[10px] px-2 py-1 rounded border border-slate-200 uppercase font-bold focus:ring-1 focus:ring-slate-500 transition-all">
                                <select x-model="item.unit" class="w-full text-[10px] px-1 py-1 rounded border border-slate-200 font-bold focus:ring-1 focus:ring-slate-500 transition-all">
                                    <option>PER 100 GR</option>
                                    <option>PER PC</option>
                                    <option>PER EKOR</option>
                                    <option>PER PACK</option>
                                    <option>PER KG</option>
                                </select>
                            </td>

                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <button @click="openSinglePreview(index)" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm" title="Preview">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                    <button @click="printSingle(index)" class="p-2 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm" title="Print Satu">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v7h10z"/></svg>
                                    </button>
                                    <button @click="removeItem(index)" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
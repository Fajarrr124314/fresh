<div x-show="confirmModal.open" 
     x-cloak
     class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm no-print"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">
    
    <div @click.away="confirmModal.open = false" 
         class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-sm overflow-hidden transform transition-all"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        
        <div class="p-8 text-center">
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm"
                 :class="confirmModal.type === 'danger' ? 'bg-red-50 text-red-500' : 'bg-green-50 text-[#00712D]'">
                <template x-if="confirmModal.type === 'danger'">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </template>
                <template x-if="confirmModal.type === 'info'">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </template>
            </div>

            <h3 class="text-xl font-black text-slate-800 mb-2 uppercase tracking-tighter" x-text="confirmModal.title"></h3>
            <p class="text-xs font-bold text-slate-400 mb-8 uppercase tracking-widest leading-relaxed" x-text="confirmModal.message"></p>
            
            <div class="grid grid-cols-2 gap-3">
                <button @click="confirmModal.open = false" 
                        class="px-6 py-3.5 text-[11px] font-black text-slate-400 hover:text-slate-600 transition uppercase tracking-widest bg-slate-50 rounded-2xl">
                    Batal
                </button>
                <button @click="confirmModal.onConfirm()" 
                        class="px-6 py-3.5 text-[11px] font-black text-white transition uppercase tracking-widest rounded-2xl shadow-lg"
                        :class="confirmModal.type === 'danger' ? 'bg-red-500 hover:bg-red-600 shadow-red-100' : 'bg-[#00712D] hover:bg-green-800 shadow-green-100'">
                    Ya, Lanjut
                </button>
            </div>
        </div>
    </div>
</div>
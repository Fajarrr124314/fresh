<header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 no-print shrink-0">
    <div class="flex items-center gap-4">
        <button @click="isSidebarOpen = true" class="lg:hidden p-2 bg-slate-100 rounded-lg">
            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>
        <div class="hidden sm:block">
            <h2 class="text-sm font-bold text-slate-800 tracking-tight uppercase">Yogya Fresh Pro</h2>
            <p class="text-[9px] text-green-600 uppercase font-black tracking-widest">Internal System v1.1.0</p>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-3 p-1.5 rounded-2xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                <div class="hidden md:block text-right">
                    <p class="text-[11px] font-black text-slate-800 leading-none uppercase">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Administrator</p>
                </div>
                
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#00712D] to-green-500 flex items-center justify-center text-white font-black text-sm shadow-md ring-2 ring-white">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>

                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="absolute right-0 mt-3 w-56 bg-white border border-slate-100 rounded-2xl shadow-2xl z-[100] p-2 overflow-hidden"
                 style="display: none;">
                
                <div class="px-3 py-2 border-b border-slate-50 mb-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Akses Akun</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-green-50 hover:text-[#00712D] transition-all group">
                    <svg class="w-5 h-5 opacity-50 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-xs font-bold uppercase">Pengaturan Profil</span>
                </a>

                <div class="my-1 border-t border-slate-50"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-500 hover:bg-red-50 transition-all group">
                        <svg class="w-5 h-5 opacity-50 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-xs font-bold uppercase">Keluar Sesi</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
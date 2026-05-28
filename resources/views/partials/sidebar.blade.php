<style>
    @keyframes float-logo {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-4px) rotate(5deg); }
    }
    .logo-float {
        animation: float-logo 3s ease-in-out infinite;
    }
</style>

<aside 
    x-data="{ isCollapsed: false }"
    :class="[
        isSidebarOpen ? 'translate-x-0' : '-translate-x-full',
        isCollapsed ? 'lg:w-[80px]' : 'lg:w-[260px]'
    ]" 
    class="fixed inset-y-0 left-0 pt-1 bg-white border-r border-slate-200 z-50 transform transition-all duration-300 ease-in-out lg:relative lg:translate-x-0 flex flex-col no-print overflow-hidden shadow-2xl lg:shadow-none flex-shrink-0"
    flex-shrink-0

>

    <div class="px-4 py-5 border-b border-slate-50 flex transition-all duration-300 min-h-[100px]"
         :class="isCollapsed ? 'flex-col items-center justify-center gap-4' : 'flex-row items-center justify-between'">

        <div class="flex items-center gap-3 overflow-hidden">
            <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-[#00712D] to-green-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-green-100 logo-float">
                Y
            </div>
            
            <div x-show="!isCollapsed" 
                 x-transition:enter="transition ease-out duration-200" 
                 x-transition:enter-start="opacity-0 -translate-x-10" 
                 x-transition:enter-end="opacity-100 translate-x-0"
                 class="whitespace-nowrap">
                <h1 class="font-black text-xl leading-none text-slate-800 uppercase tracking-tighter">Yogya</h1>
                <p class="text-[10px] font-black text-[#00712D] uppercase tracking-[0.2em]">Fresh Pro</p>
            </div>
        </div>
        
        <button @click="isCollapsed = !isCollapsed" 
                class="hidden lg:flex shrink-0 p-1.5 rounded-xl hover:bg-slate-100 text-slate-400 hover:text-[#00712D] transition-colors">
            <svg class="w-6 h-6 transform transition-transform duration-500" :class="isCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
            </svg>
        </button>
    </div>

    <nav class="flex-grow p-4 space-y-2 overflow-y-auto custom-scrollbar overflow-x-hidden">
        <div class="flex items-center px-2 mb-2 min-h-[20px]" :class="isCollapsed ? 'justify-center' : ''">
            <div x-show="!isCollapsed" class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">Main Menu</div>
            <div x-show="isCollapsed" class="w-6 h-1 bg-slate-100 rounded-full"></div>
        </div>

        {{-- POP KAYU --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-4 px-3 py-3 rounded-2xl transition-all duration-300 group relative hover:translate-x-1"
           :class="{{ request()->routeIs('dashboard') ? 'true' : 'false' }} 
                ? (isCollapsed ? 'justify-center text-[#00712D] bg-green-50 shadow-sm' : 'bg-gradient-to-r from-green-600 to-[#00712D] text-white shadow-lg shadow-green-100') 
                : (isCollapsed ? 'justify-center text-slate-500 hover:bg-green-50 hover:text-[#00712D]' : 'text-slate-500 hover:bg-green-50 hover:text-[#00712D]')">
            <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <span x-show="!isCollapsed" class="font-bold text-[12px] tracking-wide uppercase whitespace-nowrap transition-all duration-300 group-hover:pl-1">POP Kayu</span>
        </a>

        {{-- A3 LED --}}
        <a href="{{ route('pop.a3') }}" 
           class="flex items-center gap-4 px-3 py-3 rounded-2xl transition-all duration-300 group relative hover:translate-x-1"
           :class="{{ request()->routeIs('pop.a3') ? 'true' : 'false' }} 
                ? (isCollapsed ? 'justify-center text-[#00712D] bg-green-50 shadow-sm' : 'bg-gradient-to-r from-green-600 to-[#00712D] text-white shadow-lg shadow-green-100') 
                : (isCollapsed ? 'justify-center text-slate-500 hover:bg-green-50 hover:text-[#00712D]' : 'text-slate-500 hover:bg-green-50 hover:text-[#00712D]')">
            <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span x-show="!isCollapsed" class="font-bold text-[12px] tracking-wide uppercase whitespace-nowrap transition-all duration-300 group-hover:pl-1">A3 LED Gambar</span>
        </a>

        {{-- NAMA BUAH --}}
        <a href="{{ route('pop.buah') }}" 
           class="flex items-center gap-4 px-3 py-3 rounded-2xl transition-all duration-300 group relative hover:translate-x-1"
           :class="{{ request()->routeIs('pop.buah') ? 'true' : 'false' }} 
                ? (isCollapsed ? 'justify-center text-[#00712D] bg-green-50 shadow-sm' : 'bg-gradient-to-r from-green-600 to-[#00712D] text-white shadow-lg shadow-green-100') 
                : (isCollapsed ? 'justify-center text-slate-500 hover:bg-green-50 hover:text-[#00712D]' : 'text-slate-500 hover:bg-green-50 hover:text-[#00712D]')">
            <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <span x-show="!isCollapsed" class="font-bold text-[12px] tracking-wide uppercase whitespace-nowrap transition-all duration-300 group-hover:pl-1">Nama Buah</span>
        </a>

        {{-- POP ACRYLIC --}}
        <a href="{{ route('pop.acrylic') }}" 
           class="flex items-center gap-4 px-3 py-3 rounded-2xl transition-all duration-300 group relative hover:translate-x-1"
           :class="{{ request()->routeIs('pop.acrylic') ? 'true' : 'false' }} 
                ? (isCollapsed ? 'justify-center text-[#00712D] bg-green-50 shadow-sm' : 'bg-gradient-to-r from-green-600 to-[#00712D] text-white shadow-lg shadow-green-100') 
                : (isCollapsed ? 'justify-center text-slate-500 hover:bg-green-50 hover:text-[#00712D]' : 'text-slate-500 hover:bg-green-50 hover:text-[#00712D]')">
            <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <span x-show="!isCollapsed" class="font-bold text-[12px] tracking-wide uppercase whitespace-nowrap transition-all duration-300 group-hover:pl-1">POP Acrylic</span>
        </a>

        <div class="flex items-center px-2 pt-6 mb-2 min-h-[20px]" :class="isCollapsed ? 'justify-center' : ''">
            <div x-show="!isCollapsed" class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">Extras</div>
            <div x-show="isCollapsed" class="w-6 h-1 bg-slate-100 rounded-full"></div>
        </div>

        {{-- SOP VISUAL (PANDUAN DISPLAY) --}}
<a href="{{ route('sop.visual') }}" 
   class="flex items-center gap-4 px-3 py-3 rounded-2xl transition-all duration-300 group relative hover:translate-x-1"
   :class="{{ request()->routeIs('sop.visual') ? 'true' : 'false' }} 
        ? (isCollapsed ? 'justify-center text-[#00712D] bg-green-50 shadow-sm' : 'bg-gradient-to-r from-green-600 to-[#00712D] text-white shadow-lg shadow-green-100') 
        : (isCollapsed ? 'justify-center text-slate-500 hover:bg-green-50 hover:text-[#00712D]' : 'text-slate-500 hover:bg-green-50 hover:text-[#00712D]')">
    <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
    <span x-show="!isCollapsed" class="font-bold text-[12px] tracking-wide uppercase whitespace-nowrap transition-all duration-300 group-hover:pl-1">SOP Visual</span>
</a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('register') }}" 
           class="flex items-center gap-4 px-3 py-3 rounded-2xl transition-all duration-300 group relative hover:translate-x-1"
           :class="{{ request()->routeIs('register') ? 'true' : 'false' }} 
                ? (isCollapsed ? 'justify-center text-[#00712D] bg-green-50 shadow-sm' : 'bg-gradient-to-r from-green-600 to-[#00712D] text-white shadow-lg shadow-green-100') 
                : (isCollapsed ? 'justify-center text-slate-500 hover:bg-green-50 hover:text-[#00712D]' : 'text-slate-500 hover:bg-green-50 hover:text-[#00712D]')">
            <div class="shrink-0 transition-transform duration-300 group-hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            </div>
            <span x-show="!isCollapsed" class="font-bold text-[12px] tracking-wide uppercase whitespace-nowrap transition-all duration-300 group-hover:pl-1">Tambah User</span>
        </a>
        @endif
    </nav>

    {{-- Profil User tetap di bawah --}}
    <div class="p-4 bg-slate-50/50 border-t border-slate-100">
        @auth
            <div class="bg-white border border-slate-100 rounded-2xl p-2 flex items-center transition-all shadow-sm overflow-hidden"
                 :class="isCollapsed ? 'justify-center' : 'gap-3'">
                <div class="shrink-0 w-8 h-8 rounded-xl bg-gradient-to-tr from-[#00712D] to-green-400 flex items-center justify-center text-white font-black text-[10px] shadow-md uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div x-show="!isCollapsed" class="overflow-hidden whitespace-nowrap transition-all">
                    <p class="text-[10px] font-black text-slate-800 truncate uppercase">{{ Auth::user()->name }}</p>
                    <div class="flex items-center gap-1">
                        <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                        <p class="text-[8px] text-slate-400 uppercase font-black tracking-tighter">Online</p>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</aside>
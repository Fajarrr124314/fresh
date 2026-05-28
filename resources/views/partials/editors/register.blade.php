<div class="max-w-3xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-[#00712D] border border-white">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Pendaftaran User</h1>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Otorisasi Akses Baru System Pro</p>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white/70 backdrop-blur-xl border border-white shadow-2xl shadow-slate-200/50 rounded-[2.5rem] p-8 md:p-12">
        <form method="POST" action="{{ route('register') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold focus:ring-2 focus:ring-[#00712D]/10 focus:border-[#00712D] transition-all outline-none" placeholder="Contoh: Fajar Kurniawan">
                    @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 lowercase italic">*{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">ID Pengguna (Username)</label>
                    <input type="text" name="username" value="{{ old('username') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold focus:ring-2 focus:ring-[#00712D]/10 focus:border-[#00712D] transition-all outline-none" placeholder="ID untuk login">
                    @error('username') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 lowercase italic">*{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Email (Opsional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold focus:ring-2 focus:ring-[#00712D]/10 focus:border-[#00712D] transition-all outline-none" placeholder="user@yogya.com">
                    @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 lowercase italic">*{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Level Otoritas</label>
                    <select name="role" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-[#00712D]/10 focus:border-[#00712D] transition-all outline-none appearance-none">
                        <option value="user" selected>STAFF (USER)</option>
                        <option value="admin">SUPERVISOR (ADMIN)</option>
                    </select>
                    @error('role') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 lowercase italic">*{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Kata Sandi</label>
                    <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold focus:ring-2 focus:ring-[#00712D]/10 focus:border-[#00712D] transition-all outline-none" placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 lowercase italic">*{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold focus:ring-2 focus:ring-[#00712D]/10 focus:border-[#00712D] transition-all outline-none" placeholder="••••••••">
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-gradient-to-r from-[#00712D] to-green-600 text-white font-[800] uppercase tracking-[0.2em] py-4 rounded-2xl shadow-xl shadow-green-100 hover:shadow-2xl hover:translate-y-[-2px] transition-all active:scale-95 flex items-center justify-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Daftarkan User Baru
                </button>
            </div>
        </form>
    </div>

    <p class="mt-8 text-center text-[9px] font-black text-slate-400 uppercase tracking-[0.5em]">Security Protocol System • Yogya Grand Karawang</p>
</div>
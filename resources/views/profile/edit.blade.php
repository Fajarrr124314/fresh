<x-app-layout>
    <div class="min-h-screen bg-[#f8fafc] flex flex-col items-center justify-center p-6" x-data="{ isSidebarOpen: false }">
        
        <div class="w-full max-w-2xl space-y-8 pb-10">
            
            <div class="flex flex-col items-center text-center gap-4 mb-4">
                <div class="w-20 h-20 bg-white rounded-[2rem] shadow-sm flex items-center justify-center text-[#00712D] border border-slate-100 shadow-xl shadow-slate-200/50 mb-2">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">{{ __('Pengaturan Akun Admin') }}</h1>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Kelola Kredensial Akses Sistem</p>
                </div>

                <a href="{{ route('dashboard') }}" class="mt-4 flex items-center gap-3 px-8 py-3 bg-white border border-slate-200 rounded-2xl text-slate-600 hover:text-[#00712D] hover:border-[#00712D] transition-all shadow-sm group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-xs font-black uppercase tracking-widest">Kembali ke Dashboard</span>
                </a>
            </div>

            <div class="p-8 md:p-12 bg-white/80 backdrop-blur-xl border border-white shadow-2xl shadow-slate-200/50 rounded-[3rem]">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#00712D] rounded-full"></span>
                        Informasi Identitas
                    </h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 md:p-12 bg-white/80 backdrop-blur-xl border border-white shadow-2xl shadow-slate-200/50 rounded-[3rem]">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#00712D] rounded-full"></span>
                        Keamanan Kata Sandi
                    </h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <p class="text-center text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                Yogya Fresh Pro • Security Management
            </p>

        </div>
    </div>

    <style>
        /* Hilangkan elemen header bawaan x-app-layout jika masih nyangkut */
        header { display: none !important; }

        /* Sembunyikan input email di dalam form update-profile-information-form */
        /* Kita hanya butuh Nama sebagai ID */
        #email, label[for="email"], .mt-2.text-sm.text-gray-800 { 
            display: none !important; 
        }

        /* Styling Input */
        input[type="text"], input[type="password"] {
            border-radius: 14px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            font-weight: 600 !important;
            padding: 0.85rem 1rem !important;
            width: 100% !important;
        }
        input:focus {
            border-color: #00712D !important;
            box-shadow: 0 0 0 4px rgba(0, 113, 45, 0.1) !important;
            outline: none !important;
        }

        /* Styling Button Save */
        button[type="submit"], .inline-flex.items-center.px-4.py-2.bg-gray-800 {
            background: linear-gradient(135deg, #00712D 0%, #00a844 100%) !important;
            border-radius: 14px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            padding: 0.85rem 1.5rem !important;
            border: none !important;
            color: white !important;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0, 113, 45, 0.2) !important; }
    </style>
</x-app-layout>
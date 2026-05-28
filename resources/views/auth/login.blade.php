<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Masuk - Yogya Fresh System Pro</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='50' fill='%2300712D'/><text x='50%25' y='65%25' text-anchor='middle' fill='white' font-family='sans-serif' font-weight='bold' font-size='60'>Y</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; overflow: hidden; }
        .bg-full { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; object-fit: cover; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.2); z-index: 0; }
        .glass-info { background: rgba(0, 0, 0, 0.3) !important; backdrop-filter: blur(15px) !important; -webkit-backdrop-filter: blur(15px) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; border-radius: 2rem; }
        .white-login-card { background: #ffffff !important; border-radius: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; }
        .custom-input { background: #f8fafc !important; border: 1px solid #e2e8f0 !important; border-radius: 12px !important; padding: 0.85rem 1.1rem !important; color: #1e293b !important; transition: all 0.3s ease; }
        .custom-input:focus { border-color: #00712D !important; background: #ffffff !important; box-shadow: 0 0 0 4px rgba(0, 113, 45, 0.1) !important; outline: none; }
        .login-btn { background: #00712D !important; border-radius: 12px !important; padding: 1rem !important; font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 1.5px !important; color: white !important; transition: all 0.3s ease !important; border: none; }
        .login-btn:hover { background: #005a24 !important; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0, 113, 45, 0.2) !important; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <img src="{{ asset('images/freshbg.jpg') }}" class="bg-full" alt="Background">
    <div class="overlay"></div>

    <div class="flex w-full h-screen z-10 relative">
        <div class="hidden lg:flex lg:w-3/5 h-full items-end p-20 pb-24">
            <div class="glass-info p-10 max-w-lg shadow-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-12 h-1 bg-green-500 rounded-full"></span>
                    <p class="text-[11px] font-black uppercase tracking-[0.4em] text-white">Security Access</p>
                </div>
                <h1 class="text-5xl font-extrabold leading-[1.1] tracking-tighter uppercase mb-4 text-white">Yogya Fresh<br>System Pro</h1>
                <p class="text-sm font-medium text-white/90 leading-relaxed italic">"Menjaga kualitas dan kesegaran informasi di setiap label produk Anda."</p>
            </div>
        </div>

        <div class="w-full lg:w-2/5 h-full flex items-center justify-center p-8">
            <div class="white-login-card w-full max-w-md p-10 md:p-12 border border-white relative">
                <div class="flex flex-col items-center mb-10 text-center">
                    <div class="w-20 h-20 bg-[#00712D] rounded-[2rem] flex items-center justify-center text-white font-black text-4xl shadow-xl mb-6 rotate-3">Y</div>
                    <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter leading-none">Login Sesi</h2>
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em] mt-2">Administrator Portal</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">ID Pengguna (Username)</label>
                        <input type="text" name="username" value="{{ old('username') }}" required autofocus class="custom-input block w-full text-sm font-semibold" placeholder="Masukkan ID resmi">
                        @error('username')
                            <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold italic lowercase italic opacity-80">*{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Kata Sandi</label>
                        <input type="password" name="password" required class="custom-input block w-full text-sm font-semibold" placeholder="••••••••">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="login-btn flex justify-center items-center gap-3 w-full shadow-lg">
                            Verifikasi Akses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOGYA PRO - Fresh System Pro</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='50' fill='%2300712D'/><text x='50%25' y='65%25' text-anchor='middle' fill='white' font-family='sans-serif' font-weight='bold' font-size='60'>Y</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Montserrat:wght@800;900&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 0; }
        
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        .shelf-talker { 
            width: 26cm; height: 12cm; position: relative; background-color: white; 
            overflow: hidden; font-family: 'Montserrat', sans-serif; border-radius: 4px; 
            transform-origin: top left; flex-shrink: 0; background-size: 100% 100%;
        }

        .txt-header { position: absolute; top: 0.9cm; left: 1.5cm; color: white; font-size: 60px; font-weight: 900; letter-spacing: -2px; text-transform: uppercase; line-height: 1; }
        .txt-product { position: absolute; top: 5.5cm; left: 1.5cm; font-size: 65px; font-weight: 900; line-height: 0.9; color: black; text-transform: uppercase; }
        .txt-sub { position: absolute; top: 7.2cm; left: 1.5cm; font-size: 36px; font-weight: 800; color: #EE2D24; text-transform: uppercase; }
        .txt-periode { position: absolute; top: 8.8cm; left: 1.5cm; background: #00712D; color: white; padding: 6px 25px; border-radius: 50px; font-size: 18px; font-weight: 800; }

        .print-only-container { display: none; }

        @media print { 
            @page { size: A4 landscape; margin: 0; }
            html, body { height: 100%; margin: 0 !important; padding: 0 !important; overflow: hidden; }
            .no-print, aside, header, footer, [role="dialog"], .fixed { display: none !important; }
            
            .print-only-container { 
                display: block !important; 
                position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                background: white !important;
            }
            
            .print-page { 
                height: 210mm; 
                width: 297mm; 
                display: flex !important; 
                align-items: center; 
                justify-content: center; 
                page-break-after: always !important; 
                break-after: page !important;
                overflow: hidden;
                background: white !important;
            }

            .print-page:last-child { page-break-after: avoid !important; break-after: avoid !important; }

            .shelf-talker { 
                box-shadow: none !important; 
                border: none !important; 
                background-image: url('/images/template-label.jpg') !important; 
                transform: scale(1.05);
            }

            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body x-data="priceApp()" x-cloak>

    <div class="flex min-h-screen overflow-hidden no-print">
        @include('partials.sidebar')
        <div class="flex-grow flex flex-col h-screen overflow-hidden relative">
            @include('partials.header')
            <div class="flex-grow overflow-y-auto p-4 lg:p-8">
                <div class="max-w-[1600px] mx-auto">
                    @include('partials.editor')
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>

    <div class="print-only-container">
        <template x-for="(item, index) in printItems" :key="'print-'+index">
            <div class="print-page">
                <div class="shelf-talker" style="background-image: url('/images/template-label.jpg');">
                    <div class="txt-header" x-text="item.header"></div>
                    <div class="absolute top-[5.2cm] left-[1.5cm] max-w-[12cm]">
                        <div class="text-black font-[900] text-[65px] leading-[0.85] uppercase tracking-tighter" x-text="item.name"></div>
                        <div class="text-[#EE2D24] font-[800] text-[36px] uppercase tracking-tight mt-1" x-text="item.sub"></div>
                    </div>
                    <div class="txt-periode" style="top: 8.8cm; left: 1.5cm;">PERIODE: <span x-text="item.period"></span></div>
                    <div class="absolute top-[4.2cm] right-[1cm] w-[11.8cm] h-[7.3cm] bg-[#00712D] rounded-[50px] flex flex-col items-center justify-center px-6">
                        <div class="flex items-center text-white mb-1" :style="item.isMember ? '' : 'transform: translateY(-10px)'">
                            <span class="font-[900] text-[20px] mr-1 mt-2">Rp</span>
                            <div class="relative inline-block font-[900] text-[52px] tracking-tighter leading-none">
                                <span x-text="item.oldPrice"></span>
                                <div class="absolute top-[55%] left-[-5%] w-[110%] h-1.5 bg-[#EE2D24] -rotate-[3deg] rounded-full"></div>
                            </div>
                        </div>
                        <template x-if="item.isMember">
                            <div class="flex flex-col items-center w-full leading-none">
                                <div class="text-white font-[900] text-[16px] uppercase mb-1">PROMO MEMBER</div>
                                <div class="flex items-start justify-center mb-2">
                                    <span class="text-white font-[900] text-[35px] mt-7 mr-1">Rp</span>
                                    <span class="text-[#FFCC00] font-[800] text-[120px] tracking-[-6px] leading-[0.7]" x-text="item.newPrice"></span>
                                </div>
                                <div class="text-white flex flex-col items-center">
                                    <span class="text-[12px] font-black uppercase mb-0.5 tracking-tight">HARGA NON MEMBER</span>
                                    <div class="flex items-center"><span class="text-[14px] font-extrabold mr-1">Rp</span><span class="text-[#FFCC00] font-[800] text-[38px]" x-text="item.nonMemberPrice"></span></div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!item.isMember">
                            <div class="flex items-start justify-center leading-none mt-4">
                                <span class="text-white font-[900] text-[45px] mt-10 mr-1">Rp</span>
                                <span class="text-[#FFCC00] font-[800] text-[130px] tracking-[-8px] leading-[0.7]" x-text="item.newPrice"></span>
                            </div>
                        </template>
                        <div class="absolute bottom-6 right-10 text-white font-[900] text-[14px] uppercase opacity-90" x-text="item.unit"></div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    @include('partials.modal-import')
    
    <div x-show="showSinglePreview" x-transition.opacity class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-md no-print">
        <div @click.away="showSinglePreview = false" class="relative">
            <button @click="showSinglePreview = false" class="absolute -top-12 right-0 text-white font-bold bg-white/10 px-4 py-2 rounded-full hover:bg-white/20 transition">Tutup</button>
            <template x-if="previewItem">
                <div class="shelf-talker shadow-2xl scale-75 md:scale-100" style="background-image: url('/images/template-label.jpg');">
                    <div class="txt-header" x-text="previewItem.header"></div>
                    <div class="absolute top-[5.2cm] left-[1.5cm] max-w-[12cm]">
                        <div class="text-black font-[900] text-[65px] leading-[0.85] uppercase tracking-tighter" x-text="previewItem.name"></div>
                        <div class="text-[#EE2D24] font-[800] text-[36px] uppercase tracking-tight mt-1" x-text="previewItem.sub"></div>
                    </div>
                    <div class="txt-periode" style="top: 8.8cm; left: 1.5cm;">PERIODE: <span x-text="previewItem.period"></span></div>
                    <div class="absolute top-[4.2cm] right-[1cm] w-[11.8cm] h-[7.3cm] bg-[#00712D] rounded-[50px] flex flex-col items-center justify-center px-6">
                        <div class="flex items-center text-white mb-1" :style="previewItem.isMember ? '' : 'transform: translateY(-10px)'">
                            <span class="font-[900] text-[20px] mr-1 mt-2">Rp</span>
                            <div class="relative inline-block font-[900] text-[52px] tracking-tighter leading-none">
                                <span x-text="previewItem.oldPrice"></span>
                                <div class="absolute top-[55%] left-[-5%] w-[110%] h-1.5 bg-[#EE2D24] -rotate-[3deg] rounded-full"></div>
                            </div>
                        </div>
                        <template x-if="previewItem.isMember">
                            <div class="flex flex-col items-center w-full leading-none">
                                <div class="text-white font-[900] text-[16px] uppercase mb-1">PROMO MEMBER</div>
                                <div class="flex items-start justify-center mb-2">
                                    <span class="text-white font-[900] text-[35px] mt-7 mr-1">Rp</span>
                                    <span class="text-[#FFCC00] font-[800] text-[120px] tracking-[-6px] leading-[0.7]" x-text="previewItem.newPrice"></span>
                                </div>
                                <div class="text-white flex flex-col items-center">
                                    <span class="text-[12px] font-black uppercase mb-0.5 tracking-tight">HARGA NON MEMBER</span>
                                    <div class="flex items-center"><span class="text-[14px] font-extrabold mr-1">Rp</span><span class="text-[#FFCC00] font-[800] text-[38px]" x-text="previewItem.nonMemberPrice"></span></div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!previewItem.isMember">
                            <div class="flex items-start justify-center leading-none mt-4">
                                <span class="text-white font-[900] text-[45px] mt-10 mr-1">Rp</span>
                                <span class="text-[#FFCC00] font-[800] text-[130px] tracking-[-8px] leading-[0.7]" x-text="previewItem.newPrice"></span>
                            </div>
                        </template>
                        <div class="absolute bottom-6 right-10 text-white font-[900] text-[14px] uppercase opacity-90" x-text="previewItem.unit"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script>
    function priceApp() {
        // AMBIL USERNAME DARI LARAVEL BLADE
        const USER_ID = '{{ auth()->user()->username }}';
        
        // BUAT KEY UNIK PER USER: Misal yogya_labels_123456
        const STORAGE_KEY = 'yogya_labels_v3_stable_' + USER_ID; 
        const TEMPLATE_PATH = '/images/template-label.jpg';

        return {
            isSidebarOpen: false, showImportModal: false, showSinglePreview: false, previewItem: null,
            printItems: [],
            presets: ['HARGA HERAN', 'HARGA CERMAT', 'SERBA HEMAT', 'HARGA SABAR', 'HARGA LEBARAN'],
            items: [],

            init() {
                // Sekarang data yang ditarik hanya milik ID yang login
                const saved = localStorage.getItem(STORAGE_KEY);
                this.items = saved ? JSON.parse(saved) : [];
                if(this.items.length === 0) this.addItem();
                
                // Simpan otomatis ke key unik tersebut tiap ada perubahan
                this.$watch('items', val => {
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(val));
                    // Kamu bisa panggil sync ke DB di sini jika ingin auto-save ke server
                });
                
                this.preloadImage(TEMPLATE_PATH);
            },

                preloadImage(url) {
                    return new Promise((resolve, reject) => {
                        const img = new Image();
                        img.src = url;
                        img.onload = resolve;
                        img.onerror = reject;
                    });
                },

                addItem() {
                    this.items.push({ isMember: false, header: 'HARGA HERAN', name: 'NAMA BARANG', sub: 'DESKRIPSI', period: '13-15 APR 2026', oldPrice: '0.000', newPrice: '0.000', nonMemberPrice: '0.000', unit: 'PER 100 GR' });
                },

                duplicateItem(index) { this.items.splice(index + 1, 0, JSON.parse(JSON.stringify(this.items[index]))); },
                removeItem(index) { if(this.items.length > 1 && confirm('Hapus item?')) this.items.splice(index, 1); },
                clearAll() { if(confirm('Reset semua?')) { this.items = []; this.addItem(); } },
                openSinglePreview(index) { this.previewItem = this.items[index]; this.showSinglePreview = true; },
                
                async printAll() {
                    this.printItems = [...this.items];
                    await this.preloadImage(TEMPLATE_PATH);
                    // Tunggu sedikit ekstra agar Alpine menyelesaikan DOM loop
                    setTimeout(() => { window.print(); }, 800);
                },
                
                async printSingle(index) {
                    this.printItems = [JSON.parse(JSON.stringify(this.items[index]))];
                    await this.preloadImage(TEMPLATE_PATH);
                    setTimeout(() => { window.print(); }, 800);
                },

                handleFileUpload(event) {
                    const file = event.target.files[0];
                    if(!file) return;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const data = XLSX.utils.sheet_to_json(XLSX.read(new Uint8Array(e.target.result), {type:'array'}).Sheets[XLSX.read(new Uint8Array(e.target.result), {type:'array'}).SheetNames[0]]);
                        this.items = [...this.items, ...data.map(r => ({
                            header: r.HEADER || 'HARGA HERAN', name: r.NAMA_BARANG || 'BARU', sub: r.DESKRIPSI || '', period: r.PERIODE || '2026',
                            oldPrice: String(r.HARGA_NORMAL || '0.000'), newPrice: String(r.HARGA_PROMO || '0.000'), nonMemberPrice: String(r.HARGA_NON_MEMBER || '0.000'),
                            unit: r.UNIT || 'PER 100 GR', isMember: r.HARGA_NON_MEMBER ? true : false
                        }))];
                        this.showImportModal = false;
                        event.target.value = '';
                    };
                    reader.readAsArrayBuffer(file);
                }
            }
        }
    </script>
</body>
</html>
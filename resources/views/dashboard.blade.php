<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOGYA PRO - Fresh System Pro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        let token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        }
    </script>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='50' fill='%2300712D'/><text x='50%25' y='65%25' text-anchor='middle' fill='white' font-family='sans-serif' font-weight='bold' font-size='60'>Y</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Montserrat:wght@800;900&display=swap" rel="stylesheet">
    <!-- 🔥 TAMBAHAN PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
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

        /* ============================================================
           LOGIKA PEMISAHAN PRINT (A4 KAYU VS A3 LED)
           ============================================================ */
        @media print {
            .no-print, aside, header, footer, [role="dialog"], .fixed { display: none !important; }
            
            body * { visibility: hidden; }
            .print-only-container, .print-only-container * { visibility: visible; }

            .print-only-container { 
                display: block !important; 
                position: absolute; 
                top: 0; left: 0; 
                width: 100%; 
            }

            /* --- SETTINGAN JIKA MODE A3 LED --- */
            body.mode-a3-led { background: white !important; }
            body.mode-a3-led @page { size: A3 portrait; margin: 0; }
            body.mode-a3-led .print-page { 
                width: 29.7cm; height: 41.9cm; 
                display: flex !important; align-items: center; justify-content: center;
                overflow: hidden;
            }

            /* --- SETTINGAN JIKA MODE KAYU / A4 --- */
            body.mode-kayu { background: white !important; }
            body.mode-kayu @page { size: A4 landscape; margin: 0; }
            body.mode-kayu .print-page { 
                width: 297mm; height: 209mm; 
                display: flex !important; align-items: center; justify-content: center;
                overflow: hidden;
            }
            body.mode-kayu .shelf-talker { 
                transform: scale(1.05); 
                box-shadow: none !important;
                background-image: url('/images/template-label.jpg') !important;
            }

            .print-page ~ .print-page {
                page-break-before: always !important;
            }

            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body x-data="priceApp()" :class="'mode-' + APP_TYPE" x-cloak>

    <div class="flex min-h-screen overflow-hidden no-print">
        <!-- MOBILE OVERLAY BACKDROP -->
        <div x-show="isSidebarOpen" 
             x-transition.opacity.duration.300ms
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
             @click="isSidebarOpen = false"
             style="display: none;">
        </div>

        @include('partials.sidebar')
        <div class="flex-grow flex flex-col h-screen overflow-hidden relative">
            @include('partials.header')
            <div class="flex-grow overflow-y-auto p-4 lg:p-8">
                <div class="max-w-[1600px] mx-auto">
                    @include("partials.editors.{$type}")
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>

<div class="print-only-container">
    <template x-for="(item, index) in printItems":key="item.printKey || index">

        <div class="print-page">
            <div :class="APP_TYPE === 'a3-led' ? 'a3-canvas-final' : 'shelf-talker'">
                <template x-if="item"> 
                    <div x-data="{ item: item, index: 'print' }">
                        @include("partials.previews.{$type}")
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>

    @include('partials.modal-import')
    @include('partials.confirm-modal')
    
    <div x-show="showSinglePreview" x-transition.opacity class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-md no-print">
        <div @click.away="showSinglePreview = false" class="relative w-full h-full flex items-center justify-center overflow-hidden">
            <button @click="showSinglePreview = false" class="absolute top-4 right-4 z-[110] text-white font-bold bg-red-600 px-6 py-2 rounded-full hover:bg-red-700 transition shadow-xl">Tutup</button>
            
            <template x-if="previewItem">
                <div class="flex items-center justify-center p-10">
                    <div id="canvas-print-target" 
                         class="shadow-2xl origin-center bg-white" 
                         :style="window.innerWidth < 768 ? 'transform: scale(0.18)' : 'transform: scale(0.22)'">
                        
                        <div x-data="{ item: previewItem, index: 'preview' }">
                             @include("partials.previews.{$type}")
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>


    <script>
  function priceApp() {
    const USER_ID = '{{ auth()->user()->username }}';
    const APP_TYPE = '{{ $type }}'; 
    
    const STORAGE_KEY = 'yogya_labels_v3_' + USER_ID + '_' + APP_TYPE; 

    const TEMPLATES = {
        'kayu': '/images/template-label.jpg',
        'a3-led': '/images/bg-pop-a3.jpg',
        'buah': '/images/template-buah.jpg',
        'acrylic': '/images/template-acrylic.jpg'
    };
    
    const TEMPLATE_PATH = TEMPLATES[APP_TYPE] || '/images/template-label.jpg';

    return {
        isSidebarOpen: false, 
        showImportModal: false, 
        showSinglePreview: false, 
        previewItem: null,
        printItems: [],

        // ✅ TAMBAHAN IMPORT
        selectedFile: null,

        presets: ['HARGA HERAN', 'HARGA CERMAT', 'SERBA HEMAT', 'HARGA SABAR', 'HARGA LEBARAN'],
        items: [],
init() {
    const saved = localStorage.getItem(STORAGE_KEY);
    this.items = saved ? JSON.parse(saved) : [];

    if (!Array.isArray(this.items)) this.items = [];

    // 🔥 NORMALISASI SETELAH LOAD
    this.items = this.items.map(item => {
        let clean = String(item.header || '').toUpperCase().trim();

        let valid = this.presets.find(p => p === clean);

        return {
            ...item,
            header: valid || 'HARGA HERAN',
            isEditing: false
        };
    });

    if (this.items.length === 0) this.addItem();

    this.$watch('items', val => {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(val));
    });

    this.preloadImage(TEMPLATE_PATH);
    this.loadFromCloud();
},

        notifications: [],
        notify(message, type = 'success') {
            const id = Date.now();
            this.notifications.push({ id, message, type });
            setTimeout(() => {
                this.notifications = this.notifications.filter(n => n.id !== id);
            }, 3000);
        },

        confirmModal: {
            open: false,
            title: '',
            message: '',
            type: 'info',
            onConfirm: () => {}
        },

        askConfirm(title, message, type, callback) {
            this.confirmModal.title = title;
            this.confirmModal.message = message;
            this.confirmModal.type = type;
            this.confirmModal.onConfirm = () => {
                callback();
                this.confirmModal.open = false;
            };
            this.confirmModal.open = true;
        },

async saveRow(index) {
    try {
        const res = await axios.post('/api/labels/save-single', {
            type: APP_TYPE,
            item: this.items[index]
        });
        if (res.data.item) {
            this.items[index].id = res.data.item.id;
        }
        this.items[index].isEditing = false;
        this.notify(res.data.message, 'success');
    } catch (err) {
        console.error(err);
        this.notify('Gagal menyimpan baris ini!', 'error');
    }
},

async saveToCloud() {
    try {
        const res = await axios.post('/api/labels/sync', {
            type: APP_TYPE,
            items: this.items
        });
        this.notify(res.data.message, 'success');
    } catch (err) {
        console.error(err);
        this.notify('Gagal menyimpan ke cloud!', 'error');
    }
},

async loadFromCloud() {
    try {
        const res = await axios.get('/api/labels', {
            params: { type: APP_TYPE }
        });
        if (res.data && res.data.length > 0) {
            this.items = res.data.map(item => ({
                ...item,
                oldPrice: item.oldPrice || item.old_price,
                newPrice: item.newPrice || item.new_price,
                nonMemberPrice: item.nonMemberPrice || item.non_member_price,
                isMember: !!(item.isMember || item.is_member),
                header: item.header || 'HARGA HERAN',
                isEditing: false
            }));
        }
    } catch (err) {
        console.error('Error loading from cloud:', err);
    }
},


        // =======================
        // DOWNLOAD TEMPLATE
        // =======================
        downloadTemplate() {
            const data = [{
                HEADER: 'HARGA HERAN',
                BRAND: 'AYAM BROILER',
                DESKRIPSI: 'UTUH PROMO',
                HARGA_NORMAL: 40000,
                HARGA_PROMO: 35000,
                HARGA_MEMBER: 33000,
                PERIODE: '13-15 APR 2026',
                UNIT: 'PER 100 GR'
            }];

            const worksheet = XLSX.utils.json_to_sheet(data);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Template");

            XLSX.writeFile(workbook, "Template_YOGYA.xlsx");
        },

        // =======================
        // HELPER
        // =======================
  parsePrice(value) {
    if (value === null || value === undefined || value === '') return 0;

    // kalau sudah number dari Excel
    if (typeof value === 'number') return value;

    let str = String(value).trim();

    // kalau format Indonesia: 39,550 → ribuan
    if (str.includes(',') && str.includes('.')) {
        // ambil yang paling masuk akal: hapus ribuan separator
        str = str.replace(/\./g, '').replace(',', '.');
    } 
    else if (str.includes(',')) {
        // anggap koma sebagai ribuan, bukan desimal
        str = str.replace(/,/g, '');
    }

    return Number(str) || 0;
},



       formatPrice(num) {
    if (num === null || num === undefined || isNaN(num)) return '0.000';
    
    // Menggunakan Intl.NumberFormat agar otomatis 3995 jadi 3.995
    return new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 3
    }).format(num);
},

        // =======================
        // IMPORT BUTTON
        // =======================
        importExcel() {
            if (!this.selectedFile) return;

            if (!Array.isArray(this.items)) {
                this.items = [];
            }

            const fakeEvent = {
                target: {
                    files: [this.selectedFile]
                }
            };

            this.handleFileUpload(fakeEvent);

            this.selectedFile = null;
        },

        // =======================
        // HANDLE FILE
        // =======================
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = (e) => {
                const workbook = XLSX.read(new Uint8Array(e.target.result), { type: 'array' });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
               const data = XLSX.utils.sheet_to_json(sheet, {
    raw: true,
    defval: ''
});


               const newItems = data.map(r => {

               // =========================



    let normal = this.parsePrice(r.HARGA_NORMAL);
    let promo = this.parsePrice(r.HARGA_PROMO);
    let member = this.parsePrice(r.HARGA_MEMBER || r.HARGA_NON_MEMBER);

let headerRaw = String(
    r.HEADER || 
    r.Header || 
    r.header || 
    ''
)
.toUpperCase()
.trim()
.replace(/\s+/g, ' ');

let matchedHeader = 'HARGA HERAN';

if (headerRaw.includes('CERMAT')) {
    matchedHeader = 'HARGA CERMAT';
} 
else if (headerRaw.includes('HEMAT')) {
    matchedHeader = 'SERBA HEMAT';
} 
else if (headerRaw.includes('SABAR')) {
    matchedHeader = 'HARGA SABAR';
} 
else if (headerRaw.includes('LEBARAN')) {
    matchedHeader = 'HARGA LEBARAN';
} 
else if (headerRaw.includes('HERAN')) {
    matchedHeader = 'HARGA HERAN';
}


    // =========================
    // 🔥 NORMALISASI UNIT (ANTI TYPO EXCEL)
    // =========================
    let unitRaw = String(r.UNIT || '')
        .toLowerCase()
        .replace(/\s/g, '');

    let finalUnit = 'PER KG'; // default

  if (unitRaw.includes('100gr') || unitRaw.includes('100g')) {
    finalUnit = 'PER 100 GR';

    // Jika di excel 39950, dibagi 10 harusnya 3995
    // Jika di excel 39.95, maka jangan dibagi lagi (sudah benar)
   if (finalUnit === 'PER 100 GR') {
    normal = normal / 10;
    promo = promo / 10;
    member = member ? member / 10 : 0;
}

}


    let finalNewPrice = 0;
let finalNonMember = 0;
let isMemberPromo = false;

if (member > 0) {
    // 🔥 ADA MEMBER
    finalNewPrice = member;
    finalNonMember = promo;
    isMemberPromo = true;
} else {
    // 🔥 TANPA MEMBER
    finalNewPrice = promo;
    finalNonMember = 0;
    isMemberPromo = false;
}


    return {
    header: this.presets.includes(matchedHeader)
        ? matchedHeader
        : 'HARGA HERAN',

    name: r.BRAND || r.NAMA_BARANG || 'PRODUK',
    sub: r.DESKRIPSI || '',
    period: r.PERIODE || '2026',

    oldPrice: this.formatPrice(normal),
    newPrice: this.formatPrice(finalNewPrice),
    nonMemberPrice: this.formatPrice(finalNonMember),

    unit: finalUnit,
    isMember: isMemberPromo,

    image: '',
    benefit: r.MANFAAT || ''
};


});




                this.items = [...this.items, ...newItems];

                if (this.items.length === 0) {
                    this.addItem();
                }

                this.showImportModal = false;
                event.target.value = '';
            };

            reader.readAsArrayBuffer(file);
        },

        // =======================
        // UPLOAD IMAGE
        // =======================
        handleUpload(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => { 
                this.items[index].image = e.target.result; 
            };
            reader.readAsDataURL(file);

            let formData = new FormData();
            formData.append('image', file);
            formData.append('id', this.items[index].id); 

            axios.post('/upload-product-image', formData)
            .then(res => {
                this.items[index].image = res.data.image;
                this.notify('Foto berhasil diupload', 'success');
            })
            .catch(err => {
                console.error(err);
                this.notify('Gagal mengupload foto', 'error');
            });
        },

        handleImageUpload(event, index) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => { this.items[index].image = e.target.result; };
                reader.readAsDataURL(file);
            }
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
            this.items.push({ 
                isMember: false, 
                header: 'HARGA HERAN', 
                name: 'PRODUK', 
                sub: 'DESKRIPSI', 
                period: '13-15 APR 2026', 
                oldPrice: '0.000', 
                newPrice: '0.000', 
                nonMemberPrice: '0.000', 
                unit: 'PER 100 GR',
                image: '',
                benefit: '',
                isEditing: true
            });
        },

        toggleEdit(index) {
            this.items[index].isEditing = !this.items[index].isEditing;
        },

        duplicateItem(index) { 
            this.items.splice(index + 1, 0, JSON.parse(JSON.stringify(this.items[index]))); 
        },

        async removeItem(index) { 
            const item = this.items[index];
            this.askConfirm('Hapus Item?', 'Apakah Anda yakin ingin menghapus baris ini dari database?', 'danger', async () => {
                if (item.id) {
                    try {
                        await axios.delete(`/api/labels/${item.id}?type=${APP_TYPE}`);
                        this.notify('Item dihapus dari database', 'success');
                    } catch (err) {
                        console.error(err);
                        this.notify('Gagal menghapus dari database', 'error');
                        return;
                    }
                }
                
                this.items.splice(index, 1);
                if (this.items.length === 0) this.addItem();
                this.notify('Item berhasil dihapus', 'success');
            });
        },

        async clearAll() { 
            this.askConfirm('Reset Semua?', 'Semua data di CLOUD dan LOKAL akan dihapus permanen!', 'danger', async () => {
                try {
                    await axios.post('/api/labels/clear-all', { type: APP_TYPE });
                    this.items = []; 
                    this.addItem(); 
                    localStorage.removeItem(STORAGE_KEY);
                    this.notify('Semua data berhasil dibersihkan', 'success');
                } catch (err) {
                    console.error(err);
                    this.notify('Gagal membersihkan data cloud', 'error');
                }
            });
        },

        openSinglePreview(index) {
            this.previewItem = null;
            this.$nextTick(() => {
                this.previewItem = JSON.parse(JSON.stringify(this.items[index]));
                this.showSinglePreview = true;
            });
        },

        async printSingle(index) {
            this.printItems = [];

            this.$nextTick(async () => {
                this.printItems = [JSON.parse(JSON.stringify(this.items[index]))];
                await this.preloadImage(TEMPLATE_PATH);

                setTimeout(() => window.print(), 800);
            });
        },

        async printAll() {
            this.printItems = [];

            setTimeout(() => {
                this.printItems = this.items.map((item, i) => ({
                    ...item,
                    printKey: 'all-' + i + '-' + Date.now()
                }));

                this.$nextTick(async () => {
                    await this.preloadImage(TEMPLATE_PATH);
                    setTimeout(() => window.print(), 1500);
                });
            }, 100);
        }
    }
}


        
    </script>
    <!-- 🚀 FLOATING NOTIFICATIONS -->
    <div class="fixed top-6 right-6 z-[999] flex flex-col gap-3 w-80 pointer-events-none">
        <template x-for="n in notifications" :key="n.id">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-20"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-20"
                 :class="{
                    'bg-white border-green-500 text-green-700': n.type === 'success',
                    'bg-white border-red-500 text-red-700': n.type === 'error',
                    'bg-white border-blue-500 text-blue-700': n.type === 'info'
                 }"
                 class="pointer-events-auto flex items-center gap-3 p-4 rounded-2xl shadow-2xl border-l-4 overflow-hidden relative group">
                
                <div :class="n.type === 'success' ? 'bg-green-100 text-green-600' : (n.type === 'error' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600')"
                     class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0">
                    <template x-if="n.type === 'success'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </template>
                    <template x-if="n.type === 'error'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    </template>
                </div>

                <div class="flex flex-col">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-40" x-text="n.type === 'success' ? 'Berhasil' : 'Pesan Sistem'"></p>
                    <p class="text-xs font-bold leading-tight" x-text="n.message"></p>
                </div>

                <button @click="notifications = notifications.filter(x => x.id !== n.id)" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity p-1 hover:bg-slate-50 rounded-lg">
                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Progress Bar Anim -->
                <div class="absolute bottom-0 left-0 h-1 bg-current opacity-10 w-full animate-[progress_3s_linear]"></div>
            </div>
        </template>
    </div>

    <style>
        @keyframes progress {
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>
</body>
</html>
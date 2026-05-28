<style>
    /* 1. SETTINGAN PRINT KHUSUS A3 PORTRAIT (FORCE) */
    @media print {
        @page { 
            size: A3 portrait !important; 
            margin: 0 !important; 
        }
        .a3-canvas-final {
            width: 29.7cm !important;
            height: 42cm !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
            background-color: #1a1a1a !important;
            /* Memastikan background image beneran muncul saat di-print */
            background-image: url('/images/bg-pop-a3.jpg') !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            display: block !important;
        }
        
        /* Hilangkan efek blur saat print agar render tidak stuck/muter */
        .a3-benefit-box {
            background-color: rgba(0, 0, 0, 0.7) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
    }

    /* 2. TATA LETAK & STYLING LAYAR */
    .a3-canvas-final {
        width: 29.7cm; 
        height: 42cm;
        background-color: #1a1a1a;
        background-image: url('/images/bg-pop-a3.jpg'); 
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
        position: relative; 
        overflow: hidden; 
        flex-shrink: 0;
        color: white;
        font-family: 'Montserrat', sans-serif;
    }

    .a3-text-shadow {
        text-shadow: 0 10px 20px rgba(0,0,0,0.8);
    }

    .a3-strike-line {
        position: absolute; 
        top: 50%; 
        left: -5%; 
        width: 110%; 
        height: 10px; 
        background: #EE2D24; /* Garis merah lebih tegas untuk Yogya Standard */
        transform: rotate(-6deg); 
        box-shadow: 0 5px 15px rgba(0,0,0,0.4);
        border-radius: 10px;
    }

    .a3-benefit-box {
        position: absolute; 
        bottom: 1.5cm; 
        left: 1.5cm; 
        right: 1.5cm; 
        background-color: rgba(0, 0, 0, 0.4); 
        backdrop-filter: blur(15px); 
        -webkit-backdrop-filter: blur(15px);
        padding: 40px; 
        border-radius: 50px; 
        border: 1px solid rgba(255,255,255,0.1); 
        z-index: 20; 
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }
</style>

<div :id="'canvas-' + index" 
     :key="item.name + item.newPrice + index"
     class="a3-canvas-final">
    
    <div class="text-center mt-20 px-10 relative z-20">
        <h1 class="text-[140px] font-[900] uppercase tracking-tighter leading-none a3-text-shadow" 
            x-text="item.name"></h1>
        <p class="text-[40px] font-bold uppercase mt-2 tracking-[0.2em] a3-text-shadow" 
           x-text="item.sub"></p>
    </div>

    <div class="absolute top-[320px] left-0 right-0 flex flex-col items-center z-40 space-y-2">
        <div class="relative inline-block mb-2">
            <span class="text-7xl font-bold italic tracking-tight a3-text-shadow opacity-80">
                Rp<span x-text="item.oldPrice"></span>
            </span>
            <div class="a3-strike-line"></div>
        </div>
        
        <template x-if="item.isMember">
            <div class="bg-yellow-400 text-black px-8 py-2 rounded-full transform -rotate-2 shadow-lg mb-4">
                <p class="text-4xl font-[900] italic tracking-tighter uppercase leading-none">PROMO MEMBER</p>
            </div>
        </template>
        
        <div class="flex items-start">
            <span class="text-7xl font-black mt-12 mr-2 a3-text-shadow">Rp</span>
            <span class="text-[230px] font-[900] leading-[0.8] tracking-[-0.05em] drop-shadow-[0_15px_15px_rgba(0,0,0,0.5)]" 
                  x-text="item.newPrice"></span>
            <span class="text-3xl font-bold self-end mb-8 ml-2 uppercase tracking-widest opacity-80" 
                  x-text="item.unit || 'PER 100 GR'"></span>
        </div>

        <template x-if="item.isMember">
            <div class="text-center bg-black/40 p-4 px-10 rounded-[40px] backdrop-blur-sm border border-white/10 mt-8 shadow-xl">
                <p class="text-2xl font-black uppercase italic tracking-wider text-white/70">PROMO NON MEMBER</p>
                <p class="text-8xl font-black tracking-tighter">Rp<span x-text="item.nonMemberPrice"></span></p>
            </div>
        </template>
    </div>

    <div class="absolute bottom-48 left-1/2 -translate-x-1/2 w-[90%] flex justify-center z-10 pointer-events-none">
        <template x-if="item.image">
            <img :src="item.image.startsWith('data:') || item.image.startsWith('http') ? item.image : '/storage/' + item.image" 
                 class="max-w-full max-h-[550px] object-contain drop-shadow-[0_35px_35px_rgba(0,0,0,0.6)] transform scale-110">
        </template>
    </div>

    <div class="a3-benefit-box">
        <p class="text-[36px] leading-tight font-semibold italic text-center text-white tracking-tight" 
           x-text="item.benefit"></p>
    </div>

</div>
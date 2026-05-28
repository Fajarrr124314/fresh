<div class="h-full flex flex-col items-center justify-center p-6 bg-transparent">
    
    <div class="character-container mb-8">
        <div class="apple-body">
            <div class="leaf"></div>
            <div class="stem"></div>
            <div class="hard-hat">
                <div class="hat-line"></div>
            </div>
            <div class="eyes">
                <div class="eye left"></div>
                <div class="eye right"></div>
            </div>
            <div class="blush">
                <div class="dot left"></div>
                <div class="dot right"></div>
            </div>
            <div class="mouth"></div>
        </div>
        <div class="character-shadow"></div>
    </div>

    <div class="text-center">
        <h1 class="text-5xl font-[900] text-slate-800 uppercase tracking-tighter leading-none mb-4 animate-pulse">
            COMING SOON
        </h1>
        <p class="text-[12px] font-bold text-green-700 uppercase tracking-[0.4em] opacity-80">
            Fitur Acrylic Sedang Dirakit
        </p>
    </div>
</div>

<style>
    /* CSS Karakter Tetap Sama Seperti Sebelumnya */
    .character-container {
        position: relative;
        width: 200px;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: float 3s ease-in-out infinite;
    }

    .apple-body {
        position: relative;
        width: 140px;
        height: 120px;
        background: #ef4444;
        border-radius: 50% 50% 45% 45% / 60% 60% 40% 40%;
        box-shadow: inset -10px -10px 0 rgba(0,0,0,0.05);
    }

    .hard-hat {
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 50px;
        background: #fbbf24;
        border-radius: 100px 100px 10px 10px;
        border-bottom: 5px solid #d97706;
    }

    .hat-line {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 20px;
        background: rgba(255,255,255,0.5);
        border-radius: 2px;
    }

    .stem {
        position: absolute;
        top: -35px;
        left: 55%;
        width: 8px;
        height: 20px;
        background: #78350f;
        z-index: -1;
    }

    .leaf {
        position: absolute;
        top: -40px;
        left: 60%;
        width: 25px;
        height: 15px;
        background: #22c55e;
        border-radius: 0 100% 0 100%;
        transform: rotate(20deg);
        z-index: -1;
    }

    .eyes {
        position: absolute;
        top: 50px;
        width: 100%;
        display: flex;
        justify-content: space-around;
        padding: 0 30px;
    }

    .eye {
        width: 15px;
        height: 15px;
        background: #1e293b;
        border-radius: 50%;
        animation: blink 4s infinite;
    }

    .mouth {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 10px;
        border-bottom: 3px solid #1e293b;
        border-radius: 0 0 10px 10px;
    }

    .blush .dot {
        position: absolute;
        top: 65px;
        width: 15px;
        height: 8px;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
    }

    .blush .left { left: 20px; }
    .blush .right { right: 20px; }

    .character-shadow {
        position: absolute;
        bottom: -20px;
        width: 100px;
        height: 15px;
        background: rgba(0,0,0,0.05);
        border-radius: 50%;
        animation: shadow-scale 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    @keyframes shadow-scale {
        0%, 100% { transform: scale(1); opacity: 0.1; }
        50% { transform: scale(0.7); opacity: 0.05; }
    }

    @keyframes blink {
        0%, 90%, 100% { transform: scaleY(1); }
        95% { transform: scaleY(0.1); }
    }
</style>
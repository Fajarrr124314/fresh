<div class="print-page flex items-center justify-center">
    <div class="shelf-talker bg-white" 
         :key="item.name + item.newPrice + item.header"
         :class="index === 'preview' ? 'shadow-2xl' : ''"
         style="background-image: url('/images/template-label.jpg');">
        
        <div class="txt-header" x-text="item.header"></div>
        
        <div class="absolute top-[5.2cm] left-[1.5cm] max-w-[12cm]">
            <div class="text-black font-[900] text-[65px] leading-[0.85] uppercase tracking-tighter" 
                 x-text="item.name"></div>
            <div class="text-[#EE2D24] font-[800] text-[36px] uppercase tracking-tight mt-1" 
                 x-text="item.sub"></div>
        </div>
        
        <div class="txt-periode" style="top: 8.8cm; left: 1.5cm;">
            PERIODE: <span x-text="item.period"></span>
        </div>
        
        <div class="absolute top-[4.2cm] right-[1cm] w-[11.8cm] h-[7.3cm] bg-[#00712D] rounded-[50px] flex flex-col items-center justify-center px-6">
            
            <div class="flex items-center text-white mb-1" 
                 :style="item.isMember ? '' : 'transform: translateY(-10px)'">
                <span class="font-[900] text-[20px] mr-1 mt-2">Rp</span>
                <div class="relative inline-block font-[900] text-[52px] tracking-tighter leading-none">
                    <span x-text="item.oldPrice"></span>
                    <div class="absolute top-[55%] left-[-5%] w-[110%] h-1.5 bg-[#EE2D24] -rotate-[3deg] rounded-full shadow-sm"></div>
                </div>
            </div>

            <template x-if="item.isMember">
                <div class="flex flex-col items-center w-full leading-none">
                    <div class="bg-[#FFCC00] text-black px-4 py-1 rounded-full font-[900] text-[14px] uppercase mb-2 tracking-widest shadow-md transform -rotate-1">PROMO MEMBER</div>
                    <div class="flex items-start justify-center mb-2">
                        <span class="text-white font-[900] text-[35px] mt-7 mr-1">Rp</span>
                        <span class="text-[#FFCC00] font-[800] text-[120px] tracking-[-6px] leading-[0.7]" 
                              x-text="item.newPrice"></span>
                    </div>
                    <div class="text-white flex flex-col items-center">
                        <span class="text-[12px] font-black uppercase mb-0.5 tracking-tight">HARGA NON MEMBER</span>
                        <div class="flex items-center">
                            <span class="text-[14px] font-extrabold mr-1">Rp</span>
                            <span class="text-[#FFCC00] font-[800] text-[38px]" 
                                  x-text="item.nonMemberPrice"></span>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="!item.isMember">
                <div class="flex items-start justify-center leading-none mt-4">
                    <span class="text-white font-[900] text-[45px] mt-10 mr-1">Rp</span>
                    <span class="text-[#FFCC00] font-[900] text-[125px] tracking-[-8px] leading-[0.7]" 
                          x-text="item.newPrice"></span>
                </div>
            </template>

            <div class="absolute bottom-6 right-10 text-white font-[900] text-[14px] uppercase opacity-90" 
                 x-text="item.unit"></div>
        </div>
    </div>
</div>
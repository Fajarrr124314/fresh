<footer class="h-10 bg-white border-t border-slate-200 flex items-center justify-between px-8 text-[10px] text-slate-400 font-bold no-print shrink-0">
    <div>&copy; {{ date('Y') }} YOGYA GRAND KARAWANG - INTERNAL SYSTEM</div>
    <div class="flex gap-4">
        <span class="text-green-600">CONNECTED</span>
        <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
    </div>
</footer>
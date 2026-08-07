@php
    // TODO: Ganti masing-masing URL dummy di bawah ini dengan link foto asli dokumentasi desa yang diupload ke Cloudinary.
    $galleryImages = [
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785601888/WhatsApp_Image_2026-07-15_at_16.35.11_1_aq96qy.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785601887/WhatsApp_Image_2026-07-15_at_16.35.13_2_hke8jm.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785601887/WhatsApp_Image_2026-07-15_at_16.35.13_1_cjavvx.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785601872/WhatsApp_Image_2026-07-09_at_11.27.02_vkdede.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785601870/IMG_7609_kwzyec.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785600986/IMG_8111_c3nusp.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785600985/IMG_20260513_092844_2_sgcwq8.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785600978/IMG_20260513_111601_djmtp7.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785600968/WhatsApp_Image_2026-07-09_at_11.26.48_lwac73.jpg',
        'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785600965/WhatsApp_Image_2026-06-30_at_13.53.23_kz69xq.jpg',
    ];
@endphp

<div class="mt-24 border-t border-slate-700/50 pt-16" x-data="{ visibleCount: 5, totalPhotos: {{ count($galleryImages) }} }">
    
    <div class="text-center max-w-3xl mx-auto mb-10">
        <h3 class="text-2xl lg:text-3xl font-bold text-white">Galeri Kegiatan</h3>
        <p class="mt-3 text-slate-300">Potret keseruan rangkaian kegiatan Desa Cantik Kota Pariaman.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4">
        @foreach($galleryImages as $index => $imageUrl)
            @php
                // Logika pola Bento Grid: 1 kotak besar (2x2) dan 4 kotak kecil (1x1). Total 5 kotak per grup.
                $mod = $index % 5;
                if ($mod === 0) {
                    $spanClass = 'md:col-span-2 md:row-span-2';
                } else {
                    $spanClass = 'md:col-span-1 md:row-span-1';
                }
            @endphp
            <div x-show="{{ $index }} < visibleCount" 
                 x-transition.opacity.duration.500ms
                 class="{{ $spanClass }} rounded-3xl overflow-hidden group relative bg-slate-800 shadow-lg min-h-[200px]">
                
                <img src="{{ $imageUrl }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
                
                <div class="absolute inset-0 bg-navy-900/20 group-hover:bg-transparent transition-colors duration-300"></div>
            </div>
        @endforeach
    </div>

    {{-- Tombol Load More --}}
    <div class="mt-10 text-center">
        <button x-show="visibleCount < totalPhotos" 
                @click="visibleCount += 5" 
                class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-descan-500 text-white font-bold shadow-lg shadow-descan-500/20 hover:bg-descan-600 transition-all active:scale-95">
            Muat Lebih Banyak
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

</div>

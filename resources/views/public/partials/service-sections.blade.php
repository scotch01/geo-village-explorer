<div x-data="{
    active: {{ $services->first()?->id ?? 'null' }}
}">

    @foreach ($services as $service)
        <div x-show="active === {{ $service->id }}" x-transition.opacity class="space-y-10">

            {{-- ========================= --}}
            {{-- PILIHAN DESA --}}
            {{-- ========================= --}}
            <div class="flex flex-wrap gap-3 items-center justify-center">

                @foreach ($services as $item)
                    <button @click="active={{ $item->id }}"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition"
                        :class="active === {{ $item->id }} ?
                            'bg-navy-700 text-white shadow' :
                            'bg-slate-100 text-slate-700 hover:bg-navy-100 hover:text-navy-700'">

                        {{ $item->desa->nama_desa }}

                    </button>
                @endforeach

            </div>

            {{-- ========================= --}}
            {{-- INFORMASI --}}
            {{-- ========================= --}}
            <div class="grid grid-cols-1 gap-8">

                {{-- MAKLUMAT --}}
                <div class="max-w-3xl mx-auto w-full">
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

                        <h2 class="text-xl font-black text-slate-900 mb-5 text-center">

                            Maklumat Pelayanan

                        </h2>

                        @if ($service->maklumat_image)
                            <a href="{{ asset('storage/' . $service->maklumat_image) }}" target="_blank">

                                <img src="{{ asset('storage/' . $service->maklumat_image) }}"
                                    class="w-full rounded-2xl border border-slate-200 object-contain">

                            </a>
                        @else
                            <div
                                class="h-64 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center text-slate-400">

                                Maklumat belum tersedia.

                            </div>
                        @endif

                    </div>
                </div>

                {{-- CONTACT --}}
                <div class="max-w-3xl mx-auto w-full">
                    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

                        <h2 class="text-xl font-black text-slate-900 mb-6 text-center">

                            Informasi Layanan

                        </h2>

                        <div class="grid md:grid-cols-3 gap-8 text-center">

                            <div>

                                <div class="text-xs uppercase tracking-wider text-slate-500 mb-2">

                                    WhatsApp

                                </div>

                                @if ($service->whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $service->whatsapp) }}"
                                        target="_blank" class="font-semibold text-navy-700 hover:underline">

                                        {{ $service->whatsapp }}

                                    </a>
                                @else
                                    <span class="text-slate-400">

                                        -

                                    </span>
                                @endif

                            </div>

                            <div>

                                <div class="text-xs uppercase tracking-wider text-slate-500 mb-2">

                                    Email

                                </div>

                                @if ($service->email)
                                    <a href="mailto:{{ $service->email }}"
                                        class="font-semibold text-navy-700 hover:underline">

                                        {{ $service->email }}

                                    </a>
                                @else
                                    <span class="text-slate-400">

                                        -

                                    </span>
                                @endif

                            </div>

                            <div>

                                <div class="text-xs uppercase tracking-wider text-slate-500 mb-2">

                                    SOP Permintaan Data

                                </div>

                                @if ($service->sop_url)
                                    <a href="{{ $service->sop_url }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-5 py-1 rounded-xl bg-descan-500 hover:bg-descan-600 text-white font-semibold transition-all active:scale-95">

                                        Lihat SOP

                                    </a>
                                @else
                                    <span class="text-slate-400">

                                        SOP belum tersedia.

                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            {{-- ========================= --}}
            {{-- METODE --}}
            {{-- ========================= --}}
            <div>

                <h2 class="text-2xl font-black text-slate-900 mb-6 text-center">

                    Metode Pelayanan

                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($service->methods as $method)
                        <a href="{{ $method->url }}" target="_blank"
                            class="group bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition">

                            <div class="p-5">

                                <h3 class="font-bold text-slate-800 text-center">

                                    {{ $method->title }}

                                </h3>

                            </div>

                            <img src="{{ asset('storage/' . $method->image_path) }}"
                                class="w-full object-cover transition duration-300 group-hover:scale-105">
                        </a>

                    @empty

                        <div
                            class="col-span-full rounded-3xl border-2 border-dashed border-slate-200 py-16 text-center text-slate-400">

                            Belum ada metode pelayanan.

                        </div>
                    @endforelse

                </div>

            </div>

        </div>
    @endforeach

</div>

@foreach ($categories as $category)
    @php
        $desaGroups = $category->items->groupBy(fn($item) => $item->desa?->nama_desa ?? 'Tanpa Desa');
    @endphp

    <section id="{{ $category->slug }}" class="mb-6 scroll-mt-28" x-data="{ openCategory: false }">

        <div
            class="
                bg-white
                border
                border-slate-200
                rounded-3xl
                overflow-hidden
                shadow-sm
            ">

            {{-- HEADER --}}
            <button @click="openCategory=!openCategory"
                class="
                    w-full
                    px-8
                    py-6
                    flex
                    items-center
                    justify-between
                    hover:bg-slate-50
                    transition
                ">

                <div class="text-left">

                    <h2
                        class="
                            text-2xl
                            font-black
                            text-slate-900
                        ">

                        {{ $category->name }}

                    </h2>

                    <div
                        class="
                            mt-2
                            text-sm
                            text-slate-500
                        ">

                        {{ $category->items->groupBy('desa_id')->count() }}
                        Desa

                        •

                        {{ $category->items->count() }}
                        Dokumen

                    </div>

                </div>

                <svg class="w-6 h-6 transition" :class="openCategory ? 'rotate-180' : ''" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                </svg>

            </button>

            {{-- CONTENT --}}
            <div x-show="openCategory" x-collapse class="px-8 pb-8">

                @foreach ($desaGroups as $desaName => $items)
                    @php
                        $fileGroups = $items->groupBy('file_type');
                    @endphp

                    <div x-data="{ openVillage: false }"
                        class="
                            border
                            border-slate-200
                            rounded-2xl
                            overflow-hidden
                            mb-5
                        ">

                        {{-- HEADER DESA --}}
                        <button @click="openVillage=!openVillage"
                            class="
                                w-full
                                px-6
                                py-5
                                flex
                                justify-between
                                items-center
                                bg-slate-50
                                hover:bg-slate-100
                                transition
                            ">

                            <span
                                class="
                                    font-bold
                                    text-slate-800
                                ">

                                {{ $desaName }}

                            </span>

                            <svg class="w-5 h-5 transition" :class="openVillage ? 'rotate-180' : ''" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>

                        {{-- CONTENT DESA --}}
                        <div x-show="openVillage" x-collapse class="bg-white px-5 py-5 sm:px-6 sm:py-6">

                            @foreach ($fileGroups as $fileType => $documents)
                                <div class="{{ !$loop->last ? 'mb-8' : '' }}">

                                    {{-- ================================================= --}}
                                    {{-- IMAGE --}}
                                    {{-- ================================================= --}}
                                    @if ($fileType === 'image')
                                        <div
                                            class="
                        grid
                        grid-cols-1
                        sm:grid-cols-2
                        xl:grid-cols-3
                        gap-6
                    ">

                                            @foreach ($documents as $item)
                                                <div
                                                    class="
                                group
                            ">

                                                    <h4
                                                        class="
                                    text-center
                                    font-bold
                                    text-slate-800
                                    text-base
                                    mb-3
                                ">

                                                        {{ $item->title }}

                                                    </h4>

                                                    <a href="{{ asset('storage/' . $item->image_path) }}" target="_blank"
                                                        class="block">

                                                        <div
                                                            class="
                                        overflow-hidden
                                        rounded-2xl
                                        border
                                        border-slate-200
                                        bg-slate-100
                                        shadow-sm
                                    ">

                                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                                alt="{{ $item->title }}"
                                                                class="
                                            w-full
                                            h-auto
                                            object-cover
                                            transition
                                            duration-300
                                            group-hover:scale-105
                                        ">

                                                        </div>

                                                    </a>

                                                </div>
                                            @endforeach

                                        </div>
                                    @else
                                        {{-- ================================================= --}}
                                        {{-- PDF / EXCEL / DRIVE / LINK --}}
                                        {{-- ================================================= --}}

                                        <div
                                            class="
                        text-xs
                        font-bold
                        uppercase
                        tracking-[0.15em]
                        text-blue-700
                        mb-3
                    ">

                                            {{ $documents->first()->file_type_label }}

                                        </div>

                                        <div class="space-y-2">

                                            @foreach ($documents as $item)
                                                <a href="{{ $item->url }}" target="_blank"
                                                    class="
                                flex
                                items-start
                                gap-2
                                text-slate-700
                                hover:text-blue-600
                                transition
                            ">

                                                    <span>•</span>

                                                    <span>

                                                        {{ $item->title }}

                                                    </span>

                                                </a>
                                            @endforeach

                                        </div>
                                    @endif

                                    @if (!$loop->last)
                                        <hr class="mt-8 border-slate-200">
                                    @endif

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>
@endforeach

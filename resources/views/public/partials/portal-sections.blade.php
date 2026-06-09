@foreach ($categories as $category)

    @php
        $desaGroups = $category->items->groupBy(
            fn($item) => $item->desa?->nama_desa ?? 'Tanpa Desa'
        );
    @endphp

    <section
        id="{{ $category->slug }}"
        class="mb-6 scroll-mt-28"
        x-data="{ openCategory: false }"
    >

        {{-- CATEGORY ACCORDION --}}
        <div
            class="
                bg-white
                border border-slate-200
                rounded-3xl
                overflow-hidden
                shadow-sm
            "
        >

            <button
                @click="openCategory = !openCategory"
                class="
                    w-full
                    px-8 py-6
                    flex
                    items-center
                    justify-between
                    hover:bg-slate-50
                    transition
                "
            >

                <div class="text-left">

                    <h2
                        class="
                            text-2xl
                            font-black
                            text-slate-900
                        "
                    >
                        {{ $category->name }}
                    </h2>

                    <div
                        class="
                            mt-2
                            text-sm
                            text-slate-500
                        "
                    >

                        {{ $category->items->groupBy('desa_id')->count() }}
                        Desa

                        •

                        {{ $category->items->count() }}
                        Dokumen

                    </div>

                </div>

                <svg
                    class="w-6 h-6 transition"
                    :class="openCategory ? 'rotate-180' : ''"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>

            </button>

            {{-- CATEGORY CONTENT --}}
            <div
                x-show="openCategory"
                x-collapse
                class="px-8 pb-8"
            >

                @foreach ($desaGroups as $desaName => $items)

                    @php
                        $fileGroups = $items->groupBy('file_type');
                    @endphp

                    {{-- DESA ACCORDION --}}
                    <div
                        x-data="{ openVillage: false }"
                        class="
                            border border-slate-200
                            rounded-2xl
                            overflow-hidden
                            mb-4
                        "
                    >

                        <button
                            @click="openVillage = !openVillage"
                            class="
                                w-full
                                px-6 py-5
                                flex
                                items-center
                                justify-between
                                bg-slate-50
                                hover:bg-slate-100
                                transition
                            "
                        >

                            <span
                                class="
                                    font-bold
                                    text-slate-800
                                "
                            >
                                {{ $desaName }}
                            </span>

                            <svg
                                class="w-5 h-5 transition"
                                :class="openVillage ? 'rotate-180' : ''"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                        {{-- DESA CONTENT --}}
                        <div
                            x-show="openVillage"
                            x-collapse
                            class="px-6 py-6 bg-white"
                        >

                            @foreach ($fileGroups as $fileType => $documents)

                                <div class="mb-6">

                                    <div
                                        class="
                                            text-xs
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-blue-700
                                            mb-3
                                        "
                                    >
                                        {{ $fileType }}
                                    </div>

                                    <div class="space-y-2">

                                        @foreach ($documents as $item)

                                            <a
                                                href="{{ $item->url }}"
                                                target="_blank"
                                                class="
                                                    block
                                                    text-slate-700
                                                    hover:text-blue-600
                                                    hover:translate-x-1
                                                    transition
                                                "
                                            >

                                                • {{ $item->title }}

                                            </a>

                                        @endforeach

                                    </div>

                                    @if (! $loop->last)
                                        <hr class="mt-6 border-slate-200">
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
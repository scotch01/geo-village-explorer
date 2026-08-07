@extends('layouts.public')

@section('content')
    @include('public.partials.navbar')

    <section class="lg:py-24 py-16 bg-gradient-to-br from-descan-700 via-white to-blue-300">

        <div class="max-w-7xl mx-auto px-6">

            <div class="max-w-3xl items-center mx-auto text-center">

                <h1 class="mt-6 text-4xl md:text-5xl font-black text-slate-900">

                    Publikasi Desa Cantik

                </h1>

                <p class="mt-6 text-lg text-slate-600">

                    Kumpulan publikasi, data, dan infografis dan metadata resmi hasil pembinaan agen statistik untuk mewujudkan tata kelola data yang baik serta meningkatkan literasi statistik di tingkat Desa Cantik Kota Pariaman.

                </p>

            </div>

            <div class="mt-12">

                <div class="mt-12">

                    <div class="flex flex-wrap gap-3 mb-10 items-center justify-center">

                        @foreach ($categories as $category)
                            <a href="#{{ $category->slug }}"
                                class="px-4 py-2 rounded-full bg-slate-100 hover:bg-navy-100 hover:text-navy-700 text-sm font-semibold transition">
                                {{ $category->name }}
                            </a>
                        @endforeach

                    </div>

                    @include('public.partials.portal-sections', [
                        'categories' => $categories,
                    ])

                </div>

            </div>

        </div>

    </section>

    @include('public.partials.footer')
@endsection

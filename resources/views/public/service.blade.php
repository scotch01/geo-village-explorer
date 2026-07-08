@extends('layouts.public')

@section('content')

    @include('public.partials.navbar')

    <section class="lg:py-24 py-16 bg-gradient-to-br from-blue-100 via-white to-purple-100">

        <div class="max-w-7xl mx-auto px-6">

            {{-- HERO --}}
            <div class="max-w-3xl items-center mx-auto text-center">

                <span
                    class="inline-flex items-center px-4 py-2 rounded-full bg-cyan-100 text-cyan-700 text-sm font-bold">

                    Layanan Statistik

                </span>

                <h1
                    class="mt-6 text-4xl md:text-5xl font-black text-slate-900">

                    Layanan Desa Cantik

                </h1>

                <p
                    class="mt-6 text-lg text-slate-600">

                    Informasi layanan statistik Desa Cantik Kota Pariaman,
                    meliputi maklumat pelayanan, contact person,
                    SOP permintaan data, serta berbagai metode pelayanan
                    yang tersedia pada masing-masing desa.

                </p>

            </div>

            {{-- NAVIGASI DESA --}}
            <div class="mt-12">

                @include('public.partials.service-sections', [

                    'services' => $services,

                ])

            </div>

        </div>

    </section>

    @include('public.partials.footer')

@endsection
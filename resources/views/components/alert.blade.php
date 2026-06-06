{{-- SUCCESS --}}
@if (session('success'))
    <div
        class="mb-6 p-4 rounded-xl border border-green-200 bg-green-50 text-green-700 flex items-center gap-3">

        <svg class="w-5 h-5 shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>

        <span class="text-sm font-medium">
            {{ session('success') }}
        </span>
    </div>
@endif


{{-- UPDATE --}}
@if (session('warning'))
    <div
        class="mb-6 p-4 rounded-xl border border-amber-200 bg-amber-50 text-amber-700 flex items-center gap-3">

        <svg class="w-5 h-5 shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 8v4m0 4h.01"/>
        </svg>

        <span class="text-sm font-medium">
            {{ session('warning') }}
        </span>
    </div>
@endif


{{-- DELETE --}}
@if (session('danger'))
    <div
        class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700 flex items-center gap-3">

        <svg class="w-5 h-5 shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>

        <span class="text-sm font-medium">
            {{ session('danger') }}
        </span>
    </div>
@endif


{{-- ERROR --}}
@if (session('error'))
    <div
        class="mb-6 p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-700 flex items-center gap-3">

        <svg class="w-5 h-5 shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 8v4m0 4h.01"/>
        </svg>

        <span class="text-sm font-medium">
            {{ session('error') }}
        </span>
    </div>
@endif
<a href="{{ $href }}"
   class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 rounded-xl text-sm font-semibold text-slate-700 transition-all active:scale-95">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 19l-7-7 7-7" />

    </svg>

    {{ $slot }}
</a>
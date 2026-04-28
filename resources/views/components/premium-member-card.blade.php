@props(['member'])

<div class="group flex flex-col items-center w-full max-w-[260px] mx-auto">
    <div
        class="relative w-full aspect-[4/5] overflow-hidden shadow-2xl transition-all duration-500 group-hover:shadow-primary/20 group-hover:-translate-y-2 border border-slate-200">
        {{-- Member Photo --}}
        @if ($member->image)
            <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}"
                class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                <i class="fas fa-user text-5xl"></i>
            </div>
        @endif
    </div>

    {{-- Info Below Card --}}
    <div class="mt-4 text-center space-y-1 px-2">
        <h3
            class="font-black text-slate-900 text-lg md:text-xl uppercase tracking-tight group-hover:text-primary transition-colors leading-tight">
            {{ $member->name }}
        </h3>
        <p class="text-slate-500 font-extrabold text-[10px] md:text-[11px] uppercase tracking-[0.2em]">
            {{ $member->position->name }}
        </p>
        @if ($member->npm)
            <p class="text-slate-400 font-mono text-[10px] mt-1">{{ $member->npm }}</p>
        @endif
    </div>
</div>

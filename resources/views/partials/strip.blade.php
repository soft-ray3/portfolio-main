<div class="my-4 overflow-hidden py-14 sm:my-8" aria-hidden="true">
    <div class="mx-[-5%] origin-center scale-105 -rotate-[1.4deg] overflow-hidden bg-ink py-6">
        <div class="marquee-track">
            @foreach (array_merge(config('portfolio.strip'), config('portfolio.strip')) as $item)
                <span class="mx-6 shrink-0 text-2xl font-medium text-white/80 sm:text-3xl" style="font-family: var(--font-display)">
                    {{ $item }}
                </span>
            @endforeach
        </div>
    </div>
</div>

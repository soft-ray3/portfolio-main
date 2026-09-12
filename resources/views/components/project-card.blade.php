@props(['project'])

<article
    data-tilt
    class="tilt-card rv group overflow-hidden rounded-card border border-line bg-card shadow-soft transition-shadow hover:shadow-lift"
>
    <div class="tilt-thumb relative aspect-[16/10] overflow-hidden">
        {{-- Gradient placeholder shown behind the image; stays visible if the file is missing --}}
        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#FFE4D2] to-[#FFF7F1]" aria-hidden="true">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FF5C28" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.6">
                <rect x="3" y="4" width="18" height="16" rx="2"/>
                <path d="m3 15 4.5-4.5a2 2 0 0 1 2.8 0L15 15"/>
                <path d="m14 14 1.5-1.5a2 2 0 0 1 2.8 0L21 15"/>
                <circle cx="8" cy="8.5" r="1.5"/>
            </svg>
        </div>

        <img
            src="{{ $project['thumbnail'] }}"
            alt="{{ $project['title'] }} project thumbnail"
            loading="lazy"
            class="relative h-full w-full object-cover"
            onerror="this.style.display='none'"
        >

        <span class="label absolute right-3 top-3 rounded-pill bg-card/90 px-3 py-1 text-muted shadow-soft">
            {{ $project['status'] === 'live' ? 'Live' : 'In progress' }}
        </span>
    </div>

    <div class="tilt-body p-6">
        <h3 class="text-xl font-semibold text-ink">{{ $project['title'] }}</h3>

        @if(!empty($project['short']))
            <p class="mt-2 text-sm text-muted">{{ $project['short'] }}</p>
        @endif

        <a
            href="{{ route('projects.show', $project['slug']) }}"
            class="mt-5 inline-flex items-center gap-2 rounded-pill bg-ink px-5 py-2.5 text-sm font-medium text-white transition hover:bg-accent"
        >
            <span>View project</span>
            <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
                <path d="m13 6 6 6-6 6"/>
            </svg>
        </a>
    </div>
</article>

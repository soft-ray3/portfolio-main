<x-layout
    :title="$project['title'] . ' | ' . config('portfolio.name')"
    :description="$project['blurb']"
    :og-image="$project['thumbnail']"
    :canonical="config('portfolio.url') . '/work/' . $project['slug']"
>
    <main class="px-4 pb-28 pt-16 sm:pt-24">
        <div class="mx-auto max-w-4xl">

            <a
                href="{{ route('home') }}#work"
                class="label inline-flex items-center gap-2 text-muted transition hover:text-accent"
            >
                <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"/>
                    <path d="m12 19-7-7 7-7"/>
                </svg>
                <span>Back to work</span>
            </a>

            <div class="mt-8 flex flex-wrap items-start justify-between gap-6">
                <div>
                    <span class="label rounded-pill border border-line px-3 py-1 text-muted">
                        {{ $project['status'] === 'live' ? 'Live' : 'In progress' }}
                    </span>
                    <h1 class="mt-4 text-4xl font-semibold text-ink sm:text-5xl">{{ $project['title'] }}</h1>
                </div>

                @if ($project['url'])
                    <a
                        href="{{ $project['url'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex shrink-0 items-center gap-2 rounded-pill bg-ink px-6 py-3 text-sm font-medium text-white shadow-soft transition hover:bg-accent"
                    >
                        <span>Visit live site</span>
                        <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 17 17 7"/>
                            <path d="M7 7h10v10"/>
                        </svg>
                    </a>
                @endif
            </div>

            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-muted">
                {{ $project['blurb'] }}
            </p>

            <ul class="mt-6 flex flex-wrap gap-2">
                @foreach ($project['tags'] as $tag)
                    <li class="label rounded-pill border border-line px-3 py-1 text-dim">{{ $tag }}</li>
                @endforeach
            </ul>

            <div class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach ($project['gallery'] as $image)
                    <div class="relative aspect-[16/10] overflow-hidden rounded-card border border-line bg-card shadow-soft">
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#FFE4D2] to-[#FFF7F1]" aria-hidden="true">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FF5C28" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.6">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <path d="m3 15 4.5-4.5a2 2 0 0 1 2.8 0L15 15"/>
                                <path d="m14 14 1.5-1.5a2 2 0 0 1 2.8 0L21 15"/>
                                <circle cx="8" cy="8.5" r="1.5"/>
                            </svg>
                        </div>
                        <img
                            src="{{ $image }}"
                            alt="{{ $project['title'] }} screenshot"
                            loading="lazy"
                            class="relative h-full w-full object-cover"
                            onerror="this.style.display='none'"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</x-layout>

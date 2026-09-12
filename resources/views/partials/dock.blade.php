<header class="fixed inset-x-0 bottom-4 z-50 flex justify-center px-4">
    <nav aria-label="Primary" class="max-w-full">
        <div class="mx-auto flex w-fit max-w-full items-center justify-center gap-1 overflow-x-auto rounded-pill border border-line bg-white/82 px-2 py-2 no-scrollbar shadow-soft backdrop-blur-xl backdrop-saturate-[1.8]">
            <a href="{{ route('home') }}#home" aria-label="Home" title="Home" class="shrink-0 rounded-full p-2.5 text-ink transition hover:bg-ink/5">
                <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 11 9-8 9 8"/>
                    <path d="M5 10v10h14V10"/>
                    <path d="M9 21v-6h6v6"/>
                </svg>
            </a>

            <a href="{{ route('home') }}#work" aria-label="Work" title="Work" class="shrink-0 rounded-full p-2.5 text-ink transition hover:bg-ink/5">
                <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                </svg>
            </a>

            <a href="{{ route('home') }}#about" aria-label="About" title="About" class="shrink-0 rounded-full p-2.5 text-ink transition hover:bg-ink/5">
                <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21c1.5-4.5 5-6 8-6s6.5 1.5 8 6"/>
                </svg>
            </a>

            <span aria-hidden="true" class="mx-1 h-5 w-px shrink-0 bg-line"></span>

           

            <a
                href="{{ config('portfolio.socials.x') }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="X, formerly Twitter"
                title="X"
                class="shrink-0 rounded-full p-2.5 text-ink transition hover:bg-ink/5"
            >
                <svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.9 1.5h3.7l-8.1 9.3 9.5 12.7h-7.5l-5.9-7.7-6.7 7.7H.4l8.7-9.9L0 1.5h7.6l5.4 7.1Zm-1.3 19.5h2L6.5 3.4h-2Z"/>
                </svg>
            </a>

            <a
                href="{{ config('portfolio.socials.tiktok') }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="TikTok"
                title="TikTok"
                class="shrink-0 rounded-full p-2.5 text-ink transition hover:bg-ink/5"
            >
                <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16.6 5.82c-.9-.8-1.44-1.94-1.44-3.2h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.59-1.16-2.59-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/>
                </svg>
            </a>

           
        </div>
    </nav>
</header>

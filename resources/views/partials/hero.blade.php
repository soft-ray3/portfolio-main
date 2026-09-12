<section id="home" class="relative flex min-h-[92vh] items-center overflow-hidden px-4 py-20" aria-labelledby="hero-heading">

    {{-- 3D scene, filling the whole hero as a background layer --}}
    <div id="hero-scene" class="absolute inset-0 z-0">
        <canvas id="hero-canvas" class="h-full w-full"></canvas>

        <div id="hero-fallback" hidden class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#FFE4D2] to-[#FFF7F1]">
            <svg aria-hidden="true" width="220" height="220" viewBox="0 0 100 100" fill="none" stroke="#FF5C28" stroke-width="1.5">
                <path d="M50 8 88 29v42L50 92 12 71V29Z"/>
                <path d="M12 29 50 50l38-21"/>
                <path d="M50 50v42"/>
            </svg>
        </div>
    </div>

    {{-- Scrim so the centered text stays legible over the scene --}}
    <div class="pointer-events-none absolute inset-0 z-[1] bg-gradient-to-r from-bg/10 via-bg/80 to-bg/10" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-0 z-[1] bg-gradient-to-t from-bg via-transparent to-transparent" aria-hidden="true"></div>

    <span
        id="hero-drag-badge"
        class="label pointer-events-none absolute bottom-6 right-6 z-10 rounded-pill bg-white/82 px-3 py-1.5 text-muted shadow-soft backdrop-blur-xl transition-opacity duration-300"
    >
        Drag to rotate
    </span>

    {{-- Text content, on top of the scene. The wrapper is click-through so
         empty space beside the copy still lets visitors drag the scene. --}}
    <div class="pointer-events-none relative z-10 mx-auto w-full max-w-6xl">
        <div class="pointer-events-auto mx-auto max-w-2xl text-center">
           
            <h1 id="hero-heading" class="mt-8 text-5xl font-semibold leading-[1.02] text-ink sm:text-6xl lg:text-7xl">
                <span class="line-mask">
                    <span class="line-inner">Hey, I'm</span>
                </span>
                <span class="line-mask">
                    <span class="line-inner text-accent">Raymond.</span>
                </span>
                <span class="line-mask">
                    <span class="line-inner">
                        I build
                        <span id="hero-word-swap" class="inline-block transition-all duration-300 ease-out">products.</span>
                    </span>
                </span>
            </h1>

            <p class="mx-auto mt-8 max-w-xl text-lg leading-relaxed text-muted">
                Turning ideas into sleek, modern digital experiences through creativity and code.
            </p>

            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="#work" class="inline-flex items-center gap-2 rounded-pill bg-ink px-6 py-3.5 text-sm font-medium text-white shadow-soft transition hover:bg-accent">
                    <span>See my work</span>
                    <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="m13 6 6 6-6 6"/>
                    </svg>
                </a>
                <a href="#contact" class="inline-flex items-center gap-2 rounded-pill border border-line bg-card px-6 py-3.5 text-sm font-medium text-ink shadow-soft transition hover:border-accent hover:text-accent">
                    Get in touch
                </a>
            </div>
        </div>
    </div>
</section>

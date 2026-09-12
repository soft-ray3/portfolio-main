<section id="about" class="px-4 py-24" aria-labelledby="about-heading">
    <div class="mx-auto max-w-6xl">
        <div class="grid grid-cols-1 gap-14 md:grid-cols-2 md:items-start">

            {{-- Left: copy --}}
            <div class="rv">
                <span class="label text-accent">Get to Know Me</span>
                <h2 id="about-heading" class="mt-3 text-3xl font-semibold text-ink sm:text-4xl">About Me</h2>  

                <div class="mt-8 space-y-5 text-base leading-relaxed text-muted sm:text-lg">
                    <p>
                        I'm Ugochukwu Raymond. I'm a software engineer and founder based in Delta State Nigeria, building products that solve real problems for real people.
                    </p>
                    <p>
                        My work sits at the intersection of <strong class="font-semibold text-ink">design, engineering, and product thinking</strong>. 
                    </p>
                    <p>
                        I'm the founder of <strong class="font-semibold text-ink">DMART</strong> and <strong class="font-semibold text-ink">Kiosc</strong>, two live products with real users. Building them solo taught me to move fast without cutting corners, and to care about the details that make software feel trustworthy.
                    </p>
                    <p>
                        Outside of my own products, I take on client work, bringing the same standard: clean code, thoughtful design, and software people actually enjoy using.
                    </p>
                </div>

                <p class="mt-8 text-lg font-semibold text-ink sm:text-xl">
                    I build. I ship. I keep raising the bar.
                </p>
            </div>

            {{-- Right: portrait gallery --}}
            <div class="rv relative h-[420px] sm:h-[520px]">
                <div class="group absolute left-0 top-0 w-[62%] max-w-xs transition-transform duration-500 ease-out hover:-translate-y-1 hover:-rotate-1">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-card border border-line bg-card shadow-lift">
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#FFE4D2] to-[#FFF7F1]" aria-hidden="true">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#FF5C28" stroke-width="1.3" opacity="0.6">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21c1.5-4.5 5-6 8-6s6.5 1.5 8 6"/>
                            </svg>
                        </div>
                        <img
                            src="{{ config('portfolio.images.about1') }}"
                            alt="Portrait of {{ config('portfolio.name') }}"
                            loading="lazy"
                            class="relative h-full w-full object-cover"
                            onerror="this.style.display='none'"
                        >
                    </div>
                    <span class="label absolute bottom-3 left-3 rounded-pill bg-white/82 px-3 py-1 text-muted shadow-soft backdrop-blur-xl">
                        {{ '@' . config('portfolio.handle') }}
                    </span>
                </div>

                <div class="group absolute right-0 top-[34px] w-[62%] max-w-xs transition-transform duration-500 ease-out hover:-translate-y-1 hover:-rotate-1">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-card border border-line bg-card shadow-lift">
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#FFE4D2] to-[#FFF7F1]" aria-hidden="true">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#FF5C28" stroke-width="1.3" opacity="0.6">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21c1.5-4.5 5-6 8-6s6.5 1.5 8 6"/>
                            </svg>
                        </div>
                        <img
                            src="{{ config('portfolio.images.about2') }}"
                            alt="Portrait of {{ config('portfolio.name') }}, second photo"
                            loading="lazy"
                            class="relative h-full w-full object-cover"
                            onerror="this.style.display='none'"
                        >
                    </div>
                    <span class="label absolute bottom-3 left-3 rounded-pill bg-white/82 px-3 py-1 text-muted shadow-soft backdrop-blur-xl">
                        {{ '@' . config('portfolio.handle') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

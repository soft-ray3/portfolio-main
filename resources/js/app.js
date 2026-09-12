import './bootstrap';
import { initTilt } from './tilt';

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Fades and lifts any [.rv] element into place the first time it enters
 * the viewport, then stops observing it.
 */
function initReveal() {
    const items = document.querySelectorAll('.rv');

    if (!items.length) {
        return;
    }

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('in'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    items.forEach((el) => observer.observe(el));
}

/**
 * Staggers the hero headline's three lines up into place on load.
 */
function initHeadlineReveal() {
    const lines = document.querySelectorAll('#hero-heading .line-inner');

    if (!lines.length) {
        return;
    }

    if (prefersReducedMotion) {
        lines.forEach((el) => el.classList.add('in'));
        return;
    }

    lines.forEach((el, index) => {
        window.setTimeout(() => el.classList.add('in'), 120 + index * 80);
    });
}

/**
 * Writes the footer's wordmark in, one letter at a time, as soon as it
 * starts entering view while scrolling down. The moment the visitor
 * reverses direction and starts scrolling back up, it immediately erases
 * in reverse (last letter first) — it doesn't wait for the word to
 * actually leave the viewport, just for upward motion to begin.
 */
function initFooterSignatureReveal() {
    const wordmark = document.getElementById('footer-signature');

    if (!wordmark) {
        return;
    }

    const letters = Array.from(wordmark.querySelectorAll('.line-inner'));

    if (!letters.length) {
        return;
    }

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        letters.forEach((el) => el.classList.add('in'));
        return;
    }

    const staggerStep = 140;
    let timers = [];
    let isWritten = false;
    let isVisible = false;
    let lastY = window.scrollY;

    function clearPendingTimers() {
        timers.forEach((id) => window.clearTimeout(id));
        timers = [];
    }

    function write() {
        if (isWritten) {
            return;
        }

        isWritten = true;
        wordmark.classList.add('footer-signature-writing');
        wordmark.classList.remove('footer-signature-erasing');
        clearPendingTimers();
        letters.forEach((el, index) => {
            timers.push(window.setTimeout(() => el.classList.add('in'), index * staggerStep));
        });
    }

    function erase() {
        if (!isWritten) {
            return;
        }

        isWritten = false;
        wordmark.classList.add('footer-signature-erasing');
        wordmark.classList.remove('footer-signature-writing');
        clearPendingTimers();
        [...letters].reverse().forEach((el, index) => {
            timers.push(window.setTimeout(() => el.classList.remove('in'), index * staggerStep));
        });
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            isVisible = entry.isIntersecting;

            if (isVisible && window.scrollY >= lastY) {
                write();
            }
        });
    }, { threshold: 0 });

    observer.observe(wordmark);

    window.addEventListener('scroll', () => {
        const currentY = window.scrollY;
        const scrollingUp = currentY < lastY;

        if (scrollingUp) {
            erase();
        } else if (isVisible) {
            write();
        }

        lastY = currentY;
    }, { passive: true });
}

/**
 * Cycles the trailing word of the hero's third headline line, forever:
 * "products." -> "mine." -> "and yours." -> back to "products." -> ...
 * each swap 3s apart.
 */
function initHeroWordSwap() {
    const el = document.getElementById('hero-word-swap');

    if (!el) {
        return;
    }

    // Reduced motion: leave the static "products." already in the markup,
    // no looping text change.
    if (prefersReducedMotion) {
        return;
    }

    const words = ['products.', 'mine.', 'and yours.'];
    const stepDelay = 3000;
    const fadeDuration = 300;
    let index = 0;

    function swapTo(text) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(8px)';

        window.setTimeout(() => {
            el.textContent = text;
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, fadeDuration);
    }

    window.setInterval(() => {
        index = (index + 1) % words.length;
        swapTo(words[index]);
    }, stepDelay);
}

/**
 * Same "ease out expo" feel as the rest of the site's motion, applied to
 * in-page anchor navigation (the dock's Home/Work/About icons, and any
 * other #section link) instead of the browser's instant/linear jump.
 */
function initSmoothAnchorScroll() {
    const links = document.querySelectorAll('a[href*="#"]');

    if (!links.length) {
        return;
    }

    function easeOutExpo(t) {
        return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
    }

    links.forEach((link) => {
        link.addEventListener('click', (event) => {
            let url;

            try {
                url = new URL(link.href, window.location.href);
            } catch (error) {
                return;
            }

            // Only take over links that point at a section on THIS page.
            if (url.pathname !== window.location.pathname || !url.hash) {
                return;
            }

            let target;

            try {
                target = document.querySelector(url.hash);
            } catch (error) {
                return;
            }

            if (!target) {
                return;
            }

            event.preventDefault();

            if (prefersReducedMotion) {
                target.scrollIntoView({ block: 'start' });
                history.pushState(null, '', url.hash);
                return;
            }

            const startY = window.scrollY;
            const endY = Math.max(
                0,
                Math.min(
                    target.getBoundingClientRect().top + startY,
                    document.documentElement.scrollHeight - window.innerHeight
                )
            );
            const distance = endY - startY;
            const duration = 700;
            const startTime = performance.now();

            function step(now) {
                const progress = Math.min((now - startTime) / duration, 1);
                window.scrollTo(0, startY + distance * easeOutExpo(progress));

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    history.pushState(null, '', url.hash);
                }
            }

            requestAnimationFrame(step);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initHeadlineReveal();
    initHeroWordSwap();
    initFooterSignatureReveal();
    initTilt();
    initSmoothAnchorScroll();

    // Three.js is a heavy dependency (~150KB gzipped). Split it into its
    // own chunk so it never blocks the initial page render, and only
    // fetch it at all when the hero scene is actually on the page.
    if (document.getElementById('hero-scene')) {
        import('./three-hero').then(({ initThreeHero }) => initThreeHero());
    }
});

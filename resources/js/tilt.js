/**
 * 3D pointer tilt for project cards.
 *
 * Any element with [data-tilt] gets perspective rotation driven by pointer
 * position, plus a small lift. Skipped entirely on touch devices and when
 * the visitor prefers reduced motion.
 */
export function initTilt() {
    const cards = document.querySelectorAll('[data-tilt]');

    if (!cards.length) {
        return;
    }

    const isTouch = window.matchMedia('(hover: none), (pointer: coarse)').matches;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (isTouch || prefersReducedMotion) {
        return;
    }

    const maxRotateX = 7;
    const maxRotateY = 9;
    const lift = 6;

    cards.forEach((card) => {
        const reset = () => {
            card.style.transform = '';
        };

        card.addEventListener('pointermove', (event) => {
            const rect = card.getBoundingClientRect();
            const relativeX = (event.clientX - rect.left) / rect.width;
            const relativeY = (event.clientY - rect.top) / rect.height;

            const rotateY = (relativeX - 0.5) * 2 * maxRotateY;
            const rotateX = (0.5 - relativeY) * 2 * maxRotateX;

            card.style.transform =
                `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-${lift}px)`;
        });

        card.addEventListener('pointerleave', reset);
        card.addEventListener('pointercancel', reset);
    });
}

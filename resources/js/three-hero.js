import * as THREE from 'three';

/**
 * The hero's 3D scene: a rotating torus knot with five orbiting shapes.
 * Lazy-initialised once visible, skipped when WebGL is unavailable or the
 * visitor prefers reduced motion (a static SVG fallback is shown instead).
 */
export function initThreeHero() {
    const container = document.getElementById('hero-scene');
    const canvas = document.getElementById('hero-canvas');
    const fallback = document.getElementById('hero-fallback');
    const badge = document.getElementById('hero-drag-badge');

    if (!container || !canvas) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !isWebglAvailable()) {
        showFallback();
        return;
    }

    let started = false;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting && !started) {
                started = true;
                start();
                observer.disconnect();
            }
        });
    }, { threshold: 0.15 });

    observer.observe(container);

    function isWebglAvailable() {
        try {
            const testCanvas = document.createElement('canvas');
            return !!(
                window.WebGLRenderingContext &&
                (testCanvas.getContext('webgl') || testCanvas.getContext('experimental-webgl'))
            );
        } catch (error) {
            return false;
        }
    }

    function showFallback() {
        canvas.hidden = true;
        if (fallback) {
            fallback.hidden = false;
        }
    }

    function start() {
        let renderer;

        try {
            renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        } catch (error) {
            showFallback();
            return;
        }

        renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
        renderer.setSize(container.clientWidth, container.clientHeight);

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(
            42,
            container.clientWidth / container.clientHeight,
            0.1,
            100
        );
        camera.position.z = 9;

        scene.add(new THREE.AmbientLight(0xffffff, 0.72));

        const key = new THREE.DirectionalLight(0xffffff, 0.95);
        key.position.set(4, 6, 6);
        scene.add(key);

        const rim = new THREE.DirectionalLight(0xff5c28, 0.55);
        rim.position.set(-6, -3, 3);
        scene.add(rim);

        const fill = new THREE.DirectionalLight(0x1b4dff, 0.35);
        fill.position.set(-3, 5, -5);
        scene.add(fill);

        const group = new THREE.Group();
        scene.add(group);

        const knot = new THREE.Mesh(
            new THREE.TorusKnotGeometry(1.5, 0.46, 180, 28),
            new THREE.MeshStandardMaterial({ color: 0xff5c28, roughness: 0.28, metalness: 0.22 })
        );
        group.add(knot);

        const orbiters = [
            {
                mesh: new THREE.Mesh(
                    new THREE.IcosahedronGeometry(0.32),
                    new THREE.MeshStandardMaterial({ color: 0x1b4dff, roughness: 0.35, metalness: 0.2 })
                ),
                radius: 3.1, speed: 0.6, height: 0.4, offset: 0,
            },
            {
                mesh: new THREE.Mesh(
                    new THREE.BoxGeometry(0.42, 0.42, 0.42),
                    new THREE.MeshStandardMaterial({ color: 0x14120f, roughness: 0.4, metalness: 0.1 })
                ),
                radius: 3.6, speed: -0.45, height: -0.6, offset: 1.2,
            },
            {
                mesh: new THREE.Mesh(
                    new THREE.SphereGeometry(0.3, 24, 24),
                    new THREE.MeshStandardMaterial({ color: 0xffb38f, roughness: 0.5, metalness: 0.05 })
                ),
                radius: 2.6, speed: 0.75, height: 0.9, offset: 2.4,
            },
            {
                mesh: new THREE.Mesh(
                    new THREE.TorusGeometry(0.28, 0.1, 16, 32),
                    new THREE.MeshStandardMaterial({ color: 0xffd166, roughness: 0.4, metalness: 0.15 })
                ),
                radius: 3.9, speed: 0.35, height: -0.3, offset: 3.6,
            },
            {
                mesh: new THREE.Mesh(
                    new THREE.OctahedronGeometry(0.34),
                    new THREE.MeshStandardMaterial({ color: 0x1b4dff, roughness: 0.3, metalness: 0.25 })
                ),
                radius: 3.3, speed: -0.55, height: 0.2, offset: 4.8,
            },
        ];

        orbiters.forEach((orbiter) => group.add(orbiter.mesh));

        let isDragging = false;
        let lastX = 0;
        let lastY = 0;
        const dragRotation = { x: 0, y: 0 };
        const driftTarget = { x: 0, y: 0 };
        const drift = { x: 0, y: 0 };

        canvas.addEventListener('pointerdown', (event) => {
            isDragging = true;
            lastX = event.clientX;
            lastY = event.clientY;
            canvas.setPointerCapture(event.pointerId);

            if (badge) {
                badge.style.opacity = '0';
            }
        });

        canvas.addEventListener('pointermove', (event) => {
            if (!isDragging) {
                return;
            }

            dragRotation.y += (event.clientX - lastX) * 0.006;
            dragRotation.x += (event.clientY - lastY) * 0.006;
            lastX = event.clientX;
            lastY = event.clientY;
        });

        const endDrag = (event) => {
            isDragging = false;
            try {
                canvas.releasePointerCapture(event.pointerId);
            } catch (error) {
                // Pointer capture may already be released; ignore.
            }
        };

        canvas.addEventListener('pointerup', endDrag);
        canvas.addEventListener('pointercancel', endDrag);

        window.addEventListener('mousemove', (event) => {
            const normalisedX = (event.clientX / window.innerWidth) * 2 - 1;
            const normalisedY = (event.clientY / window.innerHeight) * 2 - 1;
            driftTarget.x = normalisedY * 0.15;
            driftTarget.y = normalisedX * 0.15;
        });

        const clock = new THREE.Clock();

        function animate() {
            const elapsed = clock.getElapsedTime();

            knot.rotation.x += 0.0035;
            knot.rotation.y += 0.005;

            orbiters.forEach((orbiter) => {
                const angle = elapsed * orbiter.speed + orbiter.offset;
                orbiter.mesh.position.set(
                    Math.cos(angle) * orbiter.radius,
                    orbiter.height + Math.sin(angle * 1.3) * 0.4,
                    Math.sin(angle) * orbiter.radius
                );
                orbiter.mesh.rotation.x += 0.01;
                orbiter.mesh.rotation.y += 0.015;
                orbiter.mesh.scale.setScalar(1 + Math.sin(elapsed * 2 + orbiter.offset) * 0.12);
            });

            drift.x += (driftTarget.x - drift.x) * 0.04;
            drift.y += (driftTarget.y - drift.y) * 0.04;

            group.rotation.x = dragRotation.x + drift.x;
            group.rotation.y = dragRotation.y + drift.y;

            renderer.render(scene, camera);
            requestAnimationFrame(animate);
        }

        animate();

        window.addEventListener('resize', () => {
            const width = container.clientWidth;
            const height = container.clientHeight;
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        });
    }
}

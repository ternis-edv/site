<?php
require_once __DIR__ . '/partials/header.php';
?>
    <main>
        <section class="error-page-v2">
            <div class="error-grid-overlay"></div>
            <div class="error-container">
                <div class="error-label reveal">// Status 404</div>
                <h1 class="error-title reveal">Seite <span>nicht</span> gefunden.</h1>
                <p class="error-msg reveal">Es sieht so aus, als hätte sich diese Seite in den unendlichen Weiten des Webs verirrt. Aber keine Sorge, wir navigieren dich sicher zurück.</p>
                <div class="error-actions reveal">
                    <a href="/" class="btn-p mag-link">Zurück zur Startseite</a>
                    <a href="/#contact" class="btn-g mag-link">Kontakt aufnehmen</a>
                </div>
            </div>
            <div class="error-visual reveal">
                <div class="mascot-v2-container">
                    <div class="mascot-v2 mag-link">
                        <div class="mascot-face">
                            <div class="m-eye"></div>
                            <div class="m-eye"></div>
                        </div>
                        <div class="m-mouth"></div>
                    </div>
                    <div class="mascot-shadow"></div>
                </div>
            </div>
        </section>
    </main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const eyes = document.querySelectorAll('.m-eye');
        if (eyes.length > 0) {
            document.addEventListener('mousemove', (e) => {
                const mouseX = e.clientX;
                const mouseY = e.clientY;

                eyes.forEach(eye => {
                    const rect = eye.getBoundingClientRect();
                    const eyeCenterX = rect.left + rect.width / 2;
                    const eyeCenterY = rect.top + rect.height / 2;

                    const deltaX = mouseX - eyeCenterX;
                    const deltaY = mouseY - eyeCenterY;

                    // Calculate max movement distance
                    const maxDist = 8;
                    const angle = Math.atan2(deltaY, deltaX);
                    const dist = Math.min(Math.hypot(deltaX, deltaY) / 20, maxDist);

                    const moveX = Math.cos(angle) * dist;
                    const moveY = Math.sin(angle) * dist;

                    eye.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            });
        }
    });
</script>

<?php
require_once __DIR__ . '/partials/footer.php';
?>
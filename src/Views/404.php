<?php
require_once __DIR__ . '/partials/header.php';
?>
    <main>
        <section class="error-page-v2">
            <div class="error-container">
                <div class="error-label">// Oooops!</div>
                <h1 class="error-big">404.</h1>
                <p class="error-text">Die Seite, die du suchst, ist wohl im digitalen Nirwana verschwunden. Vielleicht ein Tippfehler? <br><br>Keine Sorge, wir finden gemeinsam den Weg zurück.</p>
                <div class="error-actions">
                    <a href="/" class="btn-p">Zurück ans Licht</a>
                </div>
            </div>
            <div class="error-visual">
                <div class="mascot-v2">
                    <div class="mascot-face">
                        <div class="m-eye"></div>
                        <div class="m-eye"></div>
                    </div>
                    <div class="m-mouth"></div>
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
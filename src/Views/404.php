<?php
require_once __DIR__ . '/partials/header.php';
?>
    <main>
        <section class="error-page" style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; background: var(--bg); color: var(--text); padding-top: 8rem;">
            <div class="error-graphics" style="margin-bottom: 2rem; color: var(--accent); animation: float 6s ease-in-out infinite;">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
            </div>
            <div class="error-code" style="font-family: var(--fd); font-size: clamp(6rem, 15vw, 12rem); font-weight: 900; color: transparent; -webkit-text-stroke: 2px var(--accent); line-height: 1; margin-bottom: 1rem;">404</div>
            <h1 class="error-title" style="font-family: var(--fd); font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin-bottom: 1.5rem;">Ups, verlaufen?</h1>
            <div class="error-msg" style="font-size: 1.25rem; margin-bottom: 3rem; color: var(--muted-b); max-width: 500px;">Die gesuchte Seite existiert leider nicht. Vielleicht wurde sie verschoben oder gelöscht.</div>
            <a href="/" class="btn-p">
                Zurück zur Startseite
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1em; height: 1em; margin-left: 0.5rem;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
        </section>
    </main>
<?php
require_once __DIR__ . '/partials/footer.php';
?>

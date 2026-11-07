    <footer class="site-footer-v2" aria-label="Seitenabschluss">
        <div class="footer-v2-inner">
            <div class="footer-top-section">
                <div class="footer-message">
                    <div class="label">// Gemeinsam starten</div>
                    <h2>Deine Idee.<br><span>Unser nächstes Projekt.</span></h2>
                    <p class="footer-subtext">Erzähl uns, was du vorhast. Wir besprechen gemeinsam, wie wir dein Projekt umsetzen können.</p>
                    <a href="mailto:info@ternis-edv.de" class="footer-mail-v2">info@ternis-edv.de <?= site_icon('arrow-up-right') ?></a>
                </div>
                <div class="footer-mascot-container" aria-hidden="true">
                    <div class="footer-mascot">
                        <div class="mascot-eye"></div>
                        <div class="mascot-eye"></div>
                    </div>
                    <div class="mascot-badge">SAY HELLO!</div>
                </div>
            </div>

            <div class="footer-middle-section">
                <div class="footer-col">
                    <h3 class="col-label">Entdecken</h3>
                    <ul class="footer-list">
                        <li><a href="/#services">Leistungen</a></li>
                        <li><a href="/#work">Projekte</a></li>
                        <li><a href="/#about">Über uns</a></li>
                        <li><a href="/#faq">Häufige Fragen</a></li>
                        <li><a href="/#contact">Kontakt</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3 class="col-label">Code &amp; Projekte</h3>
                    <ul class="footer-list">
                        <li><a href="https://codeberg.org/ternis" target="_blank" rel="noopener noreferrer" aria-label="Codeberg (neuer Tab)">Codeberg <?= site_icon('arrow-up-right') ?></a></li>
                        <li><a href="https://github.com/ternis-edv" target="_blank" rel="noopener noreferrer" aria-label="GitHub (neuer Tab)">GitHub <?= site_icon('arrow-up-right') ?></a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3 class="col-label">Rechtliches</h3>
                    <ul class="footer-list">
                        <li><a href="/impressum" id="trigger-impressum">Impressum</a></li>
                        <li><a href="/datenschutz" id="trigger-datenschutz">Datenschutz</a></li>
                        <li><a href="https://ternis.dev/de/legal/imprint?domain=ternis-edv.de" class="footer-full-legal">Komplettes Impressum <?= site_icon('arrow-up-right') ?></a></li>
                        <li><a href="https://ternis.dev/de/legal/privacy?domain=ternis-edv.de" class="footer-full-legal">Komplette Datenschutzerklärung <?= site_icon('arrow-up-right') ?></a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3 class="col-label">Standort</h3>
                    <p class="footer-loc">Rhein-Main-Gebiet<br>Deutschland &amp; Remote</p>
                    <a href="mailto:info@ternis-edv.de" class="footer-contact-link">E-Mail schreiben <?= site_icon('arrow-right') ?></a>
                </div>
            </div>

            <div class="footer-bottom-v2">
                <div class="footer-legal-v2">
                    <div class="copy-line">&copy; <?= date('Y') ?> <a href="https://ternis-edv.de">ternis-edv.de</a> &amp; <a href="https://xpsystems.eu">xpsystems.eu</a></div>
                    <div class="credit-line">Webentwicklung mit Fokus auf das Wesentliche.</div>
                </div>
                <a href="/#home" class="footer-home">Zur Startseite <?= site_icon('arrow-up-right') ?></a>
            </div>
        </div>
    </footer>

    <button id="back-to-top" class="back-to-top" aria-label="Zurück nach oben">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="M18 15l-6-6-6 6"/></svg>
    </button>

    <script src="/assets/js/main.js?v=<?= filemtime(__DIR__ . '/../../../assets/js/main.js') ?>"></script>
</body>
</html>

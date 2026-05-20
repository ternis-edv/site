<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ternis-edv — Webentwicklung & Digitale Lösungen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="theme-dark">
    <div id="page-progress"></div>

    <!-- Cookie Consent -->
    <div id="cookie-consent" class="cookie-banner" role="dialog" aria-labelledby="cc-title">
        <div class="cb-content">
            <h4 id="cc-title" class="cb-title">Cookies & Privatsphäre</h4>
            <p class="cb-text">Wir nutzen Cookies, um die Nutzererfahrung zu verbessern. Wählen Sie, welche Cookies Sie zulassen möchten.</p>
            <div class="cb-actions">
                <button id="cc-accept-all" class="btn-p">Alle akzeptieren</button>
                <button id="cc-settings-trigger" class="btn-g">Einstellungen</button>
            </div>
        </div>
    </div>

    <!-- Modals Overlay -->
    <div id="modal-overlay" class="modal-overlay">

        <!-- Impressum Modal -->
        <div id="modal-impressum" class="modal-content">
            <button class="modal-close" aria-label="Schließen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <div class="modal-body">
                <h2>Impressum</h2>
                <div class="modal-section">
                    <h3>Angaben gemäß § 5 TMG</h3>
                    <p><strong>Fabian Ternis</strong><br>Alzeyer Str. 97<br>67592 Flörsheim-Dalsheim<br>Deutschland</p>
                </div>
                <div class="modal-section">
                    <h3>Kontakt</h3>
                    <p>E-Mail: info@ternis-edv.de</p>
                </div>
                <div class="modal-section">
                    <h3>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h3>
                    <p>Fabian Ternis<br>Alzeyer Str. 97<br>67592 Flörsheim-Dalsheim</p>
                </div>
            </div>
        </div>

        <!-- Datenschutz Modal -->
        <div id="modal-datenschutz" class="modal-content">
            <button class="modal-close" aria-label="Schließen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <div class="modal-body">
                <h2>Datenschutz</h2>
                <div class="modal-section">
                    <p>Wir nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend der gesetzlichen Datenschutzvorschriften sowie dieser Datenschutzerklärung.</p>

                    <h3>1. Allgemeine Hinweise</h3>
                    <p>Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert werden können.</p>

                    <h3>2. Datenerfassung auf dieser Website</h3>
                    <p><strong>Server-Log-Dateien</strong><br>Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log-Dateien, die Ihr Browser automatisch an uns übermittelt. Dies sind: Browsertyp und Browserversion, verwendetes Betriebssystem, Referrer URL, Hostname des zugreifenden Rechners, Uhrzeit der Serveranfrage, IP-Adresse. Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen.</p>
                    <p><strong>Cookies</strong><br>Unsere Internetseiten verwenden teilweise so genannte "Cookies". Cookies richten auf Ihrem Rechner keinen Schaden an und enthalten keine Viren. Sie dienen dazu, unser Angebot nutzerfreundlicher, effektiver und sicherer zu machen.</p>
                    <p><strong>Kontaktanfragen</strong><br>Wenn Sie uns per E-Mail kontaktieren, werden Ihre Angaben inklusive der von Ihnen dort angegebenen Kontaktdaten zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen bei uns gespeichert. Diese Daten geben wir nicht ohne Ihre Einwilligung weiter.</p>

                    <h3>3. Ihre Rechte</h3>
                    <p>Sie haben jederzeit das Recht, unentgeltlich Auskunft über Herkunft, Empfänger und Zweck Ihrer gespeicherten personenbezogenen Daten zu erhalten. Sie haben außerdem ein Recht, die Berichtigung oder Löschung dieser Daten zu verlangen. Hierzu sowie zu weiteren Fragen zum Thema Datenschutz können Sie sich jederzeit unter der im Impressum angegebenen Adresse an uns wenden.</p>
                </div>
            </div>
        </div>

        <!-- Cookie Settings Modal -->
        <div id="modal-cookie-settings" class="modal-content">
            <button class="modal-close" aria-label="Schließen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <div class="modal-body">
                <h2>Cookie-Einstellungen</h2>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Notwendig</h4>
                        <p>Erforderlich für den Betrieb der Seite.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" checked disabled><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Analyse</h4>
                        <p>Helfen uns die Website zu verbessern.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="cc-analytics"><span></span></label>
                </div>
                <div class="modal-actions">
                    <button id="cc-save-settings" class="btn-p">Speichern</button>
                </div>
            </div>
        </div>

        <!-- Accessibility Modal -->
        <div id="modal-a11y" class="modal-content">
            <button class="modal-close" aria-label="Schließen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <div class="modal-body">
                <h2>Barrierefreiheit</h2>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Kontrast erhöhen</h4>
                        <p>Optimiert die Farben für bessere Lesbarkeit.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-contrast"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Größere Schrift</h4>
                        <p>Skaliert alle Texte der Website.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-font"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Bewegung reduzieren</h4>
                        <p>Deaktiviert Animationen und Übergänge.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-reduce-motion"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Links hervorheben</h4>
                        <p>Macht alle anklickbaren Links deutlicher sichtbar.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-highlight-links"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Schriftart für Legastheniker</h4>
                        <p>Verwendet eine besser lesbare Schriftart.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-dyslexia-font"><span></span></label>
                </div>
                <div class="modal-actions">
                    <button id="a11y-save" class="btn-p">Anwenden</button>
                </div>
            </div>
        </div>
    </div>

    <nav id="nav">
        <a href="/" class="nav-logo">ternis<span>-edv</span></a>

        <!-- Mobile Toggle -->
        <button id="mobile-toggle" aria-label="Menü öffnen" aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path class="line-1" d="M4 6h16"/>
                <path class="line-2" d="M4 12h16"/>
                <path class="line-3" d="M4 18h16"/>
            </svg>
        </button>

        <ul class="nav-links" id="nav-links">
            <li><a href="/#services">Leistungen</a></li>
            <li><a href="/#work">Projekte</a></li>
            <li><a href="/#about">Über uns</a></li>
            <li><a href="/#contact">Kontakt</a></li>
        </ul>
        <div class="nav-actions">
            <!-- Theme Toggle -->
            <button id="theme-toggle" aria-label="Toggle Theme">
                <svg class="sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>
            <button id="a11y-trigger" aria-label="Accessibility Settings" style="background:none;border:none;cursor:pointer;color:inherit;display:flex;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="5" r="2.5"></circle>
                    <path d="M12 7.5v8.5"></path>
                    <path d="M5 10.5h14"></path>
                    <path d="M12 16l-4 6"></path>
                    <path d="M12 16l4 6"></path>
                </svg>
            </button>
            <a href="/#contact" class="nav-cta">Projekt starten <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1em; height: 1em;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
        </div>
    </nav>

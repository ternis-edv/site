<?php require_once __DIR__ . '/icons.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'ternis-edv — Webentwicklung & Digitale Lösungen' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'ternis-edv — Webentwicklung, IT-Infrastruktur & performante digitale Lösungen im Rhein-Main-Gebiet.' ?>">
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../../../assets/css/style.css') ?>">
</head>
<body class="theme-dark">
    <a class="skip-link" href="#main-content">Zum Inhalt springen</a>
    <div id="page-progress"></div>
    <div id="ui-status" class="sr-only" role="status" aria-live="polite"></div>

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
                    <h3>Angaben gemäß § 5 DDG</h3>
                    <p><strong>Fabian Ternis</strong><br>Ternis EDV &amp; Webentwicklung<br>Alzeyer Str. 97<br>67592 Flörsheim-Dalsheim<br>Deutschland</p>
                </div>
                <div class="modal-section">
                    <h3>Kontakt</h3>
                    <div class="protected-contact-list modal-contacts">
                        <div class="protected-contact-item">
                            <div class="pci-label">E-Mail:</div>
                            <a href="mailto:info@ternis-edv.de" class="legal-link" style="font-family: var(--fm); font-size: 0.95rem;">info@ternis-edv.de</a>
                        </div>
                        <div class="protected-contact-item">
                            <div class="pci-label">Telefon:</div>
                            <div class="pci-display" data-protected-contact="phone" data-font-family="var(--fm)" data-font-size="14"></div>
                            <div class="pci-actions">
                                <button type="button" class="btn-protected-copy" data-target="phone" title="Kopieren">Kopieren</button>
                                <button type="button" class="btn-protected-action" data-action="call" data-target="phone" title="Anrufen">Anrufen</button>
                            </div>
                        </div>
                        <div class="protected-contact-item">
                            <div class="pci-label">EDV &amp; Support:</div>
                            <div class="pci-display" data-protected-contact="email-edv" data-font-family="var(--fm)" data-font-size="14"></div>
                            <div class="pci-actions">
                                <button type="button" class="btn-protected-copy" data-target="email-edv" title="Kopieren">Kopieren</button>
                                <button type="button" class="btn-protected-action" data-action="mail" data-target="email-edv" title="E-Mail">E-Mail</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-section">
                    <h3>Verantwortlich nach § 18 Abs. 2 MStV</h3>
                    <p>Fabian Ternis<br>Alzeyer Str. 97<br>67592 Flörsheim-Dalsheim</p>
                </div>
                <div class="modal-actions" style="margin-top: 2rem;">
                    <a href="https://ternis.dev/de/legal/imprint?domain=ternis-edv.de" class="btn-p" style="width: 100%; justify-content: center; text-decoration: none;">
                        Komplettes Impressum <?= site_icon('arrow-right') ?>
                    </a>
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
                <div class="modal-actions" style="margin-top: 2rem;">
                    <a href="https://ternis.dev/de/legal/privacy?domain=ternis-edv.de" class="btn-p" style="width: 100%; justify-content: center; text-decoration: none;">
                        Komplette Datenschutzerklärung <?= site_icon('arrow-right') ?>
                    </a>
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

        <!-- Settings Modal -->
        <div id="modal-settings" class="modal-content">
            <button class="modal-close" aria-label="Schließen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <div class="modal-body">
                <h2>Einstellungen</h2>
                
                <div class="modal-section">
                    <h3>Erscheinungsbild</h3>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Theme</h4>
                            <p>Wähle dein bevorzugtes Farbschema.</p>
                        </div>
                        <select id="setting-theme" class="select-ui">
                            <option value="theme-dark">Midnight (Dark)</option>
                            <option value="theme-light">Coral (Light)</option>
                            <option value="theme-nord">Arctic (Nord)</option>
                            <option value="theme-midnight">Deep Sea (Midnight)</option>
                            <option value="theme-paper">Warm (Paper)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-section">
                    <h3>Layout</h3>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Abrundung</h4>
                            <p>Stärke der Eckenabrundung anpassen.</p>
                        </div>
                        <input type="range" id="setting-radius" min="0" max="2" step="0.1" value="1" class="range-ui">
                    </div>
                </div>

                <div class="modal-actions">
                    <button id="settings-save" class="btn-p">Speichern</button>
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
                        <h4 id="a11y-contrast-label">Kontrast erhöhen</h4>
                        <p>Optimiert die Farben für bessere Lesbarkeit.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-contrast" aria-labelledby="a11y-contrast-label"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4 id="a11y-font-label">Größere Schrift</h4>
                        <p>Skaliert alle Texte der Website.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-font" aria-labelledby="a11y-font-label"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4 id="a11y-reduce-motion-label">Bewegung reduzieren</h4>
                        <p>Deaktiviert Animationen und Übergänge.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-reduce-motion" aria-labelledby="a11y-reduce-motion-label"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4 id="a11y-highlight-links-label">Links hervorheben</h4>
                        <p>Macht alle anklickbaren Links deutlicher sichtbar.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-highlight-links" aria-labelledby="a11y-highlight-links-label"><span></span></label>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h4 id="a11y-dyslexia-font-label">Alternative Schrift</h4>
                        <p>Verwendet eine Systemschrift mit größerem Zeichenabstand.</p>
                    </div>
                    <label class="switch-ui"><input type="checkbox" id="a11y-dyslexia-font" aria-labelledby="a11y-dyslexia-font-label"><span></span></label>
                </div>
                <div class="modal-actions">
                    <button type="button" id="a11y-reset" class="btn-g">Zurücksetzen</button>
                    <button type="button" id="a11y-save" class="btn-p">Anwenden</button>
                </div>
            </div>
        </div>
        <div id="modal-screenshot" class="modal-content screenshot-modal">
            <div class="screenshot-modal-toolbar">
                <h2 id="screenshot-title">Projektvorschau</h2>
                <div class="screenshot-modal-actions">
                    <button type="button" id="screenshot-zoom" class="btn-g" aria-pressed="false" aria-controls="screenshot-viewport">Originalgröße</button>
                    <a id="screenshot-original" class="btn-g" target="_blank" rel="noopener noreferrer">Original öffnen <?= site_icon('arrow-up-right') ?></a>
                    <button type="button" class="modal-close" aria-label="Vorschau schließen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="m6 6 12 12M6 18 18 6"/></svg></button>
                </div>
            </div>
            <p id="screenshot-status" class="screenshot-status" role="status"></p>
            <div id="screenshot-viewport" class="screenshot-viewport" tabindex="0" role="region" aria-label="Screenshot, mit den Pfeiltasten scrollen">
                <img id="screenshot-image" alt="" hidden>
            </div>
        </div>
    </div>

    <nav id="nav" aria-label="Hauptnavigation">
        <a href="/" class="nav-logo">ternis<span>-edv</span></a>

        <!-- Mobile Toggle -->
        <button id="mobile-toggle" aria-label="Menü öffnen" aria-expanded="false" aria-controls="nav-links" type="button">
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
            <button id="theme-toggle" aria-label="Farbschema wechseln" class="theme-cycle-btn">
                <svg class="sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg class="palette" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="13.5" cy="6.5" r=".5"/><circle cx="17.5" cy="10.5" r=".5"/><circle cx="8.5" cy="7.5" r=".5"/><circle cx="6.5" cy="12.5" r=".5"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.9 0 1.6-.7 1.6-1.6 0-.4-.2-.8-.5-1.1-.3-.3-.5-.7-.5-1.1 0-.9.7-1.6 1.6-1.6H17c2.8 0 5-2.2 5-5 0-5.5-4.5-10-10-10z"/></svg>
            </button>
            <button id="settings-trigger" aria-label="Einstellungen öffnen" class="nav-icon-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
            </button>
            <button id="a11y-trigger" aria-label="Barrierefreiheit einstellen" class="nav-icon-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="5" r="2.5"></circle>
                    <path d="M12 7.5v8.5"></path>
                    <path d="M5 10.5h14"></path>
                    <path d="M12 16l-4 6"></path>
                    <path d="M12 16l4 6"></path>
                </svg>
            </button>
            <a href="/#contact" class="nav-cta">Projekt starten <?= site_icon('arrow-right') ?></a>
        </div>
    </nav>

<?php
$pageTitle = 'Impressum — ternis-edv | Webentwicklung & Digitale Lösungen';
$pageDescription = 'Rechtliche Angaben, Anbieterkennzeichnung gemäß § 5 DDG und Kontaktdaten von ternis-edv (Fabian Ternis).';
require_once __DIR__ . '/partials/header.php';
?>

<main class="legal-page">
    <section class="legal-hero">
        <div class="legal-grid-overlay"></div>
        <div class="legal-hero-inner">
            <div class="label reveal">// Rechtliche Informationen</div>
            <h1 class="legal-title reveal">Impressum</h1>
            <p class="legal-lead reveal">
                Gesetzliche Anbieterkennzeichnung nach § 5 Digitale-Dienste-Gesetz (DDG) sowie Verantwortlichkeit für redaktionelle Inhalte nach § 18 Abs. 2 MStV.
            </p>
        </div>
    </section>

    <div class="legal-container">
        <div class="legal-grid">

            <!-- Card 1: Anbieterkennzeichnung -->
            <div class="legal-card reveal">
                <div class="card-badge">§ 5 DDG</div>
                <h2 class="card-title">Anbieterkennzeichnung</h2>
                <div class="card-body">
                    <p class="org-name"><strong>Fabian Ternis</strong></p>
                    <p class="org-sub">Ternis EDV &amp; Webentwicklung</p>
                    <address class="legal-address">
                        Alzeyer Str. 97<br>
                        67592 Flörsheim-Dalsheim<br>
                        Deutschland
                    </address>
                </div>
            </div>

            <!-- Card 2: Kontakt mit Anti-Scraping Canvas -->
            <div class="legal-card legal-card-highlight reveal">
                <div class="card-badge">Direktkontakt &bull; Anti-Scraping geschützt</div>
                <h2 class="card-title">Kontaktmöglichkeiten</h2>
                <div class="card-body">
                    <p class="contact-desc">
                        Unsere Kontaktdaten werden dynamisch gerendert, um automatisierte Spam- und Harvesting-Bots abzuwehren. Du kannst die Daten mit einem Klick kopieren oder direkt die gewünschte Aktion ausführen:
                    </p>

                    <div class="protected-contact-list">
                        <!-- Phone Item -->
                        <div class="protected-contact-item">
                            <div class="pci-meta">
                                <span class="pci-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                </span>
                                <span class="pci-title">Telefon:</span>
                            </div>
                            <div class="pci-display" data-protected-contact="phone" data-font-family="var(--fm)" data-font-size="16">
                                <!-- Dynamic Canvas -->
                            </div>
                            <div class="pci-actions">
                                <button type="button" class="btn-protected-copy" data-target="phone" aria-label="Telefonnummer kopieren">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                    <span>Kopieren</span>
                                </button>
                                <button type="button" class="btn-protected-action" data-action="call" data-target="phone" aria-label="Telefonisch anrufen">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    <span>Anrufen</span>
                                </button>
                            </div>
                        </div>

                        <!-- Email Info Item -->
                        <div class="protected-contact-item">
                            <div class="pci-meta">
                                <span class="pci-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                </span>
                                <span class="pci-title">E-Mail (Allgemein):</span>
                            </div>
                            <div class="pci-display-link">
                                <a href="mailto:info@ternis-edv.de" class="legal-link" style="font-family: var(--fm); font-size: 1rem;">info@ternis-edv.de</a>
                            </div>
                            <div class="pci-actions">
                                <button type="button" class="btn-protected-copy" data-target="email-info" aria-label="E-Mail-Adresse kopieren">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                    <span>Kopieren</span>
                                </button>
                                <a href="mailto:info@ternis-edv.de" class="btn-protected-action" aria-label="E-Mail schreiben" style="text-decoration: none;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    <span>E-Mail</span>
                                </a>
                            </div>
                        </div>

                        <!-- Email EDV / Support Item -->
                        <div class="protected-contact-item">
                            <div class="pci-meta">
                                <span class="pci-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                </span>
                                <span class="pci-title">EDV &amp; Support:</span>
                            </div>
                            <div class="pci-display" data-protected-contact="email-edv" data-font-family="var(--fm)" data-font-size="16">
                                <!-- Dynamic Canvas -->
                            </div>
                            <div class="pci-actions">
                                <button type="button" class="btn-protected-copy" data-target="email-edv" aria-label="Support-E-Mail kopieren">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                    <span>Kopieren</span>
                                </button>
                                <button type="button" class="btn-protected-action" data-action="mail" data-target="email-edv" aria-label="Support-E-Mail schreiben">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    <span>E-Mail</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Redaktionelle Verantwortung -->
            <div class="legal-card reveal">
                <div class="card-badge">§ 18 Abs. 2 MStV</div>
                <h2 class="card-title">Redaktionell verantwortlich</h2>
                <div class="card-body">
                    <p>Verantwortlich für redaktionell-journalistische Angebote nach § 18 Abs. 2 des Medienstaatsvertrags (MStV):</p>
                    <address class="legal-address" style="margin-top: 1rem;">
                        <strong>Fabian Ternis</strong><br>
                        Alzeyer Str. 97<br>
                        67592 Flörsheim-Dalsheim<br>
                        Deutschland
                    </address>
                </div>
            </div>

            <!-- Card 4: Streitbeilegung -->
            <div class="legal-card reveal">
                <div class="card-badge">Streitschlichtung</div>
                <h2 class="card-title">Verbraucherstreitbeilegung</h2>
                <div class="card-body">
                    <p>Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit, die Sie unter folgendem Link finden:</p>
                    <p style="margin: 0.8rem 0;">
                        <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer" class="legal-link">
                            https://ec.europa.eu/consumers/odr/
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 0.9em; height: 0.9em; display: inline-block; vertical-align: middle;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        </a>
                    </p>
                    <p>Unsere E-Mail-Adresse finden Sie oben in den Kontaktdaten.</p>
                    <p style="margin-top: 1rem;">Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>
                </div>
            </div>

            <!-- Card 5: Haftungsausschluss -->
            <div class="legal-card reveal">
                <div class="card-badge">Rechtlicher Hinweis</div>
                <h2 class="card-title">Haftung für Inhalte &amp; Links</h2>
                <div class="card-body">
                    <h4 class="card-subtitle">Haftung für Inhalte</h4>
                    <p>Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 DDG sind wir jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.</p>

                    <h4 class="card-subtitle" style="margin-top: 1.5rem;">Haftung für externe Links</h4>
                    <p>Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.</p>
                </div>
            </div>

            <!-- Card 6: Urheberrecht -->
            <div class="legal-card reveal">
                <div class="card-badge">Copyright</div>
                <h2 class="card-title">Urheberrecht</h2>
                <div class="card-body">
                    <p>Die durch die Seitenbetreiber erstellten Inhalte, Codes, Designs und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der vorherigen schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.</p>
                    <p style="margin-top: 1rem;">Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet und als solche gekennzeichnet.</p>
                </div>
            </div>

        </div>

        <!-- Navigation actions -->
        <div class="legal-nav-actions reveal">
            <a href="/" class="btn-p">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.2em; height: 1.2em;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                <span>Zur Startseite</span>
            </a>
            <button type="button" id="trigger-datenschutz-from-page" class="btn-g">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 1.2em; height: 1.2em;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                <span>Datenschutzerklärung öffnen</span>
            </button>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . '/partials/footer.php';
?>

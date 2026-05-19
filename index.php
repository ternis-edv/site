<?php
$projects = [
    [
        'id' => 'ternismail',
        'name' => 'ternismail.de',
        'type' => 'Private Mail Infrastructure',
        'desc' => 'Custom mail infrastructure and landing page for secure, private communication. Built with a focus on privacy and high-availability architecture.',
        'stack' => ['PHP', 'Postfix', 'Dovecot', 'Landingpage'],
        'images' => [
            'light' => 'assets/img/work/ternismail.de__LIGHT.png'
        ],
        'link' => 'https://ternismail.de',
        'color' => '#10b981'
    ],
    [
        'id' => 'dnbx',
        'name' => 'dnbx.de',
        'type' => 'Digital Asset SaaS',
        'desc' => 'A high-performance platform for managing digital assets. Features advanced filtering, real-time collaboration, and a highly optimized delivery network.',
        'stack' => ['React', 'Node.js', 'PostgreSQL', 'Redis'],
        'images' => [
            'light' => 'assets/img/work/dnbx.de__LIGHT.png',
            'dark' => 'assets/img/work/dnbx.de__DARK.png'
        ],
        'link' => 'https://dnbx.de',
        'color' => '#C1FF47'
    ],
    [
        'id' => 'dogwaterdev',
        'name' => 'dogwaterdev.de',
        'type' => 'Dev Community',
        'desc' => 'A community hub for open-source enthusiasts. Focused on project discovery and collaborative coding environments.',
        'stack' => ['Next.js', 'Tailwind', 'Supabase', 'TypeScript'],
        'images' => [
            'light' => 'assets/img/work/dogwaterdev.de__LIGHT.png',
            'dark' => 'assets/img/work/dogwaterdev.de__DARK.png'
        ],
        'link' => 'https://dogwaterdev.de',
        'color' => '#3b82f6'
    ],
    [
        'id' => 'getmyname',
        'name' => 'getmy.name',
        'type' => 'Domain Branding Tool',
        'desc' => 'Intelligent domain name generator and branding assistant. Helps startups find the perfect digital identity through AI-driven suggestions.',
        'stack' => ['Vue 3', 'Python/FastAPI', 'OpenAI'],
        'images' => [
            'light' => 'assets/img/work/getmy.name_lander_LIGHT.png',
            'dark' => 'assets/img/work/getmy.name_lander_DARK.png'
        ],
        'link' => 'https://getmy.name',
        'color' => '#8b5cf6'
    ],
    [
        'id' => 'louixch',
        'name' => 'louixch.de',
        'type' => 'Creative Portfolio',
        'desc' => 'Portfolio for a creative director, emphasizing minimal aesthetics and fluid motion design principles.',
        'stack' => ['GSAP', 'HTML5 Canvas', 'PHP'],
        'images' => [
            'dark' => 'assets/img/work/louixch.de__DARK.png'
        ],
        'link' => '#',
        'color' => '#f43f5e'
    ],
    [
        'id' => 'api-sandbox',
        'name' => 'API Sandbox',
        'type' => 'Developer Tool',
        'desc' => 'A lightweight testing environment for RESTful APIs. Simplifies the debugging process for backend engineers.',
        'stack' => ['SvelteKit', 'Go', 'Docker'],
        'images' => [
            'light' => 'assets/img/work/api-sandbox.de_lander__LIGHT.png'
        ],
        'link' => '#',
        'color' => '#10b981'
    ],
    [
        'id' => 'wonnegauer',
        'name' => 'Wonnegauer Design',
        'type' => 'Agency Landingpage',
        'desc' => 'Premium showcase for a traditional design workshop. High-resolution imagery and elegant typography drive the user experience.',
        'stack' => ['Vanilla JS', 'SASS', 'Intersection Observer'],
        'images' => [
            'light' => 'assets/img/work/wonnegauer-designwerkstatt.de_LANDER__LIGHT.png'
        ],
        'link' => '#',
        'color' => '#d97706'
    ]
];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ternis-edv — Webentwicklung & Digitale Lösungen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="theme-dark">

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
            <button class="modal-close" aria-label="Schließen">&times;</button>
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
            <button class="modal-close" aria-label="Schließen">&times;</button>
            <div class="modal-body">
                <h2>Datenschutz</h2>
                <div class="modal-section">
                    <p>Wir verarbeiten Ihre Daten ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, TMG).</p>
                    <h3>Datenspeicherung</h3>
                    <p>Es werden keine personenbezogenen Daten ohne Ihre Einwilligung gespeichert.</p>
                </div>
            </div>
        </div>

        <!-- Cookie Settings Modal -->
        <div id="modal-cookie-settings" class="modal-content">
            <button class="modal-close" aria-label="Schließen">&times;</button>
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
            <button class="modal-close" aria-label="Schließen">&times;</button>
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
                <div class="modal-actions">
                    <button id="a11y-save" class="btn-p">Anwenden</button>
                </div>
            </div>
        </div>
    </div>

    <nav id="nav">
        <a href="#" class="nav-logo">ternis<span>-edv</span></a>
        <ul class="nav-links">
            <li><a href="#services">Leistungen</a></li>
            <li><a href="#work">Projekte</a></li>
            <li><a href="#about">Über uns</a></li>
            <li><a href="#contact">Kontakt</a></li>
        </ul>
        <div class="nav-actions">
            <button id="theme-toggle" aria-label="Toggle Theme">
                <svg class="sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>
            <button id="a11y-trigger" aria-label="Accessibility Settings" style="background:none;border:none;cursor:pointer;color:inherit;display:flex;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
            </button>
            <a href="#contact" class="nav-cta">Projekt starten →</a>
        </div>
    </nav>

    <main>
        <section class="hero" id="home">
            <div class="hero-grid"></div>
            <div class="hero-content">
                <div class="hero-eyebrow">// Webentwicklung aus Deutschland</div>
                <h1 class="hero-title">Wir bauen<br>das <em>Web</em><br>von morgen.</h1>
                <p class="hero-sub">Websites, Landingpages und Web-Applikationen — präzise entwickelt, leichtgewichtig und ohne Bloat.</p>
                <div class="hero-actions">
                    <a href="#work" class="btn-p">Projekte ansehen →</a>
                    <a href="#contact" class="btn-g">Kontakt aufnehmen</a>
                </div>
            </div>
            <div class="hero-hint">scroll down</div>
        </section>

        <section class="services" id="services">
            <div class="services-hd">
                <div class="label reveal">// 01 Leistungen</div>
                <h2 class="sec-title reveal">Was wir<br>für dich bauen</h2>
            </div>
            <div class="svc-grid">
                <div class="svc-card reveal">
                    <div class="svc-name">Websites</div>
                    <p class="svc-desc">Schnelle, zugängliche und suchmaschinenoptimierte Webseiten — maßgeschneidert, ohne unnötigen Overhead.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-name">Landingpages</div>
                    <p class="svc-desc">Conversion-optimierte Seiten, die Besucher in Kunden verwandeln. Klar, fokussiert und messbar.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-name">Web-Applikationen</div>
                    <p class="svc-desc">Komplexe Webanwendungen, APIs und Backends — von der Konzeption bis zum Deployment.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-name">Hosting & Pflege</div>
                    <p class="svc-desc">Zuverlässiges Hosting, kontinuierliche Wartung und persönliche Betreuung deiner digitalen Präsenz.</p>
                </div>
            </div>
        </section>

        <section class="work" id="work">
            <div class="work-progress" id="work-progress"></div>
            <div class="work-hd">
                <div class="label reveal">// 02 Projekte</div>
                <h2 class="sec-title reveal">Ausgewählte Arbeiten</h2>
            </div>

            <?php foreach ($projects as $index => $project): ?>
                <div class="project-section" id="project-<?= $project['id'] ?>" data-index="<?= $index ?>" data-color="<?= $project['color'] ?>">
                    <div class="project-container">
                        <div class="project-info">
                            <div class="pi-content">
                                <span class="p-num"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?> / <?= str_pad(count($projects), 2, '0', STR_PAD_LEFT) ?></span>
                                <h3 class="p-name"><?= $project['name'] ?></h3>
                                <div class="p-type"><?= $project['type'] ?></div>
                                <p class="p-desc"><?= $project['desc'] ?></p>
                                <div class="p-stack">
                                    <?php foreach ($project['stack'] as $tech): ?>
                                        <span class="tag"><?= $tech ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <a href="<?= $project['link'] ?>" target="_blank" class="p-link">Live ansehen ↗</a>
                            </div>
                        </div>
                        <div class="project-visual">
                            <div class="browser-frame">
                                <div class="browser-top">
                                    <div class="dots"><span></span><span></span><span></span></div>
                                    <div class="url-bar"><?= $project['name'] ?></div>
                                </div>
                                <div class="image-wrapper">
                                    <?php if (isset($project['images']['dark']) && isset($project['images']['light'])): ?>
                                        <img src="<?= $project['images']['dark'] ?>" alt="<?= $project['name'] ?>" class="work-img dark-only" loading="lazy">
                                        <img src="<?= $project['images']['light'] ?>" alt="<?= $project['name'] ?>" class="work-img light-only" loading="lazy">
                                    <?php else: ?>
                                        <?php $img = isset($project['images']['dark']) ? $project['images']['dark'] : $project['images']['light']; ?>
                                        <img src="<?= $img ?>" alt="<?= $project['name'] ?>" class="work-img" loading="lazy">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="about" id="about">
            <div class="about-content">
                <div class="label reveal">// 03 Über uns</div>
                <h2 class="sec-title reveal">Digital handgemacht.</h2>
                <p class="about-p reveal">ternis-edv ist ein kleines Studio aus Deutschland, das digitale Produkte entwickelt, die funktionieren. Keine aufgeblähten Frameworks, kein generischer Code — jedes Projekt entsteht mit Bedacht und handwerklichem Anspruch.</p>
                <div class="stats">
                    <div class="stat"><div class="stat-n">60+</div><div class="stat-l">Projekte</div></div>
                    <div class="stat"><div class="stat-n">7+</div><div class="stat-l">Jahre</div></div>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="label reveal">// 04 Kontakt</div>
            <h2 class="contact-title reveal">Dein Projekt<br>wartet auf <em>uns.</em></h2>
            <a href="mailto:info@ternis-edv.de" class="contact-mail">info@ternis-edv.de</a>
        </section>
    </main>

    <footer>
        <div class="f-logo">ternis<span>-edv</span></div>
        <div class="f-links">
            <a href="#" id="trigger-impressum">Impressum</a>
            <a href="#" id="trigger-datenschutz">Datenschutz</a>
        </div>
        <span class="f-copy">© <?= date('Y') ?> ternis-edv.de</span>
    </footer>

    <button id="back-to-top" class="back-to-top" aria-label="Back to Top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 15l-6-6-6 6"/></svg>
    </button>

    <script src="assets/js/main.js"></script>
</body>
</html>

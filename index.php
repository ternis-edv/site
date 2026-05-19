<?php
$projects = [
    [
        'id' => 'dnbx',
        'name' => 'dnbx.de',
        'type' => 'Web App / SaaS',
        'desc' => 'A modern platform for digital assets and collaboration. Focus on performance and seamless user experience.',
        'stack' => ['React', 'Node.js', 'PostgreSQL'],
        'images' => [
            'light' => 'assets/img/work/dnbx.de__LIGHT.png',
            'dark' => 'assets/img/work/dnbx.de__DARK.png'
        ],
        'link' => 'https://dnbx.de'
    ],
    [
        'id' => 'dogwaterdev',
        'name' => 'dogwaterdev.de',
        'type' => 'Portfolio / Community',
        'desc' => 'A community-driven platform for developers to share and collaborate on open-source projects.',
        'stack' => ['Next.js', 'Tailwind', 'Supabase'],
        'images' => [
            'dark' => 'assets/img/work/dogwaterdev.de__DARK.png'
        ],
        'link' => 'https://dogwaterdev.de'
    ],
    [
        'id' => 'wonnegauer',
        'name' => 'Wonnegauer Designwerkstatt',
        'type' => 'Landingpage',
        'desc' => 'High-conversion landingpage for a local design workshop, showcasing their unique craft and services.',
        'stack' => ['HTML', 'CSS', 'Vanilla JS'],
        'images' => [
            'light' => 'assets/img/work/wonnegauer-designwerkstatt.de_LANDER__LIGHT.png'
        ],
        'link' => '#'
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
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="theme-dark">
    <div class="grain"></div>

    <!-- Cookie Banner -->
    <div id="cookie-banner" class="cookie-banner">
        <div class="cb-content">
            <h4 class="cb-title">Cookies & Privatsphäre</h4>
            <p class="cb-text">Wir nutzen Cookies, um die Nutzererfahrung zu verbessern. Wählen Sie, welche Cookies Sie zulassen möchten.</p>
            <div class="cb-actions">
                <button id="cb-accept-all" class="btn-p">Alle akzeptieren</button>
                <button id="cb-settings" class="btn-g">Einstellungen</button>
                <button id="cb-reject-all" class="btn-g">Nur Notwendige</button>
            </div>
        </div>
        <div id="cb-modal" class="cb-modal">
            <div class="cbm-content">
                <h5>Cookie-Einstellungen</h5>
                <div class="cbm-option">
                    <label>
                        <input type="checkbox" checked disabled>
                        <span>Notwendig (immer aktiv)</span>
                    </label>
                    <p>Erforderlich für die Grundfunktionen der Website.</p>
                </div>
                <div class="cbm-option">
                    <label>
                        <input type="checkbox" id="cookie-analytics">
                        <span>Analyse</span>
                    </label>
                    <p>Hilft uns zu verstehen, wie Besucher mit der Website interagieren.</p>
                </div>
                <div class="cb-actions">
                    <button id="cb-save-settings" class="btn-p">Speichern</button>
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
                <div class="project-section" id="project-<?= $project['id'] ?>" data-index="<?= $index ?>">
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
                                        <img src="<?= $project['images']['dark'] ?>" 
                                             alt="<?= $project['name'] ?>" 
                                             class="work-img dark-only" 
                                             loading="lazy">
                                        <img src="<?= $project['images']['light'] ?>" 
                                             alt="<?= $project['name'] ?>" 
                                             class="work-img light-only" 
                                             loading="lazy">
                                    <?php else: ?>
                                        <?php 
                                            $img = isset($project['images']['dark']) ? $project['images']['dark'] : $project['images']['light'];
                                        ?>
                                        <img src="<?= $img ?>" 
                                             alt="<?= $project['name'] ?>" 
                                             class="work-img" 
                                             loading="lazy">
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
                    <div class="stat"><div class="stat-n">40+</div><div class="stat-l">Projekte</div></div>
                    <div class="stat"><div class="stat-n">5+</div><div class="stat-l">Jahre</div></div>
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
        <span class="f-copy">© <?= date('Y') ?> ternis-edv.de</span>
    </footer>

    <button id="back-to-top" class="back-to-top" aria-label="Back to Top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 15l-6-6-6 6"/></svg>
    </button>

    <script src="assets/js/main.js"></script>
</body>
</html>

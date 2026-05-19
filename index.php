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
    <div class="grain" aria-hidden="true"></div>

    <!-- Cookie Consent -->
    <div id="cookie-consent" class="cookie-consent" role="dialog" aria-labelledby="cc-title" aria-describedby="cc-desc">
        <div class="cc-inner">
            <h4 id="cc-title">Datenschutz & Cookies</h4>
            <p id="cc-desc">Wir verwenden Cookies, um die Funktionalität unserer Website zu gewährleisten und unseren Service zu verbessern. Sie können Ihre Einstellungen jederzeit anpassen.</p>
            <div class="cc-switches">
                <div class="cc-switch">
                    <span>Notwendig</span>
                    <label class="switch"><input type="checkbox" checked disabled><span class="slider"></span></label>
                </div>
                <div class="cc-switch">
                    <span>Analyse</span>
                    <label class="switch"><input type="checkbox" id="cc-analytics"><span class="slider"></span></label>
                </div>
            </div>
            <div class="cc-actions">
                <button id="cc-accept" class="btn-p">Auswahl bestätigen</button>
                <button id="cc-accept-all" class="btn-g">Alle akzeptieren</button>
            </div>
        </div>
    </div>

    <!-- Legal Modals -->
    <div id="modal-overlay" class="modal-overlay">
        <div id="modal-impressum" class="modal-content">
            <button class="modal-close" aria-label="Schließen">&times;</button>
            <div class="modal-body">
                <h2>Impressum</h2>
                <p>Angaben gemäß § 5 TMG</p>
                <p><strong>Fabian Ternis</strong><br>Alzeyer Str. 97<br>67592 Flörsheim-Dalsheim<br>Rheinland-Pfalz, Deutschland</p>
                <h3>Kontakt</h3>
                <p>Telefon: Die Telefonnummer wird auf Anfrage per E-Mail mitgeteilt.<br>E-Mail: info@ternis-edv.de</p>
                <h3>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h3>
                <p><strong>Fabian Ternis</strong><br>Alzeyer Str. 97<br>67592 Flörsheim-Dalsheim</p>
            </div>
        </div>
        <div id="modal-datenschutz" class="modal-content">
            <button class="modal-close" aria-label="Schließen">&times;</button>
            <div class="modal-body">
                <h2>Datenschutzerklärung</h2>
                <p>Der Schutz Ihrer persönlichen Daten ist uns ein besonderes Anliegen. Wir verarbeiten Ihre Daten daher ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, TMG).</p>
                <h3>Datenspeicherung</h3>
                <p>Wir weisen darauf hin, dass zum Zweck des einfacheren Einkaufsvorganges und zur späteren Vertragsabwicklung vom Webshop-Betreiber im Rahmen von Cookies die IP-Daten des Anschlussinhabers gespeichert werden, ebenso wie Name und Anschrift des Käufers.</p>
                <h3>Cookies</h3>
                <p>Unsere Website verwendet so genannte Cookies. Dabei handelt es sich um kleine Textdateien, die mit Hilfe des Browsers auf Ihrem Endgerät abgelegt werden. Sie richten keinen Schaden an. Wir nutzen Cookies dazu, unser Angebot nutzerfreundlich zu gestalten.</p>
                <p>Wenn Sie dies nicht wünschen, so können Sie Ihren Browser so einrichten, dass er Sie über das Setzen von Cookies informiert und Sie dies nur im Einzelfall erlauben.</p>
            </div>
        </div>
    </div>

    <nav id="nav" role="navigation">
        <a href="#" class="nav-logo" aria-label="ternis-edv Home">ternis<span>-edv</span></a>
        <ul class="nav-links">
            <li><a href="#services">Leistungen</a></li>
            <li><a href="#work">Projekte</a></li>
            <li><a href="#about">Über uns</a></li>
            <li><a href="#contact">Kontakt</a></li>
        </ul>
        <div class="nav-actions">
            <button id="theme-toggle" aria-label="Erscheinungsbild umschalten">
                <svg class="sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>
            <a href="#contact" class="nav-cta">Anfrage senden</a>
        </div>
    </nav>

    <main id="content">
        <section class="hero" id="home">
            <div class="hero-grid" aria-hidden="true"></div>
            <div class="hero-content">
                <div class="hero-eyebrow">// Digitale Exzellenz</div>
                <h1 class="hero-title">Wir gestalten<br>die <em>Zukunft</em><br>des Webs.</h1>
                <p class="hero-sub">Puristisches Design trifft auf technische Präzision. Wir entwickeln Produkte, die bleiben.</p>
                <div class="hero-actions">
                    <a href="#work" class="btn-p">Portfolio</a>
                    <a href="#contact" class="btn-g">Kontakt</a>
                </div>
            </div>
            <div class="hero-hint" aria-hidden="true">scroll</div>
        </section>

        <section class="services" id="services">
            <div class="services-hd">
                <div class="label reveal">// 01 Expertise</div>
                <h2 class="sec-title reveal">Leistungen</h2>
            </div>
            <div class="svc-grid">
                <div class="svc-card reveal">
                    <div class="svc-icon">01</div>
                    <div class="svc-name">Webentwicklung</div>
                    <p class="svc-desc">Performance, Zugänglichkeit und skalierbarer Code als Fundament Ihrer Webpräsenz.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-icon">02</div>
                    <div class="svc-name">Webdesign</div>
                    <p class="svc-desc">Minimalistisches Design, das Ihre Identität klar und hochwertig kommuniziert.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-icon">03</div>
                    <div class="svc-name">E-Commerce</div>
                    <p class="svc-desc">Moderne Shop-Lösungen mit Fokus auf User Experience und Conversion-Optimierung.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-icon">04</div>
                    <div class="svc-name">IT-Consulting</div>
                    <p class="svc-desc">Strategische Beratung für Ihre digitale Transformation und Infrastruktur.</p>
                </div>
            </div>
        </section>

        <section class="work" id="work">
            <div class="work-progress" id="work-progress" aria-hidden="true"></div>
            <div class="work-hd">
                <div class="label reveal">// 02 Arbeiten</div>
                <h2 class="sec-title reveal">Ausgewählte Projekte</h2>
            </div>

            <?php foreach ($projects as $index => $project): ?>
                <div class="project-section" 
                     id="project-<?= $project['id'] ?>" 
                     data-index="<?= $index ?>" 
                     data-color="<?= $project['color'] ?>">
                    <div class="project-container">
                        <div class="project-info">
                            <div class="pi-content">
                                <span class="p-num" aria-hidden="true"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?> / <?= str_pad(count($projects), 2, '0', STR_PAD_LEFT) ?></span>
                                <h3 class="p-name"><?= $project['name'] ?></h3>
                                <div class="p-type"><?= $project['type'] ?></div>
                                <p class="p-desc"><?= $project['desc'] ?></p>
                                <div class="p-stack" aria-label="Genutzte Technologien">
                                    <?php foreach ($project['stack'] as $tech): ?>
                                        <span class="tag"><?= $tech ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <a href="<?= $project['link'] ?>" target="_blank" class="p-link" aria-label="<?= $project['name'] ?> in neuem Tab öffnen">
                                    Projekt ansehen
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                </a>
                            </div>
                        </div>
                        <div class="project-visual">
                            <div class="browser-frame">
                                <div class="browser-top" aria-hidden="true">
                                    <div class="dots"><span></span><span></span><span></span></div>
                                    <div class="url-bar"><?= $project['name'] ?></div>
                                </div>
                                <div class="image-wrapper">
                                    <?php if (isset($project['images']['dark']) && isset($project['images']['light'])): ?>
                                        <img src="<?= $project['images']['dark'] ?>" 
                                             alt="<?= $project['name'] ?> Website Vorschau" 
                                             class="work-img dark-only" 
                                             loading="lazy">
                                        <img src="<?= $project['images']['light'] ?>" 
                                             alt="<?= $project['name'] ?> Website Vorschau" 
                                             class="work-img light-only" 
                                             loading="lazy">
                                    <?php else: ?>
                                        <?php 
                                            $img = isset($project['images']['dark']) ? $project['images']['dark'] : $project['images']['light'];
                                        ?>
                                        <img src="<?= $img ?>" 
                                             alt="<?= $project['name'] ?> Website Vorschau" 
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
                <div class="label reveal">// 03 Studio</div>
                <h2 class="sec-title reveal">Fokus auf das Wesentliche.</h2>
                <p class="about-p reveal">Wir glauben an die Kraft von Einfachheit und Präzision. Jedes Projekt wird mit höchster Sorgfalt und modernster Technologie umgesetzt.</p>
                <div class="stats">
                    <div class="stat"><div class="stat-n">60+</div><div class="stat-l">Projekte</div></div>
                    <div class="stat"><div class="stat-n">100%</div><div class="stat-l">Engagement</div></div>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="label reveal">// 04 Projektstart</div>
            <h2 class="contact-title reveal">Lass uns gemeinsam <em>Großes</em> schaffen.</h2>
            <a href="mailto:info@ternis-edv.de" class="contact-mail" aria-label="E-Mail an uns senden">info@ternis-edv.de</a>
        </section>
    </main>

    <footer role="contentinfo">
        <div class="f-logo">ternis<span>-edv</span></div>
        <div class="f-links">
            <a href="#" id="open-impressum">Impressum</a>
            <a href="#" id="open-datenschutz">Datenschutz</a>
        </div>
        <span class="f-copy">© <?= date('Y') ?> ternis-edv.de</span>
    </footer>

    <button id="back-to-top" class="back-to-top" aria-label="Nach oben scrollen">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 15l-6-6-6 6"/></svg>
    </button>

    <script src="assets/js/main.js"></script>
</body>
</html>

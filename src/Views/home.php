<?php
require_once __DIR__ . '/partials/projects_data.php';
require_once __DIR__ . '/partials/header.php';
?>

    <main>
        <section class="hero" id="home">
            <div class="hero-grid"></div>
            <div class="hero-content">
                <div class="hero-eyebrow">// Webentwicklung aus Deutschland</div>
                <h1 class="hero-title">Wir bauen<br>das <em>Web</em><br>von morgen.</h1>
                <p class="hero-sub">Websites, Landingpages und Web-Applikationen — präzise entwickelt, leichtgewichtig und ohne Bloat.</p>
                <div class="hero-actions">
                    <a href="#work" class="btn-p">Projekte ansehen <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1em; height: 1em;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                    <a href="#contact" class="btn-g">Kontakt aufnehmen</a>
                </div>
            </div>
            <div class="hero-hint">scroll down</div>
        </section>

        <section class="services" id="services">
            <div class="services-hd">
                <div class="label reveal">// 01 Leistungen</div>
                <h2 class="sec-title reveal">Was wir <br class="mobile-break">für dich bauen</h2>
            </div>
            <div class="svc-grid">
                <div class="svc-card reveal">
                    <div class="svc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    </div>
                    <div class="svc-name">Websites</div>
                    <p class="svc-desc">Schnelle, zugängliche und suchmaschinenoptimierte Webseiten — maßgeschneidert, ohne unnötigen Overhead.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <div class="svc-name">Landingpages</div>
                    <p class="svc-desc">Conversion-optimierte Seiten, die Besucher in Kunden verwandeln. Klar, fokussiert und messbar.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                    </div>
                    <div class="svc-name">Web-Applikationen</div>
                    <p class="svc-desc">Komplexe Webanwendungen, APIs und Backends — von der Konzeption bis zum Deployment.</p>
                </div>
                <div class="svc-card reveal">
                    <div class="svc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <div class="svc-name">Hosting & Pflege</div>
                    <p class="svc-desc">Zuverlässiges Hosting, kontinuierliche Wartung und persönliche Betreuung deiner digitalen Präsenz.</p>
                </div>
            </div>
        </section>

        <section class="work" id="work">
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
                                <a href="<?= $project['link'] ?>" target="_blank" class="p-link">Live ansehen <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1em; height: 1em;"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg></a>
                            </div>
                        </div>
                        <div class="project-visual">
                            <div class="browser-frame">
                                <div class="browser-top">
                                    <div class="dots"><span></span><span></span><span></span></div>
                                    <div class="url-bar"><?= $project['name'] ?></div>
                                </div>
                                <div class="image-wrapper">
                                    <?php 
                                        $mainImg = isset($project['images']['dark']) ? $project['images']['dark'] : $project['images']['light'];
                                        $dimensions = getImageData($mainImg);
                                        $aspectRatio = $dimensions['w'] . ' / ' . $dimensions['h'];
                                    ?>
                                    <?php if (isset($project['images']['dark']) && isset($project['images']['light'])): ?>
                                        <div class="progressive-img" data-dark="<?= $project['images']['dark'] ?>" data-light="<?= $project['images']['light'] ?>" style="aspect-ratio: <?= $aspectRatio ?>;">
                                            <img src="/img?src=<?= $project['images']['dark'] ?>&w=100&q=20" alt="<?= $project['name'] ?>" class="work-img dark-only low-res" loading="lazy">
                                            <img src="/img?src=<?= $project['images']['light'] ?>&w=100&q=20" alt="<?= $project['name'] ?>" class="work-img light-only low-res" loading="lazy">
                                        </div>
                                    <?php else: ?>
                                        <div class="progressive-img" data-src="<?= $mainImg ?>" style="aspect-ratio: <?= $aspectRatio ?>;">
                                            <img src="/img?src=<?= $mainImg ?>&w=100&q=20" alt="<?= $project['name'] ?>" class="work-img low-res" loading="lazy">
                                        </div>
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
            <h2 class="contact-title reveal">Dein Projekt <br class="mobile-break">wartet auf <em>uns.</em></h2>
            <a href="mailto:info@ternis-edv.de" class="contact-mail">info@ternis-edv.de</a>
        </section>
    </main>

<?php
require_once __DIR__ . '/partials/footer.php';
?>

<section class="work" id="work">
    <div class="work-hd">
        <div class="label reveal">// Projekte</div>
        <h2 class="sec-title reveal">Ausgewählte Arbeiten</h2>
    </div>

    <div class="work-list">


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
                                $lightImg = $project['images']['light'] ?? (isset($project['images']['dark']) ? $project['images']['dark'] : '');
                                $darkImg = $project['images']['dark'] ?? (isset($project['images']['light']) ? $project['images']['light'] : '');
                                $currentImg = (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'theme-light') ? $lightImg : $darkImg;
                                
                                $dimensions = getImageData($lightImg ?: $darkImg);
                                $aspectRatio = $dimensions['w'] . ' / ' . $dimensions['h'];
                            ?>
                            <div class="native-img" style="aspect-ratio: <?= $aspectRatio ?>;">
                                <img 
                                    src="/img?src=<?= $currentImg ?>&w=1200&q=85" 
                                    alt="<?= $project['name'] ?>" 
                                    class="work-img theme-sensitive" 
                                    data-light="/img?src=<?= $lightImg ?>&w=1200&q=85" 
                                    data-dark="/img?src=<?= $darkImg ?>&w=1200&q=85"
                                    loading="lazy">
                            </div>
                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
    </div>
    <div class="global-project-nav project-nav">
        <button class="nav-btn prev-btn" disabled aria-label="Vorheriges Projekt">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1.5em; height: 1.5em;"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button class="nav-btn next-btn" aria-label="Nächstes Projekt">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1.5em; height: 1.5em;"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
    </div>
</section>

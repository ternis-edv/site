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

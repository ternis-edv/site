<?php $linkStats = \App\Classes\LinkStats::get(); ?>
<section class="more-projects" id="more-projects">
    <div class="label reveal">// Mehr entdecken</div>
    <h2 class="sec-title reveal">Weitere Projekte</h2>
    <article class="more-project reveal">
        <div>
            <h3><a href="https://ternis.link" target="_blank" rel="noopener noreferrer">ternis.link <span aria-hidden="true">↗</span></a></h3>
            <p>Souveränes und DSGVO-konformes Link-Kürzen mit KI-gestütztem Spam-Schutz – und vieles mehr.</p>
            <ul class="project-domains" aria-label="Weitere Domains von ternis.link">
                <?php foreach (['meinlink.at', 'href.re', 'href.nz', 'clicked.at'] as $domain): ?>
                    <li><a href="https://<?= $domain ?>" target="_blank" rel="noopener noreferrer"><?= $domain ?> ↗</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if ($linkStats !== null): ?>
            <dl class="link-stats" aria-label="Statistik des Link-Netzwerks">
                <?php foreach (['total_links' => 'Links', 'total_clicks' => 'Klicks', 'qr_codes' => 'QR-Codes'] as $key => $label): ?>
                    <div><dt><?= $label ?></dt><dd><?= number_format($linkStats[$key], 0, ',', '.') ?></dd></div>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </article>
</section>

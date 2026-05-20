<?php
require_once __DIR__ . '/partials/projects_data.php';
require_once __DIR__ . '/partials/header.php';
?>

    <main>
        <?php 
            include __DIR__ . '/partials/home/hero.php';
            include __DIR__ . '/partials/home/services.php';
            include __DIR__ . '/partials/home/work.php';
            include __DIR__ . '/partials/home/about.php';
            include __DIR__ . '/partials/home/contact.php';
        ?>
    </main>

<?php
require_once __DIR__ . '/partials/footer.php';
?>

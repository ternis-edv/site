<?php
// Function to get image dimensions with a simple file-based cache to avoid repeated hits
function getImageData($path) {
    $fullPath = __DIR__ . '/../../../' . $path;
    if (!file_exists($fullPath)) return ['w' => 1600, 'h' => 1000]; // Fallback

    $cacheFile = __DIR__ . '/../../../storage/cache/dimensions_' . md5($path) . '.json';
    if (file_exists($cacheFile) && filemtime($cacheFile) > filemtime($fullPath)) {
        return json_decode(file_get_contents($cacheFile), true);
    }

    $size = getimagesize($fullPath);
    $data = ['w' => $size[0], 'h' => $size[1], 'ratio' => round($size[1] / $size[0], 4)];

    if (!is_dir(dirname($cacheFile))) mkdir(dirname($cacheFile), 0755, true);
    file_put_contents($cacheFile, json_encode($data));

    return $data;
}

// Set is_hidden to true to omit a project from the public showcase.
$projects = [
    [
        'is_hidden' => true,
        'id' => 'ternismail',
        'name' => 'Ternismail',
        'domain' => 'ternismail.de',
        'type' => 'Private Mail Infrastructure',
        'desc' => 'Ein eigenes Mailsystem für dynamische email-addressen, spam-schutz und Privatsphäre. Zudem eine weniger generische und unprofessionenlle @gmail.com.',
        'stack' => ['PHP', 'Postfix', 'Tailwind', 'SMTP', 'DMARC', 'RoundCube Webmail', 'Landingpage'],
        'images' => [
            'light' => 'assets/img/work/ternismail.de__LIGHT.png'
        ],
        'link' => 'https://ternismail.de',
        'color' => '#10b981'
    ],
    [
        'is_hidden' => false,
        'id' => 'dnbx',
        'name' => 'Domain Box',
        'domain' => 'dnbx.de',
        'type' => 'Domain Management',
        'desc' => 'Ein System zum Managen meiner/unserer web-Domains.',
        'stack' => ['PHP', 'custom CSS', 'REST', 'JavaScript', 'localStorage'],
        'images' => [
            'light' => 'assets/img/work/dnbx.de__LIGHT.png',
            'dark' => 'assets/img/work/dnbx.de__DARK.png'
        ],
        'link' => 'https://dnbx.de',
        'color' => '#C1FF47'
    ],
    [
        'is_hidden' => false,
        'id' => 'dogwaterdev',
        'name' => 'dogwaterdev.de',
        'domain' => 'dogwaterdev.de',
        'type' => 'Dev Community',
        'desc' => '',
        'stack' => ['custom CSS', 'External REST', 'JavaScript', 'localStorage'],
        'images' => [
            'light' => 'assets/img/work/dogwaterdev.de__LIGHT.png',
            'dark' => 'assets/img/work/dogwaterdev.de__DARK.png'
        ],
        'link' => 'https://dogwaterdev.de',
        'color' => '#3b82f6'
    ],
    [
        'is_hidden' => false,
        'id' => 'getmyname',
        'name' => 'getmy.name',
        'domain' => 'getmy.name',
        'type' => 'Portfolio API',
        'desc' => '',
        'stack' => ['Laravel', 'PHP', 'NPM', 'REST', 'MySQL', 'Chart.JS', 'Tailwind'],
        'images' => [
            'light' => 'assets/img/work/getmy.name_lander_LIGHT.png',
            'dark' => 'assets/img/work/getmy.name_lander_DARK.png'
        ],
        'link' => 'https://getmy.name',
        'color' => '#8b5cf6'
    ],
    [
        'is_hidden' => false,
        'id' => 'louixch',
        'name' => 'louixch.de',
        'domain' => 'louixch.de',
        'type' => 'Creative Portfolio (Website)',
        'desc' => '',
        'stack' => ['Custom CSS', 'JavaScript', 'Three.JS', 'External REST', 'localStorage'],
        'images' => [
            'dark' => 'assets/img/work/louixch.de__DARK.png'
        ],
        'link' => 'https://louixch.de',
        'color' => '#f43f5e'
    ],
    [
        'is_hidden' => true,
        'id' => 'api-sandbox',
        'name' => 'API Sandbox',
        'domain' => 'api-sandbox.de',
        'type' => 'Developer Tool + Website',
        'desc' => '',
        'stack' => ['Tailwind', 'JavaScript'],
        'images' => [
            'light' => 'assets/img/work/api-sandbox.de_lander__LIGHT.png'
        ],
        'link' => '#',
        'color' => '#10b981'
    ],
    [
        'is_hidden' => false,
        'id' => 'wonnegauer',
        'name' => 'Wonnegauer Designwerkstatt',
        'domain' => 'wonnegauer-designwerkstatt.de',
        'type' => 'Website',
        'desc' => '',
        'stack' => ['Vanilla JS', 'PHP', 'Custom CSS', 'localStorage'],
        'images' => [
            'light' => 'assets/img/work/wonnegauer-designwerkstatt.de_LANDER__LIGHT.png'
        ],
        'link' => 'https://wonnegauer-designwerkstatt.de',
        'color' => '#d97706'
    ],
    [
        'is_hidden' => false,
        'id' => 'pleasehireme',
        'name' => 'pleasehireme.eu',
        'domain' => null,
        'type' => 'Job Matching Platform',
        'desc' => '',
        'stack' => ['Custom CSS', 'JavaScript'],
        'images' => [
            'light' => 'assets/img/work/pleasehireme.eu__LIGHT.png'
        ],
        'link' => 'https://pleasehireme.eu',
        'color' => '#ef4444'
    ],
    [
        'is_hidden' => false,
        'id' => 'nocturne',
        'name' => 'Nocturne Lander',
        'domain' => 'nocturne.tp.xpsys.de',
        'type' => 'Design Template',
        'desc' => '',
        'stack' => ['HTML5', 'CSS3'],
        'images' => [
            'dark' => 'assets/img/work/TEMPLATE__nocturne_lander__DARK.png'
        ],
        'link' => 'https://nocturne.tp.xpsys.de',
        'color' => '#f59e0b'
    ],
    [
        'is_hidden' => false,
        'id' => 'twins-on-ice',
        'name' => 'twins-on-ice.de',
        'domain' => null,
        'type' => 'Unofficial Fanpage',
        'desc' => '',
        'stack' => ['PHP', 'Vanilla JS', 'CSS3'],
        'images' => [
            'light' => 'assets/img/work/twins-on-ice.de_lander__LIGHT.png'
        ],
        'link' => 'https://twins-on-ice.de',
        'color' => '#00a8ff'
    ],
    [
        'is_hidden' => false,
        'id' => 'leniwoess',
        'name' => 'leniwoess.de',
        'domain' => 'leniwoess.de',
        'type' => 'Unofficial Website',
        'desc' => '',
        'stack' => ['PHP', 'Vanilla JS', 'CSS3'],
        'images' => [
            'dark' => 'assets/img/work/leniwoess.de__DARK.png'
        ],
        'link' => 'https://leniwoess.de',
        'color' => '#00a8ff'
    ],
    [
        'is_hidden' => false,
        'id' => 'twinsonice-link',
        'name' => 'Twins on Ice Links',
        'domain' => 'twinsonice.link / icelnk.de',
        'type' => 'Link Hub & Short Links',
        'desc' => 'Ein zentraler Link-Hub für Twins on Ice mit Social Media, Musik, Stories und Partnern. Ergänzt durch Kurzlinks über icelnk.de und ein QR-Code-Studio.',
        'stack' => ['Link Hub', 'Short Links', 'QR-Codes'],
        'images' => [
            'dark' => 'assets/img/work/twinsonice.link__DARK.png'
        ],
        'link' => 'https://twinsonice.link',
        'color' => '#00a8ff'
    ],
    [
        'is_hidden' => false,
        'id' => 'risikoclo',
        'name' => 'RISIKO.',
        'domain' => 'risikoclo.de',
        'type' => 'Unofficial Brand Website',
        'desc' => 'Inoffizieller Wegweiser zur Streetwear-Marke RISIKO. von Tonverändert. Mit Produktübersicht, Schnellansichten und direkten Links zum offiziellen Shop auf risikoclo.com sowie zu den Social-Media-Kanälen.',
        'stack' => ['Produktübersicht', 'Social Media', 'Shop-Verlinkung'],
        'images' => [
            'light' => 'assets/img/work/risikoclo.de__LIGHT.png'
        ],
        'link' => 'https://risikoclo.de',
        'color' => '#ef4444'
    ],
    [
        'is_hidden' => false,
        'id' => 'tonveraendert',
        'name' => 'Tonverändert',
        'domain' => 'tonveraendert.de',
        'type' => 'Unofficial Creator Hub',
        'desc' => 'Ein inoffizieller Hub rund um Tonverändert: Videos, Streams und Social-Media-Kanäle auf YouTube, Twitch, Instagram und TikTok an einem Ort – ergänzt durch Links zur Modemarke RISIKO. Clothing.',
        'stack' => ['Creator Hub', 'Social Media', 'Video & Streams'],
        'images' => [
            'light' => 'assets/img/work/tonveraendert.de__LIGHT.png'
        ],
        'link' => 'https://tonveraendert.de',
        'color' => '#f97316'
    ],
];

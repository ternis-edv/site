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

// Re-defining projects with data for clarity
$projects = [
    [
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
        'id' => 'louixch',
        'name' => 'louixch.de',
        'domain' => 'louixch.de',
        'type' => 'Creative Portfolio (Website)',
        'desc' => '',
        'stack' => ['Custom CSS', 'JavaScript', 'Three.JS', 'External REST', 'localStorage'],
        'images' => [
            'dark' => 'assets/img/work/louixch.de__DARK.png'
        ],
        'link' => '#',
        'color' => '#f43f5e'
    ],
    [
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
        'id' => 'wonnegauer',
        'name' => 'Wonnegauer Designwerkstatt',
        'domain' => 'wonnegauer-designwerkstatt.de',
        'type' => 'Website',
        'desc' => '',
        'stack' => ['Vanilla JS', 'PHP', 'Custom CSS', 'localStorage'],
        'images' => [
            'light' => 'assets/img/work/wonnegauer-designwerkstatt.de_LANDER__LIGHT.png'
        ],
        'link' => '#',
        'color' => '#d97706'
    ],
    [
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
        'id' => 'leniwoess',
        'name' => 'leniwoess.de',
        'domain' => 'leniwoess.de',
        'type' => 'Unofficial Website',
        'desc' => '',
        'stack' => ['PHP', 'Vanilla JS', 'CSS3'],
        'images' => [
            'light' => 'assets/img/work/leniwoess.de__DARK.png'
        ],
        'link' => 'https://leniwoess.de',
        'color' => '#00a8ff'
    ],
];

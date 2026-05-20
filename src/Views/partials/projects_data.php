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
    ],
    [
        'id' => 'pleasehireme',
        'name' => 'pleasehireme.eu',
        'type' => 'Job Matching Platform',
        'desc' => 'A modern platform connecting developers with innovative startups. Built with a focus on candidate experience and streamlined hiring workflows.',
        'stack' => ['Vue.js', 'Firebase', 'Tailwind'],
        'images' => [
            'light' => 'assets/img/work/pleasehireme.eu__LIGHT.png'
        ],
        'link' => 'https://pleasehireme.eu',
        'color' => '#ef4444'
    ],
    [
        'id' => 'nocturne',
        'name' => 'Nocturne Lander',
        'type' => 'Design Template',
        'desc' => 'A dark-themed, high-impact landing page template designed for creative agencies and digital artists.',
        'stack' => ['HTML5', 'CSS3', 'GSAP'],
        'images' => [
            'dark' => 'assets/img/work/TEMPLATE__nocturne_lander__DARK.png'
        ],
        'link' => '#',
        'color' => '#f59e0b'
    ]
];

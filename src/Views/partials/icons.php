<?php
/** Decorative SVG icons inherit their size and color from the surrounding UI. */
function site_icon(string $name): string
{
    $paths = [
        'info' => '<circle cx="12" cy="12" r="9"/><path d="M12 11v6m0-10h.01"/>',
        'close' => '<path d="m6 6 12 12M6 18 18 6"/>',
        'browser' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M7 6.5h.01m3 0h.01"/>',
        'arrow-left' => '<path d="M19 12H5m6-6-6 6 6 6"/>',
        'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
        'expand' => '<path d="M8 3H3v5m13-5h5v5M3 16v5h5m13-5v5h-5"/>',
        'collapse' => '<path d="M3 8h5V3m8 0v5h5M8 21v-5H3m13 5v-5h5"/>',
        'arrow-right' => '<path d="M5 12h14m-6-6 6 6-6 6"/>',
        'arrow-down' => '<path d="M12 5v14m-6-6 6 6 6-6"/>',
        'arrow-up-right' => '<path d="M7 17 17 7M7 7h10v10"/>',
    ];
    return '<svg class="ui-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . ($paths[$name] ?? '') . '</svg>';
}

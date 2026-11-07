<?php
/** Decorative SVG icons inherit their size and color from the surrounding UI. */
function site_icon(string $name): string
{
    $paths = [
        'arrow-right' => '<path d="M5 12h14m-6-6 6 6-6 6"/>',
        'arrow-down' => '<path d="M12 5v14m-6-6 6 6 6-6"/>',
        'arrow-up-right' => '<path d="M7 17 17 7M7 7h10v10"/>',
    ];
    return '<svg class="ui-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . ($paths[$name] ?? '') . '</svg>';
}

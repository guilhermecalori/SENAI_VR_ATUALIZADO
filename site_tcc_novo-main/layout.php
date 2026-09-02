<?php

function render_icon(string $name, string $class = ''): string
{
    $base = 'aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"';
    $icons = [
        'vrpano' => '<svg ' . $base . '><path d="M4 7.5C4 6.12 5.12 5 6.5 5h11C18.88 5 20 6.12 20 7.5v6c0 1.38-1.12 2.5-2.5 2.5H14l-2 2-2-2H6.5C5.12 16 4 14.88 4 13.5v-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 9.5h6M8.5 12h7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'home' => '<svg ' . $base . '><path d="M4 11.5 12 5l8 6.5V19a1 1 0 0 1-1 1h-4.5v-5h-5V20H5a1 1 0 0 1-1-1v-7.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'forum' => '<svg ' . $base . '><path d="M5 6.8A2.8 2.8 0 0 1 7.8 4h8.4A2.8 2.8 0 0 1 19 6.8v5.4A2.8 2.8 0 0 1 16.2 15H11l-4.2 3v-3.3A2.8 2.8 0 0 1 5 12.2V6.8Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 8.2h8M8 10.8h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'auto_stories' => '<svg ' . $base . '><path d="M12 6.2c-1.7-1.3-3.7-1.9-6-1.9v11.7c2.3 0 4.3.6 6 1.9m0-11.7c1.7-1.3 3.7-1.9 6-1.9v11.7c-2.3 0-4.3.6-6 1.9m0-11.7v11.7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'smart_display' => '<svg ' . $base . '><rect x="4" y="6" width="16" height="10" rx="1.8" stroke="currentColor" stroke-width="1.7"/><path d="M9 18h6M10.5 16h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M8 9.2 11.8 12 8 14.8V9.2Z" fill="currentColor"/></svg>',
        'history_edu' => '<svg ' . $base . '><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M5 7.5A3.5 3.5 0 0 1 8.5 4H20v11.5A3.5 3.5 0 0 1 16.5 19H8A3 3 0 0 0 5 22V7.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'person' => '<svg ' . $base . '><path d="M12 11.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.7"/><path d="M5.5 20a6.5 6.5 0 0 1 13 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'notifications' => '<svg ' . $base . '><path d="M15 17H9m8-2H7l1.2-1.5c.5-.7.8-1.6.8-2.4V10a3 3 0 1 1 6 0v1.1c0 .8.3 1.7.8 2.4L17 15Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10 17a2 2 0 0 0 4 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'logout' => '<svg ' . $base . '><path d="M10 17.5H7.2A2.2 2.2 0 0 1 5 15.3V8.7A2.2 2.2 0 0 1 7.2 6.5H10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M13 8l3 4-3 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 12H10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'manage_accounts' => '<svg ' . $base . '><path d="M14.5 10.2a2.8 2.8 0 1 0-5.6 0 2.8 2.8 0 0 0 5.6 0Z" stroke="currentColor" stroke-width="1.7"/><path d="M5.5 20a6.5 6.5 0 0 1 13 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'smart_toy' => '<svg ' . $base . '><rect x="7" y="6" width="10" height="12" rx="3" stroke="currentColor" stroke-width="1.7"/><path d="M10 9h.01M14 9h.01M9 13c1 .8 2.1 1.2 3 .8.9.4 2 .1 3-.8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'help' => '<svg ' . $base . '><path d="M12 17.2v.1" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/><path d="M9.6 9.6a2.6 2.6 0 1 1 4.3 2c-.7.5-1.4 1-1.4 2.1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/></svg>',
        'book_5' => '<svg ' . $base . '><path d="M7 4.5h9a2 2 0 0 1 2 2V19l-5-2-5 2-3-1.2V6.5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 7.5h6M9 10.5h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'lock_open' => '<svg ' . $base . '><path d="M8 11V8.5A4 4 0 0 1 16 8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><rect x="6" y="11" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M12 14v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'auto_awesome' => '<svg ' . $base . '><path d="M12 4l1.7 4.3L18 10l-4.3 1.7L12 16l-1.7-4.3L6 10l4.3-1.7L12 4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'chevron_right' => '<svg ' . $base . '><path d="m9 6 6 6-6 6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'attachment' => '<svg ' . $base . '><path d="M8.5 12.5 13 8a3 3 0 0 1 4.2 4.2l-6 6a5 5 0 0 1-7.1-7.1l7-7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'mic' => '<svg ' . $base . '><rect x="9" y="4.5" width="6" height="10" rx="3" stroke="currentColor" stroke-width="1.7"/><path d="M12 15v3.5M8.5 19h7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'send' => '<svg ' . $base . '><path d="m5 12 14-7-4 14-3.1-5L5 12Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'lightbulb' => '<svg ' . $base . '><path d="M9 18h6M10 21h4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M12 4a6 6 0 0 0-3.5 10.9c.5.4.8 1 .8 1.6h5.4c0-.6.3-1.2.8-1.6A6 6 0 0 0 12 4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'arrow_forward' => '<svg ' . $base . '><path d="m10 7 5 5-5 5M6 12h9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'science' => '<svg ' . $base . '><path d="M10 4h4M11 4v5l-4.2 7A2 2 0 0 0 8.6 19h6.8a2 2 0 0 0 1.8-3l-4.2-7V4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'calculate' => '<svg ' . $base . '><rect x="6" y="4.5" width="12" height="15" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8.5 8h7M8.5 11.5h2M12 11.5h2M15.5 11.5h0M8.5 15h2M12 15h2M15.5 15h0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'precision_manufacturing' => '<svg ' . $base . '><path d="M8 9.5 12 7l4 2.5V14l-4 2.5-4-2.5V9.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 7V4.5M12 16.5V19.5M8 11.5H5.5M18.5 11.5H16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'history' => '<svg ' . $base . '><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/></svg>',
        'public' => '<svg ' . $base . '><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M3.8 12h16.4M12 3.8c2.2 2.1 3.5 4.8 3.5 8.2S14.2 17.9 12 20c-2.2-2.1-3.5-4.8-3.5-8s1.3-6 3.5-8.2Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'translate' => '<svg ' . $base . '><path d="M5 7h8M9 5.5v1.2c0 2.8-1.4 5.2-4 7M11 16l3.5 3.5M14 7h5M18 5.5c-.4 3.3-2.2 6-5 8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 12c.6 1.3 1.4 2.3 2.4 3.1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'groups' => '<svg ' . $base . '><path d="M7.5 13.5a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" stroke="currentColor" stroke-width="1.7"/><path d="M3.8 19a5.2 5.2 0 0 1 7.4-4.7M20.2 19a5.2 5.2 0 0 0-7.4-4.7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'psychology_alt' => '<svg ' . $base . '><path d="M12 4.5a5 5 0 0 0-3.2 8.8c.6.5 1 1.2 1 2v.2h4.4v-.2c0-.8.4-1.5 1-2A5 5 0 0 0 12 4.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10.5 18h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'palette' => '<svg ' . $base . '><path d="M12 4.5a7.5 7.5 0 1 0 0 15h1.2a1.3 1.3 0 0 1 1.3 1.3 1.7 1.7 0 0 0 1.7 1.7H17a4 4 0 0 0 4-4v-1A12.5 12.5 0 0 0 12 4.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="8.2" cy="10" r="1" fill="currentColor"/><circle cx="11.4" cy="8.2" r="1" fill="currentColor"/><circle cx="15" cy="9.5" r="1" fill="currentColor"/></svg>',
        'fitness_center' => '<svg ' . $base . '><path d="M7 10v4M5 8v8M17 10v4M19 8v8M8.5 12h7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M10.5 9h3v6h-3z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'terminal' => '<svg ' . $base . '><path d="m6 8 4 4-4 4M11 16h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'partly_cloudy_day' => '<svg ' . $base . '><path d="M10 18h8a4 4 0 0 0 .4-8 5.5 5.5 0 0 0-10.8 1.8A3.5 3.5 0 0 0 10 18Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M7 18h13" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'token' => '<svg ' . $base . '><rect x="5" y="5" width="14" height="14" rx="4" stroke="currentColor" stroke-width="1.7"/><path d="M12 8v8M8 12h8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'alternate_email' => '<svg ' . $base . '><path d="M4.5 7.5A3.5 3.5 0 0 1 8 4h8a3.5 3.5 0 0 1 3.5 3.5v9A3.5 3.5 0 0 1 16 20H8a3.5 3.5 0 0 1-3.5-3.5v-9Z" stroke="currentColor" stroke-width="1.7"/><path d="M7.5 9.5h9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M7.5 12h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'lock' => '<svg ' . $base . '><path d="M8 11V8.5A4 4 0 0 1 16 8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><rect x="6" y="11" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M12 14v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'visibility' => '<svg ' . $base . '><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="12" cy="12" r="2.8" stroke="currentColor" stroke-width="1.7"/></svg>',
        'visibility_off' => '<svg ' . $base . '><path d="m4 4 16 16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M10.6 5.4A10 10 0 0 1 21.5 12s-3.5 6-9.5 6a10 10 0 0 1-4.1-.9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.4 8.2A3.8 3.8 0 0 0 7 12a4 4 0 0 0 5 3.9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'close' => '<svg ' . $base . '><path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/></svg>',
        'language' => '<svg ' . $base . '><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M3.8 12h16.4M12 3.8c2.2 2.1 3.5 4.8 3.5 8.2S14.2 17.9 12 20c-2.2-2.1-3.5-4.8-3.5-8s1.3-6 3.5-8.2Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'arrow_outward' => '<svg ' . $base . '><path d="M8 16 16 8M10 8h6v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'arrow_back' => '<svg ' . $base . '><path d="m14 7-5 5 5 5M18 12H9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'play_arrow' => '<svg ' . $base . '><path d="m9 7 8 5-8 5V7Z" fill="currentColor"/></svg>',
        'videocam' => '<svg ' . $base . '><rect x="4.5" y="7" width="11" height="10" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="m15.5 10 4-2v8l-4-2v-4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'psychology' => '<svg ' . $base . '><path d="M12 4.5a5.5 5.5 0 0 0-3.2 10v1.5h6.4V14.5A5.5 5.5 0 0 0 12 4.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10.5 18h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'check_circle' => '<svg ' . $base . '><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="m8.5 12 2.4 2.4 4.6-4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'quiz' => '<svg ' . $base . '><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M10.5 9.2A2.2 2.2 0 0 1 14.7 10c0 1.4-1.5 1.7-2 2.8-.1.3-.2.6-.2 1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M12 16.6v.1" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/></svg>',
        'neurology' => '<svg ' . $base . '><path d="M10 4.8a3.8 3.8 0 0 0-2.6 6.5A3.8 3.8 0 0 0 10 17h4a3.8 3.8 0 0 0 2.6-5.7A3.8 3.8 0 0 0 14 4.8h-4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 8v8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'settings_input_antenna' => '<svg ' . $base . '><path d="M12 4v6M8 10l4 4 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.5 16.5a8 8 0 0 1 11 0M8.8 14.2a4.5 4.5 0 0 1 6.4 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'apps' => '<svg ' . $base . '><path d="M6 6h2V4H6v2Zm5 0h2V4h-2v2Zm5 0h2V4h-2v2ZM6 11h2V9H6v2Zm5 0h2V9h-2v2Zm5 0h2V9h-2v2ZM6 16h2v-2H6v2Zm5 0h2v-2h-2v2Zm5 0h2v-2h-2v2Zm5 0h2v-2h-2v2Z" fill="currentColor"/></svg>',
        'view_in_ar' => '<svg ' . $base . '><path d="M7 7.5 12 5l5 2.5v6L12 16l-5-2.5v-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 5v11" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'security' => '<svg ' . $base . '><path d="M12 4.8 18 7v4.3c0 4.1-2.5 6.8-6 8.4-3.5-1.6-6-4.3-6-8.4V7l6-2.2Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10.2 12 11.6 13.4 14 10.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'power_settings_new' => '<svg ' . $base . '><path d="M12 4.5v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 6.2a7 7 0 1 0 8 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'wifi_off' => '<svg ' . $base . '><path d="m4 5 16 14" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M6 10.5a11.5 11.5 0 0 1 12 0M8.8 13.2a7.8 7.8 0 0 1 6.4 0M11 16h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'signal_wifi_off' => '<svg ' . $base . '><path d="m4 5 16 14" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M6.5 9.2a10 10 0 0 1 11 0M9 12a6 6 0 0 1 6 0M11.5 15h1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'sports_score' => '<svg ' . $base . '><path d="M7 7h10v10H7z" stroke="currentColor" stroke-width="1.7"/><path d="M9 9h6M9 12h3M14 12h1M9 15h6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'directions_run' => '<svg ' . $base . '><circle cx="14" cy="6.5" r="1.5" fill="currentColor"/><path d="M10 10.5 12.5 9l2.2 1.2L16 13l2.5 1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 18l2.3-4.3M12 13l2.3 2.7M12 13l-2.3-2.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'experiment' => '<svg ' . $base . '><path d="M10 4h4M11 4v5l-4 7a2 2 0 0 0 1.7 3h4.6a2 2 0 0 0 1.7-3l-4-7V4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'account_balance' => '<svg ' . $base . '><path d="M12 4 4.5 8h15L12 4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M6 9v7M10 9v7M14 9v7M18 9v7M4 16h16M3 20h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'terrain' => '<svg ' . $base . '><path d="M4 18 9 9l3.2 5.7L15 11l5 7H4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>',
        'museum' => '<svg ' . $base . '><path d="M12 4 4.5 8h15L12 4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M6 9v7M10 9v7M14 9v7M18 9v7M4 16h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'brush' => '<svg ' . $base . '><path d="M5 19c2.5 0 3.5-1.2 4.4-3 .6-1.2 1.6-2 3-2 .9 0 1.4.4 1.8 1 .7 1 1.8 1.6 3 1.6 1.5 0 2.8-.8 3.8-2.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M14 6l4 4-6 6-4-4 6-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10 12h4M12 10v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        '3d_rotation' => '<svg ' . $base . '><path d="M7 8a5 5 0 0 1 10 0v8a5 5 0 0 1-10 0V8Z" stroke="currentColor" stroke-width="1.7"/><path d="M10 12h4M12 10v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
    ];

    return $icons[$name] ?? '';
}

function renderizar_pagina($titulo, $conteudo)
{
    // 1. DEFINE O FUSO HORÁRIO PARA BRASÍLIA
    date_default_timezone_set('America/Sao_Paulo');

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $pagina_atual = basename($_SERVER['PHP_SELF']);
    $usuario_nome = $_SESSION['usuario_nome'] ?? 'Estudante';
    $usuario_nome_seguro = htmlspecialchars($usuario_nome, ENT_QUOTES, 'UTF-8');
    $titulo_seguro = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');

    $menu = [
        'home.php' => ['Início', 'home'],
        'dashboard.php' => ['Chat', 'forum'],
        'tutorial.php' => ['Manual', 'auto_stories'],
        'quiosque.php' => ['Quiosque', 'smart_display'],
        'materias.php' => ['Matérias', 'history_edu'],
    ];

    // Agora o date() vai pegar a hora de Brasília corretamente
    $hora = date('H:i');
    $data = date('d/m/Y');
    $icon_vrpano = render_icon('vrpano', 'icon');
    $icon_person = render_icon('person', 'icon');
    $icon_logout = render_icon('logout', 'icon');
    $icon_manage = render_icon('manage_accounts', 'icon');
    $icon_notifications = render_icon('notifications', 'icon');

    $conteudo_principal = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{$titulo_seguro} | SENAI VR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: '#f1f5f9',
                        surface: '#ffffff',
                        surface2: '#f8fafc',
                        surface3: '#e2e8f0',
                        border: 'rgba(0, 0, 0, 0.06)',
                        borderStrong: 'rgba(0, 0, 0, 0.12)',
                        text: '#0f172a',
                        muted: '#64748b',
                        cyan: '#0891b2',
                        cyanSoft: 'rgba(8, 145, 178, 0.08)',
                        green: '#059669',
                        red: '#dc2626'
                    },
                    fontFamily: {
                        headline: ['Space Grotesk', 'sans-serif'],
                        body: ['Manrope', 'sans-serif']
                    },
                    boxShadow: {
                        soft: '0 18px 60px rgba(0, 0, 0, 0.08)',
                        panel: '0 10px 30px rgba(0, 0, 0, 0.06)'
                    },
                    borderRadius: {
                        xl2: '1.25rem',
                        xl3: '1.75rem',
                        xl4: '2.25rem'
                    }
                }
            }
        }
    </script>
    <style>
        :root { color-scheme: light; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(8, 145, 178, 0.04), transparent 32%),
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.03), transparent 28%),
                linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            color: #0f172a;
        }
        .headline { font-family: 'Space Grotesk', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.80);
            border: 1px solid rgba(0, 0, 0, 0.06);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }
        .panel {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }
        .sidebar-link {
            transition: all 180ms ease;
            border-left: 3px solid transparent;
            color: #475569;
        }
        .sidebar-link:hover {
            background: rgba(8, 145, 178, 0.04);
            color: #0f172a;
            border-left-color: rgba(8, 145, 178, 0.3);
        }
        .sidebar-link.active {
            background: rgba(8, 145, 178, 0.08);
            color: #0891b2 !important;
            border-left-color: #0891b2;
            box-shadow: inset 0 1px 0 rgba(0,0,0,0.02);
        }
        .sidebar-link.active span { color: #0891b2; }
        .status-dot { box-shadow: 0 0 0 6px rgba(8, 145, 178, 0.08); }
        .page-shell { min-height: 100vh; }
        .grid-faint {
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.3), transparent 70%);
            pointer-events: none;
        }
        .scrollbar-thin::-webkit-scrollbar { width: 8px; height: 8px; }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 9999px;
        }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .icon {
            width: 1.2rem;
            height: 1.2rem;
            display: inline-block;
            vertical-align: middle;
            flex: 0 0 auto;
        }

        main svg, h2 svg, header svg {
            display: inline-block !important;
            vertical-align: middle !important;
            max-width: 48px !important;
            max-height: 48px !important;
            width: 100% !important;
            height: auto !important;
        }

        .headline {
            display: flex !important;
            align-items: center !important;
        }
    </style>
</head>
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('aside a, .sidebar a, nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            const url = this.getAttribute('href');
            if (url && !url.startsWith('#') && !url.startsWith('javascript:')) {
                e.preventDefault();
                
                fetch(url)
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        // Busca a área de conteúdo principal específica
                        const novoConteudo = doc.querySelector('main') || doc.querySelector('.flex-1') || doc.body;
                        const conteudoAtual = document.querySelector('main') || document.querySelector('.flex-1') || document.body;
                        
                        if (novoConteudo && conteudoAtual) {
                            conteudoAtual.innerHTML = novoConteudo.innerHTML;
                            window.history.pushState({}, '', url);
                            
                            // Atualiza o estado visual do botão ativo no Menu Lateral
                            document.querySelectorAll('aside a, .sidebar a, nav a').forEach(a => {
                                a.classList.remove('active', 'bg-cyan-50', 'text-cyan-700', 'font-bold');
                            });
                            this.classList.add('active', 'bg-cyan-50', 'text-cyan-700', 'font-bold');
                            
                            // Reexecuta os scripts da nova página
                            novoConteudo.querySelectorAll('script').forEach(script => {
                                const novoScript = document.createElement('script');
                                if (script.src) {
                                    novoScript.src = script.src;
                                } else {
                                    novoScript.textContent = script.textContent;
                                }
                                document.body.appendChild(novoScript);
                            });
                        } else {
                            window.location.href = url;
                        }
                    })
                    .catch(() => {
                        window.location.href = url;
                    });
            }
        });
    });
});
</script>
<body class="text-text min-h-screen overflow-x-hidden">
    <div class="fixed inset-0 grid-faint"></div>

    <aside class="hidden lg:flex fixed inset-y-0 left-0 w-72 z-40 flex-col panel shadow-soft">
        <div class="px-6 pt-6 pb-5 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-cyanSoft border border-cyan-200 flex items-center justify-center shadow-panel text-cyan-600">
                    {$icon_vrpano}
                </div>
                <div>
                    <h1 class="headline text-lg font-bold tracking-tight text-slate-900">SENAI VR</h1>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto scrollbar-thin">
HTML;

    foreach ($menu as $url => [$label, $icon]) {
        $ativo = $pagina_atual === $url ? 'active' : '';
        $icone = render_icon($icon, 'icon');
        $conteudo_principal .= <<<HTML
            <a href="{$url}" class="sidebar-link {$ativo} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-600">
                <span class="text-[20px] text-slate-500">{$icone}</span>
                <span>{$label}</span>
            </a>
HTML;
    }

    $conteudo_principal .= <<<HTML
        </nav>

        <div class="p-4 border-t border-slate-200">
            <div class="rounded-2xl bg-surface2 border border-slate-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="relative w-11 h-11 rounded-full bg-cyanSoft border border-cyan-200 flex items-center justify-center text-cyan-600">
                        {$icon_person}
                        <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-green-500 status-dot border-2 border-white"></span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate user-name-display">{$usuario_nome_seguro}</p>
                        <p class="text-[10px] uppercase tracking-[0.25em] text-green-600 font-bold">Online</p>
                    </div>
                    <a href="../logout.php" class="ml-auto w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-slate-100 transition-colors" aria-label="Sair">
                        {$icon_logout}
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <div class="lg:pl-72 page-shell relative">
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/80 backdrop-blur-xl">
            <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="lg:hidden w-10 h-10 rounded-2xl bg-cyanSoft border border-cyan-200 flex items-center justify-center text-cyan-600">
                        {$icon_vrpano}
                    </div>
                    <div class="min-w-0">
                        <p class="headline text-sm sm:text-base font-bold leading-tight text-slate-800 truncate">{$titulo_seguro}</p>
                        <p class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-[0.25em]">SENAI VR • Interface institucional</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50/80 px-4 py-2 text-xs text-slate-600">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span>Operacional</span>
                    <span class="text-slate-300">•</span>
                    <span>{$data} {$hora}</span>
                </div>

                <div class="flex items-center gap-3 relative">
                    <div class="relative" id="profile-container">
                        <div id="profile-btn" class="hidden sm:flex flex-row items-center gap-2.5 h-9 rounded-full bg-slate-50 hover:bg-slate-100 border border-slate-200 pl-2.5 pr-4 text-xs font-semibold text-slate-700 transition-colors cursor-pointer select-none">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="lg:hidden px-4 sm:px-6 pt-4">
            <div class="glass rounded-2xl p-2 overflow-x-auto">
                <div class="flex gap-2 min-w-max">
HTML;

    foreach ($menu as $url => [$label, $icon]) {
        $ativo = $pagina_atual === $url ? 'bg-cyan-600 text-white border-cyan-600' : 'bg-white border-slate-200 text-slate-700';
        $icone = render_icon($icon, 'icon');
        $conteudo_principal .= <<<HTML
                    <a href="{$url}" class="inline-flex items-center gap-2 rounded-xl border {$ativo} px-4 py-2 text-sm font-semibold whitespace-nowrap transition-colors">
                        <span class="text-[18px]">{$icone}</span>
                        <span>{$label}</span>
                    </a>
HTML;
    }

    $conteudo_principal .= <<<HTML
                </div>
            </div>
        </div>

        <main class="relative bg-transparent">
            <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-6 lg:px-8 py-5 sm:py-6 lg:py-8">
                {$conteudo}
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('profile-btn');
            const dropdown = document.getElementById('profile-dropdown');
            const container = document.getElementById('profile-container');

            if (btn && dropdown) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function(e) {
                    if (!container.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
    // Intercepta todos os links internos para navegação sem recarregar
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        const estaTravado = localStorage.getItem('senai_menu_travado') === 'true';

        if (link && link.href && link.href.startsWith(window.location.origin) && !link.target) {
            // Se estiver no modo quiosque travado, faz transição suave via AJAX
            if (estaTravado) {
                e.preventDefault(); // Impede a navegação padrão que fecha a tela cheia

                fetch(link.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        // Substitui o conteúdo do container principal
                        const novoConteudo = doc.querySelector('main') || doc.body;
                        const containerAtual = document.querySelector('main') || document.body;
                        
                        if (novoConteudo && containerAtual) {
                            containerAtual.innerHTML = novoConteudo.innerHTML;
                            window.history.pushState({}, '', link.href);
                            
                            // Reexecuta funções e eventos necessários na nova página
                            if (typeof aplicarPrivacidadeGlobal === 'function') {
                                aplicarPrivacidadeGlobal();
                            }
                        } else {
                            window.location.href = link.href;
                        }
                    })
                    .catch(() => {
                        window.location.href = link.href;
                    });
            }
        }
    });
});
</script>

    <!-- SCRIPT DE PRIVACIDADE GLOBAL -->
    <script>
        function aplicarPrivacidadeGlobal() {
            const privacidadeAtiva = localStorage.getItem('senai_privacidade_ativa') === 'true';
            const nomeUsuario = "{$usuario_nome_seguro}";
            const primeiroNome = nomeUsuario.split(' ')[0];
            const NOME_ANONIMO = '********';

            // 1. Elementos diretos com a classe .user-name-display
            document.querySelectorAll('.user-name-display').forEach(el => {
                if (!el.dataset.nomeOriginal && el.innerText !== NOME_ANONIMO) {
                    el.dataset.nomeOriginal = el.innerText;
                }
                el.innerText = privacidadeAtiva ? NOME_ANONIMO : (el.dataset.nomeOriginal || nomeUsuario);
            });

            // 2. Elementos na barra lateral que contêm o nome do usuário
            if (primeiroNome) {
                document.querySelectorAll('aside span, aside div, aside p, .sidebar span, .sidebar div, .sidebar p').forEach(el => {
                    if (el.children.length === 0) {
                        if (el.innerText.includes(primeiroNome) || el.innerText === NOME_ANONIMO) {
                            if (!el.dataset.nomeOriginal && el.innerText !== NOME_ANONIMO) {
                                el.dataset.nomeOriginal = el.innerText;
                            }
                            el.innerText = privacidadeAtiva ? NOME_ANONIMO : el.dataset.nomeOriginal;
                        }
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', aplicarPrivacidadeGlobal);
        window.addEventListener('storage', aplicarPrivacidadeGlobal);
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. REMOVE O LAST_SYNC
        function removerLastSync() {
            const todosElementos = document.querySelectorAll('*');
            todosElementos.forEach(el => {
                if (el.children.length === 0 && el.textContent.toUpperCase().includes('LAST_SYNC')) {
                    el.remove();
                }
            });
        }
        removerLastSync();
        setTimeout(removerLastSync, 500);

        // 2. APLICA O EFEITO NEON DE ALTA VISIBILIDADE NAS BOLINHAS EXISTENTES
        const bolinhas = document.querySelectorAll('.bg-green-500, .status-dot, span[class*="rounded-full"]');
        
        bolinhas.forEach(bolinha => {
            if (bolinha.offsetWidth <= 20 || bolinha.offsetHeight <= 20) {
                bolinha.classList.add('animate-pulse');
                bolinha.style.backgroundColor = '#10b981'; // Verde vibrante
                bolinha.style.boxShadow = '0 0 8px #10b981, 0 0 16px rgba(16, 185, 129, 0.8)';
            }
        });

        // 3. INJETA A BOLINHA ULTRA VISÍVEL APENAS ONDE NÃO HOUVER OUTRA
        const palavrasChave = ['ONLINE', 'ATIVO'];
        const elementosTexto = document.querySelectorAll('span, p, div, b, strong');

        elementosTexto.forEach(el => {
            if (el.children.length === 0 && el.textContent) {
                const texto = el.textContent.toUpperCase();
                
                if (palavrasChave.some(palavra => texto.includes(palavra)) && !texto.includes('LAST_SYNC')) {
                    
                    const containerPai = el.closest('div.flex') || el.parentElement;
                    const jaTemBolinhaPorPerto = containerPai ? containerPai.querySelector('.status-dot, .bg-green-500, .dot-verde-solida') : null;

                    if (!jaTemBolinhaPorPerto && !el.innerHTML.includes('dot-verde-solida')) {
                        const bolinhaHTML = `<span class="dot-verde-solida animate-pulse" style="
                            display: inline-block;
                            width: 11px;
                            height: 11px;
                            background-color: #10b981;
                            border-radius: 50%;
                            margin-right: 8px;
                            vertical-align: middle;
                            box-shadow: 0 0 8px #10b981, 0 0 16px rgba(16, 185, 129, 0.8);
                        "></span>`;
                        el.insertAdjacentHTML('afterbegin', bolinhaHTML);
                    }
                }
            }
        });
    });
    </script>
</body>
</html>
HTML;

    echo $conteudo_principal;
}
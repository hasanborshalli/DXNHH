<?php

return [
    'site_name' => env('HALA_SITE_NAME', 'Hala | DXN Wellness'),
    'default_description' => env('HALA_DEFAULT_DESCRIPTION', 'High-quality natural products that support wellness and overall health.'),

    'colors' => [
        'primary' => env('HALA_PRIMARY_COLOR', '#1f3b29'),
        'secondary' => env('HALA_SECONDARY_COLOR', '#E8e3c9'),
    ],

    'social' => [
        'instagram' => env('HALA_INSTAGRAM_URL'),
        'facebook'  => env('HALA_FACEBOOK_URL'),
        'tiktok'    => env('HALA_TIKTOK_URL'),
    ],

    // Digits only, country code included. Example: 96170000000
    'whatsapp_number' => env('HALA_WHATSAPP_NUMBER'),

    // Where to receive contact form notifications (optional).
    'contact_notify_to' => env('HALA_CONTACT_NOTIFY_TO', env('MAIL_FROM_ADDRESS')),
];

<?php
return [
    'max_quota' => env('RV_MEDIA_MAX_QUOTA', 1024 * 1024 * 1024),
    'sizes' => [
        'thumb'     => '150x150',
        'featured'  => '450x300',
        'medium'    => '600x500'
    ],
    'driver' => [
        'local' => [
            'root' => public_path('upload'),
            'path' => env('RV_MEDIA_UPLOAD_PATH', '/upload'),
        ]
    ],
    'default-img'  => env('RV_MEDIA_DEFAULT_IMAGE', 'templates/frontend/no-image-available.jpg'), // Default image
];

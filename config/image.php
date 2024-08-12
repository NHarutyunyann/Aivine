<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    'sizes' => [
        'large' => ['width' => 800, 'height' => 564],
        'medium' => ['width' => 400, 'height' => 282],
        'small' => ['width' => 200, 'height' => 141],
        'extra_small' => ['width' => 100, 'height' => 71],
    ],

];

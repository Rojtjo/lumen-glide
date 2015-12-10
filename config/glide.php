<?php

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\Manipulators;

return [
    /**
     * Image route uri.
     */
    'uri' => 'img',

    /**
     * Configure whether the urls should have a signature.
     */
    'secure' => env('GLIDE_SECURE', true),

    /**
     * Configure the image manipulation driver.
     */
    'driver' => env('GLIDE_DRIVER', 'gd'),

    /**
     * Configure the source filesystem.
     */
    'source' => function () {
        return new Filesystem(new Local(
            storage_path('app/images/source')
        ));
    },

    /**
     * Configure the cache filesystem.
     */
    'cache' => function () {
        return new Filesystem(new Local(
            storage_path('app/images/cache')
        ));
    },

    /**
     * Image manipulators.
     */
    'manipulators' => function () {
        return [
            new Manipulators\Orientation(),
            new Manipulators\Crop(),
            new Manipulators\Size(2000 * 2000),
            new Manipulators\Brightness(),
            new Manipulators\Contrast(),
            new Manipulators\Gamma(),
            new Manipulators\Sharpen(),
            new Manipulators\Filter(),
            new Manipulators\Blur(),
            new Manipulators\Pixelate(),
            new Manipulators\Watermark(new Filesystem(new Local(
                storage_path('app/images/watermarks')
            ))),
            new Manipulators\Background(),
            new Manipulators\Border(),
            new Manipulators\Encode(),
        ];
    },
];

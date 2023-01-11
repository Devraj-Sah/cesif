<?php 
return[

'sizes' => [
        'thumbnail' => [
            'width'   => 120,
            'height'  => 120,
            'mode'    => 'crop',
            'quality' => 90
        ],
        'small' => [
            'width'   => 400,
            'height'  => 300,
            'mode'    => 'crop',
            'quality' => 90
        ],
        'medium' => [
            'width'   => 800,
            'height'  => 600,
            'mode'    => 'crop',
            'quality' => 90
        ],
        'large' => [
            'width'   => 1200,
            'height'  => 768,
            'mode'    => 'crop',
            'quality' => 90
        ],
        'x-large' => [
            'width'   => 1600,
            'height'  => 1200,
            'mode'    => 'crop',
            'quality' => 90
        ],
        'small-fit' => [
            'width'   => 400,
            'height'  => 300,
            'mode'    => 'fit',// || fit-x || fit-y
            'quality' => 90
        ],
    ]
];
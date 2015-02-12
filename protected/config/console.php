<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
//                    array(
//                        'class' => 'CWebLogRoute',
//                        'categories' => 'application',
//                        'levels' => 'error, warning, trace, profile, info',
//                    ),
                    array(
                        'class' => 'CFileLogRoute',
                        //'levels' => 'trace, info',
                        'levels' => 'info',
                    ),
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                    */
                ),
            ),
        ),
    )
);
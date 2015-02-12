<?php

return array(
    'appdRatchet' => array(
        'zmq' => array(
            /*
             * In console cmd
             * Binding to 127.0.0.1 means the only client that can connect is itself
             */
            'hostPull' => '127.0.0.1',
            'hostPush' => 'localhost', //in pusher
            'port' => 1234
        ),
        'webSocket' => array(
            'serverHost' => '0.0.0.0',
            'clienHost' => 'localhost',
            'port'  => 8080
        )
    )
);

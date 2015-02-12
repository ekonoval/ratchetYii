<?php

return array(
    /**
     * Workaround!
     * After changing ports an apache restart may help.
     */
    'appdRatchet' => array(
        'zmq' => array(
            /*
             * In console cmd - bindZmqPullListener
             * "Binding to 127.0.0.1 means the only client that can connect is itself"
             */
            'hostPull' => '127.0.0.1',
            'hostPush' => 'localhost', //in event riser
            'port' => 1234
        ),
        'webSocket' => array(
            'serverHost' => '0.0.0.0',
            'clientHost' => 'localhost',
            'port'  => 8080
        )
    )
);

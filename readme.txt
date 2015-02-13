- copy composer.json to protected
- composer install
    - install zmq php exension like described in
        http://blog.alexandervn.nl/2012/05/03/install-zeromq-php-ubuntu/
        http://php.net/manual/zmq.setup.php

- add composer autoloader to index.php and yiic.php
    like require __DIR__ . '/protected/vendor/autoload.php';

- change host and port params from config/params.php
    - example params have been taken from http://socketo.me/docs/push

- run custom ratched server command like ./yiic ratchetserver

- open /ratchet/testWs url and see console log. If everything is correct the line 'ws connected' should apear in console log
    - chatMsgSend and figureMove are test events which are passed via websocket (see page source)

- open /ratchet/generateEvents and generate some events /ratchet/testWs should display them in console.log
    - see RatchetController::actionGenerateEvents for event rising example. Pay attention to 'topicName' key, ehic is the name of event


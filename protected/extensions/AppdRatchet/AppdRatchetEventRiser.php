<?php

class AppdRatchetEventRiser
{
    /**
     * @var ZMQSocket
     */
    protected $socket;

    /**
     * @return AppdRatchetEventRiser
     */
    static function createByConfigParams()
    {
        $rtParamsGetter = new AppdRatchetParams();
        $serverPushAddress = $rtParamsGetter->createHostPortString(
            $rtParamsGetter->getWebSocketParam('clientHost'),
            $rtParamsGetter->getWebSocketPort()
        );
        //$eventRiser = new AppdRatchetEventRiser('localhost:1234');

        return new AppdRatchetEventRiser($serverPushAddress);
    }

    /**
     * @param string $serverPushAddress  - 'localhost:5555'
     */
    function __construct($serverPushAddress)
    {
        $context = new ZMQContext();
        $this->socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'somePesistentString');
        $this->socket->connect("tcp://{$serverPushAddress}");
    }

    public function riseEvent($pushEntry)
    {
        $this->socket->send(json_encode($pushEntry));
    }
}

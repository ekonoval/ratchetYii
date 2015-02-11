<?php
namespace RExt;

use ZMQ;
use ZMQContext;
use ZMQSocket;

class AppdRatchetEventRiser
{
    /**
     * @var ZMQSocket
     */
    protected $socket;

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

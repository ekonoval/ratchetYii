<?php

class AppdRatchetParams
{
    private function ensure($expression, $failMsg)
    {
        AppdRatchetException::ensure($expression, $failMsg);
    }

    private function getRatchetParams()
    {
        $this->ensure(Yii::app()->params["appdRatchet"], 'appdRatchet params are not set');
        return Yii::app()->params["appdRatchet"];
    }

    function getZmqParam($name)
    {
        $rtParams = $this->getRatchetParams();
        $this->ensure(isset($rtParams["zmq"]), 'No zmq key in appdRatchet params');

        $this->ensure(array_key_exists($name, $rtParams["zmq"]), "Param '{$name}' not found in appdRatchet[zmq] params");
        return $rtParams["zmq"][$name];
    }

    function getWebSocketParam($name)
    {
        $rtParams = $this->getRatchetParams();
        $this->ensure(isset($rtParams["webSocket"]), 'No webSocket key in appdRatchet params');

        $this->ensure(array_key_exists($name, $rtParams["webSocket"]), "Param '{$name}' not found in appdRatchet[webSocket] params");
        return $rtParams["webSocket"][$name];
    }

    public function getZmqPort()
    {
        return $this->getZmqParam('port');
    }

    public function getWebSocketPort()
    {
        return $this->getWebSocketParam('port');
    }

    public function createHostPortString($host, $port)
    {
        return sprintf(
            '%s:%s',
            $host,
            $port
        );
    }

    public function getClientWebsocketConnectionString()
    {
        $connStr = "ws://";
        $addr = $this->createHostPortString(
            $this->getWebSocketParam('clientHost'),
            $this->getWebSocketPort()
        );

        return $connStr.$addr;
    }
}

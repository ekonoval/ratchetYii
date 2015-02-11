<?php
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\ZMQ\Context;

class AppdRatchetCliServer
{
    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * @var AppdRatchetPusherBase
     */
    protected $pusher;

    protected $serverPoolAddress;

    protected $webSocketHost;
    protected $webSocketPort;

    /**
     * @param AppdRatchetPusherBase $pusher
     * @param string $serverPoolAddress - like '127.0.0.1:5555' - Binding to 127.0.0.1 means the only client that can connect is itself
     * @param string $websocketAddress - '0.0.0.0:8080' - Binding to 0.0.0.0 means remotes can connect
     */
    function __construct(AppdRatchetPusherBase $pusher, $serverPoolAddress, $websocketAddress)
    {
        $this->loop = Factory::create();
        $this->pusher = $pusher;

        $this->serverPoolAddress =  $serverPoolAddress;
        $this->parseWebSocketAddress($websocketAddress);
    }

    private function parseWebSocketAddress($websocketAddress)
    {
        $this->ensure(!empty($websocketAddress), 'Incorrect websocket address');

        $res = explode(':', $websocketAddress);
        $this->ensure(sizeof($res) == 2, 'Incorrect websocket address format');
        $this->webSocketHost = $res[0];
        $this->webSocketPort = $res[1];
    }

    private function ensure($expr, $failMsg)
    {
        if (!$expr) {
            throw new \Exception($failMsg);
        }
    }

    public function mainRun()
    {
        $this->bindZmqPullListener();

        $this->setupWebSocketServer();

        $this->loop->run();
    }

    protected function bindZmqPullListener()
    {
        // Listen for the web server to make a ZeroMQ push after an ajax request
        $context = new Context($this->loop);
        $pull = $context->getSocket(ZMQ::SOCKET_PULL);
        //$pull->bind('tcp://127.0.0.1:5555'); // Binding to 127.0.0.1 means the only client that can connect is itself
        // Binding to 127.0.0.1 means the only client that can connect is itself
        $pull->bind("tcp://{$this->serverPoolAddress}");
        $pull->on('message', array($this->pusher, 'onCommonEvent'));
    }

    protected function setupWebSocketServer()
    {
        $webSock = new React\Socket\Server($this->loop);
        $webSock->listen($this->webSocketPort, $this->webSocketHost); // Binding to 0.0.0.0 means remotes can connect
        $webServer = new Ratchet\Server\IoServer(
            new Ratchet\Http\HttpServer(
                new Ratchet\WebSocket\WsServer(
                    new Ratchet\Wamp\WampServer(
                        $this->pusher
                    )
                )
            ),
            $webSock
        );
    }
}

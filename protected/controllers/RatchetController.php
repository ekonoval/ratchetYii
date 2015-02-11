<?php

class RatchetController extends CController
{
    public function actionIndex()
    {
        echo "<h2>ratchet index  </h2>\n";
    }

    public function actionGenerateEvents()
    {
        if (isset($_REQUEST["isSubmitted"])) {
            //    $context = new ZMQContext();
            //    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'somePesistentString');
            //    $socket->connect("tcp://localhost:1234");
            $eventRiser = new AppdRatchetEventRiser('localhost:1234');

            $res = array();

            if (isset($_REQUEST["moveFigure"])) {
                $res = array(
                    'topicName' => 'figureMove',
                    'x' => rand(0, 9999),
                    'y' => rand(0, 9999),
                    'playerID' => rand(999, 999999)
                );
            } elseif (isset($_REQUEST["sendChatMsg"])) {
                $res = array(
                    'topicName' => 'chatMsgSend',
                    'msg' => uniqid('', true),
                    'senderID' => rand(999, 999999),
                    'receiverID' => rand(999, 999999),
                );
            }

            $res["when"] = time();

            //    $socket->send(json_encode($res));
            $eventRiser->riseEvent($res);
        }

        $this->render('generateEvents');
    }
}

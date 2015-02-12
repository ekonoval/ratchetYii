<?php

class RatchetServerCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        $pusher = new AppdRatchetPusherBase();

//        $cliServer = new AppdRatchetCliServer(
//            $pusher,
//            '127.0.0.1:1234',
//            '0.0.0.0:8080'
//        );

        $rtParamsGetter = new AppdRatchetParams();

        $cliServer = new AppdRatchetCliServer(
            $pusher,
            $rtParamsGetter->createHostPortString(
                $rtParamsGetter->getZmqParam('hostPull'),
                $rtParamsGetter->getZmqPort()
            ),
            $rtParamsGetter->createHostPortString(
                $rtParamsGetter->getWebSocketParam('serverHost'),
                $rtParamsGetter->getWebSocketPort()
            )
        );

        $cliServer->mainRun();
    }
}

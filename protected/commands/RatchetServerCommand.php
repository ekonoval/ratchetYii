<?php

class RatchetServerCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        $pusher = new AppdRatchetPusherBase();

        $obj = new React\EventLoop\Factory();

        $cliServer = new AppdRatchetCliServer($pusher, '127.0.0.1:1234', '0.0.0.0:8080');
        //$cliServer->mainRun();
    }
}
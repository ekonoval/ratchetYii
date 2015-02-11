<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController
{
    /**
     * Index action is the default action in a controller.
     */
    public function actionIndex()
    {
        echo 'sitecontroller index';
        //phpinfo();
    }

    public function actionError()
    {
        echo "<h2>error  </h2>\n";
    }
}
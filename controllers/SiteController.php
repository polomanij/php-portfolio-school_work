<?php

class SiteController {
    
    public function actionIndex()
    {
        require_once ROOT.'/view/site/index.php';
        return TRUE;
    }
}

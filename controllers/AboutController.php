<?php

class AboutController {
    
    public function actionAbout()
    {
        require_once ROOT.'/view/about/about.php';
        return TRUE;
    }
}

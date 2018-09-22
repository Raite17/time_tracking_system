<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
//    public function initialize_admin()
//    {
//        $this->tag->prependTitle('Tracking | ');
//        $this->view->setTemplateAfter('admin');
//        date_default_timezone_set('Asia/Bishkek');
//    }

    protected function initialize()
    {
        $this->tag->prependTitle('Tracking | ');
        $this->view->setTemplateAfter('main');
        date_default_timezone_set('Asia/Bishkek');
    }

    public function  getAuth()
    {
         return $this->session->get('auth');
    }

    protected function getCurrentMonth()
    {
         return date('m');
    }

    protected function getCurrentYear()
    {
        return date('Y');
    }
}

<?php

class PasswordController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Password Change');
        parent::initialize();
    }

    public function indexAction()
    {
        $form = new PasswordChangeForm();
        $this->view->form = $form;
    }

}


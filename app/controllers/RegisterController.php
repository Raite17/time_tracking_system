<?php

class RegisterController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Sign Up');
        parent::initialize();
    }

    public function indexAction()
    {
        $user = new Users();

        $form = new RegisterForm();

        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPost())) {

                $username = $this->request->getPost('username',['string', 'striptags']);
                $login = $this->request->getPost('login',['alphanum']);
                $email = $this->request->getPost('email', 'email');
                $password = $this->request->getPost('password');
                $repeatPassword = $this->request->getPost('repeatPassword');

                if ($password  != $repeatPassword) {
                    $this->flash->error('Пароли не совпадают');
                }

                else{
                    $user->setUsers();
                }
            }
            else{
                foreach ($form->getMessages() as $message) {
                    $this->flash->success($message);
                }
            }

        }
        $this->view->form = $form;
    }


}


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
        $users_model = new Users();

        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                if ($form->isValid($this->request->getPost())) {
                    $id = $this->request->getPost('id', "int");
                    $old_password = $this->request->getPost('old_password');
                    $new_password = $this->request->getPost('new_password');
                    $passwordRepeat = $this->request->getPost('new_password');

                    if ($new_password != $passwordRepeat) {
                        $this->flash->error('Пароли не совпадают!');
                    } else {
                        $find = Users::findFirst(
                            [
                                "conditions" => "id = :id: AND active = 1",
                                'bind' => ['id' => $id],
                            ]
                        );
                        $find->setNewPassword();
                    }
                } else {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            } else {
                $this->flash->error('CSRF Error!');
            }
        }
        $this->view->form = $form;
    }
}


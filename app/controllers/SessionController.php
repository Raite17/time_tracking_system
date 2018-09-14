<?php

class SessionController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Sign In');
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $user)
    {
        $this->session->set(
            'auth',
            [
                'id' => $user->id,
                'name' => $user->username,
            ]
        );
    }

    public function startAction()
    {
        $user_model = new Users();

        $form = new LoginForm();

        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user = $user_model->userAuth($email);
                if ($user) {
                    $isValid = $this->security->checkHash($password, $user->password);
                    if ($isValid) {
                        $this->_registerSession($user);
                        $this->flash->success('С возвращением!'.$user->username);
                        $this->response->redirect('/stuff');
                    } else {
                        $this->flash->error('Неправильный пароль!');
                    }
                } else {
                    $this->flash->error('Неправильный email или пароль!');
                }
            } else {
                $this->flash->error('CSRF Error!');
            }
        }
        $this->view->form = $form;
    }


    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->session->remove('auth');

        return $this->response->redirect('/auth');
    }

}


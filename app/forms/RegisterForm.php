<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


class RegisterForm extends  Form
{
    public  function initialize($entity = null, $options = null)
    {
        // Name
        $username = new Text('username');
        $username->setLabel('Username');
        $username->setFilters(['alphanum']);
        $username->addValidators([
            new PresenceOf([
                'message' => 'Введите Имя!'
            ])
        ]);
        $this->add($username);

        // Login
        $login = new Text('login');
        $login->setLabel('login');
        $login->setFilters(['alphanum']);
        $login->addValidators([
            new PresenceOf([
                'message' => 'Введите логин!'
            ])
        ]);
        $this->add($login);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'Введите E-mail '
            ]),
            new Email([
                'message' => 'E-mail не действителен'
            ])
        ]);
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Введите пароль'
            ])
        ]);
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators([
            new PresenceOf([
                'message' => 'Подтвердите пароль!'
            ])
        ]);
        $this->add($repeatPassword);
    }
}
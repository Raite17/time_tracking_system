<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class LoginForm extends Form
{
    public  function initialize($entity = null, $options = null)
    {
        //Email
        $email = new Text('email');
        $email->setLabel('email');
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

        //Password
        $password = new Password('password');
        $password->setLabel('Пароль');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Введите пароль'
            ])
        ]);
        $this->add($password);
    }
}
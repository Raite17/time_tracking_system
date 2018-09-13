<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use  Phalcon\Validation\ValidatorInterface;


class PasswordChangeForm extends  Form
{
    public  function initialize($entity = null, $options = null)
    {
        //Old Password
        $old_password = new Password('old_password');
        $old_password->setLabel('Старый Пароль');
        $old_password->setFilters(['alphanum']);
        $old_password->addValidators([
            new PresenceOf([
                'message' => 'Введите старый пароль!'
            ])
        ]);
        $this->add($old_password);

        //New Password
        $new_password = new Password('new_password');
        $new_password->setLabel('Новый Пароль');
        $new_password->setFilters(['alphanum']);
        $new_password->addValidators([
            new PresenceOf([
                'message' => 'Введите старый пароль!'
            ])
        ]);
        $this->add($new_password);

        //Confirm new password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Подтвердите пароль');
        $repeatPassword->setFilters(['alphanum']);
        $repeatPassword->addValidators([
            new PresenceOf([
                'message' => 'Введите старый пароль!'
            ])
        ]);
        $this->add($repeatPassword);
    }
}
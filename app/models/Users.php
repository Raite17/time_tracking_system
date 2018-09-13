<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $login;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $active;

    /**
     *
     * @var string
     */
    public $role;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("time_tracking");
        $this->setSource("users");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function setUsers()
    {
        $password = $this->getDI()->getSecurity()->hash($this->getDI()->getRequest()->getPost('password'));
        $this->username = $this->getDI()->getRequest()->getPost('username',['string', 'striptags']);
        $this->login = $this->getDI()->getRequest()->getPost('login',['alphanum']);
        $this->email = $this->getDI()->getRequest()->getPost('email','email');
        $this->password  = $password;
        $this->created_at = new Phalcon\Db\RawValue('now()');
        $this->active = 1;
        $this->role = 'user';
//        try {
//
//        } catch (Exception $e) {
//
//        }
        if (!$this->save()){
            return false;
        }

        else {
            $this->getDI()->getFlash()->success('Регистрация прошла успешна!');
            $this->getDI()->getResponse()->redirect('/stuff');
        }
    }


    public function getUsers($id)
    {
        return Users::query()
            ->where("role = 'user'")
            ->orderBy("IF(Users.id = {$id}, 1,0) DESC")
            ->execute();
    }

    public  function getWorks()
    {
        return Users::query()
            ->leftJoin('Works', 'Users.id = w.user_id', 'w')
            ->columns(
                array(
                    'Users.username',
                    'w.start',
                    'w.stop',
                    'w.total as total',
                    'w.user_id',
                    'UNIX_TIMESTAMP(w.start) as start_unix_time ',
                )
            )
            ->execute();
    }

}

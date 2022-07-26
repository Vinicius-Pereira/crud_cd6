<?php

require_once dirname(dirname(__FILE__)) . "\database\UserDB.php";

class UserController
{
    public ?UserDB $userDB = null;

    function __construct() {
        $this->userDB = new UserDB();
    }

    function createUser($name, $phone, $email, $password)
    {
        return $this->userDB->createUserDb($name, $phone, $email, $password);
    }
    



}

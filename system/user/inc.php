<?php

namespace project;

/*
 * Класс пользователя
 */

class user2 { 

    private $id, $email, $phone, $first_name, $last_name, $u_pass, $lastdate;
    protected $errors = array();

    public function __construct() {
        
    }

    // 
    static public function isSuperAdmin($role_code) {
        $user_id = $_SESSION['user_auth_data']['id'];

        if ($user_id > 0) {
            
        }
    }

}

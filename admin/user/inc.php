<?php

namespace project;

/*
 * Класс пользователя
 */

class user {

    private $id, $email, $phone, $first_name, $last_name, $u_pass, $lastdate;
    protected $errors = array();

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getFirst_name() {
        return $this->first_name;
    }

    function getLast_name() {
        return $this->last_name;
    }

    function getU_pass() {
        return $this->u_pass;
    }

    function getLastdate() {
        return $this->lastdate;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPhone($phone): void {
        $this->phone = $phone;
    }

    function setFirst_name($first_name): void {
        $this->first_name = $first_name;
    }

    function setLast_name($last_name): void {
        $this->last_name = $last_name;
    }

    function setU_pass($u_pass): void {
        $this->u_pass = $u_pass;
    }

    function setLastdate($lastdate): void {
        $this->lastdate = $lastdate;
    }

    public function __construct() {
        
    }

}

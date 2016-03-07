<?php

    class User
    {
        private $user_name;
        private $password;

        function __construct($user_name, $password){
            $this->user_name = $user_name;
            $this->password = $password;
        }

        function getUserName(){
            return $this->user_name;
        }

        function getPassword(){
            return $this->password;
        }
    }
?>

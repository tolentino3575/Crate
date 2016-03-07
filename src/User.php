<?php

    class User
    {
        private $user_name;
        private $password;
        private $id;

        function __construct($user_name, $password, $id = null){
            $this->user_name = $user_name;
            $this->password = $password;
            $this->id = $id;
        }

        function getUserName(){
            return $this->user_name;
        }

        function getPassword(){
            return $this->password;
        }

        function getId(){
            return $this->id;
        }

        function save(){
            $GLOBALS['DB']->exec("INSERT INTO users (user_name, password) VALUES ('{$this->getUserName()}', '{$this->getPassword()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll(){
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users;");

            $users = array();
            foreach($returned_users as $user){
                $username = $user['user_name'];
                $password = $user['password'];
                $id = $user['id'];
                $new_user = new User($username, $password, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users");
        }
    }
?>

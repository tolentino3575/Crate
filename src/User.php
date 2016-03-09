<?php
<<<<<<< HEAD

=======
>>>>>>> master
    class User
    {
        private $user_name;
        private $password;
        private $id;

<<<<<<< HEAD
        function __construct($user_name, $password, $id = null){
=======
        function __construct($user_name, $password, $id=null)
        {
>>>>>>> master
            $this->user_name = $user_name;
            $this->password = $password;
            $this->id = $id;
        }

<<<<<<< HEAD
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
=======
        function setUserName($new_user_name)
        {
            $this->user_name = (string) $new_user_name;
        }

        function getUserName()
        {
            return $this->user_name;
        }

        function setPassword($new_password)
        {
            $this->password = (string) $new_password;
        }

        function getPassword()
        {
            return $this->password;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
>>>>>>> master
            $GLOBALS['DB']->exec("INSERT INTO users (user_name, password) VALUES ('{$this->getUserName()}', '{$this->getPassword()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

<<<<<<< HEAD
        static function getAll(){
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users;");

            $users = array();
            foreach($returned_users as $user){
                $username = $user['user_name'];
                $password = $user['password'];
                $id = $user['id'];
                $new_user = new User($username, $password, $id);
=======
        static function getAll()
        {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users");
            $users = array();
            foreach($returned_users as $user){
                $user_name = $user['user_name'];
                $password = $user['password'];
                $id = $user['id'];
                $new_user = new User($user_name, $password, $id);
>>>>>>> master
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users");
        }
<<<<<<< HEAD
    }
=======

        function addRecord($record)
        {
            $GLOBALS['DB']->exec("INSERT INTO collections (user_id, album_id) VALUES ({$this->getId()}, {$record->getId()});");
        }

        function getRecords()
        {
            $records = $GLOBALS['DB']->query("SELECT records.* FROM users
                JOIN collections ON (users.id = collections.user_id)
                JOIN records ON (collections.album_id = records.id)
                WHERE users.id = {$this->getId()};");

            $result_records = array();
            foreach($records as $record)
            {
                $title = $record['title'];
                $artist = $record['artists'];
                $genre = $record['genre'];
                $track = $record['tracks'];
                $release_date = $record['release_date'];
                $image = $record['image'];
                $id = $record['id'];
                $new_record = new Record($title, $artist, $genre, $track, $release_date, $image, $id);
                array_push($result_records, $new_record);
            }
            return $result_records;
        }

        static function find($search_id)
        {
            $found_user = null;
            $users = User::getAll();

            foreach($users as $user)
            {
                $user_id = $user->getId();
                if($user_id == $search_id)
                {
                    $found_user = $user;
                }
            }
            return $found_user;
        }

    }

>>>>>>> master
?>

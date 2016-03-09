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

            $GLOBALS['DB']->exec("INSERT INTO users (user_name, password) VALUES ('{$this->getUserName()}', '{$this->getPassword()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users");
            $users = array();
            foreach($returned_users as $user){
                $user_name = $user['user_name'];
                $password = $user['password'];
                $id = $user['id'];
                $new_user = new User($user_name, $password, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users");
        }



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

        // static function login($user_name, $password)
        // {
        //     $query = $GLOBALS['DB']->query("SELECT * FROM users WHERE user_name = '{$user_name}' AND password = '{$password}'");
        //     $login_match = $query->fetchAll(PDO::FETCH_ASSOC);
        //     $found_match = null;
        //
        //     foreach($login_match as $match)
        //     {
        //         $user_name = $match['user_name'];
        //         $passowrd = $match['password'];
        //         $id = $match['id'];
        //         $found_match = User::find($id);
        //     }
        //     return $found_match;
        // }

        static function login($user_name, $password)
        {
                $all_users = User::getAll();
                $found_user = null;
                foreach ($all_users as $user) {
                    if ($user->getUserName() == $user_name && $user->getPassword() == $password) {
                        $found_user = $user;
                    } else {
                        return 'NO USER OR PASSWORD EXISTS';
                    }
                }
                return $found_user;
        }

    }

?>

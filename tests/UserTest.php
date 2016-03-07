<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/User.php';

    $server = 'mysql:host=localhost;dbname=discogs_test';
    $user = 'root';
    $password = 'root';
    $DB = new PDO($server, $user, $password);

    class UserTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            User::deleteAll();
        }

        function test_getUserName()
        {
            // Arrange
            $username = 'user';
            $password = 'user';
            $new_user = new User($username, $password);

            // Act
            $result = $new_user->getUserName();

            // Assert
            $this->assertEquals('user', $result);
        }

        function test_save()
        {
            // Arrange
            $username = 'user';
            $password = 'user';
            $new_user = new User($username, $password);


            // Act
            $new_user->save();

            // Arrange
            $result = User::getAll();
            $this->assertEquals($new_user, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $username1 = 'user';
            $password1 = 'user';
            $new_user1 = new User($username1, $password1);
            $new_user1->save();

            $username2 = 'user2';
            $password2 = 'user2';
            $new_user2 = new User($username2, $password2);
            $new_user2->save();

            // Act
            $result = User::getAll();
            $this->assertEquals([$new_user1, $new_user2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $username = 'user';
            $password = 'user';
            $new_user = new User($username, $password);
            $new_user->save();

            // Act
            User::deleteAll();
            $result = User::getAll();

            // Assert
            $this->assertEquals([], $result);
        }
    }
?>

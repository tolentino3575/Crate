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
    }
?>

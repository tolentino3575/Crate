<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/User.php";
require_once "src/Record.php";

$server = 'mysql:host=localhost:8889;dbname=discogs_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class UserTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        User::deleteAll();
        Record::deleteAll();
    }

    function test_getUserName()
    {
        //Arrange
        $name = "Jeff";
        $id = null;
        $test_name = new User($name, $id);

        //Act
        $result = $test_name->getUserName();

        //Assert
        $this->assertEquals($name, $result);
    }

    function test_getPassword()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_password = new User($name, $password, $id);

        //Act
        $result = $test_password->getPassword();

        //Assert
        $this->assertEquals($password, $result);
    }

    function test_getId()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_id = new User($name, $password, $id);

        //Act
        $result = $test_id->getId();

        $this->assertEquals($id, $result);
    }

    function test_save()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_user = new User($name, $password, $id);
        $test_user->save();

        //Act
        $result = User::getAll();

        //Assert
        $this->assertEquals([$test_user], $result);
    }

    function test_getAll()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_user = new User($name, $password, $id);
        $test_user->save();

        $name2 = "Steve";
        $password2 = "poot";
        $id2 = 2;
        $test_user2 = new User($name2, $password2, $id2);
        $test_user2->save();

        //Act
        $result = User::getAll();

        //Assert
        $this->assertEquals([$test_user, $test_user2], $result);
    }

    function test_addRecords()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_user = new User($name, $password, $id);
        $test_user->save();

        $title = "Awesome";
        $artist = "Erik T";
        $genre = "Jazz";
        $track = "Good";
        $year = "2000";
        $image = null;
        $label = "DeathRow";
        $id = 1;
        $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
        $test_record->save();

        //Act
        $test_user->addRecord($test_record);
        $result = $test_user->getRecords();

        //Assert
        $this->assertEquals([$test_record], $result);
    }

    function test_getRecords()
    {
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_user = new User($name, $password, $id);
        $test_user->save();

        $title = "Awesome";
        $artist = "Erik T";
        $genre = "Jazz";
        $track = "Good";
        $year = "2000";
        $image = null;
        $label = "DeathRow";
        $id = 1;
        $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
        $test_record->save();

        $title2 = "Yeah";
        $artist2 = "Berik B";
        $genre2 = "Rock";
        $track2 = "Great";
        $year2 = "2000";
        $image = null;
        $label = "DeathRow";
        $id2 = 1;
        $test_record2 = new Record($title2, $artist2, $genre2, $track2, $year2, $image, $label, $id2);
        $test_record2->save();

        //Act
        $test_user->addRecord($test_record);
        $test_user->addRecord($test_record2);
        $result = $test_user->getRecords();

        //Assert
        $this->assertEquals([$test_record, $test_record2], $result);
    }

    function test_find()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_user = new User($name, $password, $id);
        $test_user->save();

        //Act
        $result = User::find($test_user->getId());

        //Assert
        $this->assertEquals($test_user, $result);
    }

    function test_login()
    {
        //Arrange
        $name = "Jeff";
        $password = "root";
        $id = 1;
        $test_user = new User($name, $password, $id);
        $test_user->save();

        //Act
        $result = User::login($test_user->getUserName(), $test_user->getPassword());

        //Assert
        $this->assertEquals($test_user, $result);
    }
}

?>

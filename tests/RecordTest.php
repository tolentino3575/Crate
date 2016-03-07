<?php
/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/
  require_once "src/Record.php";

	$server = "mysql:host=localhost;dbname=discogs_test";
	$username = "root";
	$password = "root";
	$DB = new PDO($server, $username, $password);

  class RecordTest extends PHPUnit_Framework_TestCase
  {
    function test_getArtist()
    {
      //Arrange
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $release_date = "2015-02-02";
      $id = 1;
      $test_record =  new Record($artist, $genre, $track, $release_date, $id);
      //Act
      $result = $test_record->getArtist();
      //Assert
      $this->assertEquals($artist, $result);
    }
    function test_getId()
    {
      //Arrange
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($artist, $genre, $track, $release_date, $id);
      //Act
      $result = $test_record->getId();
      //Assert
      $this->assertEquals($id, $result);
    }
    function test_getGenre()
    {
      //Arrange
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($artist, $genre, $track, $release_date, $id);
      //Act
      $result = $test_record->getGenre();
      //Assert
      $this->assertEquals($genre, $result);

    }

  }

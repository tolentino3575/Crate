<?php
/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/
  require_once "src/Record.php";
  require_once "src/User.php";

	$server = "mysql:host=localhost;dbname=discogs_test";
	$username = "root";
	$password = "root";
	$DB = new PDO($server, $username, $password);

  class RecordTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
    {
      Record::deleteAll();
      User::deleteAll();
    }
    function test_getTitle()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record =  new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      //Act
      $result = $test_record->getTitle();
      //Assert
      $this->assertEquals($title, $result);
    }
    function test_getArtist()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record =  new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      //Act
      $result = $test_record->getArtist();
      //Assert
      $this->assertEquals($artist, $result);
    }
    function test_getGenre()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      //Act
      $result = $test_record->getGenre();
      //Assert
      $this->assertEquals($genre, $result);
    }
    function test_getTrack()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015-02-02";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      //Act
      $result = $test_record->getTrack();
      //Assert
      $this->assertEquals($track, $result);
    }
    function test_getYear()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015-02-02";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      //Act
      $result = $test_record->getYear();
      //Assert
      $this->assertEquals($year, $result);
    }
    function test_getId()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      //Act
      $result = $test_record->getId();
      //Assert
      $this->assertEquals($id, $result);
    }
    function test_save()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      $test_record->save();

      //Act
      $result = Record::getAll();
      //Assert
      $this->assertEquals([$test_record], $result);
    }
    function test_getAll()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      $test_record->save();

      $title = "Sound and Color";
      $artist = "Tame Impala";
      $genre = "Blues";
      $track = "Let It Happen";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 2;
      $test_record2 = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      $test_record2->save();

      //Act
      $result = Record::getAll();

      //Assert
      $this->assertEquals([$test_record, $test_record2], $result);
    }
    function test_deleteAll()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      $test_record->save();

      $title2 = "Sound and Color";
      $artist2 = "Tame Impala";
      $genre2 = "Blues";
      $track2 = "Let It Happen";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id2 = 2;
      $test_record2 = new Record($title2, $artist2, $genre2, $track2, $year, $image, $label, $id2);
      $test_record2->save();
      //Act
      Record::deleteAll();
      $result = Record::getAll();
      //Assert
      $this->assertEquals([], $result);
    }
    function test_delete()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = null;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      $test_record->save();

      $title2 = "Sound and Color";
      $artist2 = "Tame Impala";
      $genre2 = "Blues";
      $track2 = "Let It Happen";
      $year2 = "2015";
      $image2 = null;
      $label2 = "DeathRow";
      $id2 = null;
      $test_record2 = new Record($title2, $artist2, $genre2, $track2, $year2, $image2, $label2, $id2);
      $test_record2->save();
      //Act
      $test_record2->delete();
      $result = Record::getAll();

      //Assert
      $this->assertEquals([$test_record], $result);
    }
    function test_find()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $year = "2015";
      $image = null;
      $label = "DeathRow";
      $id = null;
      $test_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      $test_record->save();

      $title2 = "Sound and Color";
      $artist2 = "Tame Impala";
      $genre2 = "Blues";
      $track2 = "Let It Happen";
      $release_date2 = "2015";
      $image2 = null;
      $label2 = "DeathRow";
      $id2 = null;
      $test_record2 = new Record($title2, $artist2, $genre2, $track2, $release_date2, $image2, $label2, $id2);
      $test_record2->save();

      //Act
      $result = Record::find($test_record2->getId());
      //Assert
      $this->assertEquals($test_record2, $result);
    }
  }

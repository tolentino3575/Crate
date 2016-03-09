<?php
/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/
  require_once "src/Record.php";

	$server = "mysql:host=localhost:8889;dbname=discogs_test";
	$username = "root";
	$password = "root";
	$DB = new PDO($server, $username, $password);

  class RecordTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
    {
      Record::deleteAll();
    }
    function test_getTitle()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $release_date = "2015-02-02";
      $id = 1;
      $test_record =  new Record($title, $artist, $genre, $track, $release_date, $id);
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
      $release_date = "2015-02-02";
      $id = 1;
      $test_record =  new Record($title, $artist, $genre, $track, $release_date, $id);
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
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $id);
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
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $id);
      //Act
      $result = $test_record->getTrack();
      //Assert
      $this->assertEquals($track, $result);
    }
    function test_getReleaseDate()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $id);
      //Act
      $result = $test_record->getReleaseDate();
      //Assert
      $this->assertEquals($release_date, $result);
    }
    function test_getId()
    {
      //Arrange
      $title = "Sound and Color";
      $artist = "Alabama Shakes";
      $genre = "Blues";
      $track = "Sound and Color";
      $release_date = "2015-02-02";
      $image = null;
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $image, $id);
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
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $id);
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
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $id);
      $test_record->save();

      $title = "Sound and Color";
      $artist = "Tame Impala";
      $genre = "Blues";
      $track = "Let It Happen";
      $release_date = "2015-03-02";
      $id = 2;
      $test_record2 = new Record($title, $artist, $genre, $track, $release_date, $id);
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
      $release_date = "2015-02-02";
      $id = 1;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $id);
      $test_record->save();

      $title2 = "Sound and Color";
      $artist2 = "Tame Impala";
      $genre2 = "Blues";
      $track2 = "Let It Happen";
      $release_date2 = "2015-03-02";
      $id2 = 2;
      $test_record2 = new Record($title2, $artist2, $genre2, $track2, $release_date2, $id2);
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
      $release_date = "2015-02-02";
      $image = null;
      $id = null;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $image, $id);
      $test_record->save();

      $title2 = "Sound and Color";
      $artist2 = "Tame Impala";
      $genre2 = "Blues";
      $track2 = "Let It Happen";
      $release_date2 = "2015-03-02";
      $image2 = null;
      $id2 = null;
      $test_record2 = new Record($title2, $artist2, $genre2, $track2, $release_date2, $image2, $id2);
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
      $release_date = "2015-02-02";
      $image = null;
      $id = null;
      $test_record = new Record($title, $artist, $genre, $track, $release_date, $image, $id);
      $test_record->save();

      $title2 = "Sound and Color";
      $artist2 = "Tame Impala";
      $genre2 = "Blues";
      $track2 = "Let It Happen";
      $release_date2 = "2015-03-02";
      $image2 = null;
      $id2 = null;
      $test_record2 = new Record($title2, $artist2, $genre2, $track2, $release_date2, $image2, $id2);
      $test_record2->save();

      //Act
      $result = Record::find($test_record2->getId());
      //Assert
      $this->assertEquals($test_record2, $result);
    }
  }

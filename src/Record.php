<?php

class Record
{
  private $title;
  private $artist;
  private $genre;
  private $track;
  private $release_date;
  private $id;

  function __construct($title, $artist, $genre, $track, $release_date, $id = null)
  {
    $this->title = $title;
    $this->artist = $artist;
    $this->genre = $genre;
    $this->track = $track;
    $this->release_date = $release_date;
    $this->id = $id;
  }
  function setTitle($new_title)
  {
    $this->title = (string) $title;
  }
  function getTitle()
  {
    return $this->title;
  }
  function setArtist($new_artist)
  {
    $this->artist = (string) $artist;
  }
  function getArtist()
  {
    return $this->artist;
  }
  function getGenre()
  {
    return $this->genre;
  }
  function setGenre($new_genre)
  {
    $this->genre = (string)$new_genre;
  }
  function getTrack()
  {
    return $this->track;
  }
  function setTrack($new_track)
  {
    $this->track = (string)$new_track;
  }
  function setReleaseDate($new_release_date)
  {
    $this->release_date = $release_date;
  }
  function getReleaseDate()
  {
    return $this->release_date;
  }
  function getId()
  {
    return $this->id;
  }
  function save()
  {
    $GLOBALS['DB']->exec("INSERT INTO records (title, artists, genre, tracks, release_date) VALUES ('{$this->getTitle()}','{$this->getArtist()}', '{$this->getGenre()}', '{$this->getTrack()}', '{$this->getReleaseDate()}')");
    $this->id = $GLOBALS['DB']->lastInsertId();
  }
  static function getAll()
  {
    $returned_records = $GLOBALS['DB']->query("SELECT * FROM records");
    $record = array();
    foreach($returned_records as $records){
      $title = $record['title'];
      $artist = $record['artists'];
      $genre = $record['genre'];
      $track = $record['tracks'];
      $release_date = $record['release_date'];
      $id = $record['id'];
      $new_record = new Record($title, $artist, $genre, $track, $release_date, $id);
      array_push($records, $new_record);
    }
    return $records;
  }
  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM records");
  }


}
 ?>

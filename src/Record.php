<?php

class Record
{
  private $title;
  private $artist;
  private $genre;
  private $track;
  private $year;
  private $image;
  private $label;
  private $id;

  function __construct($title, $artist, $genre, $track, $year, $image, $label, $id = null)
  {
    $this->title = $title;
    $this->artist = $artist;
    $this->genre = $genre;
    $this->track = $track;
    $this->year = $year;
    $this->image = $image;
    $this->label = $label;
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
  function setYear($new_year)
  {
    $this->year = $year;
  }
  function getYear()
  {
    return $this->year;
  }
  function getImage()
  {
    return $this->image;
  }
  function getLabel()
  {
    return $this->label;
  }
  function getId()
  {
    return $this->id;
  }
  function save()
  {
    $GLOBALS['DB']->exec(
    "INSERT INTO records (title, artists, genre, tracks, year, image, label)
    VALUES ('{$this->getTitle()}','{$this->getArtist()}', '{$this->getGenre()}', '{$this->getTrack()}', '{$this->getYear()}', '{$this->getImage()}', '{$this->getLabel()}')");
    $this->id = $GLOBALS['DB']->lastInsertId();
  }
  static function getAll()
  {
    $returned_records = $GLOBALS['DB']->query(
    "SELECT * FROM records
    ORDER BY year");
    $records = array();
    foreach($returned_records as $record){
      $title = $record['title'];
      $artist = $record['artists'];
      $genre = $record['genre'];
      $track = $record['tracks'];
      $year = $record['year'];
      $image = $record['image'];
      $label = $record['label'];
      $id = $record['id'];
      $new_record = new Record($title, $artist, $genre, $track, $year, $image, $label, $id);
      array_push($records, $new_record);
    }
    return $records;
  }
  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM records");
  }

  function delete()
  {
    $GLOBALS['DB']->exec("DELETE FROM records WHERE id = {$this->getId()}");
    $GLOBALS['DB']->exec("DELETE FROM collections WHERE album_id = {$this->getId()}");
  }
  static function find($search_id)
  {
    $found_record = null;
    $records = Record::getAll();
    foreach($records as $record){
      $record_id = $record->getId();
      if($record_id == $search_id){
        $found_record = $record;
      }
    }return $found_record;

  }


}
 ?>

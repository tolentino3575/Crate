<?php

class Record
{
  private $artist;
  private $genre;
  private $track;
  private $release_date;
  private $id;

  function __construct($artist, $genre, $track, $release_date, $id = null)
  {
    $this->artist = $artist;
    $this->genre = $genre;
    $this->track = $track;
    $this->release_date = $release_date;
    $this->id = $id;
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
    $GLOBALS['DB']->exec("INSERT INTO records (artists, genre, tracks, release_date) VALUES ('{$this->getArtist()}', '{$this->getGenre()}', '{$this->getTrack()}', '{$this->getReleaseDate()}')");
    $this->id = $GLOBALS['DB']->lastInsertId();
  }
}
 ?>

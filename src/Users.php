<?php
  class User
  {
    private $user_name;
    private $id;

    function __construct($user_name, $id = null)
    {
      $this->user_name = $user_name;
      $this->id = $id;
    }
  }




 ?>

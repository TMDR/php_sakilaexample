<?php
session_start();
class film
{
  public $title;
  public $description;
  public $release_year;
  function __construct($t,$d,$r)
  {
    $this->title=$t;
    $this->description=$d;
    $this->release_year=$r;
  }
}
 ?>

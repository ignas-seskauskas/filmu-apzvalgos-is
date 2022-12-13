<?php

class Movie {
  public $movieName;
  public $movieYear;
  public $movieDirector;
  public $movieDuration;
  public $movieDescription;
  public $movieWriter;
  public $id;

  private static $last_id = 0;

  public static function generalMovieInfo($movieName, $movieYear, $movieDirector, $movieWriter, $id) {
    $instance = new self();
    $instance->movieName = $movieName;
    $instance->movieYear = $movieYear;
    $instance->movieDirector = $movieDirector;
    $instance->movieWriter = $movieWriter;
    $instance->id = $id;
    return $instance;
 }
}
class MovieController {
  function getMovies() {
    $dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
    $sql = "SELECT * FROM `filmas`";
    $result = mysqli_query($dbc, $sql);
    $movies = [];
    while($row = mysqli_fetch_assoc($result)){
      array_push($movies, Movie::generalMovieInfo($row['pavadinimas'], $row['metai'], $row['rezisierius'], $row['rasytojas'], $row['id']));
    }
    return $movies;
  }

  function getMovieById($id) {
    $dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
    $sql = "SELECT * FROM `filmas` WHERE `id`=$id";
    $result = mysqli_query($dbc, $sql);
    $movies = [];
    while($row = mysqli_fetch_assoc($result)){
      return Movie::generalMovieInfo($row['pavadinimas'], $row['metai'], $row['rezisierius'], $row['rasytojas'], $row['id']);
    }
  }
}

$_movieController = new MovieController();
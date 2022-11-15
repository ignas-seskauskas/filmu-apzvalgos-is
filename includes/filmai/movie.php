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

  public static function generalMovieInfo($movieName, $movieYear, $movieDirector, $movieWriter) {
    $instance = new self();
    $instance->movieName = $movieName;
    $instance->movieYear = $movieYear;
    $instance->movieDirector = $movieDirector;
    $instance->movieWriter = $movieWriter;
    $instance->id = $instance::$last_id++;
    return $instance;
 }
}
class MovieController {
  function getMovies($page = 0) {
    $movies = [Movie::generalMovieInfo("Van Hellsing", 2004, "Stephen Sommers", "Stephen Sommers"),
		Movie::generalMovieInfo("Perfect Blue", 1997, "Satoshi Kon", "Sadayuki Murai")]; 
    return $movies;
  }

  function getMovieById($id) {
    return $this->getMovies()[$id];
  }
}

$_movieController = new MovieController();
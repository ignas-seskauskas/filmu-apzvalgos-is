<?php
array_push($GLOBALS['_styleRenderers'], function() {
  ?>
    .filmas__wrapper {
      position: absolute;
      height: 100%;
      width: 100%;
      display: flex;
      flex-direction: row;
      align-items: stretch;
      justify-content: flex-start;
    }

    .filmas__sidebar {
      min-width: 16rem;
      background-color: <?php echo $GLOBALS['_color_darker'] ?>;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

  <?php
});

$GLOBALS['_style_full-width'] = true;
$movie = $GLOBALS['_movieController']->getMovieById($_GET['id']);
$_title = "Filmas - " . $movie->movieName;

if(!isset($movie) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$_render = function() {
  global $movie;
  #$movies = $movie->getMovies();
  #$messages = $channel->getMessages();
  #$currentUser = $GLOBALS['_userController']->getCurrentUser();
}
  ?>
   
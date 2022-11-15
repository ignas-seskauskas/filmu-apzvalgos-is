<?php
array_push($GLOBALS['_styleRenderers'], function() {
  ?>
    .filmas__sidebar {
      min-width: 16rem;
      background-color: <?php echo $GLOBALS['_color_darker'] ?>;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

  <?php
});

$movie = $GLOBALS['_movieController']->getMovieById($_GET['id']);
$_title = "Filmas - " . $movie->movieName;

if(!isset($movie) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$_render = function() {
  global $movie;

  ?>
    <div class="filmas__sidebar">
	  Filmo pavadinimas: <strong><?php echo $movie->movieName; ?></strong>
	  Metai: <strong><?php echo $movie->movieYear; ?></strong>
	  Režisierius: <strong><?php echo $movie->movieDirector; ?></strong>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	</div>
<?php 
};
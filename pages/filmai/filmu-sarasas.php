<?php
array_push($GLOBALS['_styleRenderers'], function() {
  ?>
    .filmu-sarasas__input {
      max-width: 20rem;
      display: inline;
      margin: 0 1rem;
    }

    .filmu-sarasas__create-button {
      margin-bottom: 1rem;
    }
  <?php
});

$_title = "Filmų sąrašas";
$_render = function() {
  $movies = $GLOBALS['_movieController']->getMovies();

  ?>
    <button type="button" class="btn btn-success filmu-sarasas__create-button" onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/filmu-pridejimas' ?>';">
      <i class="bi bi-plus-circle"></i>
      Pridėti naują filmą
    </button>
    <table class="filmu-sarasas__table table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">
            Pavadinimas
            <input class="form-control filmu-sarasas__input" type="text" placeholder="Filtruoti"></input>
          </th>
          <th scope="col">Metai</th>
          <th scope="col">Režisierius</th>
		  <th scope="col">Rašytojas</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($movies as &$movie) {
            echo '<tr>';
            echo '<td><a href="'. $GLOBALS['_pagePrefix'] .'/filmas&id=' . $movie->id . '">' . $movie->movieName . '</a></td>';
			echo '<td><a href="'. $GLOBALS['_pagePrefix'] .'/filmas&id=' . $movie->id . '">' . $movie->movieYear . '</a></td>';
			echo '<td><a href="'. $GLOBALS['_pagePrefix'] .'/filmas&id=' . $movie->id . '">' . $movie->movieDirector . '</a></td>';
			echo '<td><a href="'. $GLOBALS['_pagePrefix'] .'/filmas&id=' . $movie->id . '">' . $movie->movieWriter . '</a></td>';

            }
          }
        ?>
      </tbody>
    </table>
  <?php

<?php
array_push($GLOBALS['_styleRenderers'], function () {
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
$comments = $GLOBALS['_commentController']->getCommentsByMovieID($_GET['id']);
$_title = "Filmas - " . $movie->movieName;

if (!isset($movie) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$currentUser = $GLOBALS['_userController']->getCurrentUser();

$_render = function () {
  global $movie;
  global $comments;
  global $currentUser;
?>
  <div class="filmas__sidebar">
    Filmo pavadinimas: <strong><?php echo $movie->movieName; ?></strong>
    Metai: <strong><?php echo $movie->movieYear; ?></strong>
    Režisierius: <strong><?php echo $movie->movieDirector; ?></strong>
    <br>
    <br>
    <?php
    if($currentUser != null){
    ?>
    <button type="button" class="btn btn-success" style='width: 20%' onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/komentaru-pridejimas' . '&moveid=' .  $_GET['id']?>';">
      <i class="bi bi-plus-circle"></i>
      Pridėti naują komentarą
    </button>
    <?php
    }
    ?>
    <table class="table table-dark table-striped">
      <tr>
        <th style='text-align: center' colspan='6'>Komentarai</th>
      </tr>
      <?php
      //52 eilutej pridet on click, kad rodytu pranesimo langa ar nori istrint komentara
      foreach ($comments as &$comment) {
        echo "<tr><td>Antraštė: <b>" . $comment->header . "</b></td>";
        echo "<td>Komentaro sukūrimo data: <b>" . $comment->date . "</b></td>";
        echo "<td>Reitingas: <b>" . $comment->rating . "</b></td>";
        echo "<td>Komentaras: <b>" . $comment->text . "</b></td>";
        echo "<td>";
        if($currentUser != null && ($currentUser->type == "Moderator" || $comment->fk_user == $currentUser->id)){
          ?><button type="button" class="btn btn-warning" onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/komentaru-redagavimas' . '&id=' . $comment->id . '&movieid=' . $movie->id ?> .';">
          <i class="bi bi-pencil-fill"></i>
          Redaguoti komentarą
        </button></td>
        <td>
          <button type="button" class="btn btn-danger" onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/komentaro-salinimas' . '&id=' . $comment->id . '&movieid=' . $movie->id ?> .';">
            <i class="bi bi-x-circle"></i>
            Šalinti komentarą
          </button>
        </td>
        </tr><?php
            }
          }
              ?>
    </table>
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

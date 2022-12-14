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

//gauti atitinkamo komentaro ivertinimus
$dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);

$_render = function () {
  global $movie;
  global $comments;
  global $currentUser;
  global $dbc;
?>

  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <div class="filmas__sidebar">
    Filmo pavadinimas: <strong><?php echo $movie->movieName; ?></strong>
    Metai: <strong><?php echo $movie->movieYear; ?></strong>
    Režisierius: <strong><?php echo $movie->movieDirector; ?></strong>
    <br>
    <br>
    <?php
    if ($currentUser != null) {
    ?>
      <button type="button" class="btn btn-success" style='width: 20%' onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/komentaru-pridejimas' . '&moveid=' .  $_GET['id'] ?>';">
        <i class="bi bi-plus-circle"></i>
        Pridėti naują komentarą
      </button>
    <?php
    }
    ?>
    <table class="table table-dark table-striped">
      <tr>
        <th style='text-align: center' colspan='8'>Komentarai</th>
      </tr>
      <?php
      //52 eilutej pridet on click, kad rodytu pranesimo langa ar nori istrint komentara
      foreach ($comments as &$comment) {
        //cia idet kuris komenttaras to asmens palike'intas, o kurie ne su $comments->id
        echo "<tr>";
        $sql = "SELECT `fk_user` FROM `komentaro_ivertinimas` WHERE `fk_Komentaras`=$comment->id";
        $result = mysqli_query($dbc, $sql);
        $row = mysqli_fetch_assoc($result);
        $liked = 0;
        //patiko kiekis tam tikram komentarui
        $sql = "SELECT COUNT(`patiko`) as liked FROM `komentaro_ivertinimas` WHERE `patiko`=1 AND `fk_Komentaras`=$comment->id";
        $result = mysqli_query($dbc, $sql);
        $row1 = mysqli_fetch_assoc($result); 
        //nepatiko kiekis tam tikram komentarui
        $sql = "SELECT COUNT(`patiko`) as disliked FROM `komentaro_ivertinimas` WHERE `patiko`=0 AND `fk_Komentaras`=$comment->id";
        $result = mysqli_query($dbc, $sql);
        $row2 = mysqli_fetch_assoc($result);

        if(isset($row["fk_user"])){
          if($currentUser->id == $row["fk_user"]){
            $liked = 1;
          }
        }
        //patiko skaiciuojam ir nepatiko
        if ($currentUser->type != "LoggedOut" && $liked == 0) {
      ?>
            <td style="width: 200px;">
              <div>Patiko: <?php echo $row1['liked'];?> </div><button style='color: green;' onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/like-pridejimas' . '&id=' . $comment->id ?> .';"><i class='fa fa-thumbs-up'></i></button>
              <div>Nepatiko: <?php echo $row2['disliked'];?> </div><button style='color: red' onclick="location.href='<?php echo $GLOBALS['_pagePrefix'] . '/dislike-pridejimas' . '&id=' . $comment->id  ?> .';"><i class='fa fa-thumbs-down'></i></button>
            </td>
          <?php
        }else{
          echo "<td><div>Patiko: ". $row1['liked'] ."</div>
                    <div>Nepatiko: ". $row2['disliked'] ."</div></td>";
        }
        echo "<td>slapyvardis: <b>" . $comment->userName . "</b></td>";
        echo "<td>Antraštė: <b>" . $comment->header . "</b></td>";
        echo "<td>Komentaro sukūrimo data: <b>" . $comment->date . "</b></td>";
        echo "<td>Reitingas: <b>" . $comment->rating . "</b></td>";
        echo "<td>Komentaras: <b>" . $comment->text . "</b></td>";
        echo "<td>";
        if ($currentUser->type != "LoggedOut" && ($currentUser->type == "Moderator" || $comment->fk_user == $currentUser->id)) {
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

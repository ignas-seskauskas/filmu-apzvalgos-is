<?php
$_title = "Komentarų pridėjimas";
if (isset($_POST["editComment"])) {
	$tekstas = $_POST["komentaru_redagavimas_komentaras"];
	$reitingas = $_POST["komentaru_redagavimas_reitingas"];
	$antraste = $_POST["komentaru_redagavimas_antraste"];
	$commentID = $_GET['id'];

	$dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
	$sql = "UPDATE `komentaras` SET `tekstas`='$tekstas', `reitingas`=$reitingas, `antraste`='$antraste' WHERE `id`=$commentID";
	echo $sql;
	$result = mysqli_query($dbc, $sql);
}
$comment = $GLOBALS['_commentController']->getCommentByID($_GET['id']);
$_render = function () {
	//sql pridet, kad detu i duomenu baze
	global $comment;
?>
	<form method="post">
		<div class="form-group">
			<label for="komentaru_redagavimas_antraste">Antraštė</label>
			<input type="text" class="form-control" id="komentaru_redagavimas_antraste" name="komentaru_redagavimas_antraste" value='<?php echo $comment->header ?>'>
		</div>
		<div class="form-group">
			<label for="komentaru_redagavimas_reitingas">Reitingas</label>
			<input type="number" min="0" max="10" class="form-control" id="komentaru_redagavimas_reitingas" name="komentaru_redagavimas_reitingas" value='<?php echo $comment->rating ?>'>
		</div>
		<div class="form-group">
			<label for="komentaru_redagavimas_komentaras">Komentaras</label>
			<textarea class="form-control" id="komentaru_redagavimas_komentaras" name="komentaru_redagavimas_komentaras"rows="5"><?php echo $comment->text ?></textarea>
		</div>
		<br />
		<center>
			<button type="submit" class="btn btn-success" name="editComment">
				Redaguoti komentarą
			</button>
			<?php
			if (isset($_POST["editComment"])) {
				echo "<div style='color: red;'>Sėkmingai redagavote komentarą!</div>";
			}
			?>
		</center>
	</form>
<?php
};

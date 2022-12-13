<?php
$_title = "Komentarų pridėjimas";
$currentUser = $GLOBALS['_userController']->getCurrentUser();
if (isset($_POST["addComment"])) {
	$moveID = $_GET["moveid"];
	$tekstas = $_POST["komentaru_pridejimas_komentaras"];
	$data = date("Y-m-d H:i:s");
	$reitingas = $_POST["komentaru_pridejimas_reitingas"];
	$antraste = $_POST["komentaru_pridejimas_antraste"];

	$dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
	$sql = "INSERT INTO `komentaras`(`vartotojo_vardas`, `tekstas`, `data`, `reitingas`, `antraste`, `id`, `fk_Filmas`, `fk_user`) 
							 VALUES (NULL,'$tekstas', '$data', '$reitingas', '$antraste', '', $moveID, $currentUser->id)";
	$result = mysqli_query($dbc, $sql);
}
$_render = function () {
	//sql pridett, kad detu i duomenu baze	
?>
	<form method="post">
		<div class="form-group">
			<label for="komentaru_pridejimas_antraste">Antraštė</label>
			<input type="text" class="form-control" id="komentaru_pridejimas_antraste" name="komentaru_pridejimas_antraste">
		</div>
		<div class="form-group">
			<label for="komentaru_pridejimas_reitingas">Reitingas</label>
			<input type="number" min="0" max="10" class="form-control" id="komentaru_pridejimas_reitingas" name="komentaru_pridejimas_reitingas">
		</div>
		<div class="form-group">
			<label for="komentaru_pridejimas_komentaras">Komentaras</label>
			<textarea class="form-control" id="komentaru_pridejimas_komentaras" rows="5" name="komentaru_pridejimas_komentaras"></textarea>
		</div>
		<br />
		<center>
			<button type="submit" class="btn btn-success" name='addComment'>
				Pridėti filmą
			</button>
			<?php
			if (isset($_POST["addComment"])) {
				echo "<div style='color: red;'>Sėkmingai pridėjote komentarą!</div>";
			}
			?>
		</center>
	</form>
<?php
};

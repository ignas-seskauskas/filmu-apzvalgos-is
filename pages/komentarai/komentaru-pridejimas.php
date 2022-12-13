<?php
$_title = "Komentarų pridėjimas";
if (isset($_POST["addComment"])) {
	$dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
	$sql = "INSERT INTO `komentarai` (`tekstas`, `data`, `reitingas`, `antraste` `fk_filmoID`, `fk_komentaroIvertinimoID`) 
                          VALUES ('tekstas', 'data', 'reitingas', 'antraste', 'fk1', 'fk2')";
	echo $sql;
	//$result = mysqli_query($dbc, $sql);
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
		</center>
	</form>
<?php
};

<?php
$_title = "Komentarų pridėjimas";
$_render = function() {
	//sql pridet, kad detu i duomenu baze
	?>
		<form method="post">
			<div class="form-group">
				<label for="komentaru_redagavimas_antraste">Antraštė</label>
				<input type="text" class="form-control" id="komentaru_redagavimas_antraste">
			</div>
			<div class="form-group">
				<label for="komentaru_redagavimas_reitingas">Reitingas</label>
				<input type="number" min="0" max="10" class="form-control" id="komentaru_redagavimas_reitingas">
			</div>
			<div class="form-group">
				<label for="komentaru_redagavimas_komentaras">Komentaras</label>
				<textarea class="form-control" id="komentaru_redagavimas_komentaras" rows="5"></textarea>
			</div>
			<br/>
			<center>
				<button type="submit" class="btn btn-success" name="editComment">
					Redaguoti komentarą
				</button>
			</center>
		</form>
<?php
};
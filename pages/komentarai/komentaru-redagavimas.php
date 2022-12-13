<?php
$_title = "Komentarų pridėjimas";
$_render = function() {
	//sql pridet, kad detu i duomenu baze
	?>
		<form method="post">
			<div class="form-group">
				<label for="exampleFormControlInput1">Antraštė</label>
				<input type="text" class="form-control" id="komentaru_redagavimas__antraste">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Reitingas</label>
				<input type="number" min="0" max="10" class="form-control" id="komentaru_redagavimas__reitingas">
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Komentaras</label>
				<textarea class="form-control" id="komentaru_redagavimas__antraste" rows="5"></textarea>
			</div>
			<br/>
			<center>
				<button type="submit" class="btn btn-success">
					Redaguoti komentarą
				</button>
			</center>
		</form>
<?php
};
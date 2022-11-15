<?php
$_title = "Komentarų pridėjimas";
$_render = function() {
	?>
		<form>
			<div class="form-group">
				<label for="exampleFormControlInput1">Antraštė</label>
				<input type="text" class="form-control" id="komentaru_pridejimas__antraste">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Reitingas</label>
				<input type="number" min="0" max="10" class="form-control" id="komentaru_pridejimas__antraste">
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Komentaras</label>
				<textarea class="form-control" id="komentaru_pridejimas__antraste" rows="5"></textarea>
			</div>
			<br/>
			<center>
				<button type="submit" class="btn btn-success">
					Pridėti filmą
				</button>
			</center>
		</form>
<?php
};
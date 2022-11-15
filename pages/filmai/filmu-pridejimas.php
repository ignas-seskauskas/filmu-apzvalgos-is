<?php
$title = "Filmų pridėjimas";
$render = function() {
	?>
		<form>
			<div class="form-group">
				<label for="exampleFormControlInput1">Filmo pavadinimas</label>
				<input type="text" class="form-control" id="filmu_pridejimas__pavadinimas">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Metai</label>
				<input type="text" class="form-control" id="filmu_pridejimas__metai"?
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Režisierius</label>
				<input type="text" class="form-control" id="filmu_pridejimas__rezisierius">
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Trukmė</label>
				<input type="text" class="form-control" id="filmu_pridejimas__trukme"?
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Siužetas</label>
				<textarea class="form-control" id="filmu_pridejimas__siuzetas" rows="5"></textarea>
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Rašytojas</label>
				<input type="text" class="form-control" id="filmu_pridejimas__rasytojas">
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
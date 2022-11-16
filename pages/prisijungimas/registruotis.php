<?php
$_title = "Registracija";
$_render = function() {
  ?>
    <form action="prisijungti">
      <div class="form-group">
        <label for="exampleFormControlInput1">Vardas</label>
        <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Pavardė</label>
        <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">E-paštas</label>
        <input type="email" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Slaptažodis</label>
        <input type="password" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Pakartoti slaptažodį</label>
        <input type="password" class="form-control" id="exampleFormControlInput1">
      </div>
      <br/>
      <center>
        <button type="submit" class="btn btn-success">
          Registruotis
        </button>
      </center>
    </form>
  <?php
};
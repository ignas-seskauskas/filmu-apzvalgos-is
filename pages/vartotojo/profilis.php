<?php
$_title = "Profilis";
$_render = function() {
  ?>
    <form>
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
        <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div>
      <label for="exampleFormControlInput1">Nuotrauka</label>
      <div><input type="image" alt="Image" width="48" height="48"></div>
      </div>
      <br/>
      <center>
        <button type="submit" class="btn btn-success">
          Redaguoti
        </button>
      </center>
    </form>
  <?php
};
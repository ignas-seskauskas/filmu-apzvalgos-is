<?php
$_title = "Prisijungimas";
$_render = function() {
  ?>
    <form action="index.php">
      <div class="form-group">
        <label for="exampleFormControlInput1">E-paštas</label>
        <input type="email" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Slaptažodis</label>
        <input type="password" class="form-control" id="exampleFormControlInput1">
      </div>
      <br/>
      <center>
        <button type="submit" class="btn btn-success">
          Prisijungti
        </button>
      </center>
    </form>
  <?php
};
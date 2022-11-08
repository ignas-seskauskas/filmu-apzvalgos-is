<?php
$_title = "Kanalo sukūrimas";
$_render = function() {
  ?>
    <form>
      <div class="form-group">
        <label for="exampleFormControlInput1">Pavadinimas</label>
        <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Aprašymas</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Maksimalus vartotojų skaičius</label>
        <input type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <br/>
      <center>
        <button type="submit" class="btn btn-success">
          Kurti kanalą
        </button>
      </center>
    </form>
  <?php
};
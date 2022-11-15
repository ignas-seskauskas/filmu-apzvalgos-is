<?php
array_push($GLOBALS['_styleRenderers'], function() {
  ?>
    .filmu-sarasas__input {
      max-width: 20rem;
      display: inline;
      margin: 0 1rem;
    }

    .filmu-sarasas__create-button {
      margin-bottom: 1rem;
    }
  <?php
});

$_title = "Peržiūrėtų filmų sąrašas";
$_render = function() {

  ?>
    <table class="filmu-sarasas__table table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">
            Pavadinimas
          </th>
          <th scope="col">Išleidimo metai</th>
          <th scope="col">Žanrai</th>
          <th scope="col">Peržiūrėtas</th>
          <th scope="col"></th>
          <input class="form-control filmu-sarasas__input" type="text" placeholder="Filtruoti"></input>

        </tr>
      </thead>
      <tbody>
        <?php
            echo '<tr>';

            echo '<td>Filmas1</td>';
            echo '<td>1999</td>';
            echo '<td>Komedija</td>';
            echo '<td>+</td>';
            echo '<td>';
              ?>
                <button type="button" class="btn btn-primary">
                  <i class="bi bi-pencil-fill"></i>
                </button>
              <?php
              ?>
                <button type="button" class="btn btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              <?php
            echo '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Filmas2</td>';
            echo '<td>2020</td>';
            echo '<td>Komedija</td>';
            echo '<td></td>';
            echo '<td>';
              ?>
                <button type="button" class="btn btn-primary">
                  <i class="bi bi-pencil-fill"></i>
                </button>
              <?php
              ?>
                <button type="button" class="btn btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              <?php
            echo '</td>';
            
            echo '</tr>';
        ?>
      </tbody>
    </table>
  <?php
};
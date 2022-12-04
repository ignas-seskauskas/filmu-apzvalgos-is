<?php
array_push($GLOBALS['_styleRenderers'], function() {
  ?>
    .kanalu-sarasas__input {
      max-width: 20rem;
      display: inline;
      margin: 0 1rem;
    }

    .kanalu-sarasas__create-button {
      margin-bottom: 1rem;
    }
  <?php
});

$_title = "Kanalų sąrašas";
$_render = function() {
  $currentUser = $GLOBALS['_userController']->getCurrentUser();
  $channels = $GLOBALS['_channelController']->getChannels();

  ?>
    <button type="button" class="btn btn-success kanalu-sarasas__create-button" onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/sukurti-kanala' ?>';">
      <i class="bi bi-plus-circle"></i>
      Pridėti naują kanalą
    </button>
    <table class="kanalu-sarasas__table table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">
            Pavadinimas
            <input class="form-control kanalu-sarasas__input" type="text" placeholder="Filtruoti"></input>
          </th>
          <th scope="col">Prisijungę vartototojai</th>
          <th scope="col">Veiksmai</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($channels as &$channel) {
            echo '<tr>';
            echo '<td><a href="'. $GLOBALS['_pagePrefix'] .'/kanalas&id=' . $channel->id . '">' . $channel->name . '</a></td>';
            echo '<td>' . $channel->current_users . '/' . $channel->max_users . '</td>';

            echo '<td>';
            if($currentUser->permissions->editAllChannels || $currentUser->id == $channel->creator) {
              ?>
                <button type="button" class="btn btn-primary" 
                  onclick="location.href='<?php echo $GLOBALS['_pagePrefix'] . '/pakeisti-kanala&id=' . $channel->id; ?>'"
                >
                  <i class="bi bi-pencil-fill"></i>
                </button>
              <?php
            }
            if($currentUser->permissions->removeAllChannels || $currentUser->id == $channel->creator) {
              ?>
                <button type="button" class="btn btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              <?php
            }
            echo '</td>';
            
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  <?php
};
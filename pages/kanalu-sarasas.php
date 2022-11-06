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

$title = "Kanalų sąrašas";
$render = function() {
  $currentUser = $GLOBALS['_userController']->getCurrentUser();
  $userType = $currentUser->type;

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
            echo '<td>' . $channel->currentUsers . '/' . $channel->maxUsers . '</td>';

            if($userType == UserType::Moderator || $currentUser->id == $channel->userId) {
              ?>
              <td>
                <button type="button" class="btn btn-primary">
                  <i class="bi bi-pencil-fill"></i>
                </button>
                <button type="button" class="btn btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
              <?php
            } else {
              echo '<td></td>';
            }

            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  <?php
};
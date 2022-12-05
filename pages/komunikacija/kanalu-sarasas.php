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

  ?>
    <script>
      function removeChannel(id, thisButton) {
        $.ajax({
            url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/channel/remove'; ?>",
            type: 'POST',
            data: {
              id
            },
            success: (data) => {
              $(thisButton).closest('tr').remove();
            },
            error: console.log
				  });
      }

      function addChannelToTable(channel) {
        const removeAllChannels = <?php echo $currentUser->getPermissions()->removeAllChannels; ?>;
        const editAllChannels = <?php echo $currentUser->getPermissions()->removeAllChannels; ?>;
        const userId = <?php echo $currentUser->id; ?>;
        const channelUrl = "<?php echo $GLOBALS['_pagePrefix'] .'/kanalas&id='; ?>";
        const changeChannelUrl = "<?php echo $GLOBALS['_pagePrefix'] .'/pakeisti-kanala&id='; ?>";
        const currentUsersOfChannel = 0;

        const editButton = `
          <button type="button" class="btn btn-primary" 
            onclick="location.href='${changeChannelUrl}${channel.id}'"
          >
            <i class="bi bi-pencil-fill"></i>
          </button>
        `;
        const removeButton = `
          <button type="button" class="btn btn-danger" onclick="removeChannel(${channel.id}, this)">
            <i class="bi bi-trash"></i>
          </button>
        `;

        $('.kanalu-sarasas__table').find('tbody').append(`
          <tr>
            <td><a href="${channelUrl}${channel.id}">${channel.name}</a></td>
            <td>${currentUsersOfChannel}/${channel.max_users}</td>
            <td>
              ${editAllChannels || channel.creator === userId ? editButton : ""}
              ${removeAllChannels || channel.creator === userId ? removeButton : ""}
            </td>
          </tr>
        `);
      }

      function getLoaderInTable() {
        return `<tr><td colspan="3"><center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center></td></tr>`;
      }

      function getChannels(nameFilter) {
        $('.kanalu-sarasas__table').find('tbody').html(getLoaderInTable());

        $.ajax({
          url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/channel/get'; ?>",
          type: 'POST',
          data: {name_filter: nameFilter},
          success: (data) => {
            $('.kanalu-sarasas__table').find('tbody').html("");
            data.payload.channels.forEach(addChannelToTable);
          },
          error: console.log
        });
      }

      let nameFilterTimer = null;

      function debounceFilter(func, timeout){
        if(nameFilterTimer == null) {
          $('.kanalu-sarasas__table').find('tbody').html(getLoaderInTable());
        }

        return (...args) => {
          clearTimeout(nameFilterTimer);
          nameFilterTimer = setTimeout(() => { func.apply(this, args); nameFilterTimer = null; }, timeout);
        };
      }

      $(document).ready(() => {
        getChannels();

        $(".kanalu-sarasas__name-filter").on("input", (elem) => {
          debounceFilter((value) => getChannels(value), 300)(elem.currentTarget.value);
        });
      });
    </script>

    <button type="button" class="btn btn-success kanalu-sarasas__create-button" onclick="location.href = '<?php echo $GLOBALS['_pagePrefix'] . '/sukurti-kanala' ?>';">
      <i class="bi bi-plus-circle"></i>
      Pridėti naują kanalą
    </button>
    <table class="kanalu-sarasas__table table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">
            Pavadinimas
            <input class="form-control kanalu-sarasas__input kanalu-sarasas__name-filter" type="text" placeholder="Filtruoti"></input>
          </th>
          <th scope="col">Prisijungę vartototojai</th>
          <th scope="col">Veiksmai</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  <?php
};
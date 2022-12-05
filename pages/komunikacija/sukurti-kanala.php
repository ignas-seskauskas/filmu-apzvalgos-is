<?php
$_title = "Kanalo sukūrimas";
$_render = function() {
  ?>
    <script>
      $(document).ready(() => {
        $('#create-channel__button').click(() => {
          let values = {};
          const inputs = $('#create-channel__form :input');
          inputs.each(function() {
              values[this.name] = $(this).val();
          });

          $.ajax({
            url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/channel/add'; ?>",
            type: 'POST',
            data: values,
            success: (data) => {
              const channelUrl = "<?php echo $GLOBALS['_pagePrefix'] . '/kanalas&id='; ?>";
              location.href = `${channelUrl}${data.payload.createdId}`;
            },
            error: console.log,
            complete: console.log
				  });
        });
      });
    </script>
    <form id="create-channel__form">
      <div class="form-group">
        <label for="add-channel-form__name">Pavadinimas</label>
        <input type="text" class="form-control" id="add-channel-form__name" name="name">
      </div>
      <div class="form-group">
        <label for="add-channel-form__description">Aprašymas</label>
        <textarea class="form-control" id="add-channel-form__description" rows="3" name="description"></textarea>
      </div>
      <div class="form-group">
        <label for="add-channel-form__max-users">Maksimalus vartotojų skaičius</label>
        <input type="text" class="form-control" id="add-channel-form__max-users" name="max_users">
      </div>
      <br/>
      <center>
        <button type="button" id="create-channel__button" class="btn btn-success">
          Kurti kanalą
        </button>
      </center>
    </form>
  <?php
};
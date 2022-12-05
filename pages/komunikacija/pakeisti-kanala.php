<?php
$_title = "Kanalo pakeitimas";

$channel = $GLOBALS['_channelController']->getChannelById($_GET['id']);
if(!isset($channel) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$_render = function() {
  global $channel;

  ?>
  <script>
      $(document).ready(() => {
        $('#edit-channel__button').click(() => {
          let values = {};
          const inputs = $('#edit-channel__form :input');
          inputs.each(function() {
              values[this.name] = $(this).val();
          });

          values['id'] = <?php echo $_GET['id']; ?>;

          $.ajax({
            url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/channel/edit'; ?>",
            type: 'POST',
            data: values,
            success: (data) => {
              const channelUrl = "<?php echo $GLOBALS['_pagePrefix'] . '/kanalas&id='; ?>";
              location.href = `${channelUrl}<?php echo $_GET['id']; ?>`;
            },
            error: console.log,
            complete: console.log
				  });
        });
      });
    </script>
    <form id="edit-channel__form">
      <div class="form-group">
        <label for="exampleFormControlInput1">Pavadinimas</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $channel->name ?>" name="name">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Aprašymas</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo $channel->description ?></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Maksimalus vartotojų skaičius</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $channel->max_users ?>" name="max_users">
      </div>
      <br/>
      <center>
        <button type="button" id="edit-channel__button" class="btn btn-success">
          Keisti kanalą
        </button>
      </center>
    </form>
  <?php
};
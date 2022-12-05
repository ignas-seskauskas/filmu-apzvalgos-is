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
      function setError(error) {
        $(".errors").html(error);
      }

      $(document).ready(() => {
        $('#edit-channel__button').click(() => {
          setError("");

          let values = {};
          const inputs = $('#edit-channel__form :input');
          inputs.each(function() {
              values[this.name] = $(this).val();
          });

          let validationSucceed = true;

          Object.keys(values).forEach(key => {
            if(key !== "" && (values[key] === "" || !values[key])) {
              console.log(key);
              setError("Neturėtų būti tuščių reikšmių");
              validationSucceed = false;
            }
          });

          if(values['name'].length > 50) {
            setError("Maksimalus pavadinimo ilgis: 50");
            validationSucceed = false;
          }

          if(values['description'].length > 5000) {
            setError("Maksimalus aprašymo ilgis: 5000");
            validationSucceed = false;
          }

          if(/[^0-9]/.test(values['max_users'])) {
            setError("Maksimalus vartotojų skaičius turėtų būt sveikas");
            validationSucceed = false;
          }

          if(Number(values['max_users']) > 1000) {
            setError("Maksimalus maksimalus vartotojų skaičius yra 1000");
            validationSucceed = false;
          }

          if(!validationSucceed) return;

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
        <input type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo $channel->max_users ?>" name="max_users">
      </div>
      <br/>
      <center>
        <button type="button" id="edit-channel__button" class="btn btn-success">
          Keisti kanalą
        </button>
      </center>
    </form>
    <center><div class="errors"></div></center>
  <?php
};
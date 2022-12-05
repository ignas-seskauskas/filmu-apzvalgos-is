<?php
$_title = "Kanalo sukūrimas";
$_render = function() {
  ?>
    <script>
      function setError(error) {
        $(".errors").html(error);
      }

      $(document).ready(() => {
        $('#create-channel__button').click(() => {
          setError("");

          let values = {};
          const inputs = $('#create-channel__form :input');
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
        <input type="number" class="form-control" id="add-channel-form__max-users" name="max_users">
      </div>
      <br/>
      <center>
        <button type="button" id="create-channel__button" class="btn btn-success">
          Kurti kanalą
        </button>
      </center>
    </form>
    <center><div class="errors"></div></center>
  <?php
};
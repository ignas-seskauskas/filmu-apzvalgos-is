<?php
$_title = "Prisijungimas";
$_render = function () {
?>
  <script>
    function setError(error) {
      $(".errors").html(error);
    }

    $(document).ready(() => {
      $('#login-user__button').click(() => {
        setError("");

        let values = {};
        const inputs = $('#login-user__form :input');
        inputs.each(function() {
          values[this.name] = $(this).val();
        });

        let validationSucceed = true;

        Object.keys(values).forEach(key => {
          if (key !== "" && (values[key] === "" || !values[key])) {
            console.log(key);
            setError("Neturėtų būti tuščių reikšmių");
            validationSucceed = false;
          }
        });

        if (!validationSucceed) return;

        $.ajax({
          url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/user/controller'; ?>",
          type: 'POST',
          data: {
            values,
            action: 'login',
          },
          success: (response) => {
            if (response.success != null || response.success != undefined) {
              location.href = '/filmu-apzvalgos-is/';
            } else {
              if (response.error.includes("not registered")) {
                setError("Įvestas vartotojas nėra užregistruotas");
              } else if (response.error.includes("password not correct")) {
                setError("Įvestas neteisingas slaptažodis");
              }
            }
            console.log(response);
          },
          error: console.log,
          complete: console.log
        });
      });
    });
  </script>
  <form id="login-user__form">
    <div class="form-group">
      <label for="login-user-form__email">E-paštas</label>
      <input type="email" class="form-control" id="login-channel-form__email" name="email">
    </div>
    <div class="form-group">
      <label for="login-user-form__password">Slaptažodis</label>
      <input type="password" class="form-control" id="login-user-form__password" name="password">
    </div>
    <br />
    <center>
      <button type="button" id="login-user__button" class="btn btn-success">
        Prisijungti
      </button>
    </center>
  </form>
  <center>
    <div class="errors"></div>
    <center>
    <?php
  };

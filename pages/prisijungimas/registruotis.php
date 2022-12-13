<?php
$_title = "Registracija";
$_render = function () {
?>
  <script>
    function setError(error) {
      $(".errors").html(error);
    }

    $(document).ready(() => {
      $('#register-user__button').click(() => {
        setError("");

        let values = {};
        const inputs = $('#register-user__form :input');
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

        if (values.password !== values.password_repeat) {
          setError("Slaptažodžiai nesutampa");
          validationSucceed = false;
        } else {
          delete values.password_repeat;
        }

        if (!values.email.includes('@')) {
          setError("E-pašte nerasta @ simbolio");
          validationSucceed = false;
        }

        if (!validationSucceed) return;

        $.ajax({
          url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/user/controller'; ?>",
          type: 'POST',
          data: {
            values,
            action: 'register',
          },
          success: (response) => {
            if (response.success != null || response.success != undefined) {
              location.href = 'prisijungti';
            } else if (response.error.includes('user with this email already exists')) {
              setError("Šis e-paštas jau užregistruotas");
            }
            console.log(response);
          },
          error: console.log,
          complete: console.log
        });
      });
    });
  </script>
  <form id="register-user__form">
    <div class="form-group">
      <label for="register-user-form__name">Vardas</label>
      <input type="text" class="form-control" id="register-channel-form__name" name="name">
    </div>
    <div class="form-group">
      <label for="register-user-form__surname">Pavardė</label>
      <input type="text" class="form-control" id="register-channel-form__surname" name="surname">
    </div>
    <div class="form-group">
      <label for="register-user-form__email">E-paštas</label>
      <input type="email" class="form-control" id="register-channel-form__email" name="email">
    </div>
    <div class="form-group">
      <label for="register-user-form__password">Slaptažodis</label>
      <input type="password" class="form-control" id="register-user-form__password" name="password">
    </div>
    <div class="form-group">
      <label for="register-user-form__password-repeat">Pakartoti slaptažodį</label>
      <input type="password" class="form-control" id="register-user-form__password-repeat" name="password_repeat">
    </div>
    <div class="form-group">
      <label for="register-user-form__username">Slapyvardis</label>
      <input type="text" class="form-control" id="register-user-form__username" name="username">
    </div>
    <br />
    <center>
      <button type="button" id="register-user__button" class="btn btn-success">
        Registruotis
      </button>
    </center>
  </form>
  <center>
    <div class="errors"></div>
    <center>
    <?php
  };

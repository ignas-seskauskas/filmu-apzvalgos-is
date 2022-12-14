<?php
if (!isset($_SESSION['user'])) {
  header('location:index.php');
  exit();
}
$_title = "Profilis";
$_render = function () {
  $currentUser = $GLOBALS['_userController']->getCurrentUser();
  $MAX_WIDTH = 800;
  $MAX_HEIGHT = 500;
  if ($currentUser->avatar_width == 0 || $currentUser->avatar_height == 0) {
    $currentUser->avatar_width = $MAX_WIDTH;
    $currentUser->avatar_height = $MAX_HEIGHT;
  }
?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js">
  </script>
  <script>
    function setError(error) {
      $(".errors").html(error);
    }
    // $('#profile-user-form__avatar').css('display', 'inline-block');
    $(document).ready(() => {
      let avatar_handle = $("#profile-user-form__avatar");

      $(function() {
        // $("#profile-user-form__avatar").resizable({
        avatar_handle.resizable({
          // animate: "slow",
          // animateDuration: 800,
          autoHide: true,
          cancel: "#profile-user-form__button",
          // containment: "parent",
          distance: 25,
          grid: [25, 25],
          maxHeight: 500,
          maxWidth: 800,
          minHeight: 50,
          minWidth: 50,
          // ghost: true,
        });
      });
      $('#profile-user__delete').on('click', function() {
        if (confirm('Ar tikrai norite ištrinti profilį?') === true) {
          $.ajax({
            url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/user/controller'; ?>",
            type: 'POST',
            data: {
              action: 'deleteProfile',
            },
            success: (response) => {
              location.href = '/filmu-apzvalgos-is/atsijungti';

              console.log(response);
            },
            error: console.log,
            complete: console.log
          });
        }
      });
      $('#profile-user__button').click(() => {
        setError("");

        let values = {};
        const inputs = $('#profile-user__form :input');
        inputs.each(function() {
          if (this.name !== "type") {
            values[this.name] = $(this).val();
          }
        });

        let validationSucceed = true;

        Object.keys(values).forEach(key => {
          if (key !== "" && (values[key] === "" || !values[key])) {
            console.log(key);
            if (key !== 'avatar_src') {
              setError("Neturėtų būti tuščių reikšmių");
              validationSucceed = false;
            }
          }
        });

        if (!validationSucceed) return;

        values.avatar_height = avatar_handle.height();
        values.avatar_width = avatar_handle.width();

        $.ajax({
          url: "<?php echo $GLOBALS['_pagePrefix'] . '/api/user/controller'; ?>",
          type: 'POST',
          data: {
            values,
            action: 'updateProfile',
          },
          success: (response) => {
            if (response.success != null || response.success != undefined) {
              alert("Profilis atnaujintas sėkmingai!");
              // location.href = '/filmu-apzvalgos-is/';
            }

            console.log(response);
          },
          error: console.log,
          complete: console.log
        });
      });
    });
  </script>
  <form id="profile-user__form">
    <div class="form-group">
      <label for="profile-user-form__name">Vardas</label>
      <input type="text" class="form-control" id="profile-channel-form__name" name="name" value="<?php echo $currentUser->name; /*$_SESSION['_user']->name; */ ?>">
    </div>
    <div class="form-group">
      <label for="profile-user-form__surname">Pavardė</label>
      <input type="text" class="form-control" id="profile-user-form__surname" name="surname" value="<?php echo $currentUser->surname;/*$_SESSION['_user']->surname;*/ ?>">
    </div>
    <div class="form-group">
      <label for="profile-user-form__username">Slapyvardis</label>
      <input type="text" class="form-control" id="profile-user-form__username" name="username" value="<?php echo $currentUser->username;/*$_SESSION['_user']->username;*/ ?>">
    </div>
    <div class="form-group">
      <label for="profile-user-form__type">Tipas</label>
      <input type="text" class="form-control" id="profile-user-form__type" name="type" readonly value="<?php if ($currentUser->type === UserType::Critic->value) {
                                                                                                          echo "Kritikas";
                                                                                                        } else if ($currentUser->type === UserType::Default->value) {
                                                                                                          echo "Paprastas";
                                                                                                        } else if ($currentUser->type === UserType::Moderator->value) {
                                                                                                          echo "Moderatorius";
                                                                                                        }/*$_SESSION['_user']->type;*/ ?>">
    </div>
    <div class="form-group">
      <label for="profile-user-form__avatar-src">Nuotraukos nuoroda</label>
      <input type="text" class="form-control" id="profile-user-form__avatar-src" name="avatar_src" value="<?php echo $currentUser->avatar_src; ?>">
    </div>
    <div class="form-group">
      <label for="profile-user-form__avatar">Nuotrauka</label>
      <br />
      <?php if (!$currentUser->avatar_src) { ?>
        <p style="color:red;">Neturite nuotraukos</p>
      <?php } ?>
      <img src="<?php echo $currentUser->avatar_src; ?>" style="height:<?php echo $currentUser->avatar_height; ?>px;width:<?php echo $currentUser->avatar_width; ?>px" alt="User avatar" id="profile-user-form__avatar">
    </div>
    <br />
    <center>
      <button type="button" id="profile-user__button" class="btn btn-success">
        Atnaujinti
      </button>
      <button type="button" id="profile-user__delete" class="btn btn-danger">
        Trinti profilį
      </button>
    </center>
  </form>
  <center>
    <div class="errors"></div>
    <center>
    <?php
  };

<?php
array_push($GLOBALS['_styleRenderers'], function() {
  ?>
    .kanalas__wrapper {
      position: absolute;
      height: 100%;
      width: 100%;
      display: flex;
      flex-direction: row;
      align-items: stretch;
      justify-content: flex-start;
    }

    .kanalas__sidebar {
      min-width: 16rem;
      background-color: <?php echo $GLOBALS['_color_darker'] ?>;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .kanalas__user {
      min-height: 3rem;
      display: flex;
      flex-direction: row;
      align-items: center;
      margin: 0.5rem;
      border-radius: 5px;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }

    .kanalas__user:hover {
      background-color: <?php echo $GLOBALS['_color_primary'] ?>44;
    }

    .kanalas__user-avatar {
      width: 40px;
      height: 40px;
    }

    .kanalas__user-avatar-wrapper {
      position: relative;
      margin-right: 1rem;
    }

    .kanalas__sidebar-bottom {
      margin: 1rem;
    }

    .kanalas__status {
      transform: translate(-60%,-40%);
      padding: .4rem;
    }

    .kanalas__status--online {
      transform: translate(-60%,-40%);
      padding: .4rem;
      background-color: <?php echo $GLOBALS['_color_success'] ?>;
      border: 1px solid #dee2e6;
      border-color: #f8f9fa!important;
    }

    .kanalas__status--writing {
      transform: translate(-60%,-40%);
      padding: .4rem;
    }

    .kanalas__status--blocked {
      transform: translate(-60%,-40%);
      color: <?php echo $GLOBALS['_color_danger'] ?>;
    }

    .kanalas__user-more {
      color: <?php echo $GLOBALS['_color_light'] ?>;
      box-shadow: none !important;
      outline: none !important;
    }

    .kanalas__user-more:hover {
      color: <?php echo $GLOBALS['_color_light'] ?>aa;
    }

    .kanalas__messages {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 1rem;
    }

    .kanalas__input {
      border-radius: 5px;
      margin-top: 1rem;
    }

    .kanalas__message {
      margin: 0.5rem 1rem;
    }

    .kanalas__message-block {
      padding: 0.5rem 1rem;
      background-color: <?php echo $GLOBALS['_color_noticable'] ?>;
      width: fit-content;
      border-radius: 10px;
      
    }

    .kanalas__message-block--yours {
      background-color: <?php echo $GLOBALS['_color_primary'] ?>cc;
      margin-left: auto;
    }

    .kanalas__message--yours {
      margin-left: auto;
      text-align: right;
    }

    .kanalas__message-top {
      color: <?php echo $GLOBALS['_color_light'] ?>;
      font-weight: bold;
      margin: 0.25rem 0; 
    }

    .kanalas__message-time {
      color: <?php echo $GLOBALS['_color_light'] ?>aa;
      font-weight: normal;
    }

    .kanalas__message-avatar {
      margin-bottom: 1.25rem;
    }

    .kanalas__message-wrapper {
      display: flex;
      flex-direction: row;
      align-items: flex-end;
    }

    .kanalas__message-wrapper--yours {
      flex-direction: row-reverse;
    }
  <?php
});

$GLOBALS['_style_full-width'] = true;
$channel = $GLOBALS['_channelController']->getChannelById($_GET['id']);
$title = "Kanalas - " . $channel->name;

if(!isset($channel) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$render = function() {
  global $channel;
  $users = $channel->getUsers();
  $messages = $channel->getMessages();
  $currentUser = $GLOBALS['_userController']->getCurrentUser();

  ?>
    <div class="kanalas__wrapper">
      <div class="kanalas__sidebar">
        <div class="kanalas__users">
        <?php
          foreach ($users as &$user) {
            ?>
              <div class="kanalas__user" aria-current="true">
                <div class="kanalas__user-avatar-wrapper">
                  <img src="<?php echo $user->avatar_src ?>" class="rounded-circle kanalas__user-avatar">
                  <span class="position-absolute top-0 rounded-circle kanalas__status
                    <?php
                      switch($user->status)
                      {
                        case ChannelUserStatus::Online:
                          echo 'kanalas__status--online';
                          break;
                        case ChannelUserStatus::Writing:
                          echo 'kanalas__status--writing bi bi-chat-dots';
                          break;
                        case ChannelUserStatus::Blocked:
                          echo 'kanalas__status--blocked bi bi-dash-circle';
                          break;
                      }
                    ?>
                  ">
                    
                  </span>
                </div>
                <?php echo $user->name ?>
                <div style="flex: 1;"></div>
                <div class="dropdown">
                  <a class="btn kanalas__user-more" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                  </a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php
                      if($user->status == ChannelUserStatus::Blocked) {
                        echo '<li><a class="dropdown-item" href="#">Atblokuoti</a></li>';
                      } else {
                        echo '<li><a class="dropdown-item" href="#">Užblokuoti</a></li>';
                      }
                    ?>
                  </ul>
                </div>
              </div>
            <?php
          }
        ?>
        </div>
        <div class="kanalas__sidebar-bottom">
          Prisijungę vartotojai: <strong><?php echo $channel->currentUsers . '/' . $channel->maxUsers; ?></strong>
        </div>
      </div>
      <div class="kanalas__messages">
        <div style="flex: 1;"></div>
        <?php
          foreach ($messages as &$message) {
            

            ?> 
            <div class="kanalas__message-wrapper <?php 
            if($message->user->id == $currentUser->id) echo 'kanalas__message-wrapper--yours'; 
          ?>">
            <img src="<?php echo $message->user->avatar_src ?>" class="rounded-circle kanalas__message-avatar kanalas__user-avatar">
            <div class="kanalas__message <?php 
            if($message->user->id == $currentUser->id) echo 'kanalas__message--yours'; 
          ?>"> 
              

              <div class="kanalas__message-top">
                <?php echo $message->user->name ?>
                <span class="kanalas__message-time"><?php echo $message->time ?></span>
              </div>

              <div class="kanalas__message-block
            <?php 
              if($message->user->id == $currentUser->id) echo 'kanalas__message-block--yours'; 
            ?>">
              <?php echo $message->message ?>
            </div> 
            
            </div> 
          </div><?php
          }
        ?>
        <input type="text" class="kanalas__input form-control"></input>
      </div>
    </div>
  <?php
};
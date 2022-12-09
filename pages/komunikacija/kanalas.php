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

    .kanalas__messages-with-input {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 1rem;
    }

    .kanalas__messages {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 1rem;
      overflow-y: scroll;
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

    .kanalas__filter {
      margin-bottom: 0.25rem;
    }
  <?php
});

$GLOBALS['_style_full-width'] = true;
$channel = $GLOBALS['_channelController']->getChannelById($_GET['id']);
$_title = "Kanalas - " . $channel->name;

if(!isset($channel) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$_render = function() {
  global $channel;
  $messages = $channel->getMessages();
  $currentUser = $GLOBALS['_userController']->getCurrentUser();

  ?>
    <script>
      let users = [];

      function addUserToChat(user) {
        const userStatus = "Online";
        const userStatusClass = 
          userStatus === "Online" ? "kanalas__status--online" :
          userStatus === "Writing" ? "kanalas__status--writing bi bi-chat-dots" :
          userStatus === "Blocked" ? "kanalas__status--blocked bi bi-dash-circle" : 
          "";

        const newComponent = `
          <div class="kanalas__user kanalas__user--${user.id}" aria-current="true">
            <div class="kanalas__user-avatar-wrapper">
              <img src="${user.avatar_src}" class="rounded-circle kanalas__user-avatar">
              <span class="position-absolute top-0 rounded-circle kanalas__status
                ${userStatusClass}
              ">
                
              </span>
            </div>
            ${user.name}
            <div style="flex: 1;"></div>
            <div class="dropdown">
              <a class="btn kanalas__user-more" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                ${userStatus === "Blocked" ? 
                  '<li><a class="dropdown-item" href="#">Atblokuoti</a></li>' :
                  '<li><a class="dropdown-item" href="#">Užblokuoti</a></li>'}
              </ul>
            </div>
          </div>
          `;
        
        $('.kanalas__users').append(newComponent);
        users.push(user);
      }

      function removeUserFromChat(userId) {
        $(`kanalas__user--${userId}`).eq(1).remove();
      }

      function addMessage(message) {
        const user = users.find(user => user.id === message.sender);

        const hours = `${Math.floor(message.time / 3600) % 24}`.padStart(2, '0');
        const minutes = `${Math.floor(message.time / 60) % 60}`.padStart(2, '0');
        const formattedTime = `${hours}:${minutes}`;
        console.log(message.time);

        const currentUserId = <?php echo $currentUser->id; ?>;

        const newComponent = `
          <div class="kanalas__message-wrapper ${currentUserId === user.id ? 'kanalas__message-wrapper--yours' : ''}">
            <img src="${user.avatar_src}" class="rounded-circle kanalas__message-avatar kanalas__user-avatar">
            <div class="kanalas__message ${currentUserId === user.id ? 'kanalas__message--yours' : ''}"> 
              <div class="kanalas__message-top">
                ${user.name}
                <span class="kanalas__message-time">${formattedTime}</span>
              </div>

              <div class="kanalas__message-block ${currentUserId === user.id ? 'kanalas__message-block--yours' : ''}">
              ${message.text}
            </div> 
            </div> 
          </div>
        `;

        $('.kanalas__messages').append(newComponent);
        $('.kanalas__messages').scrollTop($('.kanalas__messages').prop("scrollHeight"));
      }

      $(document).ready(() => {
        const websocketUrl = '<?php echo $GLOBALS['_websocketServerUrl']; ?>';
        const currentUserId = <?php echo $currentUser->id; ?>;
        const channelId = <?php echo $channel->id; ?>;
        const conn = new WebSocket(`${websocketUrl}?user=${currentUserId}&channel=${channelId}`);
        conn.onopen = function(e) {
          conn.send('~~~get_users~~~');
          conn.send('~~~users_count~~~');
        };

        conn.onmessage = function(e) {
          const msg = e.data;
          const regex = /^~~~(.*)~~~(.*)$/;
          const matches = regex.exec(msg);
          const command = matches[1];
          const args = matches[2];

          console.log(`Received command ${command} with args ${args}`);

          if(command === "connect") {
            const user = JSON.parse(args);
            if(!users.find(currentUser => currentUser.id === user.id))
              addUserToChat(user);
            conn.send('~~~users_count~~~');
          } else if(command === "get_users") {
            const users = JSON.parse(args);
            users.forEach(addUserToChat);
          } else if(command === "message") {
            console.log("received");
            const argsRegex = /^(.*)~&~(.*)~&~(.*)$/;
            const argsMatches = argsRegex.exec(args);
            const userId = Number(argsMatches[1]);
            const time = Number(argsMatches[2]);
            const text = argsMatches[3];
            console.log({userId, time, text});
            addMessage({sender: userId, time, text});
          } else if(command === "disconnect") {
            const userId = Number(args);
            removeUserFromChat(userId);
          } else if(command === "users_count") {
            $('.kanalas__online-users-count').text(args);
          }
        };

        conn.onclose = function(e) {
          console.log("Connection closed.");
          location.href = "<?php echo $GLOBALS['_pagePrefix']; ?>/kanalu-sarasas";
        };

        $(document).on("keypress", ".kanalas__input", (e) => {
          if(e.which == 13){
            const inputVal = $('.kanalas__input').val();
            conn.send(`~~~message~~~${inputVal}`);
            $('.kanalas__input').val("");
          }
        });

        $('.kanalas__messages').scrollTop($('.kanalas__messages').prop("scrollHeight"));
      });
      
    </script>
    <div class="kanalas__wrapper">
      <div class="kanalas__sidebar">
        <div class="kanalas__users">
        </div>
        <div class="kanalas__sidebar-bottom">
          <input class="form-control kanalas__filter" type="text" placeholder="Filtruoti vartotojus"></input>
          Prisijungę vartotojai: <strong><span class="kanalas__online-users-count">0</span><?php echo '/' . $channel->max_users; ?></strong>
        </div>
      </div>
      <div class="kanalas__messages-with-input">
        <div class="kanalas__messages">
          <div style="flex: 1;"></div>
          <?php
            foreach ($messages as &$message) {
              $messageUser = $GLOBALS['_userController']->getUserById($message->sender);
              ?> 
              <script>
                $(document).ready(() => {
                  const id = <?php echo $messageUser->id; ?>;
                  const currentUserId = <?php echo $currentUser->id; ?>;

                  if(!users.some(user => user.id == id)) {
                    users.push({
                      id,
                      name: "<?php echo $messageUser->name; ?>",
                      avatar_src: "<?php echo $messageUser->avatar_src; ?>"
                    });
                  }

                  if(!users.some(user => user.id == currentUserId)) {
                    users.push({
                      currentUserId,
                      name: "<?php echo $currentUser->name; ?>",
                      avatar_src: "<?php echo $currentUser->avatar_src; ?>"
                    });
                  }
                });
                
              </script>
              <div class="kanalas__message-wrapper <?php 
              if($message->sender== $currentUser->id) echo 'kanalas__message-wrapper--yours'; 
            ?>">
              <img src="<?php echo $messageUser->avatar_src ?>" class="rounded-circle kanalas__message-avatar kanalas__user-avatar">
              <div class="kanalas__message <?php 
              if($message->sender == $currentUser->id) echo 'kanalas__message--yours'; 
            ?>"> 
                <div class="kanalas__message-top">
                  <?php echo $messageUser->name ?>
                  <span class="kanalas__message-time"><?php echo $message->getTimeString(); ?></span>
                </div>

                <div class="kanalas__message-block
              <?php 
                if($message->sender == $currentUser->id) echo 'kanalas__message-block--yours'; 
              ?>">
                <?php echo $message->text ?>
              </div> 
              </div> 
            </div><?php
            }
          ?>
        </div>
        <input type="text" class="kanalas__input form-control"></input>
      </div>
    </div>
  <?php
};
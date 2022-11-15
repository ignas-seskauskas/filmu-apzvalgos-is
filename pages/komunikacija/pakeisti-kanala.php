<?php
$_title = "Kanalo pakeitimas";

$channel = $GLOBALS['_channelController']->getChannelById($_GET['id']);
if(!isset($channel) || !isset($_GET['id'])) {
  header("Location: " . $GLOBALS['_pagePrefix'] . "/404");
}

$_render = function() {
  global $channel;

  ?>
    <form>
      <div class="form-group">
        <label for="exampleFormControlInput1">Pavadinimas</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $channel->name ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Aprašymas</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" value="<?php echo $channel->description ?>"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Maksimalus vartotojų skaičius</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $channel->maxUsers ?>">
      </div>
      <br/>
      <center>
        <button type="button" onclick="location.href='<?php echo $GLOBALS['_pagePrefix']; ?>/kanalu-sarasas'" class="btn btn-success">
          Keisti kanalą
        </button>
      </center>
    </form>
  <?php
};
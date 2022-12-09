<?php
$_styleRenderers = [];

function renderStyles() {
  ?>

<style>
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: <?php echo $GLOBALS['_color_dark'] ?>;
    color: <?php echo $GLOBALS['_color_light'] ?>;
    <?php 
      if(isset($GLOBALS['_style_max-height'])) {
        echo 'max-height: 100vh;';
      }
    ?>
  }

  .content {
    flex: 1;
    position: relative;
    <?php 
      if(isset($GLOBALS['_style_full-width'])) {
        echo 'width: 100vw;';
      } else {
        echo 'width: 70vw;';
        echo 'margin: 1rem auto;';
      }
    ?>
  }

  .navbar {
    padding: 0.5rem 1rem;
  }

  a {
    text-decoration: none;
    color: <?php echo $GLOBALS['_color_light'] ?>;
  }

  a:hover {
    text-decoration: none;
    color: <?php echo $GLOBALS['_color_primary'] ?>;
  }

  .btn-primary {
    background-color: <?php echo $GLOBALS['_color_primary'] ?>;
    border-color: <?php echo $GLOBALS['_color_primary'] ?>;
  }

  .btn-primary:hover {
    background-color: <?php echo $GLOBALS['_color_primary_darker'] ?>;
    border-color: <?php echo $GLOBALS['_color_primary_darker'] ?>;
  }

  .btn-primary:active, .btn-primary:visited, .btn-primary:focus {
    background-color: <?php echo $GLOBALS['_color_primary'] ?>;
    border-color: <?php echo $GLOBALS['_color_primary_lighter'] ?>;
    box-shadow: 0 0 0 0.25rem <?php echo $GLOBALS['_color_primary_lighter'] ?>55 !important;
  }

  .lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-ellipsis div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #fff;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
  }
  .lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
  }
  @keyframes lds-ellipsis1 {
    0% {
      transform: scale(0);
    }
    100% {
      transform: scale(1);
    }
  }
  @keyframes lds-ellipsis3 {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(0);
    }
  }
  @keyframes lds-ellipsis2 {
    0% {
      transform: translate(0, 0);
    }
    100% {
      transform: translate(24px, 0);
    }
  }

  .errors {
    color: red;
    margin-top: 1rem;
  }

  ::-webkit-scrollbar { width: 8px; height: 0px;}
  ::-webkit-scrollbar-button { height: 0; }
  ::-webkit-scrollbar-track-piece { background-color: #2c3136;}
  ::-webkit-scrollbar-thumb { height: 50px; background-color: #666; border-radius: 5px;}

  <?php
    foreach ($GLOBALS['_styleRenderers'] as &$styleRenderer) {
      $styleRenderer();
    }
  ?>
</style>

<?php
  }
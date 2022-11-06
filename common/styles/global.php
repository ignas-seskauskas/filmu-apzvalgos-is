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

  <?php
    foreach ($GLOBALS['_styleRenderers'] as &$styleRenderer) {
      $styleRenderer();
    }
  ?>
</style>
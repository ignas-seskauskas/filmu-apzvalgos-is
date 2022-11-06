<?php

$_pagePrefix = '/imdb-copy';

$_styleRenderers = [];
require('common/styles/colors.php');
require('common/includes/user.php');
require('common/includes/channel.php');

if(isset($_GET['page'])) {
  switch ($_GET['page']) {
    case '':
      require('pages/index.php');
    break;
    case 'kanalu-sarasas':
      require('pages/kanalu-sarasas.php');
    break;
    case 'sukurti-kanala':
      require('pages/sukurti-kanala.php');
    break;
    case 'kanalas':
      require('pages/kanalas.php');
    break;
    default:
      require('pages/404.php');
    break;
  }
} else {
  require('pages/index.php');
}

require('common/components/header.php');
require('common/components/footer.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <?php require('common/styles/global.php'); ?>
  </head>
  <body>
    <?php 
      renderHeader($title);
      echo '<div class="content">';
      $render();
      echo '</div>';
      renderFooter();
    ?>
  </body>
</html>
<?php
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
<?php
if(isset($_GET['page'])) {
  switch ($_GET['page']) {
    case '':
      require('pages/pagrindinis.php');
    break;
    case 'kanalu-sarasas':
      require('pages/komunikacija/kanalu-sarasas.php');
    break;
    case 'sukurti-kanala':
      require('pages/komunikacija/sukurti-kanala.php');
    break;
    case 'kanalas':
      require('pages/komunikacija/kanalas.php');
    break;
    default:
      require('pages/404.php');
    break;
  }
} else {
  require('pages/pagrindinis.php');
}
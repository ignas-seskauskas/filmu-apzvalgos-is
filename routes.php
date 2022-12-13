<?php
if (isset($_GET['page'])) {
  switch ($_GET['page']) {
    case '':
      require('pages/filmai/filmu-sarasas.php');
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
    case 'filmu-pridejimas':
      require('pages/filmai/filmu-pridejimas.php');
      break;
    case 'filmas':
      require('pages/filmai/filmas.php');
      break;
    case 'pakeisti-kanala':
      require('pages/komunikacija/pakeisti-kanala.php');
      break;
    case 'prisijungti':
      require('pages/prisijungimas/prisijungti.php');
      break;
    case 'registruotis':
      require('pages/prisijungimas/registruotis.php');
      break;
    case 'atsijungti':
      require('pages/prisijungimas/atsijungti.php');
      break;
    case 'perziuretu-filmu-sarasas':
      require('pages/vartotojo/perziuretu-filmu-sarasas.php');
      break;
    case 'profilis':
      require('pages/vartotojo/profilis.php');
      break;
    case 'komentaru-pridejimas':
      require('pages/komentarai/komentaru-pridejimas.php');
      break;
    case 'komentaru-redagavimas':
      require('pages/komentarai/komentaru-redagavimas.php');
      break;
    case 'api/channel/add':
      require('api/channel/add.php');
      break;
    case 'api/channel/edit':
      require('api/channel/edit.php');
      break;
    case 'api/channel/remove':
      require('api/channel/remove.php');
      break;
    case 'api/channel/get':
      require('api/channel/get.php');
      break;
    case 'api/user/controller':
      require('api/user/controller.php');
      break;
    default:
      require('pages/404.php');
      break;
  }
} else {
  require('pages/filmai/filmu-sarasas.php');
}

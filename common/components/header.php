<?php
array_push($GLOBALS['_styleRenderers'], function () {
?>
  .navbar-nav {
  flex-direction: row;
  gap: 1rem;
  flew-wrap: wrap;
  }
<?php
});
function renderHeader()
{
?>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo $GLOBALS['_pagePrefix']; ?>">Filmų apžvalgos IS | <?php echo $GLOBALS['_title']; ?></a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/kanalu-sarasas">Kanalų sąrašas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/">Filmų sąrašas</a>
      </li>
      <?php
      if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
      ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/perziuretu-filmu-sarasas">Peržiūrėtų filmų sąrašas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/profilis">Profilis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/atsijungti">Atsijungti</a>
        </li>
      <?php
      } else {
      ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/prisijungti">Prisijungti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/registruotis">Registruotis</a>
        </li>
      <?php
      }
      ?>
    </ul>
  </nav>
<?php
}

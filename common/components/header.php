<?php
function renderHeader() {
  ?>
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo $GLOBALS['_pagePrefix']; ?>">Filmų apžvalgos IS | <?php echo $GLOBALS['_title']; ?></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $GLOBALS['_pagePrefix']; ?>/kanalu-sarasas">Kanalų sąrašas</a>
        </li>
      </ul>
    </nav>
  <?php
}


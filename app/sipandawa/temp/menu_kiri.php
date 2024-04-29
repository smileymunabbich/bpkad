<div class="page-sidebar">
  <a class="logo-box" href="index.html">
    <span><img src="../assets/images/logo-white.png" alt=""></span>
    <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
  </a>
  <div class="page-sidebar-inner">
    <div class="page-sidebar-menu">
      <ul class="accordion-menu">
      <?php
          $html = $menu->setMenuKiri($_SESSION['id_level']);
          echo $html;
          ?>
      </ul>
    </div>
  </div>
</div>
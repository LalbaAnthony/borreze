<?php

require_once "init.php";

$dao = new PageDAO();
$navbarPages = $dao->findAllNavbarPages();

?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
  <div class="container px-4 px-lg-5">

    <a style="text-decoration: none" class="d-flex justify-content-start" href="index.php">
      <img src="assets/armorial_borreze.png" style="width: 25px; height: 30px;" class="mx-3 align-middle my-auto" alt="Armorial de Borrèze">
      <span class="navbar-brand">Borrèze</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto py-4 py-lg-0">
        <?php
        foreach ($navbarPages as $currentPage) {
          echo "<li class='nav-item'><a class='nav-link px-lg-3 py-3 py-lg-4' href='" . $currentPage->get_pathPage() . "'>" . $currentPage->get_nomPage() . "</a></li>";
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
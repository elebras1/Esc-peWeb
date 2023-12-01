<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>bootstrap2/assets/img/apple-icon.png">
  <link rel="icon" href="<?php echo base_url();?>bootstrap/images/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="<?php echo base_url();?>bootstrap/images/favicon.ico" type="image/x-icon">
  <title>
    EscapeWeb
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="<?php echo base_url();?>bootstrap2/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>bootstrap2/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?php echo base_url();?>bootstrap2/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

  <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap-icons.css">

  <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/owl.carousel.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/owl.theme.default.min.css">
  
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?php echo base_url();?>">
        <img src="<?php echo base_url();?>bootstrap/images/logo_website.png" class="logo-image img-fluid" alt="templatemo pod talk">
        <?php
          if (session()->role == 'A')
          {
            echo ('<div><span class="ms-1 font-weight-bold text-white">EscapeWeb</span>');
            echo ('<span class="ms-1 font-weight-bold text-white">Administrateur</span></div>');
          }
          elseif (session()->role == 'O') {
            echo ('<div><span class="ms-1 font-weight-bold text-white">EscapeWeb</span>');
            echo ('<span class="ms-1 font-weight-bold text-white">Organisateur</span></div>');
          }
        ?>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="<?php echo base_url();?>index.php/compte/afficher_accueil">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Accueil</span>
          </a>
        </li>
        <?php
          if (session()->role == 'A')
          {
        ?>
          <li class="nav-item">
            <a class="nav-link text-white " href="<?php echo base_url();?>index.php/compte/lister">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Comptes</span>
            </a>
          </li>
        <?php
          }
        ?>
        <?php
          if (session()->role == 'O')
          {
        ?>
          <li class="nav-item">
            <a class="nav-link text-white " href="<?php echo base_url();?>index.php/scenario/lister">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Scenarios</span>
            </a>
          </li>
        <?php
          }
        ?>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Section utilisateur</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="<?php echo base_url();?>index.php/compte/afficher_profil">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="<?php echo base_url();?>index.php/compte/deconnecter">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
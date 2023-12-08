<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>EscapeWeb</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" href="<?php echo base_url();?>bootstrap/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url();?>bootstrap/images/favicon.ico" type="image/x-icon">


    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap-icons.css">

    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/owl.carousel.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/owl.theme.default.min.css">

    <link href="<?php echo base_url();?>bootstrap/css/templatemo-pod-talk.css" rel="stylesheet">

    <!--

TemplateMo 584 Pod Talk

https://templatemo.com/tm-584-pod-talk

-->
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand me-lg-5 me-0" href="<?php echo base_url();?>">
                <img src="<?php echo base_url();?>bootstrap/images/logo_website.png" class="logo-image img-fluid" alt="templatemo pod talk">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>index.php/scenario/afficher_scenarios">Scénario</a>
                    </li>
                </ul>
                <?php
                    if(session()->user == null) {
                    ?>
                        <div class="ms-4">
                            <a href="<?php echo base_url();?>index.php/compte/connecter" class="btn custom-btn custom-border-btn smoothscroll">Connexion</a>
                        </div>
                <?php
                    }
                    else {
                ?>
                   <a href="<?php echo base_url();?>index.php/compte/deconnecter" class="btn custom-btn custom-border-btn smoothscroll m-3">Déconnexion</a>
                   <a href="<?php echo base_url();?>index.php/compte/afficher_accueil" class="btn custom-btn">Espace privé</a> 
                <?php
                    }
                ?>
            </div>
        </div>
    </nav>
    
    <main>
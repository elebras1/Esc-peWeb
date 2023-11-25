<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?php echo base_url();?>index.php/compte/afficher_accueil">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $titre ?></li>
        </ol>
    </nav>
</nav>
<!-- End Navbar -->
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('https://4kwallpapers.com/images/walls/thumbs_3t/5898.jpg');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="p-5">
            <?php
                if (!empty($profil)) {
                    echo '<p class="fs-3"><strong class="text-dark">Login:</strong> ' . $profil->cpt_login . '</p>';
                    echo '<p class="fs-3"><strong class="text-dark">Nom:</strong> ' . $profil->pfl_nom . '</p>';
                    echo '<p class="fs-3"><strong class="text-dark">Prénom:</strong> ' . $profil->pfl_prenom . '</p>';
                    echo '<p class="fs-3"><strong class="text-dark">Email:</strong> ' . $profil->pfl_email . '</p>';
                    echo '<p class="fs-3"><strong class="text-dark">Date d\'inscription:</strong> ' . $profil->pfl_date_inscription . '</p>';
                    echo '<p class="fs-3"><strong class="text-dark">Role:</strong> ' . $profil->pfl_role . '</p>';
                    echo '<p class="fs-3"><strong class="text-dark">Validité:</strong> ' . $profil->pfl_validite . '</p>';
                } else {
                    echo "<p class='fs-4'>Profil non disponible</p>";
                }
            ?>
        </div>
    </div>
</div>
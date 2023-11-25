<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?php echo base_url();?>index.php/compte/deconnecter">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $titre ?></li>
        </ol>
    </nav>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-4 px-5">
    <div class="row">
        <div class="bg-light py-4">
            <?php
                if (!empty($profil)) {
                    echo '<p class="fs-3"><strong>Login:</strong> ' . $profil->cpt_login . '</p>';
                    echo '<p class="fs-3"><strong>Nom:</strong> ' . $profil->pfl_nom . '</p>';
                    echo '<p class="fs-3"><strong>Prénom:</strong> ' . $profil->pfl_prenom . '</p>';
                    echo '<p class="fs-3"><strong>Email:</strong> ' . $profil->pfl_email . '</p>';
                    echo '<p class="fs-3"><strong>Date d\'inscription:</strong> ' . $profil->pfl_date_inscription . '</p>';
                    echo '<p class="fs-3"><strong>Role:</strong> ' . $profil->pfl_role . '</p>';
                    echo '<p class="fs-3"><strong>Validité:</strong> ' . $profil->pfl_validite . '</p>';
                } else {
                    echo "<p class='fs-4'>Profil non disponible</p>";
                }
            ?>
        </div>
    </div>
</div>
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
        <div class="row">
            <div class="col-md-8">
                <div class="p-5 d-flex flex-column">
                    <?php
                    if (!empty($scenario)) {
                        echo "<div><img src='".base_url()."ressources/". $scenario->snr_image."' style='width : 80px; height : 80px; border-radius: 10%;'/>";
                        echo "<span class='fs-3 px-4' >". $scenario->snr_intitule . "</span></div>";
                        echo "<span class='fs-3 my-4'>". $scenario->snr_description . "</span>";
                        if (!empty($etapes) && is_array($etapes)) {
                            foreach($etapes as $etape) {
                                echo '<p class="fs-3">' . $etape['etp_numero']. ' - ' . $etape['etp_intitule'] . '</p>';
                            }
                        }
                        else {
                            echo "<p class='fs-4'>Aucune étape</p>";
                        }
                    } else {
                        echo "<p class='fs-4'>Scenario non disponible</p>";
                        echo $scenario;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

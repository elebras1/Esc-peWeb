<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<?php
if (!isset($etape)) {
    echo "<div class='container'>";
    echo "<h2 class='mb-2'>Erreur : Pas d'étape</h2>";
    echo "</div>";
    echo "<br>";
    echo "<br>";
} else {
?>
    <section class="">
        <div class="container">
            <div class="row justify-content-center">
            
                <div class="col-lg-10 col-12">
                    <div class="section-title-wrap mb-5">
                        <h4 class="section-title"><?php echo $titre;?></h4>
                    </div>

                    <div class="row">
                        <div class="">
                            <div class="custom-block-info">
                                <h2 class="mb-2"><?php echo $etape->etp_intitule;?></h2>
                                <p><?php echo $etape->etp_question;?></p>
                                <div class="">
                                    <div class="custom-block-icon-wrap">
                                        <div class="custom-block-image-wrap custom-block-image-detail-page">
                                            <img src="<?php echo base_url(). 'ressources/' . $etape->rsc_url;?>"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <p class="bi-chat me-1">
                                <?php
                                    if ($etape->idc_id) 
                                    {
                                        echo "<span>Indice difficulté (" .$etape->idc_difficulte. ") : ". $etape->idc_description . "<span>";
                                        echo '<a href="' . $etape->idc_url . '" target="_blank"><span>' . $etape->idc_url . '</span></a>';

                                    } else {
                                        echo "Pas d'indice";
                                    }
                                    ?>
                                </p>
                                <br>
                                <!--
                                <p>reponse : <?php //echo $etape->etp_reponse;?></p>
                                <button type="button" class="btn btn-primary btn-lg btn-block ml-auto">Envoyer</button>
                                -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php
}
?>
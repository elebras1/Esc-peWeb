<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<?php
if (!isset($etape)) {
    echo "<div class='container'>";
    echo "<h2 class='mb-2'>Ce scénario n’existe pas!</h2>";
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
                                <?php
                                    if ($etape->idc_id) 
                                    {
                                        echo '<p class="bi-chat me-1">';
                                        echo "<span>Indice difficulté (" .$etape->idc_difficulte. ") : ". $etape->idc_description . "<span>";
                                        echo '<a href="' . $etape->idc_url . '" target="_blank"><span>' . $etape->idc_url . '</span></a>';
                                        echo '</p>';

                                    }
                                    ?>
                                </p>
                                <br>
                                <?php
                                echo form_open('/scenario/afficher_1ere_etape/'); ?>
                                    <?= csrf_field() ?>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-floating">
                                            <input type="hidden" name="code_etape" id="code_etape" class="form-control" value="<?php echo $etape->etp_code ?>" required="">
                                            <input type="hidden" name="code_scenario" id="code_scenario" class="form-control" value="<?php echo $etape->snr_code ?>" required="">
                                            <input type="hidden" name="difficulte_etape" id="difficulte_etape" class="form-control" value="<?php echo $difficulte ?>" required="">

                                            <input type="text" name="reponse" id="reponse" class="form-control"
                                                placeholder="reponse" required="">
                                            <label for="floatingInput">Reponse</label>
                                            <?= validation_show_error('reponse') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block ml-auto">Envoyer</button>
                                </form>
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
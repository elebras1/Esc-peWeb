<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12">  
                    <div class="section-title-wrap mb-5">
                        <h4 class="section-title"><?php echo $titre . ' ' .$scenario->snr_intitule;?></h4>
                    </div>
                    <div class="row"> 
                        <span class="m-3 font-weight-bold h4">Bravo! vous avez terminé le scénario, il ne vous reste qu'à remplir le champ email et nom/pseudo afin d'enregistrer votre participation.</span>
                        <?php 
                            echo form_open('/scenario/finaliser_scenario/'); ?>
                            <?= csrf_field() ?>
                                <div class="col-lg-12 col-12">
                                    <input type="hidden" name="code_etape" id="code_etape" class="form-control" value="<?php echo $code_etape ?>" required="">
                                    <input type="hidden" name="code_scenario" id="code_scenario" class="form-control" value="<?php echo $code_scenario ?>" required="">
                                    <input type="hidden" name="difficulte" id="difficulte" class="form-control" value="<?php echo $difficulte ?>" required="">
                                    <div class="form-floating">
                                        <input type="text" name="nom" id="nom" class="form-control" placeholder="nom" required="">
                                        <label for="floatingInput">Nom</label>
                                        <?= validation_show_error('nom') ?>
                                    </div>
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="email" required="">
                                        <label for="floatingInput">Email</label>
                                        <?= validation_show_error('email') ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block ml-auto">Envoyer</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

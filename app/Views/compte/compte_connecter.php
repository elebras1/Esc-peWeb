<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 mx-auto">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title"><?php echo $titre; ?></h4>
                </div>
                <?= session()->getFlashdata('error') ?>
                <?php
                // Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
                echo form_open('/compte/connecter'); ?>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="text" name="pseudo" id="pseudo" class="form-control"
                                    placeholder="pseudo" required="">
                                <?= validation_show_error('pseudo') ?>
                                <label for="floatingInput">Pseudo</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="password" name="mdp" id="mdp" class="form-control"
                                    placeholder="Mot de passe" required="">
                                <?= validation_show_error('mdp') ?>
                                <label for="floatingInput">Mot de passe</label>
                            </div>
                        </div>

                        <div class="col-lg-4  ms-auto">
                            <button type="submit" class="btn btn-primary btn-lg btn-block ml-auto">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
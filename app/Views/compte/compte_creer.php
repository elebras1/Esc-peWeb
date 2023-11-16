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
                <?= validation_list_errors() ?>
                <?php
                // Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
                echo form_open('/compte/creer', array('class' => 'custom-form contact-form')); ?>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="text" name="pseudo" id="pseudo" class="form-control"
                                    placeholder="pseudo" required="">

                                <label for="floatingInput">Pseudo</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Mot de passe" required="">

                                <label for="floatingInput">Mot de passe</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="password" name="password2" id="password2" class="form-control"
                                    placeholder="Mot de passe" required="">

                                <label for="floatingInput">Confirmation du mot de passe</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" name="nom" id="nom" class="form-control"
                                    placeholder="Nom" required="">

                                <label for="floatingInput">Nom</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" name="prenom" id="prenom" class="form-control"
                                    placeholder="Prenom" required="">

                                <label for="floatingInput">Prénom</label>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Email" required="">

                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 ms-auto">
                            <button type="submit" class="form-control" name="submit">Envoyer</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
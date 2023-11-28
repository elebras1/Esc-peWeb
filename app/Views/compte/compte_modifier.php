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
    <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1486520299386-6d106b22014b?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="p-5">
            <div class="col-lg-8 col-12 mx-auto">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title"><?php echo $titre; ?></h4>
                </div>
                <?= session()->getFlashdata('error') ?>
                <?php
                // Création d’un formulaire qui pointe vers l’URL de base + /compte/modifier
                echo form_open('/compte/modifier', array('class' => 'custom-form contact-form')); ?>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="form-floating">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Mot de passe" required="">
                                <?= validation_show_error('password') ?>
                                <label for="floatingInput">Mot de passe*</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="form-floating">
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="Nouveau mot de passe"required="">
                                <?= validation_show_error('new_password') ?>
                                <label for="floatingInput">Nouveau mot de passe*</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="form-floating">
                                <input type="password" name="new_password2" id="new_password2" class="form-control"
                                    placeholder="Confirmation "required="">
                                <?= validation_show_error('new_password2') ?>
                                <label for="floatingInput">Confirmation du nouveau mot de passe*</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="form-floating">
                                <input type="text" name="nom" id="nom" class="form-control"
                                    placeholder="Nom" required="" value="<?php echo stripslashes($profil->pfl_nom); ?>">
                                <?= validation_show_error('nom') ?>
                                <label for="floatingInput">Nom*</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="form-floating">
                                <input type="text" name="prenom" id="prenom" class="form-control"
                                    placeholder="Prenom" required="" value="<?php echo stripslashes($profil->pfl_prenom); ?>">
                                <?= validation_show_error('prenom') ?>
                                <label for="floatingInput">Prénom*</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Email" required="" value="<?php echo $profil->pfl_email; ?>">
                                <?= validation_show_error('email') ?>
                                <label for="floatingInput">Email*</label>
                            </div>
                        </div>

                        <div class="col-lg-4 ms-auto mt-4" style="display:flex">
                            <a href="<?php echo base_url(); ?>index.php/compte/afficher_profil" class="btn btn-primary form-control" name="submit" style="margin-right:5px; text-align:center; width: 50%;">Annuler</a>
                            <input type="submit" class="btn btn-primary form-control" name="submit" value="Envoyer" style="width: 50%;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
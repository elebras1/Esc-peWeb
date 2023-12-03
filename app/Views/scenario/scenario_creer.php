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
    <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1578070181910-f1e514afdd08?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8fA%3D%3D');">
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
                // Création d’un formulaire qui pointe vers l’URL de base + /scenario/creer
                echo form_open_multipart('/scenario/creer'); ?>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="text" name="intitule" id="intitule" class="form-control"
                                    placeholder="Intitule" required="">
                                <div class="text-danger">
                                    <?= validation_show_error('intitule') ?>
                                </div>
                                <label for="floatingInput">Intitule*</label>
                            </div>
                            <span class="text-danger"><?php if(!empty($erreur)) { echo $erreur; } ?></span>
                        </div>

                        <div class="col-lg-12 col-12 mt-4">
                            <div class="form-floating">
                                <textarea name="description" id="description" class="form-control"
                                    placeholder="Description" required=""></textarea>
                                <div class="text-danger">
                                    <?= validation_show_error('description') ?>
                                </div>
                                <label for="floatingInput">Description*</label>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-12 mt-4">
                            <input type="file" name="fichier" class="form-control"">
                            <div class="text-danger">
                                <?= validation_show_error('fichier') ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-4">
                            <div class="">
                                <select class="form-select" aria-label="Default select example" name="statut" id="statut">
                                    <option selected>Choisir le statut*</option>
                                    <option value="A">Activé</option>
                                    <option value="D">Désactivé</option>
                                </select>
                            </div>
                            <div class="text-danger">
                                <?= validation_show_error('statut') ?>
                            </div>
                        </div>

                        <div class="col-lg-4  ms-auto  mt-4">
                            <input type="submit" class="btn btn-primary form-control" name="submit" value="Envoyer" style="width: 50%;" />
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
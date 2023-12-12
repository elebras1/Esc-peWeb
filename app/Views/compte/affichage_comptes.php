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

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3"><?php echo $titre; ?></h6>
                        <a href="<?php echo base_url()?>index.php/compte/creer" class="btn custom-btn">
                            <img src="<?php echo base_url()?>bootstrap2/assets/img/plus_white.png" style="width: 15px;"/>
                        </a>
                    </div>

                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pseudo / Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nom / Prénom</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rôle</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Validité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($logins) && is_array($logins)) {
                                    foreach ($logins as $pseudo) {
                                        echo "<tr>";
                                        echo "<td class='align-middle'>";
                                        echo "<div class='d-flex px-2 py-1'>";
                                        echo "<div>";
                                        echo "</div>";
                                        echo "<div class='d-flex flex-column justify-content-center'>";
                                        echo "<h6 class='mb-0 text-sm'>" . $pseudo["cpt_login"] . "</h6>";
                                        echo "<p class='text-xs text-secondary mb-0'>" . $pseudo["pfl_email"] . "</p>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo "<p class='text-xs font-weight-bold mb-0'>" . stripslashes($pseudo["pfl_nom"]) . "</p>";
                                        echo "<p class='text-xs text-secondary mb-0'>" . stripslashes($pseudo["pfl_prenom"]) . "</p>";
                                        echo "</td>";
                                        echo "<td class='align-middle text-center'>";
                                        echo "<span class='text-secondary text-xs font-weight-bold'>" . $pseudo["pfl_date_inscription"] . "</span>";
                                        echo "<td class='align-middle text-center text-sm'>";
                                        if($pseudo["pfl_role"] == 'O') {
                                            echo "<span class='text-secondary text-xs font-weight-bold'>Organisateur</span>";
                                        }
                                        elseif($pseudo["pfl_role"] == 'A') {
                                            echo "<span class='text-secondary text-xs font-weight-bold'>Administrateur</span>";
                                        }
                                        echo "</td>";
                                        echo "<td class='align-middle text-center text-sm'>";
                                        if($pseudo["pfl_validite"] == 'A') {
                                            echo "<span class='text-secondary text-xs font-weight-bold'>Activer</span>";
                                        }
                                        elseif($pseudo["pfl_validite"] == 'D') {
                                            echo "<span class='text-secondary text-xs font-weight-bold'>Désactiver</span>";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'><h3>Aucune actualité pour le moment</h3></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

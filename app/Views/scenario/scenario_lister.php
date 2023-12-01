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
                        <a href="" class="btn custom-btn">
                            <img src="<?php echo base_url()?>bootstrap2/assets/img/plus_white.png" style="width: 15px;"/>
                        </a>
                    </div>

                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Intitule</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Auteur</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etapes</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="max-width: 20px;">Image</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 image-column" style="max-width: 20px;">Visualiser</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 image-column" style="max-width: 20px;">Copier</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 image-column" style="max-width: 20px;">Modifier</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 image-column" style="max-width: 20px;">A/D</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 image-column" style="max-width: 20px;">Supprimer</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 image-column" style="max-width: 20px;">RAZ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $session = session();
                                if (!empty($scenarios) && is_array($scenarios)) {
                                    foreach ($scenarios as $scenario) {
                                        echo "<tr>";
                                        echo "<td class='align-middle text-center'>";
                                        echo "<span class='text-secondary text-xs font-weight-bold'>" . $scenario["snr_intitule"] . "</span>";
                                        echo "</td>";
                                        echo "<td class='align-middle text-center text-sm'>";
                                        echo "<span class='text-secondary text-xs font-weight-bold'>" . $scenario["cpt_login"] . "</span>";
                                        echo "</td>";
                                        echo "<td class='align-middle text-center text-sm'>";
                                        echo "<span class='text-secondary text-xs font-weight-bold'>" . $scenario["nb_etape"] . "</span>";
                                        echo "</td>";
                                        echo "<td class='align-middle text-center text-sm'>";
                                        echo "<img src='".base_url()."ressources/". $scenario["snr_image"] ."' style='width : 30px; height : 30px; border-radius: 50%;'/>";
                                        echo "</td>";
                                        if($session->get('user') != $scenario["cpt_login"]) {
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href='".base_url()."index.php/scenario/afficher_scenario/". $scenario["snr_code"] ."' target='_blank'><img src='".base_url()."bootstrap2/assets/img/oeil-black.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href=''><img src='".base_url()."bootstrap2/assets/img/copy-black.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        elseif ($session->get('user') == $scenario["cpt_login"]) {
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href='".base_url()."index.php/scenario/afficher_scenario/". $scenario["snr_code"] ."' target='_blank'><img src='".base_url()."bootstrap2/assets/img/oeil-black.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href=''><img src='".base_url()."bootstrap2/assets/img/pencil-black.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href=''><img src='".base_url()."bootstrap2/assets/img/padlock-black.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href=''><img src='".base_url()."bootstrap2/assets/img/cross-black.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "<td class='align-middle text-center text-sm'>";
                                            echo "<a href=''><img src='".base_url()."bootstrap2/assets/img/circular-arrow.png' style='width : 10px;'/></a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
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

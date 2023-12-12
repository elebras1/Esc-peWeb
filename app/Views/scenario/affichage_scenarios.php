<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="row">    
            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title"><?php echo $titre; ?></h4>
                </div>
            </div>
            <?php 
                if (! empty($scenarios) && is_array($scenarios))
                {
                    foreach ($scenarios as $scenario)
                    {
                        echo '<div class="col-lg-4 col-12 mb-4">';
                        echo '<div class="custom-block custom-block-full">';
                        echo '<div class="custom-block-image-wrap">';
                        echo '<img src="'. base_url() . "ressources/" . $scenario["snr_image"] . '" class="custom-block-image img-fluid" alt="">';
                        echo '</div>';
                        echo '<div class="custom-block-info">';
                        echo '<h5 class="mb-2">';
                        echo '<span> ' . $scenario["snr_intitule"] . '</span>';
                        echo '</h5> <div class="profile-block d-flex"> <p>' . $scenario["cpt_login"] . '</p> </div>';
                        echo '<a href="' . base_url() . 'index.php/scenario/afficher_1ere_etape/' . $scenario["snr_code"] .'/1" target="_blank" class=""><p class="mb-0 link-success">Facile</p></a>';
                        echo '<br>';
                        echo '<a href="' . base_url() . 'index.php/scenario/afficher_1ere_etape/' . $scenario["snr_code"] .'/2" target="_blank" class=""><p class="mb-0 link-success">Moyen</p></a>';
                        echo '<br>';
                        echo '<a href="' . base_url() . 'index.php/scenario/afficher_1ere_etape/' . $scenario["snr_code"] .'/3" target="_blank" class=""><p class="mb-0 link-success">Difficile</p></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                else {
                    echo("<h3>Aucun scénario pour l'instant !</h3>");
                }
            ?>
        </div>
    </div>
</section>

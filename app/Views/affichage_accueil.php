<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="text-center mb-5 pb-2">
                    <h1 class="text-white">Bienvenue sur Esc@peWeb</h1>

                    <p class="text-white">
                        Jouez à de nombreux scénarios sur la culture générale.
                    </p>
                    
                    <a href="<?php echo base_url();?>index.php/scenario/lister" class="btn custom-btn smoothscroll mt-3">Commencer un scénario</a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <table class="table table-hover">
            <tbody>
                <?php
                    if (! empty($actualites) && is_array($actualites))
                    {
                        foreach ($actualites as $actu)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $actu["act_titre"];
                            echo "</td>";
                            echo "<td>";
                            echo $actu["act_description"];
                            echo "</td>";
                            echo "<td>";
                            echo $actu["act_date"];
                            echo "</td>";
                            echo "<td>";
                            echo $actu["cpt_login"];
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    else {
                        echo("<h3>Aucune actualité pour le moment</h3>");
                    }
                ?>
            </tbody>
        </table>       
    </div>
<section>


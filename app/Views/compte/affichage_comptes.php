<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="section-title-wrap mb-5">
            <h4 class="section-title"><?php echo $titre; ?></h4>
            <h4 class="section-title"><?php echo $total->number; ?></h4>
        </div>
        <div class="mt-2">
            <a href="#" class="btn custom-btn">
                Ajouter un compte
            </a>
        </div>
        <table class="table table-hover">
            <tbody>
                <?php
                    if (! empty($logins) && is_array($logins))
                    {
                        foreach ($logins as $pseudo)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $pseudo["cpt_login"];
                            echo "</td>";
                            echo "<td>";
                            echo $pseudo["pfl_nom"];
                            echo "</td>";
                            echo "<td>";
                            echo $pseudo["pfl_prenom"];
                            echo "</td>";
                            echo "<td>";
                            echo $pseudo["pfl_email"];
                            echo "</td>";
                            echo "<td>";
                            echo $pseudo["pfl_date_inscription"];
                            echo "</td>";
                            echo "<td>";
                            echo $pseudo["pfl_role"];
                            echo "</td>";
                            echo "<td>";
                            echo $pseudo["pfl_validite"];
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
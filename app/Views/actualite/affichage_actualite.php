<section class="hero-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-10 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title"><?php echo $titre;?></h4>
                </div>

                <div class="row">
                    <?php
                        if (isset($news)){
                            echo $news->act_id;
                            echo(" -- ");
                            echo $news->act_titre;
                        }
                        else {
                            echo ("Pas d'actualité !");
                        }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>
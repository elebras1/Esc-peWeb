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


<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Scénarios récents</h4>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block d-flex">
                    <div class="">
                        <div class="custom-block-icon-wrap">
                            <div class="section-overlay"></div>
                            <a href="<?php echo base_url();?>bootstrap/ pages/detail-page.html" class="custom-block-image-wrap">
                                <img src="<?php echo base_url();?>bootstrap/images/podcast/11683425_4790593.jpg"
                                    class="custom-block-image img-fluid" alt="">

                                <a href="#" class="custom-block-icon">
                                    <i class="bi-play-fill"></i>
                                </a>
                            </a>
                        </div>

                        <div class="mt-2">
                            <a href="#" class="btn custom-btn">
                                Subscribe
                            </a>
                        </div>
                    </div>

                    <div class="custom-block-info">
                        <div class="custom-block-top d-flex mb-1">
                            <small class="me-4">
                                <i class="bi-clock-fill custom-icon"></i>
                                50 Minutes
                            </small>

                            <small>Episode <span class="badge">15</span></small>
                        </div>

                        <h5 class="mb-2">
                            <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                                Modern Vintage
                            </a>
                        </h5>

                        <div class="profile-block d-flex">
                            <img src="<?php echo base_url();?>bootstrap/images/profile/woman-posing-black-dress-medium-shot.jpg"
                                class="profile-block-image img-fluid" alt="">

                            <p>
                                Elsa
                                <img src="<?php echo base_url();?>bootstrap/images/verified.png" class="verified-image img-fluid" alt="">
                                <strong>Influencer</strong>
                            </p>
                        </div>

                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                        <div class="custom-block-bottom d-flex justify-content-between mt-3">
                            <a href="#" class="bi-headphones me-1">
                                <span>120k</span>
                            </a>

                            <a href="#" class="bi-heart me-1">
                                <span>42.5k</span>
                            </a>

                            <a href="#" class="bi-chat me-1">
                                <span>11k</span>
                            </a>

                            <a href="#" class="bi-download">
                                <span>50k</span>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex flex-column ms-auto">
                        <a href="#" class="badge ms-auto">
                            <i class="bi-heart"></i>
                        </a>

                        <a href="#" class="badge ms-auto">
                            <i class="bi-bookmark"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="custom-block d-flex">
                    <div class="">
                        <div class="custom-block-icon-wrap">
                            <div class="section-overlay"></div>
                            <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html" class="custom-block-image-wrap">
                                <img src="<?php echo base_url();?>bootstrap/images/podcast/12577967_02.jpg" class="custom-block-image img-fluid"
                                    alt="">

                                <a href="#" class="custom-block-icon">
                                    <i class="bi-play-fill"></i>
                                </a>
                            </a>
                        </div>

                        <div class="mt-2">
                            <a href="#" class="btn custom-btn">
                                Subscribe
                            </a>
                        </div>
                    </div>

                    <div class="custom-block-info">
                        <div class="custom-block-top d-flex mb-1">
                            <small class="me-4">
                                <i class="bi-clock-fill custom-icon"></i>
                                15 Minutes
                            </small>

                            <small>Episode <span class="badge">45</span></small>
                        </div>

                        <h5 class="mb-2">
                            <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                                Daily Talk
                            </a>
                        </h5>

                        <div class="profile-block d-flex">
                            <img src="<?php echo base_url();?>bootstrap/images/profile/handsome-asian-man-listening-music-through-headphones.jpg"
                                class="profile-block-image img-fluid" alt="">

                            <p>William
                                <strong>Vlogger</strong>
                            </p>
                        </div>

                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                        <div class="custom-block-bottom d-flex justify-content-between mt-3">
                            <a href="#" class="bi-headphones me-1">
                                <span>140k</span>
                            </a>

                            <a href="#" class="bi-heart me-1">
                                <span>22.4k</span>
                            </a>

                            <a href="#" class="bi-chat me-1">
                                <span>16k</span>
                            </a>

                            <a href="#" class="bi-download">
                                <span>62k</span>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex flex-column ms-auto">
                        <a href="#" class="badge ms-auto">
                            <i class="bi-heart"></i>
                        </a>

                        <a href="#" class="badge ms-auto">
                            <i class="bi-bookmark"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="topics-section section-padding pb-0" id="section_3">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Topics</h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-overlay">
                    <a href="<?php echo base_url();?>bootstrap//detail-page.html" class="custom-block-image-wrap">
                        <img src="<?php echo base_url();?>bootstrap/images/topics/physician-consulting-his-patient-clinic.jpg"
                            class="custom-block-image img-fluid" alt="">
                    </a>

                    <div class="custom-block-info custom-block-overlay-info">
                        <h5 class="mb-1">
                            <a href="<?php echo base_url();?>bootstrap/pages/listing-page.html">
                                Productivity
                            </a>
                        </h5>

                        <p class="badge mb-0">50 Episodes</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-overlay">
                    <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html" class="custom-block-image-wrap">
                        <img src="<?php echo base_url();?>bootstrap/images/topics/repairman-doing-air-conditioner-service.jpg"
                            class="custom-block-image img-fluid" alt="">
                    </a>

                    <div class="custom-block-info custom-block-overlay-info">
                        <h5 class="mb-1">
                            <a href="<?php echo base_url();?>bootstrap/pages/listing-page.html">
                                Technician
                            </a>
                        </h5>

                        <p class="badge mb-0">12 Episodes</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-overlay">
                    <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html" class="custom-block-image-wrap">
                        <img src="<?php echo base_url();?>bootstrap/images/topics/woman-practicing-yoga-mat-home.jpg"
                            class="custom-block-image img-fluid" alt="">
                    </a>

                    <div class="custom-block-info custom-block-overlay-info">
                        <h5 class="mb-1">
                            <a href="<?php echo base_url();?>bootstrap/pages/listing-page.html">
                                Mindfullness
                            </a>
                        </h5>

                        <p class="badge mb-0">35 Episodes</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-overlay">
                    <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html" class="custom-block-image-wrap">
                        <img src="<?php echo base_url();?>bootstrap/images/topics/delicious-meal-with-sambal-arrangement.jpg"
                            class="custom-block-image img-fluid" alt="">
                    </a>

                    <div class="custom-block-info custom-block-overlay-info">
                        <h5 class="mb-1">
                            <a href="p<?php echo base_url();?>bootstrap/pages/listing-page.html">
                                Cooking
                            </a>
                        </h5>

                        <p class="badge mb-0">12 Episodes</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="trending-podcast-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Trending episodes</h4>
                </div>
            </div>

            <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-full">
                    <div class="custom-block-image-wrap">
                        <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                            <img src="<?php echo base_url();?>bootstrap/images/podcast/27376480_7326766.jpg" class="custom-block-image img-fluid"
                                alt="">
                        </a>
                    </div>

                    <div class="custom-block-info">
                        <h5 class="mb-2">
                            <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                                Vintage Show
                            </a>
                        </h5>

                        <div class="profile-block d-flex">
                            <img src="<?php echo base_url();?>bootstrap/images/profile/woman-posing-black-dress-medium-shot.jpg"
                                class="profile-block-image img-fluid" alt="">

                            <p>Elsa
                                <strong>Influencer</strong>
                            </p>
                        </div>

                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                        <div class="custom-block-bottom d-flex justify-content-between mt-3">
                            <a href="#" class="bi-headphones me-1">
                                <span>100k</span>
                            </a>

                            <a href="#" class="bi-heart me-1">
                                <span>2.5k</span>
                            </a>

                            <a href="#" class="bi-chat me-1">
                                <span>924k</span>
                            </a>
                        </div>
                    </div>

                    <div class="social-share d-flex flex-column ms-auto">
                        <a href="#" class="badge ms-auto">
                            <i class="bi-heart"></i>
                        </a>

                        <a href="#" class="badge ms-auto">
                            <i class="bi-bookmark"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-full">
                    <div class="custom-block-image-wrap">
                        <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                            <img src="<?php echo base_url();?>bootstrap/images/podcast/27670664_7369753.jpg" class="custom-block-image img-fluid"
                                alt="">
                        </a>
                    </div>

                    <div class="custom-block-info">
                        <h5 class="mb-2">
                            <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                                Vintage Show
                            </a>
                        </h5>

                        <div class="profile-block d-flex">
                            <img src="<?php echo base_url();?>bootstrap/images/profile/cute-smiling-woman-outdoor-portrait.jpg"
                                class="profile-block-image img-fluid" alt="">

                            <p>
                                Taylor
                                <img src="<?php echo base_url();?>bootstrap/images/verified.png" class="verified-image img-fluid" alt="">
                                <strong>Creator</strong>
                            </p>
                        </div>

                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                        <div class="custom-block-bottom d-flex justify-content-between mt-3">
                            <a href="#" class="bi-headphones me-1">
                                <span>100k</span>
                            </a>

                            <a href="#" class="bi-heart me-1">
                                <span>2.5k</span>
                            </a>

                            <a href="#" class="bi-chat me-1">
                                <span>924k</span>
                            </a>
                        </div>
                    </div>

                    <div class="social-share d-flex flex-column ms-auto">
                        <a href="#" class="badge ms-auto">
                            <i class="bi-heart"></i>
                        </a>

                        <a href="#" class="badge ms-auto">
                            <i class="bi-bookmark"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="custom-block custom-block-full">
                    <div class="custom-block-image-wrap">
                        <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                            <img src="<?php echo base_url();?>bootstrap/images/podcast/12577967_02.jpg" class="custom-block-image img-fluid"
                                alt="">
                        </a>
                    </div>

                    <div class="custom-block-info">
                        <h5 class="mb-2">
                            <a href="<?php echo base_url();?>bootstrap/pages/detail-page.html">
                                Daily Talk
                            </a>
                        </h5>

                        <div class="profile-block d-flex">
                            <img src="<?php echo base_url();?>bootstrap/images/profile/handsome-asian-man-listening-music-through-headphones.jpg"
                                class="profile-block-image img-fluid" alt="">

                            <p>
                                William
                                <img src="<?php echo base_url();?>bootstrap/images/verified.png" class="verified-image img-fluid" alt="">
                                <strong>Vlogger</strong>
                            </p>
                        </div>

                        <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>

                        <div class="custom-block-bottom d-flex justify-content-between mt-3">
                            <a href="#" class="bi-headphones me-1">
                                <span>100k</span>
                            </a>

                            <a href="#" class="bi-heart me-1">
                                <span>2.5k</span>
                            </a>

                            <a href="#" class="bi-chat me-1">
                                <span>924k</span>
                            </a>
                        </div>
                    </div>

                    <div class="social-share d-flex flex-column ms-auto">
                        <a href="#" class="badge ms-auto">
                            <i class="bi-heart"></i>
                        </a>

                        <a href="#" class="badge ms-auto">
                            <i class="bi-bookmark"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
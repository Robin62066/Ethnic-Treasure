<?php
include "config/autoload.php";

$items = $db->select('ai_images', ['status' => 1], 1, "id ASC")->row();
$sql = "SELECT * FROM `ai_images` WHERE id > (SELECT MIN(id) FROM `ai_images`) AND status = 1";
$bannerImg = $db->query($sql)->result();

$seo = $db->select("ai_seo_details", ['web_link' => '1'], 1, 'id DESC')->row();



$description = $seo->meta_description ?? "EthnicTreasures – A curated collection of exclusive, handcrafted cultural treasures.
Discover timeless artistry and heritage in every piece.";
$seoKeyword = $seo->meta_keywords ?? "ethnic treasures, handcrafted cultural items, exclusive artisanal products, heritage-inspired collection, timeless artistry";
$title = $seo->meta_title ?? "Ethnic Treasures – Handcrafted Elegance in Every Stitch";
include "nav.php";
?>
<style>
    .social-icons {
        position: fixed;
        left: 7px;

        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 1000;

    }

    .social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #fff;

        color: #000;

        border-radius: 50%;
        text-decoration: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .social-icons a:hover {
        background-color: #f1f1f1;
        transform: scale(1.1);
    }

    .social-icons i {
        font-size: 20px;
    }
</style>
<section>
    <div class="col-md-12 ">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php if ($items->image != '') { ?>
                        <img src="<?= base_url(upload_dir($items->image)) ?>" height="auto" class="d-block w-100" alt="...">
                    <?php } ?>
                </div>

                <?php
                foreach ($bannerImg as $banner) {
                    if ($banner->image != '') { ?>
                        <div class="carousel-item">
                            <img src="<?= base_url(upload_dir($banner->image)) ?>" height="auto" class="d-block w-100" alt="...">
                        </div>
                <?php }
                } ?>


                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                        style="background-color: rgb(204, 177, 136); padding: 10px; border-radius: 50%;"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                        style="background-color: rgb(204, 177, 136); padding: 10px; border-radius: 50%;"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Fixed Social Media Icons -->
    <div class="social-icons">
        <a href="https://www.facebook.com/share/1AMhCVmN4X/ " class="icon facebook" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
            </svg></a>
        <a href="#" class="icon twitter" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
            </svg></a>
        <a href="https://www.instagram.com/ethnictreasures9?igsh=aDh5eGhhdWYweWVi " class="icon instagram" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
            </svg></i></a>
        <a href="#" class="icon linkedin" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
            </svg></a>
    </div>

    <div class="container">

        <div class="row mt-5" align="center">
            <div class="choose mt-3">
                <h1>Looking for Unique Handcrafted Elegance</h1>
                <div class="under"></div>
            </div>
            <?php
            $items = $db->select("ai_products", [], 4, "id DESC")->result();

            foreach ($items as $item) {
                if ($item->image != "") {
            ?>
                    <div class="col-md-3 mt-5">
                        <div class="late  rounded-4">
                            <a href=""><img src="<?= base_url(upload_dir($item->image)) ?>" height="300" width="150" alt="..."></a>

                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <!-- <div class="col-md-3 mt-5">
                <div class="late  rounded-4">
                    <a href=""><img src="image/img6.jpg" height="300" width="150" alt="..."></a>
                </div>
            </div>
            <div class="col-md-3 mt-5">
                <div class="late  rounded-4">
                    <a href=""><img src="image/img5.jpg" height="300" width="150" alt="..."></a>
                </div>
            </div>
            <div class="col-md-3 mt-5">
                <div class="late  rounded-4">
                    <a href=""><img src="image/img4.jpg" height="300" width="150" alt="..."></a>
                </div>
            </div> -->

            <div class="  mt-3">
                <a href="product.php" type="submit" class="btn btn-warning">View All Product</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5" align="center">
        <h2 class="with">As featured in...</h2>
        <div class="geeks"></div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-5">
                <img src="image/img5.jpg" height="300" width="100%" alt="..." class="vl">
                <div></div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="adds">
                    <p>Beautifully handerfted with vibrand granny square patterns.</p>
                    <p>Adds a touch of elegance to any decor.</p>
                </div>

            </div>

        </div>
        <div class="row mt-5">
            <?php
            $featured = $db->select("ai_media", ['status' => 1], false, "id DESC")->result();
            $count = 0;
            $arr = ['fade-right', 'fade-down', 'fade-right', 'fade-up'];
            foreach ($featured as $img) {
                if ($img->image != "") {
                    if ($count <= 3) {
            ?>
                        <div class="col-md-6 px-0">
                            <div class="late">
                                <div data-aos="<?php echo $arr[$count]; ?>" data-aos-easing="linear" data-aos-duration="1100">
                                    <img src="<?= base_url(upload_dir($img->image)) ?>" height="auto" width="100%" alt="...">
                                </div>
                            </div>
                        </div>
            <?php $count++;
                    }
                } else {
                    break;
                }
            }  ?>
            <!-- <div class="col-md-6 px-0">
                <div class="late ">
                    <div data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1100">
                        <img src="image/w013.png" height="auto" width="100%" alt="...">
                    </div>
                </div>
            </div> -->
        </div>
        <!-- <div class="row">
            <div class="col-md-6 px-0">
                <div class="late">
                    <div data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1100">
                        <img src="image/w002.png" height="auto" width="100%" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-0">
                <div class="late">
                    <div data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1100">
                        <img src="image/w027.png" height="auto" width="100%" alt="...">
                    </div>
                </div>
            </div>
        </div> -->








        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12 " align="center">
                    <div class="review ">
                        <h3>View Our Gallary</h3>
                        <div class="geeks"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-5">
                    <span class="background">
                        <section class="gallery">
                            <?php
                            $gallery = $db->select("ai_gallery_img", ['status' => 1], 4, 'id DESC')->result();
                            foreach ($gallery as $img) {
                                if ($img->image != "") {
                            ?>
                                    <section class="img-card">
                                        <img src="<?= base_url(upload_dir($img->image)) ?>" alt="" />
                                    </section>
                            <?php

                                }
                            }  ?>

                            <!-- <section class="img-card">
                                <img src="image/web1.png" alt="" />
                            </section>

                            <section class="img-card">
                                <img src="image/w016.png" alt="" />
                            </section>

                            <section class="img-card">
                                <img src="image/w9.png" alt="" />
                            </section>

                            <section class="img-card">
                                <img src="image/web4.png" alt="" />
                            </section> -->
                        </section>
                    </span>
                </div>
            </div>
        </div>



        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12 mt-5" align="center">
                    <div class="review">
                        <h3>Customer’s Reviews</h3>
                        <div class="geeks"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 " align="center">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            $items = $db->select("ai_review", [], false, "id DESC")->result();
                            foreach ($items as $item) {
                            ?>
                                <div class="swiper-slide">
                                    <div class="feedback">
                                        <b><?= $item->name; ?></b>

                                        <p><?= $item->message; ?></p>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="feedback">
                                    <b>John Doe</b>
                                    <span>18/1/2025</span>
                                    <p>“Malesuada et ut vitae eget. Leo viverra fringilla faucibus proin lacinia ornare
                                        amet.
                                        Aliquam mi eros.”</p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div> -->
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12 mt-5" align="center">
                        <h2 class="with text-center">As Brand in...</h2>
                        <div class="geeks"></div>
                        <div class="photo mt-5">
                            <img src="image/img7.avif" height="80" width="200" alt="...">
                            <img src="image/img8.avif" height="80" width="200" alt="...">
                            <img src="image/img9.avif" height="80" width="200" alt="...">
                            <img src="image/img10.avif" height="80" width="200" alt="...">
                        </div>
                    </div>
                </div>
           -->

</section>

<?php include "footer.php";
?>
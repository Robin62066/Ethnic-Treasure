<?php

include "nav.php";
$seo = $db->select("ai_seo_details", ['web_link' => '3'], 1, 'id DESC')->row();
$title = $seo->meta_title ?? "All Blogs";
$description = $seo->meta_description ?? "EthnicFoundation is dedicated to preserving cultural heritage through handcrafted ethnic treasures. Explore our blog for insights on traditional craftsmanship, artisan stories, and timeless artistry from around the world";
$seoKeyword = $seo->meta_keywords ??  "Ethnic crafts ,Traditional craftsmanship ,Handcrafted cultural treasures ,Artisan-made products, Cultural heritage";
$userObj = new User();
?>
<style>
    .blog a {
        text-decoration: none;
        color: black;
        font-size: 25px;
        font-weight: 600;
        margin-bottom: 10px;

    }

    .blog p {
        color: grey;
        font-size: 14px;
        margin-top: 8px;
        padding-left: 5px;

    }

    .coment a {
        text-decoration: none;
        color: grey;
        font-size: 11px;
        font-weight: 400;
        padding: 10px;
    }

    .blog a:hover {
        color: orangered;
    }

    .choose input {
        padding: 10px;
        margin: 15px;
        position: relative;
        right: 15px;
    }

    .category h3 {
        border-bottom: 1px solid grey;
        padding: 10px;
        font-weight: 550;
        font-size: 20px;
    }

    .category li {
        list-style: none;
        line-height: 30px;
        border-bottom: 1px solid grey;
        padding: 15px;
    }

    .category a {
        text-decoration: none;
        color: grey;
        position: relative;
        right: 15px;
    }

    .category a:hover {
        color: orangered;
        font-weight: 400;
    }

    .recent h3 {
        border-bottom: 1px solid grey;
        padding: 10px;
        font-weight: 550;
        font-size: 20px;
    }

    .recent p {
        line-height: 30px;
        border-bottom: 1px solid grey;
        color: grey;
    }

    .recent a {
        text-decoration: none;
        color: black;
        font-weight: 550;
    }

    .recent a:hover {
        color: orangered;
        font-weight: 550;
    }

    .clouds h3 {
        border-bottom: 1px solid grey;
        padding: 10px;
        font-weight: 550;
        font-size: 20px;

    }

    .clouds a {

        text-decoration: none;
        color: grey;
        background-color: white;
        padding: 10px;
        margin-inline: 5px;
        line-height: 50px;
    }

    .clouds a:hover {
        background-color: orangered;
        color: white;
    }

    .feeds h3 {
        border-bottom: 1px solid grey;
        padding: 10px;
        font-weight: 550;
        font-size: 20px;
    }

    .feeds img {
        margin: 5px;
    }

    .choose h3 {
        border-bottom: 1px solid grey;
        padding: 10px;
        font-weight: 550;
        font-size: 20px;
    }

    .about h1 {
        font-family: "Rubik", sans-serif;
        font-weight: 400;
    }

    .us b {
        color: royalblue;
    }

    .vision h3 {
        font-family: "Rubik", sans-serif;
        font-weight: 400;
        font-size: 22px;
    }

    .power h3 {
        font-family: "Rubik", sans-serif;
        font-weight: 400;
        font-size: 22px;
    }

    .power li {
        line-height: 30px;
    }
</style>
<section>
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
    <div>
        <!--website blog open-->
        <div class="container">
            <div class="row p-3">
                <!-- ------------------------------------------------------------------- -->

                <!-- Category Section (Visible in Mobile Only) -->
                <div class="category bg-light p-4 mt-4 mb-3 d-block d-md-none">
                    <h3>Category</h3>
                    <?php
                    $items = $db->select('ai_blog_categories', ['parent_id' => 0], false)->result();
                    foreach ($items as $item) {
                        $subCats = $db->select('ai_blog_categories', ['parent_id' => $item->id])->result();
                        $total = count($subCats);
                    ?>
                        <li><a href="<?= base_url($userObj->getBlogCategory($item->id)) ?>"><b><?= $item->name; ?> [<?= $total ?>]</b></a><br>
                            <?php foreach ($subCats as $sub) { ?>
                                <a class="ml-1" href="<?= base_url($userObj->getBlogCategory($sub->id)) ?>">- <?= $sub->name; ?></a><br>
                            <?php } ?>
                        </li>
                    <?php
                    } ?>
                </div>

                <!-- ------------------------------------------------------------------- -->

                <div class="col-md-8 p-3">
                    <?php
                    $cat = $_GET['cat'] ?? '';
                    if ($cat) {

                        $items = $db->select('ai_blog_post', ["category" => $cat, 'status' => 1], false, "id DESC")->result();
                    } else {
                        $items = $db->select('ai_blog_post', ['status' => 1], false, "id DESC")->result();
                    }
                    foreach ($items as $item) {
                    ?>
                        <label onclick="window.location.href='<?= $userObj->getBlogUrl($item->id); ?>';" style="cursor: pointer;">
                            <div class="blog mb-3">
                                <div class="shadow p-3 bg-body-tertiary rounded">
                                    <img src="<?= base_url(upload_dir($item->image)) ?>" height="auto" width="100%">
                                    <a class="mt-2 mb-2" href="<?= $userObj->getBlogUrl($item->id) ?>"><?= $item->ptitle; ?></a>
                                    <?= $item->description; ?>
                                </div>
                            </div>
                        </label>
                    <?php } ?>

                </div>


                <!--search open-->
                <div class="col-md-4 ">
                    <!-- <div class="choose bg-light p-3">
                        <input type="text" name="" value="" class="form-control" placeholder="search">
                        <button class="btn btn-danger w-100 p-2">Search</button>
                    </div> -->
                    <!--search close-->


                    <!--website category open-->
                    <!-- <div class="category bg-light p-4 mt-4"> -->
                    <!-- Category Section (Visible in Desktop Only) -->

                    <!-- ------------------------------------------------------------------- -->
                    <div class="category bg-light p-4 mt-4 d-none d-md-block">
                        <!-- ------------------------------------------------------------------- -->
                        <h3>Category</h3>
                        <?php
                        $items = $db->select('ai_blog_categories', ['parent_id' => 0], false)->result();

                        foreach ($items as $item) {
                            $subCats = $db->select('ai_blog_categories', ['parent_id' => $item->id])->result();
                            $totoal = count($subCats);
                        ?>
                            <li><a href="<?= base_url($userObj->getBlogCategory($item->id)) ?>"><b><?= $item->name; ?> [<?= $totoal ?>]</b></a><br>
                                <?php foreach ($subCats as $sub) { ?>
                                    <a class="ml-1" href="<?= base_url($userObj->getBlogCategory($sub->id)) ?>">-<?= $sub->name; ?></a><br>
                                <?php } ?>
                            </li>

                        <?php
                        } ?>
                    </div>
                    <!--website catogary close-->


                    <!--website post open-->
                    <!-- <div class="recent bg-light p-3 mt-4  ">
                        <h3>Recent Post</h3>
                        <div class="row mt-5">
                            <div class="col-3 mt-4">
                                <img src="image/post1.webp" height="70" width="70">
                            </div>
                            <div class="col-9 mt-4">
                                <a href="">From life was you fish...</a>
                                <p>January 12, 2019</p>
                            </div>
                            <div class="col-3 mt-4">
                                <img src="image/post2.webp" height="70" width="70">
                            </div>
                            <div class="col-9 mt-4">
                                <a href="">The Amazing Hubble</a>
                                <p>02 Hours ago</p>
                            </div>
                            <div class="col-3 mt-4">
                                <img src="image/post3.webp" height="70" width="70">
                            </div>
                            <div class="col-9 mt-4">
                                <a href="">Astronomy Or Astrology</a>
                                <p>03 Hours ago</p>
                            </div>
                            <div class="col-3 mt-4">
                                <img src="image/post4.webp" height="70" width="70">
                            </div>
                            <div class="col-9 mt-4">
                                <a href="">Asteroids telescope</a>
                                <p>01 Hours ago</p>
                            </div>
                        </div>
                    </div> -->
                    <!--website post close-->


                    <!--website clouds open-->
                    <!-- <div class="clouds bg-light p-3 mt-4">
                        <h3>Tag Clouds</h3>
                        <a href="">Travels</a>
                        <a href="">Resturent</a>
                        <a href="">Life Style</a>
                        <a href="">New Destination</a>
                        <a href="">Explore</a>
                        <a href="">Adventures</a>
                    </div> -->
                    <!--website clouds close-->


                    <!--website instagram open-->
                    <!-- <div class="feeds bg-light p-2 mt-4">
                        <h3>Instagram Feeds</h3>
                        <div class="insta mt-5"></div>
                        <img src="image/post5.webp">
                        <img src="image/post6.webp">
                        <img src="image/post7.webp">
                        <img src="image/post8.webp">
                        <img src="image/post9.webp">
                        <img src="image/post10.webp">
                    </div> -->
                    <!--website instagram close-->


                    <!--website letter open-->
                    <!-- <div class="choose bg-light p-3 mt-5">
                        <h3>New Letter</h3>
                        <div class="new mt-5"></div>
                        <input type="text" name="" value="" class="form-control" placeholder="Enter email id">
                        <button class="btn btn-danger w-100 p-2">Submit</button>
                    </div> -->
                    <!--website letter close-->
                </div>
            </div>
        </div>

    </div>


    <!-- 
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 250) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
    </script> -->




</section>


<?php include "footer.php";

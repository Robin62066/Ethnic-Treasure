<?php
include_once "config/autoload.php";
$admin = $db->select("ai_admin", ['username' => 'admin'])->row();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if (isset($title)) echo $title; ?></title>
    <meta name="description" content="<?php if (isset($description)) echo $description; ?>" />
    <meta name="keywords" content="<?php if (isset($seoKeyword)) echo $seoKeyword; ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url('style1.css') ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('image/logo.png') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EHB8VCEWFY"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-EHB8VCEWFY');
</script>
<style>
    .social-icons {
        position: fixed;
        left: 12px;

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

<body>
    <header>
        <div class="back bg-light">
            <div class="container">
                <div class="row" align="center">
                    <div class="col-md-4">
                        <div class="head text-white ">
                            <i class="" aria-hidden="true">
                                <span><?= $admin->address; ?></span>
                            </i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="head text-white ">
                            <i class="" aria-hidden="true">
                                <span><?= $admin->phone_no; ?></span>
                            </i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="head text-white ">
                            <i class="" aria-hidden="true">
                                <span><?= $admin->email_id; ?></span>
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="background-color:white;">
            <nav id="navbar_top" class="navbar navbar-expand-lg navbar" style="background-color: white;">
                <div class="container">
                    <a href="<?= base_url() ?>" class="navbar-brand"><img src="<?= base_url('image/logo.png') ?>" height="70" width="100"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end  bg-light" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <a href="<?= base_url() ?>" class="navbar-brand"><img src="image/logo.png" height="70" width="100"></a>
                            <button type="button" class="btn-close bg-info" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="container">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3  ms-auto ">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>about.php">About Us</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>product.php">Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>blog.php">Blogs</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>contact.php">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </nav>
        </div>
        </div>
    </header>
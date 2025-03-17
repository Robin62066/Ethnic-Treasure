<!DOCTYPE html>
<html lang="en">

<head>
    <title>Secure Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css'); ?>" />



    <script type="text/javascript" src="<?= base_url('assets/admin/js/jquery-3.2.1.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0/axios.min.js"></script>
    <script src="<?= base_url('assets/admin/js/vue.js'); ?>"></script>
    <script>
        var ApiUrl = '<?= base_url('api.php') ?>';
        var apiUrl = '<?= base_url('api.php') ?>';
        $(document).ready(function() {
            $('.btn-menu').click(function() {
                $('.sidebar').toggle();
            });
        });
    </script>

    <style>
        .lg {
            display: none;
        }

        .logout {
            position: absolute;
            left: 1000px;
            bottom: 7px;
        }

        .company {
            position: absolute;
            left: 900px;
            bottom: 7px;
        }

        .sidebar {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            overflow-y: auto;
            transition: 0.5s;
            z-index: 999;
        }

        .content {
            margin-left: 250px;

            transition: 0.5s;
        }

        .content.open {
            width: 100%;
            margin-left: 0;
        }

        .dash {
            color: white;
            font-size: 20px;

        }


        @media (min-width: 992px) {
            .sidebar {
                margin-left: 0;
            }

            .sidebar.open {
                margin-left: -250px;
                display: block;
                transition: 0.5s;

            }

            .content {
                width: calc(100% - 250px);
            }

            .content.open {
                width: 100%;
                margin-left: 0;

            }
        }

        @media (max-width: 992px) {
            .sidebar {
                margin-right: -250px;

            }

            .sidebar.open {
                margin-left: 0;
                display: block;
            }

            .content {
                width: 100%;
                margin-left: 0;
            }

            .dash {
                position: absolute;
                left: 320px;
            }

            .logout {
                position: absolute;
                left: 100px;
                bottom: 7px;
            }

            .company {
                position: absolute;
                left: 9px;
                bottom: 7px;
            }

            .lg {
                display: block;
            }
        }
    </style>

</head>
<?php
$adminItems = $db->select('ai_admin', ["username" => "admin"])->row();
$menu = isset($menu) ? $menu : '';
?>

<body>
    <div class="main-outer">
        <div class="sidebar bg-dark">
            <div class="userinfo bg-white">
                <img src="<?= base_url(upload_dir($adminItems->image)) ?>" class="img-fluid circle" />
                <div class="user-details text-dark">
                    Welcome <b>Admin</b> <br />
                    <small><?php echo date("jS M, h:i A"); ?></small><br />
                    <a href="<?= admin_url('index.php') ?>" class="btn btn-light btn-logout">Logout <span
                            class="fa fa-sign-out"></span></a>
                </div>
            </div>
            <ul class="menu">
                <li><a href="<?= admin_url('dashboard.php') ?>"><i class="bi-window-dock"></i> Dashboard </a></li>
                <li class="has-submenu <?= $menu == 'catalog' ? 'active' : null; ?>"><a href="#"><i
                            class="bi bi-list"></i>Catalog<span class="bi-chevron-down"></span></a></a>
                    <ul>
                        <li><a href="<?= admin_url('catalog/categories.php') ?>"><span
                                    class="bi-chevron-right"></span>Categories</a></li>
                        <li><a href="<?= admin_url('catalog/products.php') ?>"><span
                                    class="bi-chevron-right"></span>Products</a></li>
                    </ul>
                </li>
                <li class="has-submenu <?= $menu == 'order' ? 'active' : null; ?>"><a href="#"><i
                            class="bi-cart4"></i>Manage Order<span class="bi-chevron-down"></span></a></a>
                    <ul>
                        <li><a href="<?= admin_url('order/new-order.php') ?>"><span
                                    class="bi-chevron-right"></span>New Order</a></li>
                        <li><a href="<?= admin_url('order/order-history.php') ?>"><span
                                    class="bi-chevron-right"></span>All Orders</a></li>

                    </ul>
                </li>
                <li class="has-submenu <?= $menu == 'notification' ? 'active' : null; ?>"><a href="#"><i
                            class="bi-bell"></i>Notifications<span class="bi-chevron-down"></span></a></a>
                    <ul>
                        <li><a href="<?= admin_url('notification/contact-recived.php') ?>"><span
                                    class="bi-chevron-right"></span>Contact Recived</a></li>
                        <!-- <li><a href="<?= admin_url('order/order-history.php') ?>"><span
                                    class="bi-chevron-right"></span>All Orders</a></li> -->

                    </ul>
                </li>

                <li class="has-submenu <?= $menu == 'gallery' ? 'active' : null; ?>"><a href="#"><i
                            class="bi-card-image"></i> Gallery<span class="bi-chevron-down"></span></a>
                    <ul>
                        <li><a href="<?= admin_url('gallery/bannerImages.php') ?>"><span
                                    class="bi-chevron-right"></span>Banner Images</a></li>
                        <li><a href="<?= admin_url('gallery/galleryImages.php') ?>"><span
                                    class="bi-chevron-right"></span>Gallery Images</a></li>
                        <li><a href="<?= admin_url('gallery/featuredImages.php') ?>"><span
                                    class="bi-chevron-right"></span>Featured Images</a></li>
                    </ul>
                </li>

                <li class="has-submenu <?= $menu == 'blogs' ? 'active' : null; ?>"><a href="#"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
                                <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1z" />
                                <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z" />
                            </svg></i> Blogs and Categories <span class="bi-chevron-down"></span></a>
                    <ul>
                        <li><a href="<?= admin_url('blogs/blogsCategories.php') ?>"><span
                                    class="bi-chevron-right"></span>Blogs categories</a></li>
                        <li><a href="<?= admin_url('blogs/blogs.php') ?>"><span
                                    class="bi-chevron-right"></span>All Blogs Post</a></li>
                    </ul>
                </li>
                <!-- <li><a href="<?= admin_url('contactus/') ?>"><i class="bi-people"></i>Contact Us <span class="bi-chevron-right"></span></a></li> -->
                <li><a href="<?= admin_url('about/') ?>"><i class="bi-people"></i> About Page <span class="bi-chevron-right"></span></a></li>
                <li><a href="<?= admin_url('seoSetting/') ?>"><i class="bi-people"></i>Seo Setting <span class="bi-chevron-right"></span></a></li>
                <li><a href="<?= admin_url('testimonial.php') ?>"><i class="bi-people"></i> Testimonial <span class="bi-chevron-right"></span></a></li>
                <li class="has-submenu <?= $menu == 'settings' ? 'active' : null; ?>"><a href="#"><i
                            class="bi-gear"></i> Settings<span class="bi-chevron-down"></span></a>
                    <ul>

                        <li><a href="<?= admin_url('setting/edit_profile.php') ?>"><span
                                    class="bi-chevron-right"></span> Edit Profile</a></li>
                        <!-- <li><a href="<?= admin_url('setting/general_setting.php') ?>"><span class="bi-chevron-right"></span> General Settings</a></li> -->
                        <li><a href="<?= admin_url('setting/manage_admin.php') ?>"><span
                                    class="bi-chevron-right"></span> Manage Admin</a></li>
                        <li><a href="<?= admin_url('setting/change_password.php') ?>"><span
                                    class="bi-chevron-right"></span> Change Password </a></li>
                    </ul>
                </li>
                <li class="lg">

                    <div class="d-flex justify-content-center">
                        <a class="text-white" href="<?= admin_url('index.php') ?>"><i
                                class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="content-open">
                <div class="topbar bg-primary">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col col-sm-4">
                                <nav class="navbar navbar-expand navbar-dark sticky-top py-0 ">
                                    <a href="#" class="sidebar-toggler rounded-1 dash ">
                                        <i class="bi bi-list"></i>
                                    </a>
                                    <div class="">
                                        <a class="text-white company" target="_blank" href="<?= base_url() ?>"><i
                                                class="fa fa-desktop"></i> Company </a>
                                        <a class="text-white logout" href="<?= admin_url('index.php') ?>"><i
                                                class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content">
                    <script>
                        (function($) {
                            "use strict";


                            // Back to top button



                            // Sidebar Toggler
                            $('.sidebar-toggler').click(function() {
                                $('.sidebar, .content').toggleClass("open");
                                return false;
                            });

                        })(jQuery);
                    </script>


                    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

                    <script src="lib/easing/easing.min.js"></script>


                    <?php include ROOT_PATH . "admin/common/alert.php" ?>
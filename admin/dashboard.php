<?php

include "../config/autoload.php";

if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

include "common/header.php";

$products = $db->select('ai_products')->result();
$categories = $db->select("ai_categories")->result();
$orders = $db->select('ai_order_enquiry')->result();
$sql = "SELECT * FROM ai_order_enquiry WHERE DATE(created) = CURDATE() ORDER BY id DESC";
$items = $db->query($sql)->result();
?>

<div class="page-header">

    <h5>Dashboard</h5>

</div>

<div id="origin" class="dashboard text-white">

    <?php include "common/alert.php"; ?>

    <div class="row g-2">

        <div class="col-sm-3">

            <div class="box bg-primary border-0">

                <div class="p-3 d-flex justify-content-between align-items-center">

                    <div>

                        <h6>Total Coustomers</h6>

                        <h2 class="m-0">---</h2>

                    </div>

                    <div>

                        <i class="bi-person fa-3x"></i>

                    </div>

                </div>

                <div class="box-footer p-2 box-footer-dark">

                    <a href="<?= admin_url('members/all_members.php') ?>" class="btn btn-sm btn-outline-light">View More</a>

                </div>

            </div>

        </div>
        <div class="col-sm-3">

            <div class="box bg-primary border-0">

                <div class="p-3 d-flex justify-content-between align-items-center">

                    <div>

                        <h6>New Order</h6>

                        <h2 class="m-0"><?php
                                        if (count($items) == 0) {
                                            echo "----";
                                        } else {
                                            echo count($items);
                                        } ?></h2>


                    </div>

                    <div>

                        <i class="bi-bag fa-3x"></i>

                    </div>

                </div>

                <div class="box-footer p-2 box-footer-dark">

                    <a href="#" class="btn btn-sm btn-outline-light">View More</a>

                </div>

            </div>

        </div>
        <div class="col-sm-3">

            <div class="box bg-primary border-0">

                <div class="p-3 d-flex justify-content-between align-items-center">

                    <div>

                        <h6>Total Orders</h6>


                        <h2 class="m-0"><?php
                                        if (count($orders) == 0) {
                                            echo "----";
                                        } else {
                                            echo count($orders);
                                        } ?></h2>

                    </div>

                    <div>

                        <i class="bi-people-fill fa-3x"></i>

                    </div>

                </div>

                <div class="box-footer p-2 box-footer-dark">

                    <a href="<?= admin_url('members/today_registration.php') ?>" class="btn btn-sm btn-outline-light">View More</a>

                </div>

            </div>

        </div>
        <div class="col-sm-3">

            <div class="box bg-primary border-0">

                <div class="p-3 d-flex justify-content-between align-items-center">

                    <div>

                        <h6>Total Products</h6>

                        <h2 class="m-0"><?= count($products) ?></h2>

                    </div>

                    <div>

                        <i class="bi-people-fill fa-3x"></i>

                    </div>

                </div>

                <div class="box-footer p-2 box-footer-dark">

                    <a href="<?= admin_url('members/today_registration.php') ?>" class="btn btn-sm btn-outline-light">View More</a>

                </div>

            </div>

        </div>
        <div class="col-sm-3">

            <div class="box bg-primary border-0">

                <div class="p-3 d-flex justify-content-between align-items-center">

                    <div>

                        <h6>Total Categories</h6>

                        <h2 class="m-0"><?= count($categories) ?></h2>

                    </div>

                    <div>

                        <i class="bi-people-fill fa-3x"></i>

                    </div>

                </div>

                <div class="box-footer p-2 box-footer-dark">

                    <a href="<?= admin_url('members/today_registration.php') ?>" class="btn btn-sm btn-outline-light">View More</a>

                </div>

            </div>

        </div>
    </div>




</div>

<?php

include "common/footer.php";

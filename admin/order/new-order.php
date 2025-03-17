<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {

    $db->update('ai_order_enquiry', ['status' => 2], ['id' => $id], 1);
    session()->set_flashdata('danger', 'Order Cancle Successfull');
}
if ($action == 'confirm') {
    $db->update('ai_order_enquiry', ['status' => 1], ['id' => $id], 1);
    session()->set_flashdata('success', 'Order Conformed Successfully');
}
// $items = $db->select("ai_order_enquiry", [], false, "created DESC")->result();
$sql = "SELECT * FROM ai_order_enquiry WHERE DATE(created) = CURDATE() ORDER BY id DESC";
$items = $db->query($sql)->result();
$menu = 'order';
include "../common/header.php";
?>

<div id="origin">
    <div class="page-header">
        <h5>All Orders</h5>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Product Title</th>
                        <th>Product Code</th>
                        <th>Address</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $sl = 1;

                    foreach ($items as $item) {

                    ?>

                        <tr>

                            <td><?= $sl++; ?></td>
                            <td>
                                <a href="#">
                                    <?= $item->name; ?><br>

                                </a>
                            </td>
                            <td><?= $item->email; ?></td>
                            <td><?= $item->mobile_no; ?></td>

                            <td><?= $item->product_title; ?></td>
                            <td><?= $item->product_code; ?></td>
                            <td><?= $item->address; ?></td>
                            <td><?= $item->created; ?></td>
                            <td>
                                <?php if ($item->status == 1) { ?>
                                    <p class="bg-success p-1 text-white">Conformed</p>
                                <?php } else if ($item->status == 0) { ?>
                                    <p class="bg-warning p-1 text-white">Pending</p>
                                <?php } else if ($item->status == 2) { ?>
                                    <p class="bg-danger p-1 text-white">Decline</p>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">

                                    <a href="<?= admin_url('order/new-order.php?action=confirm&id=' . $item->id); ?>" class="btn btn-xs btn-primary btn-confirm" data-msg="Are you sure to Confirm?">Approve</a>



                                    <a href="<?= admin_url('order/new-order.php?action=decline&id=' . $item->id); ?>" class="btn btn-xs btn-danger btn-confirm" data-msg="Are you sure to Delete?">Reject</a>
                                </div>
                            </td>
                        </tr>
                    <?php

                    }

                    ?>

                </tbody>



            </table>
        </div>
    </div>

</div>

<?php

include "../common/footer.php";

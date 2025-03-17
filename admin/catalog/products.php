<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {

    $db->delete('ai_products', ['id' => $id]);
    session()->set_flashdata('success', 'Record Successfully deleted');
}
$menu = "catalog";
include "../common/header.php";

?>
<div id="origin">
    <div class="page-header">
        <h5>All Products</h5>
        <div>
            <a href="<?= admin_url('catalog/addProduct.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Product</a>
        </div>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Product Title</th>
                        <th>Product Code</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Price </th>
                        <!-- <th>Offer Price</th> -->
                        <th>Options </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = $db->select('ai_products', [], false, "created DESC")->result();
                    $sl = 1;
                    foreach ($items as $item) {

                    ?>
                        <tr>
                            <td><?= $sl++; ?></td>
                            <td>
                                <a href="#">
                                    <?= $item->ptitle; ?><br>
                                </a>
                            </td>
                            <td><?= $item->product_code; ?></td>
                            <td>
                                <?php
                                if ($item->status == 1) {
                                ?>

                                    <i class="bg-success p-1 text-light">Active</i>

                                <?php } else {

                                ?>

                                    <i class="bg-danger p-1 text-light">In-Active</i>

                                <?php
                                } ?>

                            </td>
                            <td>
                                <?php
                                $cat = $db->select('ai_categories', ['id' => $item->category], 1)->row();
                                echo $cat->name;
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($item->image != "") { ?>
                                    <img src="<?= base_url(upload_dir($item->image)) ?>" alt="" width="80">
                                <?php } ?>
                            </td>

                            <td> <?= $item->price; ?></td>
                            <!-- <td> <?= $item->offer; ?></td> -->

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('catalog/addProduct.php?id=' . $item->id); ?>" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="<?= admin_url('catalog/products.php?action=decline&id=' . $item->id); ?>" class="btn btn-xs btn-danger btn-confirm" data-msg="Are you sure to Delete?">Delete</a>
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
    <?php
    include "../common/footer.php";
    ?>
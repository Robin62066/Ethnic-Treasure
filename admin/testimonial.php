<?php

include "../config/autoload.php";

if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {
    $db->delete('ai_review', ['id' => $id]);
    session()->set_flashdata('success', 'Record Successfully deleted');
}
include "common/header.php";
?>
<div id="origin">
    <div class="page-header">
        <h5>All Testimonials</h5>
        <div>
            <a href="<?= admin_url('addTestimonial.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Customer Review</a>
        </div>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>sl</th>
                        <th>Coustomer Name</th>
                        <th>Message</th>
                        <th>Options </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = $db->select('ai_review', [], false, "created DESC")->result();
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
                            <td><?= $item->message; ?></td>

                            <!-- <td>
                                <?php
                                if ($item->image != "") { ?>
                                    <img src="<?= base_url(upload_dir($item->image)) ?>" alt="" width="80">
                                <?php } ?>
                            </td> -->



                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('editTestimonial.php?id=' . $item->id); ?>" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="<?= admin_url('testimonial.php?action=decline&id=' . $item->id); ?>" class="btn btn-xs btn-danger btn-confirm" data-msg="Are you sure to Delete?">Delete</a>
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
    include "common/footer.php";
    ?>
<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {

    $db->delete('ai_blog_post', ['id' => $id]);
    session()->set_flashdata('success', 'Record Successfully deleted');
}
include "../common/header.php";

?>
<div id="origin">
    <div class="page-header">
        <h5>All About Details</h5>
        <div>
            <a href="<?= admin_url('about/add.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New about Details</a>
        </div>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>image </th>
                        <th>Our Story </th>
                        <th>why Choose us</th>
                        <th>Status</th>
                        <th>Options </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = $db->select('ai_about', [], false, "sl DESC")->result();

                    foreach ($items as $item) {

                    ?>
                        <tr>
                            <td><?= $item->sl; ?></td>
                            <td>
                                <?php
                                if ($item->image != "") { ?>
                                    <img src="<?= base_url(upload_dir($item->image)) ?>" alt="" width="80">
                                <?php } ?>
                            </td>
                            <td>

                                <?= $item->our_story; ?><br>

                            </td>
                            <td> <?= $item->why_choose; ?></td>
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
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('about/add.php?id=' . $item->sl); ?>" class="btn btn-xs btn-primary">Edit</a>
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
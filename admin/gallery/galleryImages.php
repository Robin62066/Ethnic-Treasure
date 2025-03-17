<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {
    $db->delete('ai_gallery_img', ['id' => $id]);
    session()->set_flashdata('success', 'Record Successfully deleted');
}


$menu = "gallery";
include "../common/header.php";

?>
<div id="origin">
    <div class="page-header">
        <h5>All Gallery Images </h5>
        <div>
            <a href="<?= admin_url('gallery/addGalleryImage.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Image</a>
        </div>
    </div>
    <div class="w-50">
        <marquee behavior="" direction="" class="text-danger">*Only 5 Gallery Images Visible on Home which status is show on home</marquee>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Gallery Image</th>
                        <th>Status</th>
                        <th>Options </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl = 1;
                    $items = $db->select('ai_gallery_img', [], false)->result();

                    foreach ($items as $item) {

                    ?>
                        <tr>
                            <td><?= $sl++; ?></td>

                            <td>
                                <?php
                                if ($item->image != "") { ?>
                                    <img src="<?= base_url(upload_dir($item->image)) ?>" alt="" width="80">
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                if ($item->status == 1) { ?>
                                    <i class="bg-success p-1 text-light">Visible on Home</i>
                                <?php } else { ?>
                                    <i class="bg-danger p-1 text-light">Not Visible On Home</i>
                                <?php
                                } ?>
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('gallery/editGalleryImage.php?id=' . $item->id); ?>" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="<?= admin_url('gallery/galleryImages.php?action=decline&id=' . $item->id); ?>" class="btn btn-xs btn-danger btn-confirm" data-msg="Are you sure to Delete?">Delete</a>
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
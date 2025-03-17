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
            <a href="<?= admin_url('seoSetting/addNewSeo.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New SEO Details</a>
        </div>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>page Name </th>
                        <th>Seo Title </th>
                        <th>Seo Decription</th>
                        <th>Seo KeyWords</th>
                        <th>Options </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = $db->select('ai_seo_details', [], false, "id DESC")->result();
                    $id = 1;
                    foreach ($items as $item) {

                    ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td>
                                <?php
                                if ($item->web_link == 1) {
                                ?>

                                    <i class="p-1 ">index Page</i>

                                <?php } elseif ($item->web_link == 2) {

                                ?>

                                    <i class="p-1">Product Page</i>

                                <?php } elseif ($item->web_link == 3) {

                                ?>

                                    <i class="p-1">Blog Page</i>

                                <?php } elseif ($item->web_link == 4) {

                                ?>

                                    <i class="p-1">Contact us page Page</i>

                                <?php
                                } ?>

                            </td>
                            <td>
                                <?= $item->meta_title; ?><br>
                            </td>
                            <td> <?= $item->meta_description; ?></td>
                            <td> <?= $item->meta_keywords; ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('seoSetting/addNewSeo.php?id=' . $item->id); ?>" class="btn btn-xs btn-primary">Edit</a>
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
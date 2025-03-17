<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {

    $db->delete('ai_blog_categories', ['id' => $id]);
    session()->set_flashdata('success', 'Record Successfully deleted');
}


$menu = 'blogs';
include "../common/header.php";

?>
<div id="origin">
    <div class="page-header">
        <h5>All Categories </h5>
        <div>
            <a href="<?= admin_url('blogs/addBlogCategories.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add Categories</a>
        </div>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>Parent</th>
                        <!-- <th>Sequence</th> -->
                        <!-- <th>Image</th> -->
                        <th>Status</th>
                        <th>Options </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl = 1;
                    $items = $db->select('ai_blog_categories', [], false,"id DESC")->result();

                    foreach ($items as $item) {
                        $parent = $db->select('ai_blog_categories', ["id" => $item->parent_id], 1)->row();
                    ?>
                        <tr>
                            <td><?= $sl++; ?></td>
                            <td>
                                <a href="#">
                                    <?= $item->name; ?><br>
                                </a>
                            </td>
                            <td><?php if (is_object($parent)) echo $parent->name ?></td>


                            <td>
                                <?php
                                if ($item->status == 1) { ?>
                                    <i class="bg-success p-1 text-light">Active</i>
                                <?php } else { ?>
                                    <i class="bg-danger p-1 text-light">In-Active</i>
                                <?php
                                } ?>
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('blogs/addBlogCategories.php?id=' . $item->id); ?>" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="<?= admin_url('blogs/blogsCategories.php?action=decline&id=' . $item->id); ?>" class="btn btn-xs btn-danger btn-confirm" data-msg="Are you sure to Delete?">Delete</a>
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
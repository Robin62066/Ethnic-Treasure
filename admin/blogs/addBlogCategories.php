<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$id = $_GET['id'] ?? "";

$cats = $id ? $db->select('ai_blog_categories', ['id' => $id], 1)->row() : null;

if (isset($_POST['submit'])) {
    $form = $_POST['cat'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $form['image'] = do_upload('image');
    }

    if ($id) {

        $db->update('ai_blog_categories', $form, ['id' => $id]);
        session()->set_flashdata('success', 'Category updated successfully');
        redirect(admin_url("blogs/addBlogCategories.php?id=$id"));
    } else {

        $db->insert('ai_blog_categories', $form);
        session()->set_flashdata('success', 'Category added successfully');
        redirect(admin_url('blogs/addBlogCategories.php'));
    }
}
$menu = 'blogs';
include "../common/header.php";

?>

<div class="page-header">
    <h5>Category Form</h5>
    <div>
        <a href="<?= admin_url('blogs/addBlogCategories.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add Categories</a>
    </div>
</div>
<form enctype="multipart/form-data" action="" method="post">
    <div class="card card-body">
        <div class="form-group row">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" name="cat[name]" value="<?= $cats->name ?? ''; ?>" class="form-control" />
            </div>
            <label class="col-sm-1 control-label">Parent </label>
            <div class="col-sm-4">
                <select class="form-control" name="cat[parent_id]">
                    <option value="0">Select</option>
                    <?php
                    $items = $db->select('ai_blog_categories', [], false)->result();
                    foreach ($items as $item) { ?>
                        <option value="<?= $item->id ?>" <?= isset($cats) && $cats->parent_id == $item->id ? 'selected' : '' ?>>
                            <?= $item->name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <!-- <label class="col-sm-2 control-label">Slug</label>
            <div class="col-sm-4">
                <input type="text" name="cat[slug]" value="" class="form-control" />
            </div> -->
            <!-- <label class="col-sm-2 control-label">Sequence</label>
            <div class="col-sm-2">
                <input type="text" name="cat[sequence]" value="" class="form-control" />
            </div> -->
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-8">
                <textarea name="cat[description]" rows="4" class="form-control"><?= $cats->description ?? ''; ?></textarea>
            </div>
        </div>
        <!-- <div class="form-group row">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <input type="file" name="image" id="">
            </div>
        </div> -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-3">
                <select class="form-control" name="cat[status]">
                    <option value="">Select</option>
                    <option value="1" <?= isset($cats) && $cats->status == 1 ? 'selected' : '' ?>>Yes</option>
                    <option value="0" <?= isset($cats) && $cats->status == 0 ? 'selected' : '' ?>>No</option>
                </select>
            </div>

        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input type="hidden" name="submit" value="Submit">
                <button class="btn btn-primary btn-submit">Save</button>
                <a href="<?= admin_url('blogs/addBlogCategories.php') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
<?php
include "../common/footer.php";
?>
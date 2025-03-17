<?php
include "../../config/autoload.php";
$menu = "catalog";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

if (isset($_POST['submit'])) {
    $form = $_POST['cat'];
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $form['image'] = do_upload('image');
    }

    $db->insert('ai_categories', $form);
    session()->set_flashdata('success', 'Profile details updated');
}

include "../common/header.php";

?>

<div class="page-header">
    <h5>Category Form</h5>
    <div>
        <a href="<?= admin_url('catalog/addCategories.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add Categories</a>
    </div>
</div>
<form enctype="multipart/form-data" action="" method="post">
    <div class="card card-body">
        <div class="form-group row">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" name="cat[name]" value="" class="form-control" />
            </div>
            <label class="col-sm-1 control-label">Parent </label>
            <div class="col-sm-4">
                <select class="form-control" name="cat[parent_id]" id="">
                    <option value="0">select </option>
                    <?php $items = $db->select('ai_categories', [], false)->result();
                    foreach ($items as $item) {
                    ?>
                        <option value="<?= $item->id ?>"><?= $item->name; ?></option>
                    <?php } ?>

                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 control-label">Slug</label>
            <div class="col-sm-4">
                <input type="text" name="cat[slug]" value="" class="form-control" />
            </div>
            <label class="col-sm-2 control-label">Sequence</label>
            <div class="col-sm-2">
                <input type="text" name="cat[sequence]" value="" class="form-control" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-8">
                <textarea name="cat[description]" rows="4" cols="" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <input type="file" name="image" id="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-3">
                <select class="form-control" name="cat[status]" id="">
                    <option value="">select </option>
                    <option value="1">yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <label class="col-sm-2 control-label">Popular Category</label>
            <div class="col-sm-3">
                <label class="checkbox-inline"><input type="checkbox" name="cat[popular_cat]" value="1" /> Yes </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input type="hidden" name="submit" value="Submit">
                <button class="btn btn-primary btn-submit">Save</button>
                <a href="" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
<?php
include "../common/footer.php";
?>
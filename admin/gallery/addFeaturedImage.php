<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$id = $_GET['id'] ?? '';
if (isset($_POST['submit'])) {
    $form = $_POST['form'];
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $form['image'] = do_upload('image');
    }

    $db->insert('ai_media', $form);

    session()->set_flashdata('success', 'banner saved successfully ');
}

$menu = "gallery";
include "../common/header.php";

?>

<div class="page-header">
    <h5>Add New Featured Image</h5>
    <div>
        <a href="<?= admin_url('gallery/addFeaturedImage.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Image</a>
    </div>
</div>
<form enctype="multipart/form-data" action="" method="post">
    <div class="card card-body">
        <div class="form-group row">
            <label class="col-sm-2 control-label">Show On Home</label>
            <div class="col-sm-4">
                <select class="form-control" name="form[status]" id="">
                    <option value="0">select </option>
                    <option value="1">Yes </option>
                    <option value="0">No </option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <input type="file" name="image" id="">
                <p class="text-danger">*Image Size will be 570x285</p>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input type="hidden" name="submit" value="Submit">
                <button class="btn btn-primary btn-submit">Save</button>
                <a href="<?= admin_url('gallery/addFeaturedImage.php') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
<?php
include "../common/footer.php";
?>
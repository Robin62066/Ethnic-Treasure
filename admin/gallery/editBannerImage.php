<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$id = $_GET['id'] ?? '';
if (isset($_POST['submit'])) {
    $form = $_POST['form'];
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $form['image'] = do_upload('image');
    }
    $db->update('ai_images', $form, ['id' => $id], 1);

    session()->set_flashdata('success', 'banner Updated Successfully ');
}
$image = $db->select('ai_images', ['id' => $id], 1)->row();
$menu = "gallery";
include "../common/header.php";

?>

<div class="page-header">
    <h5>Add New Banner Image</h5>
    <div>
        <a href="<?= admin_url('gallery/addBannerImage.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Banner</a>
    </div>
</div>
<form enctype="multipart/form-data" action="" method="post">
    <div class="card card-body">
        <div class="form-group row">
            <label class="col-sm-2 control-label">Show On Home</label>
            <div class="col-sm-4">
                <select class="form-control" name="form[status]" id="">
                    <option value="0">select </option>
                    <option value="1" <?= $image->status == 1 ? 'selected' : ''; ?>>yes</option>
                    <option value="0" <?= $image->status == 0 ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <?php if ($image->image != '') { ?>
                    <img src="<?= base_url(upload_dir($image->image)) ?>" class="img-fluid circle mb-2" />
                <?php } ?>
                <input type="file" name="image" id="">
                <p class="text-danger">*Image Size will be 1602x452</p>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input type="hidden" name="submit" value="Submit">
                <button class="btn btn-primary btn-submit">Save</button>
                <a href="<?= admin_url('gallery/editBannerImage.php?id=') . $id; ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
<?php
include "../common/footer.php";
?>
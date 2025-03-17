<?php

include "../config/autoload.php";

if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$id = $_GET['id'] ?? '';
if (isset($_POST['submit'])) {
    $form = $_POST['form'];
    // if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
    //     $form['image'] = do_upload('image');
    // }

    $db->insert('ai_review', $form);

    session()->set_flashdata('success', 'Record saved successfully ');
}
include "common/header.php";
?>

<div class="page-header">
    <h5>Add New Customer Review</h5>
    <div>
        <a href="<?= admin_url('addTestimonial.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Banner</a>
    </div>
</div>
<form enctype="multipart/form-data" action="" method="post">
    <div class="card card-body">
        <div class="form-group row">
            <label class="col-sm-2 control-label">Customer Name</label>
            <div class="col-sm-4">
                <input type="text" name="form[name]" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Review Message</label>
            <div class="col-sm-8">
                <textarea name="form[message]" class="form-control" id="" rows="6"></textarea>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input type="hidden" name="submit" value="Submit">
                <button class="btn btn-primary btn-submit">Save</button>
                <a href="<?= admin_url('testimonial.php') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
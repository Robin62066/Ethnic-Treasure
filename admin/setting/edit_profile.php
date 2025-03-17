<?php

include "../../config/autoload.php";

if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$menu = 'settings';
if (isset($_POST['submit'])) {

    $form = $_POST['form'];
    if (isset($_FILES['avatar']['name']) && $_FILES['avatar']['name'] != '') {

        $form['image'] = do_upload('avatar');
    }
    if (isset($_FILES['qr_image']['name']) && $_FILES['qr_image']['name'] != '') {

        $form['qr_image'] = do_upload('qr_image');
    }

    $db->update('ai_admin', $form, ["username" => "admin"]);

    session()->set_flashdata('success', 'Profile details updated');
}



$items = $db->select('ai_admin', ["username" => "admin"])->row();

include "../common/header.php";

?>

<div class="main-content">

    <div class="row">

        <div class="col-sm-12">

        </div>

    </div>

    <div class="page-header">

        <h5>Edit Profile</h5>

    </div>

    <div class="px-3">

        <form enctype="multipart/form-data" action="" method="post">

            <div class="row">

                <div class="col-sm-3">

                    <div class="card card-info mb-1 p-3">

                        <?php

                        if ($items->image != '') {

                        ?>

                            <img src="<?= base_url(upload_dir($items->image)) ?>" class="img-fluid circle" />

                        <?php

                        }

                        ?>

                    </div>

                    <div class="d-grid">

                        <input type="file" name="avatar" id="avatar" class="form-control">

                    </div>

                    <div class="mt-4">
                        <label for="name">QR Code</label>
                        <div class="card card-info mb-1 p-3">
                            <?php
                            if ($items->qr_image != '') {
                            ?>
                                <img src="<?= base_url(upload_dir($items->qr_image)) ?>" class="img-fluid circle" />
                            <?php } ?>
                        </div>
                        <div class="d-grid">
                            <input type="file" name="qr_image" id="avatar" class="form-control">
                        </div>
                    </div>

                </div>


                <div class="col-sm-9">

                    <div class="card card-info p-3">

                        <div class="form-group row">

                            <label class="col-sm-3 control-label">Username</label>

                            <div class="col-sm-6">

                                <input type="text" name="admin" value="admin" disabled class="form-control">

                                <input type="hidden" name="username" value="admin" class="form-control">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">

                                <input type="text" name="form[first_name]" value="<?= $items->first_name . " " . $items->last_name ?>" class="form-control">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-sm-3 control-label">Email Id</label>

                            <div class="col-sm-6">

                                <input type="text" name="form[email_id]" value="<?= $items->email_id; ?>" class="form-control">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-sm-3 control-label">Country</label>

                            <div class="col-sm-6">

                                <input type="text" name="form[country]" value="<?= $items->country; ?>" class="form-control">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-sm-3 control-label">Phone Number</label>

                            <div class="col-sm-6">

                                <input type="text" name="form[phone_no]" value="<?= $items->phone_no; ?>" class="form-control">

                            </div>

                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 control-label">Company Address</label>

                            <div class="col-sm-6">
                                <textarea name="form[address]" class="form-control" rows="3"><?= $items->address; ?></textarea>
                            </div>

                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 control-label">QR Code Holder Name</label>

                            <div class="col-sm-6">

                                <input type="text" name="form[Qr_name]" value="<?= $items->Qr_name; ?>" class="form-control">

                            </div>

                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 control-label">UPI ID</label>

                            <div class="col-sm-6">

                                <input type="text" name="form[upi_id]" value="<?= $items->upi_id; ?>" class="form-control">

                            </div>

                        </div>

                        <div class="row">

                            <label class="col-sm-3 control-label"> </label>

                            <div class="col-sm-6">

                                <input type="hidden" name="submit" value="Submit">

                                <button class="btn btn-primary btn-submit">Save</button>

                            </div>

                        </div>

                    </div>

                </div>

        </form>

    </div>

</div>

<?php

include "../common/footer.php";

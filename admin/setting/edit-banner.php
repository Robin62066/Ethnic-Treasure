<?php

include "../../config/autoload.php";

if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$menu = 'settings';
if (isset($_POST['submit'])) {
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

        $form['image'] = do_upload('image');
    }
    if (isset($_FILES['image2']['name']) && $_FILES['image2']['name'] != '') {

        $form['image2'] = do_upload('image2');
    }
    if (isset($_FILES['image3']['name']) && $_FILES['image3']['name'] != '') {

        $form['image3'] = do_upload('image3');
    }
    if (isset($_FILES['image4']['name']) && $_FILES['image4']['name'] != '') {

        $form['image4'] = do_upload('image4');
    }

    $db->update('ai_images', $form, ['id' => 1]);

    session()->set_flashdata('success', 'Profile details updated');
}



$items = $db->select('ai_images', ['id' => 1], false, "id DESc")->row();

include "../common/header.php";

?>

<div class="main-content">

    <div class="row">

        <div class="col-sm-12">

        </div>

    </div>

    <div class="page-header">

        <h5>Edit Banner </h5>

    </div>

    <div class="px-3" style="border: 2px solid gray;">
        <div class="p-3">
            <h4>Edit Banner Images</h4>
            <form enctype="multipart/form-data" action="" method="post">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card card-info mb-1 p-3">
                            <?php if ($items->image != '') { ?>
                                <img src="<?= base_url(upload_dir($items->image)) ?>" class="img-fluid circle" />
                            <?php } ?>
                        </div>
                        <div class="d-grid">
                            <input type="file" name="image" id="avatar" class="form-control">
                            <p class="text-danger">*Image Size Must be 1602x452</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-info mb-1 p-3">
                            <?php if ($items->image2 != '') { ?>
                                <img src="<?= base_url(upload_dir($items->image2)) ?>" class="img-fluid circle" />
                            <?php } ?>
                        </div>
                        <div class="d-grid">
                            <input type="file" name="image2" id="avatar" class="form-control">
                            <p class="text-danger">*Image Size Must be 1602x452</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-info mb-1 p-3">
                            <?php if ($items->image3 != '') { ?>
                                <img src="<?= base_url(upload_dir($items->image3)) ?>" class="img-fluid circle" />
                            <?php } ?>
                        </div>
                        <div class="d-grid">
                            <input type="file" name="image3" id="avatar" class="form-control">
                            <p class="text-danger">*Image Size Must be 1602x452</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-info mb-1 p-3">
                            <?php if ($items->image4 != '') { ?>
                                <img src="<?= base_url(upload_dir($items->image4)) ?>" class="img-fluid circle" />
                            <?php } ?>
                        </div>
                        <div class="d-grid">
                            <input type="file" name="image4" id="avatar" class="form-control">
                            <p class="text-danger">*Image Size Must be 1602x452</p>
                        </div>
                    </div>

                    <div class="row">


                        <div class="mt-3">

                            <input type="hidden" name="submit" value="Submit">
                            <button class="btn btn-primary btn-lg btn-submit">Save</button>

                        </div>

                    </div>
                </div>



            </form>

        </div>

    </div>

</div>

<?php

include "../common/footer.php";

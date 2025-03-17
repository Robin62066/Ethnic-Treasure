<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$id = $_GET['id'] ?? "";

$seo = $id ? $db->select('ai_seo_details', ['id' => $id], 1)->row() : null;

if (isset($_POST['submit'])) {
    $form = $_POST['frm'];

    // if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
    //     $form['image'] = do_upload('image');
    // }

    if ($id) {

        $db->update('ai_seo_details', $form, ['id' => $id]);
        session()->set_flashdata('success', 'About secction  successfully updated');
        redirect(admin_url("seoSetting/addNewSeo.php?id=$id"));
    } else {
        $db->insert('ai_seo_details', $form);
        session()->set_flashdata('success', 'Details successfully added ');
        redirect(admin_url('seoSetting/index.php'));
    }
}
include "../common/header.php";
?>
<style>
    body {
        background-color: #f8f9fa;
    }

    .my-container {
        margin-top: 10px;
        padding: 18px;
    }

    .card {
        margin-right: 150px;
    }
</style>

<div class="my-container">
    <h2 class="mb-4">SEO Setting</h2>
    <!-- <div class="quick-links mb-3">
        <button class="btn btn-primary">Global Settings</button>
        <button class="btn btn-primary">Display Setting</button>
        <button class="btn btn-primary">SEO Settings</button>
    </div> -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="url" class="form-label">Page Name</label>
                    <div class="">
                        <select class="form-control" name="frm[web_link]" id="" required>
                            <option value="">select </option>
                            <option value="1" <?= isset($seo) && $seo->web_link == 1 ? 'selected' : '' ?>>index page</option>
                            <option value="2" <?= isset($seo) && $seo->web_link == 2 ? 'selected' : '' ?>>Product Page</option>
                            <option value="3" <?= isset($seo) && $seo->web_link == 3 ? 'selected' : '' ?>>Blog Page</option>
                            <option value="4" <?= isset($seo) && $seo->web_link == 4 ? 'selected' : '' ?>>Contact us page Page</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="seoTitle" class="form-label">SEO Title</label>
                    <input type="text" class="form-control" name="frm[meta_title]" value="<?= $seo->meta_title ?? ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="frm[meta_description]" rows="3" required><?= $seo->meta_description ?? ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="keywords" class="form-label">Keywords</label>
                    <textarea class="form-control" name="frm[meta_keywords]" rows="2" required><?= $seo->meta_keywords ?? ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label class="">&nbsp;</label>
                    <div class="">
                        <input type="hidden" name="submit" value="Submit">
                        <button class="btn btn-primary btn-submit">Save</button>
                        <a href="<?= admin_url('seoSetting/addNewSeo.php') ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include "../common/footer.php";
?>
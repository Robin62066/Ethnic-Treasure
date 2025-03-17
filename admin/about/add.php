<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$id = $_GET['id'] ?? "";

$about = $id ? $db->select('ai_about', ['sl' => $id], 1)->row() : null;

if (isset($_POST['submit'])) {
    $form = $_POST['frm'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $form['image'] = do_upload('image');
    }

    if ($id) {

        $db->update('ai_about', $form, ['sl' => $id]);
        session()->set_flashdata('success', 'About secction  successfully updated');
        redirect(admin_url("about/index.php?id=$id"));
    } else {
        $db->insert('ai_about', $form);
        session()->set_flashdata('success', 'Details successfully added ');
        redirect(admin_url('about/index.php'));
    }
}
include "../common/header.php";
?>
<!-- basic editor link -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<style>
    .card {
        margin-top: -14px;
        margin-right: 60px;
    }
</style>
<div class="container">
    <h2 class="mb-4">About Page</h2>
    <div class="card">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <h4 class="mb-3">SEO Details</h4>
                <div class="mb-3 row">
                    <div class="col-sm-6">
                        <label for="seoTitle" class="form-label">SEO Title</label>
                        <input type="text" class="form-control" name="frm[meta_title]" value="<?= $about->meta_title ?? ''; ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Status</label>
                        <div class="">
                            <select class="form-control" name="frm[status]" id="" required>
                                <option value="">select </option>
                                <option value="1" <?= isset($about) && $about->status == 1 ? 'selected' : '' ?>>Yes</option>
                                <option value="0" <?= isset($about) && $about->status == 0 ? 'selected' : '' ?>>No</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <label for="meta_description" class="form-label">SEO Description</label>
                    <textarea class="form-control" name="frm[meta_description]" rows="3"><?= $about->meta_description ?? ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="keywords" class="form-label">SEO Keywords</label>
                    <textarea class="form-control" name="frm[meta_keywords]" rows="2"><?= $about->meta_keywords ?? ''; ?></textarea>
                </div>

                <h4 class="mb-3">About Page Details</h4>
                <div class="mb-3 col-sm-6">
                    <label for="image" class="form-label">About Section Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <?php
                    if (!empty($about->image)) { ?>
                        <img src="<?= base_url(upload_dir($about->image)) ?>" alt="" width="80">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="our_story" class="form-label">Our Story</label>
                    <textarea class="form-control" name="frm[our_story]" rows="3"><?= $about->our_story ?? ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="seoDescription" class="form-label">Why Chosee Us</label>
                    <div class="" rows=" 3">
                        <!-- Quill Editor -->
                        <div id="editor-2" style="height: 150px;"></div>
                        <!-- Hidden Input Field to Store Quill Data -->
                        <input type="hidden" name="frm[why_choose]" id="editorContent-2">

                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">All Basic Details</label>
                    <div class="" rows=" 3">
                        <!-- Quill Editor -->
                        <div id="editor-1" style="height: 150px;"></div>
                        <!-- Hidden Input Field to Store Quill Data -->
                        <input type="hidden" name="frm[all_details]" id="editorContent-1">

                    </div>
                    <div class="form-group">
                        <label class="">&nbsp;</label>
                        <div class="">
                            <input type="hidden" name="submit" value="Submit">
                            <button class="btn btn-primary btn-submit">Save</button>
                            <a href="<?= admin_url('catalog/addProduct.php') ?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        CKEDITOR.replace('.ckeditor');
    </script>

    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        // Initialize first Quill editor for "all_details"
        const quill1 = new Quill('#editor-1', {
            theme: 'snow'
        });

        // Initialize second Quill editor for "why_choose"
        const quill2 = new Quill('#editor-2', {
            theme: 'snow'
        });

        // Set initial content for "all_details"
        <?php if (!empty($about->all_details)) { ?>
            quill1.root.innerHTML = `<?= addslashes($about->all_details) ?>`;
        <?php } ?>

        // Set initial content for "why_choose"
        <?php if (!empty($about->why_choose)) { ?>
            quill2.root.innerHTML = `<?= addslashes($about->why_choose) ?>`;
        <?php } ?>

        // Update hidden input fields before form submission
        document.querySelector("form").addEventListener("submit", function() {
            document.getElementById("editorContent-1").value = quill1.root.innerHTML;
            document.getElementById("editorContent-2").value = quill2.root.innerHTML;
        });
    </script>

    <?php
    include "../common/footer.php";
    ?>
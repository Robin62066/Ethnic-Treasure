<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$id = $_GET['id'] ?? "";

$posts = $id ? $db->select('ai_blog_post', ['id' => $id], 1)->row() : null;
if (isset($_POST['submit'])) {
    $form = $_POST['frm'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $form['image'] = do_upload('image');
    }

    if ($id) {

        $db->update('ai_blog_post', $form, ['id' => $id]);
        session()->set_flashdata('success', 'Category updated successfully');
        redirect(admin_url("blogs/addBlog.php?id=$id"));
    } else {

        $db->insert('ai_blog_post', $form);
        session()->set_flashdata('success', 'Category added successfully');
        redirect(admin_url('blogs/addBlog.php'));
    }
}

$menu = "blogs";
include "../common/header.php";

?>
<!-- basic editor link -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<style>
    #cust1 {
        display: none;
    }
</style>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="h5">Blog Form </h4>
    <div>
        <a href="<?= admin_url('blogs/addBlog.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Blog</a>
    </div>
</div>
<hr>


<div class="row">
    <div class="col-sm-9">
        <div class="box box-p">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Product Title</label>
                    <div class="col-sm-10"><input type="text" name="frm[ptitle]" value="<?= $posts->ptitle ?? ''; ?>" class="form-control " required />
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Samll Description</label>
                    <div class="col-sm-10">
                        <textarea name="frm[small_desc]" rows="3" id="" class="form-control"><?= $posts->small_desc ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Description</label>
                    <div class="col-sm-10">
                        <!-- Quill Editor -->
                        <div id="editor" style="height: 150px;"></div>
                        <!-- Hidden Input Field to Store Quill Data -->
                        <input type="hidden" name="frm[description]" id="editorContent">

                    </div>
                </div>

                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Category</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="frm[category]" id="">
                            <option value="">select </option>
                            <?php $items = $db->select('ai_blog_categories', [], false)->result();
                            foreach ($items as $item) {
                            ?>
                                <option value="<?= $item->id; ?>" <?= isset($posts) && $posts->category == $item->id ? 'selected' : '' ?>><?= $item->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label class="col-sm-3 text-center">Status</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="frm[status]" id="" required>
                            <option value="">select </option>
                            <option value="1" <?= isset($posts) && $posts->status == 1 ? 'selected' : '' ?>>Yes</option>
                            <option value="0" <?= isset($posts) && $posts->status == 0 ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                </div>

                <div class=" form-group row mt-2">
                    <label class="col-sm-2 ">Post Image</label>
                    <div class="col-sm-3">
                        <input type="file" name="image" id="file_name">
                        <?php if (!empty($posts->image)) { ?>

                            <img src="<?= base_url(upload_dir($posts->image)) ?>" alt="Post Image" width="100px" height="150px">
                        <?php } ?>
                    </div>


                </div>

                <div class="form-group row">
                    <label class="col-sm-2 text-center">&nbsp;</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="submit" value="Submit">
                        <button class="btn btn-primary btn-submit">Save</button>
                        <a href="<?= admin_url('catalog/addProduct.php') ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('.ckeditor');
</script>
<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    // Initialize Quill editor
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Set initial content only if there is a valid description
    <?php if (!empty($posts->description)) { ?>
        quill.root.innerHTML = `<?= addslashes($posts->description) ?>`;
    <?php } ?>

    // Update hidden input field before form submission
    document.querySelector("form").addEventListener("submit", function() {
        document.getElementById("editorContent").value = quill.root.innerHTML;
    });
</script>
<?php
include "../common/footer.php";
?>
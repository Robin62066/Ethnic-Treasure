<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$id = $_GET['id'] ?? "";
$posts = $id ? $db->select('ai_products', ['id' => $id], 1)->row() : null;
if (isset($_POST['submit'])) {
    $form = $_POST['frm'];

    if (isset($_FILES['cover_image']['name']) && $_FILES['cover_image']['name'] != '') {
        $form['image'] = do_upload('cover_image');
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

    $userOb = new User();
    $data = $userOb->url_title($form['ptitle']);

    function  getRandomProductCode()
    {
        $db = db_connect();
        $id = rand(100000, 999999);
        $chk = $db->select('ai_users', ['id' => $id], 1)->row();
        if (!is_object($chk)) {
            return $id;
        } else {
            return getRandomProductCode();
        }
    }
    $form['slug'] = $data;
    if ($id) {
        $db->update('ai_products', $form, ['id' => $id], 1);
        session()->set_flashdata('success', 'Product details updated');
        redirect(admin_url("catalog/addProduct.php?id=$id"));
    } else {
        $form['product_code'] = "ETH" . getRandomProductCode();
        $form['created'] = date('Y-m-d H:i:s');
        $db->insert('ai_products', $form);
        session()->set_flashdata('success', 'Product Add Successfull !!');
    }
}

$menu = "catalog";
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
    <h4 class="h5">Product Form </h4>
    <a href="<?= admin_url('catalog/addProduct.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Add New Product</a>
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
                    <label class="col-sm-2 text-center">Description</label>
                    <div class="col-sm-10">
                        <!-- Quill Editor -->
                        <div id="editor" style="height: 150px;"></div>
                        <!-- Hidden Input Field to Store Quill Data -->
                        <input type="hidden" name="frm[description]" id="editorContent">
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">SEO Title</label>
                    <div class="col-sm-10"><input type="text" name="frm[meta_title]" value="<?= $posts->meta_title ?? ''; ?>" class="form-control " required />
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center"> SEO Description</label>
                    <div class="col-sm-10">
                        <textarea name="frm[meta_description]" class="form-control" rows="3"><?= $posts->meta_description ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center"> SEO Keywords</label>
                    <div class="col-sm-10">
                        <textarea name="frm[meta_keywords]" id="" rows="3" class="form-control"><?= $posts->meta_keywords ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Category</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="frm[category]" id="">
                            <option value="">select </option>
                            <?php $items = $db->select('ai_categories', [], false)->result();
                            foreach ($items as $item) {
                            ?>
                                <option value="<?= $item->id; ?>" <?= $posts->category ? 'selected' : "" ?>><?= $item->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label class="col-sm-3 text-center">Price</label>
                    <div class="col-sm-3">
                        <input type="text" name="frm[price]" value="<?= $posts->price ?? ''; ?>" class="form-control " placeholder="peice" />
                    </div>
                </div>

                <div class=" form-group row mt-2">
                    <label class="col-sm-2 ">Front Image</label>
                    <div class="col-sm-3">
                        <input type="file" name="cover_image" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if (!empty($posts->image)) { ?>
                            <img src="<?= base_url(upload_dir($posts->image)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                    <label class="col-sm-3 text-center">Image-2 </label>
                    <div class="col-sm-3">
                        <input type="file" name="image2" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if (!empty($posts->image2)) { ?>
                            <img src="<?= base_url(upload_dir($posts->image2)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                </div>
                <div class=" form-group row mt-2">
                    <label class="col-sm-2 text-center">Image-3</label>
                    <div class="col-sm-3">
                        <input type="file" name="image3" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if (!empty($posts->image3)) { ?>
                            <img src="<?= base_url(upload_dir($posts->image3)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                    <label class="col-sm-3 text-center">Image-4</label>
                    <div class="col-sm-3">
                        <input type="file" name="image4" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if (!empty($posts->image4)) { ?>
                            <img src="<?= base_url(upload_dir($posts->image4)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                </div>
                <div class=" form-group row mt-2">
                    <label class="col-sm-2 text-center">Product Color</label>
                    <div class="col-sm-3">
                        <input type="text" name="frm[pcolor]" value="<?= $posts->pcolor ?? ''; ?>" id="" class="form-control ">
                    </div>
                    <label class="col-sm-3 text-center">Status</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="frm[status]" id="" required>
                            <option value="">select </option>
                            <option value="1" <?= $posts->status == 1 ? 'selected' : ''; ?>>yes</option>
                            <option value="0" <?= $posts->status == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
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
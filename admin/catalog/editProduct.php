<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$id = $_GET['id'] ?? "";
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
    $db->update('ai_products', $form, ['id' => $id], 1);
    session()->set_flashdata('success', 'Product details updated');
}
$item = $db->select('ai_products', ["id" => $id], 1)->row();

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
                    <div class="col-sm-10"><input type="text" name="frm[ptitle]" value="<?= $item->ptitle; ?>" class="form-control " />
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <div class="form-group row mt-2">
                        <label class="col-sm-2 text-center">Description</label>
                        <div class="col-sm-10">
                            <!-- Quill Editor -->
                            <div id="editor" style="height: 150px;"><?= $item->description; ?></div>
                            <!-- Hidden Input Field to Store Quill Data -->
                            <input type="hidden" name="frm[description]" id="editorContent">
                        </div>
                    </div>

                </div>
                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Category</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="frm[category]" id="">
                            <option value="">select </option>
                            <?php $items = $db->select('ai_categories', [], false)->result();
                            foreach ($items as $it) {
                            ?>
                                <option value="<?= $it->id; ?>" <?= $item->category ? 'selected' : "" ?>><?= $it->name; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <label class="col-sm-3 text-center">Size</label>
                    <div class="col-sm-3">
                        <input type="text" name="frm[sizes]" value="<?= $item->sizes; ?>" class="form-control " />
                    </div>
                </div>
                <!-- <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Price</label>
                    <div class="col-sm-3">
                        <input type="number" name="frm[price]" value="<?= $item->price; ?>" class="form-control " />
                    </div>
                    <label class="col-sm-3 text-center">Offer Price</label>
                    <div class="col-sm-3">
                        <input type="number" name="frm[offer]" value="<?= $item->offer; ?>" class="form-control " />
                    </div>
                </div> -->
                <div class=" form-group row mt-2">
                    <label class="col-sm-2 ">Front Image</label>
                    <div class="col-sm-3">
                        <input type="file" name="cover_image" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if ($item->image != "") { ?>
                            <img src="<?= base_url(upload_dir($item->image)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                    <label class="col-sm-3 text-center">Image-2 </label>
                    <div class="col-sm-3">
                        <input type="file" name="image2" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if ($item->image2 != "") { ?>
                            <img src="<?= base_url(upload_dir($item->image2)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                </div>
                <div class=" form-group row mt-2">
                    <label class="col-sm-2 text-center">Image-3</label>
                    <div class="col-sm-3">
                        <input type="file" name="image3" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if ($item->image3 != "") { ?>
                            <img src="<?= base_url(upload_dir($item->image3)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                    <label class="col-sm-3 text-center">Image4 </label>
                    <div class="col-sm-3">
                        <input type="file" name="image4" id="file_name">
                        <p class="text-danger">*image size must be 500x700</p>
                        <?php
                        if ($item->image4 != "") { ?>
                            <img src="<?= base_url(upload_dir($item->image4)) ?>" alt="" width="80">
                        <?php } ?>
                    </div>
                </div>
                <div class=" form-group row mt-2">
                    <label class="col-sm-2 text-center">Product Color</label>
                    <div class="col-sm-3">
                        <input type="text" name="frm[pcolor]" value="<?= $item->pcolor ?>" class="form-control ">
                    </div>
                </div>


                <div class="form-group row mt-2">
                    <label class="col-sm-2 text-center">Status</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="frm[status]" id="">
                            <option value="<?= $item->ptitle; ?>">select </option>
                            <option value="1" <?= $item->status == 1 ? 'selected' : ''; ?>>yes</option>
                            <option value="0" <?= $item->status == 0 ? 'selected' : ''; ?>>No</option>
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

    // Set initial content from PHP variable
    quill.root.innerHTML = `<?= addslashes($item->description); ?>`;

    // Update hidden input field before form submission
    document.querySelector("form").addEventListener("submit", function() {
        document.getElementById("editorContent").value = quill.root.innerHTML;
    });
</script>
<?php
include "../common/footer.php";
?>
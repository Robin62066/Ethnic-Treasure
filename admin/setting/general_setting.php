<?php

include "../../config/autoload.php";

if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$menu = 'settings';

if (isset($_GET['act']) && $_GET['act'] == 'del') {

    $id = $_GET['id'];

    $db->delete('ai_products', ['id' => $id]);

    set_flashdata("success", "Product is deleted");

}

$items = $db->select('ai_products', [], false, "id DESC")->result();

include "../common/header.php";



?>

<div class="main-content">

    <div class="row">

        <div class="col-sm-12">

        </div>

    </div>

    <div class="box p-3 shadow-sm">

        <div class="page-header">

            <h5>Global Settings</h5>

        </div>

        <form enctype="multipart/form-data" action="https://admin.inspirelife.in/settings" method="post">

            <div class="box-p">

                <div class="form-group row">

                    <label class="col-sm-2 control-label">Dashboard Logo</label>

                    <div class="col-sm-8">

                        <input type="text" name="logo" value="https://admin.inspirelife.in/ai-content/uploads/1732596816_72fdbc997160e62c8714.jpg" class="form-control input-sm" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-sm-2 control-label">Dashboard Message </label>

                    <div class="col-sm-8">

                        <textarea cols="20" class="form-control" rows="5" name="message">this message will be visible on home page in scrolling text</textarea>

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-sm-2 control-label">PDF Download</label>

                    <div class="col-sm-8">

                        <input type="text" name="pdf_link" value="" placeholder="PDF Plan link" class="form-control input-sm" />

                    </div>

                </div>



                <fieldset>

                    <legend>Zoom Meeting Details</legend>

                    <hr>

                    <div class="form-group row">

                        <label class="col-sm-2 control-label">Zoom Meeting Link </label>

                        <div class="col-sm-3">

                            <input type="text" name="zoom_link" value="https://arnavsoftech.com/zoom/link" placeholder="Zoom Meeting Link" class="form-control input-sm" />

                        </div>

                        <label class="col-sm-2 control-label">Zoom Meeting Info </label>

                        <div class="col-sm-3">



                            <input type="text" name="zoom_info" value="Next Meeting: 26 Nov 2024, 8:00 PM" placeholder="Zoom Meeting Info" class="form-control input-sm" />

                        </div>

                    </div>

                </fieldset>



                <div class="form-group row">

                    <label class="col-sm-2">&nbsp;</label>

                    <div class="col-sm-5">

                        <button type="submit" name="submit" value="Save Settings" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>

                        <a href="https://admin.inspirelife.in/settings/restore" class="btn btn-secondary reset"><i class="fa fa-close"></i> Restore Default</a>

                    </div>

                </div>

            </div>

            <input type="hidden" name="fields" value="logo,message,pdf_link,zoom_link,zoom_info" />

        </form>

    </div>



</div>





<?php

include "../common/footer.php";


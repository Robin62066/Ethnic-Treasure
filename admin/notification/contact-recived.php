<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');
$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
if ($action == 'decline') {

    $db->delete('ai_enquiry', ['sl' => $id]);
    session()->set_flashdata('success', 'Record Successfully deleted');
}
$items = $db->select("ai_enquiry", [], false, "sl DESC")->result();
$menu = 'notification';
include "../common/header.php";
?>

<div id="origin">
    <div class="page-header">
        <h5>All Notifications</h5>
    </div>
    <div class="bg-white p-3">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>

                        <th>Sl</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>
                    <?php
                    $sl = 1;
                    foreach ($items as $item) {

                    ?>

                        <tr>

                            <td><?= $sl++; ?></td>
                            <td>
                                <a href="#">
                                    <?= $item->name; ?><br>
                                </a>
                            </td>
                            <td><?= $item->mobile_no; ?></td>
                            <td><?= $item->email; ?></td>

                            <td><?= $item->message; ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= admin_url('notification/contact-recived.php?action=decline&id=' . $item->sl); ?>" class="btn btn-xs btn-danger btn-confirm" data-msg="Are you sure to Delete?">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php

                    }

                    ?>

                </tbody>



            </table>
        </div>
    </div>

</div>

<?php

include "../common/footer.php";

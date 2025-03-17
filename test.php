<?php
include_once "config/autoload.php";
include_once "common/User.php";
$api = new RestApi();
$db = db_connect();

$userOb = new User();

$sql = "SELECT * FROM ai_topup_history ORDER BY id ASC";
$list = $db->query($sql)->result();
// print_r($list);
foreach ($list as $sl =>  $item) {
    if ($sl <= 11) continue;
    $userOb->add2UniversalPool($item->user_id);
}











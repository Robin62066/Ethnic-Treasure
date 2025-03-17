<?php
include "../../config/autoload.php";
if (!is_admin_login()) redirect(admin_url('index.php'), 'You must login to continue');

$id     = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if ($action && $id) {
    $item = $db->select("ai_fund_request", ['id' => $id], 1)->row();
    if (is_object($item) && $item->status == 2) {
        if ($action == 'confirm') {
            $sb = [];
            $sb['status'] = 1;
            $db->update('ai_fund_request', $sb, ['id' => $id], 1);
            $user = $db->select('ai_users', ['id' => $item->user_id], 1)->row();
            if ($user->ac_status == 0 && $user->pv == 2) {
                $ab = [];
                $ab['ac_status'] = 1;
                $ab['pv'] = 0;
                $ab['is_upgraded'] = $item->level;
                $ab['ac_active_date'] = date("Y-m-d H:i:s");
                $db->update('ai_users', $ab, ['id' => $item->user_id]);

                //Data inserted in topup-history
                $userOb = new User();
                $userOb->chkInTopupTable($user->id, $item->level, $user->sponsor_id);
                session()->set_flashdata('success', 'Fund Request approved successfully');
            } else if ($user->ac_status == 0 && $user->pv == 0) {
                $ab = [];
                $ab['pv'] = 2;
                $db->update('ai_users', $ab, ['id' => $item->user_id]);
            } else if ($user->ac_status == 1 && $user->pv == 0) {
                $ab = [];
                $ab['pv'] = 0;
                $ab['is_upgraded'] = $item->level;
                $db->update('ai_users', $ab, ['id' => $item->user_id]);

                //Data inserted in topup-history
                $userOb = new User();
                $userOb->chkInTopupTable($user->id, $item->level, $user->sponsor_id);
                session()->set_flashdata('success', 'Fund Request approved successfully');
            }
        }
    } else {
        session()->set_flashdata('error', 'Request already processed');
    }
}
redirect(admin_url('fundmanagement/diposit_history.php'));

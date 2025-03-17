<?php

use LDAP\Result;

include_once "config/autoload.php";

$api = new RestApi();
$db = db_connect();

$m = isset($_GET['action']) ? $_GET['action'] : '';
$data = json_decode(file_get_contents("php://input"), true);
if ($data == null) $data = [];

$userOb = new User();
// switch ($m) {
//     case 'payment-history':
//         if ($api->checkINPUT(['user_id', 'type'], $data)) {
//             $user_id = $data['user_id'];
//             $type = $data['type'];
//             if($type == 'universal') $type = INCOME_AUTOPOOL;
//             $items = $db->select('ai_transaction', ['user_id' => $user_id, 'notes' => $type], false, 'id DESC')->result();
//             $api->setOK('Success');
//             $api->setData($items);
//         }
//         break;
//     case 'login':
//         if ($api->checkINPUT(['username', 'password'], $data)) {
//             $username = $data['username'];
//             $passwd = $data['password'];
//             $item = $userOb->login($username, $passwd);
//             if (is_object($item)) {
//                 $api->setOK('Login successful');
//                 $api->setData($item);
//             } else {
//                 $api->setError("Invalid userid and password");
//             }
//         }
//         break;
//     case 'signup':
//         if ($api->checkINPUT(['sponsor', 'passwd', 'first_name', 'last_name', 'mobile', 'email_id', "position"], $data)) {
//             //print_r($data);
//             $sponsor = $data['sponsor'];
//             $first_name = trim($data['first_name']);
//             $last_name = trim($data['last_name']);
//             $mobile = trim($data['mobile']);
//             $password = trim($data['passwd']);
//             $email_id = trim($data['email_id']);
//             $position = trim($data['position']);
//             $api = $userOb->createSignup($sponsor, $first_name, $last_name, $email_id, $mobile, $position, $password);
//         }
//         break;
//     case 'forgot':
//         if ($api->checkINPUT(['email_id'], $data)) {
//             $email_id = $data['email_id'];
//             $item = $userOb->forgotPassword($email_id);
//             if ($item) {
//                 $api->setOK('Password sent to your email');
//             } else {
//                 $api->setError("Invalid email");
//             }
//         }
//         break;
//     case 'dashboard':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];

//             $userinfo = $userOb->getUserinfo($user_id);
//             if ($userinfo == null) {
//                 $api->setError("Invalid userid");
//                 break;
//             }

//             $mainBal = $userOb->getMainBalance($user_id);
//             $fundBal = $userOb->getFundBalance($user_id);

//             $sql = "SELECT COUNT(*) AS total FROM ai_users WHERE sponsor_id = '$user_id'";
//             $direct = (int)$db->query($sql)->row()->total;
//             $sql = "SELECT COUNT(*) AS total FROM ai_users WHERE sponsor_id = '$user_id' AND ac_status = 1";
//             $directActive = (int)$db->query($sql)->row()->total;

//             $ids = $userOb->getDownloadLineIds($user_id);
//             $sql1 = "SELECT SUM(amount) AS total FROM ai_withdraw WHERE status IN (0, 1) AND user_id = '$user_id'";
//             $widTotal = (int)$db->query($sql1)->row()->total;

//             $sql2 = "SELECT SUM(amount) AS total FROM ai_transaction WHERE cr_dr = 'cr' AND user_id = '$user_id'";
//             $totalEarning = (int)$db->query($sql2)->row()->total;

//             $matchIncome = $userOb->getIncomeByType($user_id, INCOME_MATCHING);
//             $levelIncome = $userOb->getIncomeByType($user_id, INCOME_LEVEL);
//             $roiIncome = $userOb->getIncomeByType($user_id, INCOME_ROI);
//             $incomeAutopool = $userOb->getIncomeByType($user_id, INCOME_AUTOPOOL);

//             $items = [];
//             $items[] = ['label' => 'Boosting', 'value' => 'Not-Purchase'];
//             $items[] = ['label' => 'Direct Team', 'value' => $directActive . '/' . $direct];
//             $items[] = ['label' => 'Total Team', 'value' => count($ids)];
//             $items[] = ['label' => 'Universal Autopool Income', 'value' => 'Rs ' . $incomeAutopool];
//             $items[] = ['label' => 'Matching Income', 'value' => 'Rs ' . $matchIncome];
//             $items[] = ['label' => 'Level Income', 'value' => 'Rs ' . $levelIncome];
//             $items[] = ['label' => 'ROI Income', 'value' => 'Rs ' . $roiIncome];
//             $items[] = ['label' => 'Main Wallet', 'value' => 'Rs ' . $mainBal];
//             $items[] = ['label' => 'Fund Wallet', 'value' => 'Rs ' . $fundBal];
//             $items[] = ['label' => 'Total Earning', 'value' => $totalEarning];
//             $items[] = ['label' => 'Total Withdrawal', 'value' => $widTotal];
//             $items[] = ['label' => 'Recharge Fund', 'value' => '-'];

//             $userinfo->sponsor = $userinfo->sponsor_id;
//             $userinfo->rank_level = "Member";

//             $tmp = [];
//             $tmp['basicinfo'] = $userinfo;
//             $tmp['tiles'] = $items;
//             $tmp['members'] = $db->select('ai_users', ['sponsor_id' => $user_id, 'ac_status' => 0], 10, false, "AND", "id, username, first_name, last_name, created, mobile, ac_status")->result();

//             $api->setData($tmp);
//             $api->setOK();
//         }
//         break;
//     case 'search':
//         if ($api->checkINPUT(['username'], $data)) {
//             $username = $data['username'];
//             $ab = $db->select('ai_users', ['username' => $username], 1, false, 'AND', 'id, mobile, username, first_name, last_name')->row();
//             if (is_object($ab)) {
//                 $name = $ab->first_name .  ' ' . $ab->last_name;
//                 $api->setOK($name);
//                 $api->setData($ab);
//             } else {
//                 $api->setError("Username is invalid.");
//             }
//         }
//         break;
//     case 'wallet-types':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $mainBal = $userOb->getMainBalance($user_id);
//             $fundBal = $userOb->getFundBalance($user_id);

//             $items = [
//                 ['label' => 'Fund Balace Rs. ' . $fundBal, 'fundtype' => 'fund'],
//                 ['label' => 'Main Balace Rs. ' . $mainBal, 'fundtype' => 'main']
//             ];
//             $api->setOK();
//             $api->setData($items);
//         }
//         break;

//     case 'plans':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $items = $userOb->getActivationPlans();
//             $api->setOK();
//             $api->setData($items);
//         }
//         break;
//     case 'activate':
//         if ($api->checkINPUT(['from_id', 'payfrom', 'username', 'plan_id'], $data)) {
//             $me_id = $data['from_id'];
//             $payfrom = $data['payfrom'];
//             $username = $data['username'];
//             $plan_id = $data['plan_id'];

//             $user = $db->select('ai_users', ['username' => $username], 1, false, 'AND', 'id')->row();
//             if (is_object($user)) {
//                 $user_id = $user->id;
//                 $bal = 0;
//                 if ($payfrom == 'main') {
//                     $api->setError('you can not topup by main');
//                     break;
//                     // $bal = $userOb->getMainBalance($me_id);
//                 } else if ($payfrom == 'fund') {
//                     $bal = $userOb->getFundBalance($me_id);
//                 }

//                 if ($plan_id <= 0 && $plan_id >= 7) {
//                     $api->setError('Invalid Plan');
//                     break;
//                 }

//                 $plan = $userOb->getActivationPlans($plan_id);
//                 $planAmt = $plan['value'];
//                 if ($planAmt <= $bal) {
//                     if ($userOb->isPlanActive($user_id, $plan_id)) {
//                         $api->setError("Your plan is already active.");
//                     } else {
//                         $userOb->activateAccount($user_id, $plan_id, $me_id, $payfrom);
//                         if ($payfrom == 'main') {
//                             $userOb->debit($me_id, $planAmt, ACCOUNT_TOPUP, $user_id, "TOPUP/$user_id");
//                             $userOb->activeRecharge($user_id);
//                         } else if ($payfrom == 'fund') {
//                             $userOb->debitFund($me_id, $planAmt, ACCOUNT_TOPUP, $user_id, "TOPUP/$user_id");
//                             $userOb->activeRecharge($user_id);
//                         }
//                         $api->setOK("Your account is activated successfully.");
//                     }
//                 } else {
//                     $api->setError("You have not $payfrom Balance");
//                 }
//             } else {
//                 $api->setError("Username is invalid for activation.");
//             }
//         }
//         break;

//     case 'withdrawal-fee':
//         $api->setData(["fee" => WITHDRAWAL_FEE]);
//         $api->setOK("sucess");
//         break;

//     case 'balance':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $mainBal = $userOb->getMainBalance($user_id);
//             $fundBal = $userOb->getFundBalance($user_id);
//             $bal = ["main" => $mainBal, "fund" => $fundBal];
//             $api->setData($bal);
//             $api->setOK("success");
//         }
//         break;

//     case 'withdraw':
//         if ($api->checkINPUT(['user_id', 'amount'], $data)) {
//             $user_id = $data['user_id'];
//             $amount = $data['amount'];
//             if ($amount < 200) {
//                 $api->setError("minimum withdrawal 200");
//                 break;
//             }
//             if ($amount % 50 != 0) {
//                 $api->setError("The amount is not a multiple of 50.");
//                 break;
//             }
//             $mainBal = $userOb->getMainBalance($user_id);
//             if ($mainBal < $amount) {
//                 $api->setError("Insufficient balance");
//             } else {
//                 $userOb->withdrawBalance($user_id, $amount);
//                 $api->setOK("Amount sucessfully widthraw");
//             }
//         }

//         break;
//     case 'withdraw-history':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $user = $db->select("ai_withdraw", ['user_id' => $user_id], false, false)->result();
//             if ($user) {
//                 $api->setData($user);
//                 $api->setOK("success");
//             } else {
//                 $api->setError("No withdraw history");
//             }
//         }
//         break;
//     case 'fund-trsnfer':
//         if ($api->checkINPUT(['user_id', 'amount', 'receiver_id'], $data)) {

//             $receiver_username = $data['receiver_id'];
//             $sender_id = $data['user_id'];
//             $amount = $data['amount'];
//             // $fundtype = $data['fundtype'];
//             $fundtype = 'fund';
//             $reciverInfo = $userOb->getUserFromUname($receiver_username);
//             $SenderInfo = $userOb->getUserinfo($sender_id);

//             if ($reciverInfo == null || $SenderInfo == null) {
//                 $api->setError("Invalid userid");
//                 break;
//             }
//             if ($reciverInfo->id == $SenderInfo->id) {
//                 $api->setError("You can't transfer to yourself");
//                 break;
//             }
//             $myid = $SenderInfo->id;
//             $user_id = $reciverInfo->id;

//             $mainBal = $userOb->getMainBalance($myid);
//             $fundBal = $userOb->getFundBalance($myid);
//             if ($fundtype == 'main' && $mainBal < $amount) {
//                 $api->setError("Insufficient balance");
//             } else if ($fundtype == 'fund' && $fundBal < $amount) {
//                 $api->setError("Insufficient balance");
//             } else {
//                 $userOb->fundTransfer($user_id, $amount, $fundtype, $myid);
//                 $str = json_encode($data);
//                 $api->setOK("Successfully transfered $str");
//             }
//         }
//         break;
//     case 'fund-history':
//         if ($api->checkINPUT(['user_id', 'fundtype'], $data)) {
//             $user_id = $data['user_id'];
//             $fundtype = $data['fundtype'];
//             if ($fundtype == "main") {
//                 $user = $db->select("ai_transaction", ['id' => $user_id, 'comments' => 'm2f'], false, false)->result();
//                 if ($user) {
//                     $api->setData($user);
//                     $api->setOK("success");
//                 } else {
//                     $api->setError("No Funds transfer history");
//                 }
//             }
//             if ($fundtype == "fund") {
//                 $user = $db->select("ai_fund", ['user_id' => $user_id, 'comments' => 'p2p'], false, false)->result();
//                 if ($user) {
//                     $api->setData($user);
//                     $api->setOK("success");
//                 } else {
//                     $api->setError("No Funds transfer history");
//                 }
//             }
//             if ($fundtype == "recharge") {
//                 $user = $db->select("ai_recharge_fund", ['id' => $user_id, 'comments' => 'm2r'], false, false)->result();
//                 if ($user) {
//                     $api->setData($user);
//                     $api->setOK("success");
//                 } else {
//                     $api->setError("No Funds transfer history");
//                 }
//             }
//         }
//         break;
//     case 'topup-history':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $user = $db->select("ai_topup_history", ['id' => $user_id], 1)->row();
//             $topupby = $db->select("ai_topup_history", ['topup_by' => $user_id], false, "id DESC")->result();
//             if ($user) {
//                 $arr = [];
//                 $arr[0] = $user;
//                 $count = 1;
//                 foreach ($topupby as $top) {
//                     $arr[$count] = $top;
//                     $count++;
//                 }
//                 if ($topupby) {
//                     $api->setData($arr);
//                     $api->setOK("success");
//                 } else {
//                     $api->setError("No Topup history");
//                 }
//             } else if ($topupby) {
//                 $api->SetData($topupby);
//                 $api->setOK("success");
//             } else {
//                 $api->setError("No Topup history");
//             }
//         }
//         break;
//     case 'upgrade-account':
//         if ($api->checkINPUT(['from_id', 'payfrom', "plan_id"], $data)) {
//             $user_id = $data['from_id'];
//             $payfrom = $data['payfrom'];
//             $plan_id = $data['plan_id'];
//             if ($user_id) {
//                 $bal = 0;
//                 if ($payfrom == 'main') {
//                     $bal = $userOb->getMainBalance($user_id);
//                 } else if ($payfrom == 'fund') {
//                     $bal = $userOb->getFundBalance($user_id);
//                 }

//                 if ($plan_id <= 0 && $plan_id >= 7) {
//                     $api->setError('Invalid Plan');
//                     break;
//                 }

//                 $plan = $userOb->getActivationPlans($plan_id);
//                 $planAmt = $plan['value'];
//                 if ($userOb->isPlanActive($user_id, $plan_id)) {
//                     $api->setError("Your plan is already active.");
//                 } else if ($planAmt < $bal) {
//                     $userOb->activateAccount($user_id, $plan_id, $user_id, $payfrom);
//                     if ($payfrom == 'main') {
//                         $userOb->debit($user_id, $planAmt, ACCOUNT_TOPUP, $user_id, "TOPUP/$user_id");
//                     } else if ($payfrom == 'fund') {
//                         $userOb->debitFund($user_id, $planAmt, ACCOUNT_TOPUP, $user_id, "TOPUP/$user_id");
//                     }
//                     $api->setOK("Your account is  successfully upgraded.");
//                 }
//             } else {
//                 $api->setError("Username is invalid for activation.");
//             }
//         }
//         break;
//     case 'change-password':
//         if ($api->checkINPUT(['user_id', 'new_pass', 'old_pass'], $data)) {
//             $user_id = $data['user_id'];
//             $new_pass = $data['new_pass'];
//             $old_pass = $data['old_pass'];
//             if ($old_pass == $new_pass) {
//                 $api->setError("Both password same use diffrent password");
//                 break;
//             }
//             $user = $userOb->getUserinfo($user_id);
//             if ($user->passwd == $old_pass) {
//                 $sb = [];
//                 $sb['passwd'] = $new_pass;
//                 $db->update('ai_users', $sb, ['id' => $user_id], 1);
//                 $api->setOK("Password updated successfully!");
//             } else {
//                 $api->setError("password not matched");
//             }
//         }
//         break;
//     case 'kyc-update':
//         if ($api->checkPOST(['user_id'])) {
//             $user_id = $_POST['user_id'];
//             $sb = [];
//             if (isset($_FILES['aadharf'])) {
//                 $sb['aadharf'] = do_upload('aadharf');
//             }
//             if (isset($_FILES['aadharb'])) {
//                 $sb['aadharb'] = do_upload('aadharb');
//             }
//             if (isset($_FILES['pan'])) {
//                 $sb['pan'] = do_upload('pan');
//             }
//             $sa['kyc_status'] = -1;
//             $upd = $db->update('ai_users', $sb, ['id' => $user_id], 1);
//             if ($upd) {
//                 $api->setData($sb);
//                 $api->setOK();
//             } else {
//                 $api->setError("Failed to update");
//             }
//             $api->setData($sb);
//             $api->setOK();
//         }
//         break;

//     case 'deposit-history';
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $user = $userOb->getUserinfo($user_id);
//             if ($user) {
//                 $depositHistory = $db->select('ai_fund_request', ['user_id' => $user_id], false, false, "AND", "amount, txn_no, created,status ")->result();
//                 if ($depositHistory) {
//                     $api->setData($depositHistory);
//                     $api->setOK("success");
//                 } else {
//                     $api->setError("No deposit history");
//                 }
//             } else {
//                 $api->setError("User not found");
//             }
//         }
//         break;
//     case 'edit-profile':
//         if ($api->checkINPUT(['user_id', 'last_name', 'email', 'city', 'district', 'address', 'bank_name', 'bank_ac_name', 'bank_ac_number', 'bank_ifsc', 'bank_branch'], $data)) {
//             $user_id = $data['user_id'];
//             $last_name = $data['last_name'];
//             $email = $data['email'];
//             $city = $data['city'];
//             $district = $data['district'];
//             $address = $data['address'];
//             $bank_name = $data['bank_name'];
//             $bank_ac_name = $data['bank_ac_name'];
//             $bank_ac_number = $data['bank_ac_number'];
//             $bank_ifsc = $data['bank_ifsc'];
//             $bank_branch = $data['bank_branch'];

//             $user = $userOb->getUserinfo($user_id);
//             if ($user) {
//                 $check = $userOb->updateProfile($user_id, $last_name, $email, $city, $district, $address, $bank_name, $bank_ac_name, $bank_ac_number, $bank_ifsc, $bank_branch);
//                 if ($check) {
//                     $api->setOK("Profile updated successfully!");
//                 } else {
//                     $api->setError("Failed to update profile");
//                 }
//             }
//         }
//         break;
//     case 'user-details':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $user = $userOb->getUserinfo($user_id);
//             if ($user) {
//                 if ($user->pan != '') $user->pan = 'https://admin.cashorbit.net/assets/uploads/' . $user->pan;
//                 if ($user->aadharf != '') $user->aadharf = 'https://admin.cashorbit.net/assets/uploads/' . $user->aadharf;
//                 if ($user->aadharb != '') $user->aadharb = 'https://admin.cashorbit.net/assets/uploads/' . $user->aadharb;
//                 if ($user->image != '') $user->image = 'https://admin.cashorbit.net/assets/uploads/' . $user->image;
//                 $api->setData($user);
//                 $api->setOK("success");
//             } else {
//                 $api->setError("User not found");
//             }
//         }
//         break;
//     case 'recharge':
//         if ($api->checkINPUT(["user_id"], $data)) {
//             $user_id = $data["user_id"];
//             $result = $userOb->rechargeInfo($user_id);
//             $api->setData($result);
//             $api->setOK("success");
//         }
//         break;

//     case 'getRecharge':

//         if ($api->checkINPUT(['id', 'user_id', "mobile", "operator"], $data)) {
//             $user_id = $data["user_id"];
//             $mobile = $data["mobile"];
//             $operator = $data['operator'];
//             $id = $data['id'];
//             $item = $db->select('ai_recharges', ['user_id' => $user_id, 'id' => $id, 'status' => 0], 1)->row();
//             if (is_object($item)) {
//                 $result = $userOb->getRecharge($id, $mobile, $operator);
//                 if ($result) {
//                     $api->setOK("Request submitted.");
//                 } else {
//                     $api->setError("Somting wont wrong");
//                 }
//             } else {
//                 $api->setError("Recharge request is invalid.");
//             }
//         }
//         break;
//     case 'getTotal-linked-members':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $total = $userOb->getTotalMemers($user_id);
//             $api->setData($total);
//         }
//         break;
//     case 'fund-request':
//         if ($api->checkPOST(['user_id', 'pay_mode', 'amount', 'date', 'txn_no'])) {
//             $user_id = $_POST['user_id'];
//             $pay_mode = $_POST['pay_mode'];
//             $amount = $_POST['amount'];
//             $date1 = $_POST['date'];
//             $txn_no = $_POST['txn_no'];
//             $sb = [];
//             $sb['user_id'] = $user_id;
//             $sb['amount'] = $amount;
//             $sb['txn_no'] = $txn_no;
//             $sb['created'] = date('Y-m-d H:i:s');
//             $sb['status'] = 0;
//             $sb['pay_mode'] = $pay_mode;
//             if (isset($_FILES['screenshot'])) {
//                 $sb['screenshot'] = do_upload('screenshot');
//             }

//             $upd = $db->insert('ai_fund_request', $sb);
//             if ($upd) {
//                 $api->setData($sb);
//                 $api->setOK();
//             } else {
//                 $api->setError("Failed to update");
//             }
//             $api->setData($sb);
//             $api->setOK();
//         }
//         break;
//     case 'direct-member':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $direct = $db->select('ai_users', ['sponsor_id' => $user_id], false, false, "AND", "first_name, last_name, username, sponsor_id, mobile, position, created")->result();
//             if (count($direct) != 0) {
//                 $api->setData($direct);
//                 $api->setOk("success");
//             } else {
//                 $api->setError("No direct member");
//             }
//         }
//         break;
//     case 'my-downline-member':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $users = $userOb->getDownloadLineIds($user_id);
//             if (count($users) > 0) {
//                 $id_str = implode(',', $users);
//                 $sql = "SELECT id, username, first_name, last_name, ac_status, created, position FROM ai_users WHERE id IN ($id_str)";
//                 $items = $db->query($sql)->result();
//                 $api->setData($items);
//                 $api->setOk("success");
//             } else {
//                 $api->setError("No downline member");
//             }
//         }
//         break;

//     case 'member-tree':
//         if ($api->checkINPUT(['user_id'], $data)) {
//             $user_id = $data['user_id'];
//             $list = $userOb->getMemberTree($user_id);
//             $api->setOK("Success");
//             $api->setData($list);
//         }
//         break;
//     case 'stateList':
//         $result = $db->select('ai_states', [])->result();
//         $api->setData($result);
//         $api->setOk("success");
//         break;
//     case 'edit-photo':
//         if ($api->checkPOST(['user_id'])) {
//             $user_id = $_POST['user_id'];
//             $sb = [];
//             if (isset($_FILES['image'])) {
//                 $sb['image'] = do_upload('image');
//             }
//             $upd = $db->update('ai_users', $sb, ['id' => $user_id], 1);
//             $user = $userOb->getUserinfo($user_id);

//             if ($upd) {
//                 $ab = "https://admin.cashorbit.net/assets/uploads/" . $user->image;
//                 $api->setData($ab);
//                 $api->setOK();
//             } else {
//                 $api->setError("Failed to update");
//             }
//         }
//         break;
//     case 'main-to-fund':
//         if ($api->checkINPUT(['user_id', 'amount', 'fundtype'], $data)) {
//             $user_id  = $data['user_id'];
//             $amount  = $data['amount'];
//             $fundtype  = $data['fundtype'];
//             if ($amount < 100) {
//                 $api->setError("Minimum transfer 100/-");
//                 break;
//             }
//             $user = $userOb->getUserinfo($user_id);
//             if ($user == null) {
//                 $api->setError("Invalid userid");
//                 break;
//             }
//             $mainBal = $userOb->getMainBalance($user_id);
//             if ($fundtype == 'main' && $mainBal < $amount) {
//                 $api->setError("Insufficient balance");
//             } else {
//                 $userOb->mainTofundTransfer($user_id, $amount, $fundtype);
//                 $str = json_encode($data);
//                 $api->setOK("Successfully transfered $str");
//             }
//         }
//         break;
//     default:
//         $api->setError("Invalid api request");
// }

// $api->render();

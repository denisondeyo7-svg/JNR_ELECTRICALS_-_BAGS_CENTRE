<?php
session_start();
include("config.php");

// 1. Validate Login, Cart, and Price
if (!isset($_SESSION['customer_id'])) {
    header("Location: customerlogin.html");
    exit();
}

if (!isset($_GET['total']) || empty($_SESSION['cart'])) {
    header("Location: ../cart.php");
    exit();
}

// 2. Fetch User Phone Number from Database
$customer_id = (int)$_SESSION['customer_id'];
$grand_total = (int)ceil((float)$_GET['total']);
$user_phone = '';
$customer_fname = '';
$customer_lname = '';

$phone_query = "SELECT phone, fname, lname FROM customers WHERE id = ?";
$stmt = mysqli_prepare($connection, $phone_query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $customer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $user_phone = $row['phone'];
        $customer_fname = $row['fname'];
        $customer_lname = $row['lname'];
    }
    mysqli_stmt_close($stmt);
}

// 3. Format Phone Number into M-Pesa Format (2547XXXXXXXX or 2541XXXXXXXX)
$user_phone = preg_replace('/[^0-9]/', '', $user_phone);
if (substr($user_phone, 0, 1) == '0') {
    $user_phone = '254' . substr($user_phone, 1);
} elseif (substr($user_phone, 0, 3) != '254') {
    $user_phone = '254' . $user_phone;
}

// 4. STEP A: Generate the OAuth Access Token using correct API gateway
$consumerKey = 'y5fmO7oaiA5KVRVlsa7Qo8ExUEO78c1qn9EtOSsmCOo3H4jx';
$consumerSecret = 'aTpAjdcld8PrmGUXObJbYVmN8kfqy5C25CYAqtoTvjmJ5UdUF2ZL39Yuag2pHwvG';

// FIX: Use the official Daraja sandbox URL and the correct token endpoint path
$baseUrl = 'https://sandbox.safaricom.co.ke'; 
$authUrl = $baseUrl . '/oauth/v1/generate?grant_type=client_credentials';

$ch = curl_init($authUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$auth_response = curl_exec($ch);
if ($auth_response === false) {
    die("Local cURL Network Error: " . curl_error($ch));
}
curl_close($ch);

$token_data = json_decode($auth_response, true);
if (!isset($token_data['access_token'])) {
    echo "<h3>--- Safaricom Connection Refused ---</h3>";
    echo "<strong>Raw Server Response:</strong> " . htmlspecialchars($auth_response) . "<br>";
    exit();
}
$accessToken = $token_data['access_token'];

// 5. STEP B: Define STK Push Configurations (Sandbox Details)
$businessShortCode = '174379';
$passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$timestamp = date('YmdHis');
$stkPassword = base64_encode($businessShortCode . $passkey . $timestamp);

// FIX: Use the correct endpoint endpoint path for STK Push processing
$stkUrl = $baseUrl . '/mpesa/stkpush/v1/processrequest'; 
$callbackUrl = 'https://ngrok-free.dev'; // Ensure this matches your active ngrok URL path

// 6. Assemble M-Pesa Payload
$stkPayload = [
    'BusinessShortCode' => $businessShortCode,
    'Password' => $stkPassword,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $grand_total,
    'PartyA' => $user_phone,
    'PartyB' => $businessShortCode,
    'PhoneNumber' => $user_phone,
    'CallBackURL' => $callbackUrl,
    'AccountReference' => 'JNR_Shop_Order_' . $customer_id,
    'TransactionDesc' => 'Cart Payment'
];

// 7. STEP C: Transmit STK Request Packet using cURL
$ch = curl_init($stkUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stkPayload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$stk_response = curl_exec($ch);
$stk_result = json_decode($stk_response, true);
curl_close($ch);

// 8. Analyze Response and Route User
if (isset($stk_result['ResponseCode']) && $stk_result['ResponseCode'] == '0') {
    $order_query = "INSERT INTO orders (customer_id, fname, lname, total_amount, order_status) VALUES (?, ?, ?, ?, 'Pending M-Pesa')";
    $order_stmt = mysqli_prepare($connection, $order_query);
    if ($order_stmt) {
        mysqli_stmt_bind_param($order_stmt, "issd", $customer_id, $customer_fname, $customer_lname, $_GET['total']);
        mysqli_stmt_execute($order_stmt);
        $new_order_id = mysqli_insert_id($connection);
        mysqli_stmt_close($order_stmt);

        $item_query = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
        $item_stmt = mysqli_prepare($connection, $item_query);
        if ($item_stmt) {
            foreach ($_SESSION['cart'] as $pid => $item) {
                $p_name = $item['name'];
                $p_qty = (int)$item['quantity'];
                $p_price = (float)preg_replace('/[^0-9.]/', '', $item['price']);
                mysqli_stmt_bind_param($item_stmt, "iisis", $new_order_id, $pid, $p_name, $p_qty, $p_price);
                mysqli_stmt_execute($item_stmt);
            }
            mysqli_stmt_close($item_stmt);
        }
    }
    $_SESSION['cart'] = array();
    echo "<script> alert('Check your phone! An M-Pesa PIN prompt has been sent to your line.'); window.location.href = '../index.php'; </script>";
} else {
    echo "STK Push Initiation Failed. Response Error: <br><pre>";
    print_r($stk_result);
    echo "</pre>";
}
?>

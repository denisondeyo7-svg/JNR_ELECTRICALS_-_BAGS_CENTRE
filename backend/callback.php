<?php
// Include database configuration
include("config.php");

// 1. Capture raw JSON payload broadcasted by Safaricom
$json_content = file_get_contents('php://input');

// 2. Decode incoming data stream into a PHP array
$data = json_decode($json_content, true);

if ($data && isset($data['Body']['stkCallback'])) {
    
    $stkCallback = $data['Body']['stkCallback'];
    $resultCode = $stkCallback['ResultCode'];
    $resultDesc = $stkCallback['ResultDesc'];
    $checkoutRequestID = $stkCallback['CheckoutRequestID']; // Unique tracking ID
    
    // 3. Check if the payment was successful (ResultCode 0 means Success)
    if ($resultCode == 0) {
        $callbackMetadata = $stkCallback['CallbackMetadata']['Item'];
        
        $mpesa_receipt = '';
        $amount_paid = 0;
        $phone_number = '';
        
        // Extract payment variables safely from metadata array
        foreach ($callbackMetadata as $item) {
            switch ($item['Name']) {
                case 'MpesaReceiptNumber':
                    $mpesa_receipt = $item['Value'];
                    break;
                case 'Amount':
                    $amount_paid = $item['Value'];
                    break;
                case 'PhoneNumber':
                    $phone_number = $item['Value'];
                    break;
            }
        }
        
        // 4. FIX: Use CheckoutRequestID and Prepared Statements to update the exact order
        $update_query = "UPDATE orders 
                         SET order_status = 'Completed' 
                         WHERE tracking_id = ? AND order_status = 'Pending M-Pesa'";
                         
        $stmt = mysqli_prepare($connection, $update_query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $checkoutRequestID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        
        // Log receipt details for auditing
        file_put_contents('mpesa_success.txt', "Receipt: $mpesa_receipt | Amount: $amount_paid | Phone: $phone_number | ID: $checkoutRequestID\n", FILE_APPEND);
        
    } else {
        // 5. FIX: Update the exact failed/cancelled order using CheckoutRequestID
        $fail_query = "UPDATE orders 
                       SET order_status = 'Cancelled / Failed' 
                       WHERE tracking_id = ? AND order_status = 'Pending M-Pesa'";
                       
        $stmt = mysqli_prepare($connection, $fail_query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $checkoutRequestID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        
        // Log failure description
        file_put_contents('mpesa_fails.txt', "ID: $checkoutRequestID | Code: $resultCode | Desc: $resultDesc\n", FILE_APPEND);
    }
}

// Respond to Safaricom with a 200 OK so they stop sending the same notification
header("Content-Type: application/json");
echo json_encode(["status" => "success"]);
?>

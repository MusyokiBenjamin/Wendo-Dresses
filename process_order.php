<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\wamp64\www\KilimoKe 3rd Trial\PHPMailer\src\PHPMailer.php';
require 'C:\wamp64\www\KilimoKe 3rd Trial\PHPMailer\src\Exception.php';
require 'C:\wamp64\www\KilimoKe 3rd Trial\PHPMailer\src\SMTP.php';

// Retrieve and decode the JSON data
$data = json_decode( file_get_contents( 'php://input' ), true );
if ( !$data ) {
    echo json_encode( [ 'success' => false, 'message' => 'Invalid order data' ] );
    exit;
}

$cart = $data[ 'cart' ];
$subtotal = $data[ 'subtotal' ];
$userName = $data[ 'user' ][ 'name' ];
$userEmail = $data[ 'user' ][ 'email' ];

// Order summary email to user
$userMail = new PHPMailer( true );
try {
    $userMail->isSMTP();
    $userMail->Host = 'smtp.gmail.com';
    // Update with your SMTP server
    $userMail->SMTPAuth = true;
    $userMail->Username = 'benjaminmusyoki064@gmail.com';
    // Update with your SMTP username
    $userMail->Password = 'bzevpvakkxignqkm';
    // Update with your SMTP password
    $userMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $userMail->Port = 587;

    $userMail->setFrom( 'benjaminmusyoki064@gmail.com', 'Wendo Dresses' );
    $userMail->addAddress( $userEmail, $userName );
    $userMail->isHTML( true );
    $userMail->Subject = 'Order Confirmation';

    $userMail->Body = "<h1>Order Confirmation</h1>
                       <p>Dear $userName,</p>
                       <p>Thank you for your order! Here are the details:</p>
                       <table border='1' cellpadding='5' cellspacing='0'>
                           <tr><th>Product</th><th>Price</th></tr>";

    foreach ( $cart as $item ) {
        $userMail->Body .= "<tr><td>{$item['name']}</td><td>KES {$item['price']}</td></tr>";
    }

    $userMail->Body .= "</table>
                        <p>Cart Subtotal: KES $subtotal</p>
                        <p>Thank you for shopping with us!</p>";

    $userMail->send();
} catch ( Exception $e ) {
    echo json_encode( [ 'success' => false, 'message' => 'Failed to send order confirmation to user' ] );
    exit;
}

// Order summary email to admin
$adminMail = new PHPMailer( true );
try {
    $adminMail->isSMTP();
    $adminMail->Host = 'smtp.gmail.com';
    // Update with your SMTP server
    $adminMail->SMTPAuth = true;
    $adminMail->Username = 'benjaminmusyoki064@gmail.com';
    // Update with your SMTP username
    $adminMail->Password = 'bzevpvakkxignqkm';
    // Update with your SMTP password
    $adminMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $adminMail->Port = 587;

    $adminMail->setFrom( 'your-email@example.com', 'Wendo Dresses' );
    $adminMail->addAddress( 'benjaminmusyoki064@gmail.com' );
    // Admin email address
    $adminMail->isHTML( true );
    $adminMail->Subject = 'New Order Received';

    $adminMail->Body = "<h1>New Order Received</h1>
                        <p>Order Details:</p>
                        <table border='1' cellpadding='5' cellspacing='0'>
                            <tr><th>Product</th><th>Price</th></tr>";

    foreach ( $cart as $item ) {
        $adminMail->Body .= "<tr><td>{$item['name']}</td><td>KES {$item['price']}</td></tr>";
    }

    $adminMail->Body .= "</table>
                         <p>Cart Subtotal: KES $subtotal</p>
                         <p>Order placed by: $userName (Email: $userEmail)</p>";

    $adminMail->send();
    echo json_encode( [ 'success' => true ] );
} catch ( Exception $e ) {
    echo json_encode( [ 'success' => false, 'message' => 'Failed to send order notification to admin' ] );
}

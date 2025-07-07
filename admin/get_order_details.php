<?php
include "../config/connect.php";

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    $status = $_GET['status'] ?? '';

    // Get order info
    $sql_order = "SELECT * FROM orders WHERE id = $order_id AND is_deleted = 0";
    $order_result = mysqli_query($conn, $sql_order);
    $order_row = mysqli_fetch_assoc($order_result);

    // Check if order exists and not deleted
    if (!$order_row) {
        http_response_code(404);
        echo json_encode(['error' => 'Order not found or has been deleted']);
        exit;
    }

    // Get user info
    $user_id = $order_row['user_id'];
    $sql_user = "SELECT * FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conn, $sql_user);
    $user_row = mysqli_fetch_assoc($user_result);

    // Get order details
    $sql = "SELECT order_details.*, jewelries.name as jewelry_name, jewelries.price, categories.name as category_name
            FROM order_details
            INNER JOIN jewelries ON order_details.jewelry_id = jewelries.id
            INNER JOIN categories ON jewelries.category_id = categories.id
            WHERE order_details.order_id = $order_id AND order_details.is_deleted = 0";
    $result = mysqli_query($conn, $sql);

    $items = [];
    $total = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $subtotal = intval($row["quantity"]) * $row["price"];
        $total += $subtotal;

        $items[] = [
            'jewelry_name' => $row['jewelry_name'],
            'category_name' => $row['category_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'subtotal' => $subtotal
        ];
    }

    $response = [
        'id' => $order_id,
        'date' => $order_row['created_at'],
        'name' => $user_row['username'],
        'address' => $user_row['address'],
        'phone_number' => $user_row['phone_number'],
        'notes' => $order_row['status'],
        'total' => $total,
        'items' => $items,
        'status' => $status
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing order ID']);
}

<?php
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    // Delete order and related order_details
    $sql_delete_details = "UPDATE order_details SET is_deleted = 1 WHERE order_id = $order_id";
    $sql_delete_order = "UPDATE orders SET is_deleted = 1 WHERE id = $order_id";

    $success = true;

    // Start transaction
    mysqli_autocommit($conn, FALSE);

    try {
        // Delete order details first
        if (!mysqli_query($conn, $sql_delete_details)) {
            throw new Exception("Failed to delete order details");
        }

        // Delete order
        if (!mysqli_query($conn, $sql_delete_order)) {
            throw new Exception("Failed to delete order");
        }

        // Commit transaction
        mysqli_commit($conn);

        echo json_encode([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($conn);

        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete order: ' . $e->getMessage()
        ]);
    }

    // Reset autocommit
    mysqli_autocommit($conn, TRUE);
} else {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}

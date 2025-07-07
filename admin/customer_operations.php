<?php
header('Content-Type: application/json');
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $response = ['success' => false, 'message' => ''];

    switch ($action) {
        case 'get':
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND is_deleted = 0");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    $response['success'] = true;
                    $response['data'] = $row;
                } else {
                    $response['message'] = 'Customer not found';
                }
                $stmt->close();
            } else {
                $response['message'] = 'Customer ID is required';
            }
            break;

        case 'update':
            if (
                isset($_POST['id']) && isset($_POST['username']) && isset($_POST['date_of_birth']) &&
                isset($_POST['address']) && isset($_POST['phone_number']) && isset($_POST['email'])
            ) {

                $id = intval($_POST['id']);
                $username = trim($_POST['username']);
                $date_of_birth = $_POST['date_of_birth'];
                $address = trim($_POST['address']);
                $phone_number = trim($_POST['phone_number']);
                $email = trim($_POST['email']);

                // Validate input
                if (
                    empty($username) || empty($date_of_birth) || empty($address) ||
                    empty($phone_number) || empty($email)
                ) {
                    $response['message'] = 'All fields are required';
                    break;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response['message'] = 'Invalid email format';
                    break;
                }

                // Check if email exists for other customers
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ? AND is_deleted = 0");
                $stmt->bind_param("si", $email, $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $response['message'] = 'Email already exists for another customer';
                    $stmt->close();
                    break;
                }
                $stmt->close();

                // Update customer
                $stmt = $conn->prepare("UPDATE users SET username = ?, date_of_birth = ?, address = ?, phone_number = ?, email = ? WHERE id = ? AND is_deleted = 0");
                $stmt->bind_param("sssssi", $username, $date_of_birth, $address, $phone_number, $email, $id);

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $response['success'] = true;
                        $response['message'] = 'Customer updated successfully';
                    } else {
                        $response['message'] = 'No changes made or customer not found';
                    }
                } else {
                    $response['message'] = 'Failed to update customer';
                }
                $stmt->close();
            } else {
                $response['message'] = 'All fields are required';
            }
            break;

        case 'delete':
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);

                // Soft delete - set is_deleted = 1
                $stmt = $conn->prepare("UPDATE users SET is_deleted = 1 WHERE id = ? AND is_deleted = 0");
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $response['success'] = true;
                        $response['message'] = 'Customer deleted successfully';
                    } else {
                        $response['message'] = 'Customer not found or already deleted';
                    }
                } else {
                    $response['message'] = 'Failed to delete customer';
                }
                $stmt->close();
            } else {
                $response['message'] = 'Customer ID is required';
            }
            break;

        default:
            $response['message'] = 'Invalid action';
            break;
    }

    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
}

$conn->close();

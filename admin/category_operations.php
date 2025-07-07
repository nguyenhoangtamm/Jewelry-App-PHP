<?php
include "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            addCategory();
            break;
        case 'update':
            updateCategory();
            break;
        case 'delete':
            deleteCategory();
            break;
        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

function addCategory()
{
    global $conn;

    $categoryName = trim($_POST['category_name']);
    $categoryDescription = trim($_POST['category_description']);

    // Check for duplicate names
    $sql_check = "SELECT id FROM categories WHERE name = ? AND is_deleted = 0";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $categoryName);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Category name already exists'
        ]);
        return;
    }

    // Add new category
    $sql_insert = "INSERT INTO categories (name, description) VALUES (?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "ss", $categoryName, $categoryDescription);

    if (mysqli_stmt_execute($stmt_insert)) {
        echo json_encode([
            'success' => true,
            'message' => 'Category added successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to add category'
        ]);
    }
}

function updateCategory()
{
    global $conn;

    $categoryId = intval($_POST['category_id']);
    $categoryName = trim($_POST['category_name']);
    $categoryDescription = trim($_POST['category_description']);

    // Check for duplicate names
    $sql_check = "SELECT id FROM categories WHERE name = ? AND id != ? AND is_deleted = 0";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "si", $categoryName, $categoryId);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Category name already exists'
        ]);
        return;
    }

    // Update category
    $sql_update = "UPDATE categories SET name = ?, description = ? WHERE id = ? AND is_deleted = 0";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ssi", $categoryName, $categoryDescription, $categoryId);

    if (mysqli_stmt_execute($stmt_update)) {
        echo json_encode([
            'success' => true,
            'message' => 'Category updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update category'
        ]);
    }
}

function deleteCategory()
{
    global $conn;

    $categoryId = intval($_POST['category_id']);

    // Check if category is being used by any jewelry
    $sql_check = "SELECT id FROM jewelries WHERE category_id = ? AND is_deleted = 0";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "i", $categoryId);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cannot delete category that is being used by jewelry items'
        ]);
        return;
    }

    // Soft delete category
    $sql_delete = "UPDATE categories SET is_deleted = 1 WHERE id = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $categoryId);

    if (mysqli_stmt_execute($stmt_delete)) {
        echo json_encode([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete category'
        ]);
    }
}

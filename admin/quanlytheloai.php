<?php
include "../config/connect.php";
$sql = "SELECT * FROM categories WHERE is_deleted = 0";
$result = mysqli_query($conn, $sql);
$pageRow = $result->num_rows;
$numPage = ceil($pageRow / 5);
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="data:;base64,iVBORw0KGgo=">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="sidebar">
        <ul class="menu">
            <li>
                <a href="./index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./jewelry_management.php">
                    <i class="fa-solid fa-gem"></i>
                    <span>Jewelry</span>
                </a>
            </li>
            <li>
                <a href="./quanlykhachhang.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="./quanlyhoadon.php">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="active">
                <a href="./quanlytheloai.php">
                    <i class="fa-solid fa-tags"></i>
                    <span>Category</span>
                </a>
            </li>
            <li class="logout">
                <a href="../user/login-signup.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Categories Managerment</h2>
            </div>
            <div class="user-info">
                <img src="../images_web/avatar.png" alt="avatar">
            </div>
        </div>
        <div class="table-wrapper">
            <div class="table-header">
                <h3 class="main-title">
                    Categories Information
                </h3>
                <div class="add-book add-category js-add-category"><i class="fa-solid fa-plus icon-add"></i>Add Category</div>
            </div>
            <div class="table-container" name="category-table">
                <table id="category-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../config/connect.php";
                        if ($page == "") {
                            $currentData = 0;
                        } else {
                            $currentData = ($page - 1) * 5;
                        }
                        $sql = "SELECT * FROM categories WHERE is_deleted = 0 LIMIT " . $currentData . ", 5";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $description = $row['description'];
                        ?>
                            <tr>
                                <td class="category-id"><?php echo $row['id'] ?></td>
                                <td class="category-name"><?php echo $row['name'] ?></td>
                                <td class="category-description"><?php echo htmlspecialchars($row['description']) ?></td>
                                <td>
                                    <a href="#"
                                        class="fa-solid fa-pen icon-change js-changeCategory"
                                        data-category-id="<?php echo $row['id'] ?>"
                                        data-category-name="<?php echo htmlspecialchars($row['name']) ?>"
                                        data-category-description="<?php echo htmlspecialchars($row['description']) ?>"
                                        onclick="showEditCategoryModal(<?php echo $row['id'] ?>, '<?php echo htmlspecialchars($row['name']) ?>', '<?php echo htmlspecialchars($row['description']) ?>')">
                                    </a>
                                    <a href="#"
                                        class="fas fa-trash icon-delete js-delete-category"
                                        data-category-id="<?php echo $row['id'] ?>"
                                        onclick="handleDeleteCategory(<?php echo $row['id'] ?>)">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="quanlytheloai.php?page=<?php echo (($page - 1) > 0) ? ($page - 1) : 1 ?>" class="prev">Prev</a>
                    <?php
                    for ($i = 0; $i < $numPage; $i++) {
                    ?>
                        <a href="quanlytheloai.php?page=<?php echo ($i + 1) ?>" class="<?php echo ($page == $i + 1) ? "page-current" : "" ?>"> <?php echo ($i + 1) ?> </a>
                    <?php } ?>
                    <a href="quanlytheloai.php?page=<?php echo (($page + 1) <= $numPage) ? ($page + 1) : $numPage ?>" class="next">Next</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Add Category -->
    <div class="modal js-modal-addCategory">
        <form class="modal-container modal-container-category js-modal-addCategory-container" method="post" action="quanlytheloai.php" enctype="multipart/form-data">
            <div class="modal-close js-modal-addCategory-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header modal-header-books">
                <i class="modal-heading-icon fa-solid fa-tags"></i>
                Add Category
            </header>

            <div class="modal-content modal-content-category">
                <div class="modal-col">
                    <label for="category-name" class="modal-label">
                        Name
                        <input id="category-name" name="addCategory-name" type="text" class="js-addCategory-name modal-input" placeholder="Name..." required>
                        <span class="name-addCategory-error check-error"></span>
                    </label>
                </div>
                <div class="modal-col">
                    <label for="category-description" class="modal-label">
                        Description
                        <textarea id="category-description" name="addCategory-description" class="js-addCategory-description modal-input" placeholder="Description..." rows="3"></textarea>
                        <span class="description-addCategory-error check-error"></span>
                    </label>
                </div>
                <div class="action-form">
                    <div class="cancel-book js-cancel-category">
                        Cancel
                    </div>
                    <button type="submit" name="addCategory" class="submit-book" onclick="checkAddCategory()">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Edit Category -->
    <div class="modal js-modal-editCategory" style="display: none;">
        <div class="modal-container modal-container-category js-modal-editCategory-container">
            <div class="modal-close js-modal-editCategory-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header modal-header-books">
                <i class="modal-heading-icon fa-solid fa-tags"></i>
                Edit Category
            </header>

            <div class="modal-content modal-content-category">
                <div class="modal-col">
                    <label for="edit-category-name" class="modal-label">
                        Name
                        <input id="edit-category-name" name="editCategory-name" type="text" class="js-editCategory-name modal-input" placeholder="Name..." required>
                        <span class="name-editCategory-error check-error"></span>
                    </label>
                </div>
                <div class="modal-col">
                    <label for="edit-category-description" class="modal-label">
                        Description
                        <textarea id="edit-category-description" name="editCategory-description" class="js-editCategory-description modal-input" placeholder="Description..." rows="3"></textarea>
                        <span class="description-editCategory-error check-error"></span>
                    </label>
                </div>
                <div class="action-form">
                    <button type="button" class="cancel-book js-cancel-edit-category">
                        Cancel
                    </button>
                    <button type="button" class="submit-book js-save-category">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal-delete js-modal-deleteCategory" style="display: none;">
        <div class="modal-delete-container js-modal-deleteCategory-container">
            <div class="modal-delete-close js-modal-deleteCategory-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal-delete-body">
                <p>Do you want to delete this category?</p>
                <div class="btn-delete-choose">
                    <button type="button" class="btn-yes js-confirm-delete-category">Yes</button>
                    <button type="button" class="btn-no js-cancel-delete-category">No</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["addCategory"])) {
            $nameCategory = $_POST["addCategory-name"];
            $descriptionCategory = $_POST["addCategory-description"];
            $isDuplicate = false;
            $sql2 = "SELECT * FROM categories WHERE is_deleted = 0";
            $names = mysqli_query($conn, $sql2);
            while ($category = mysqli_fetch_array($names)) {
                if ($category["name"] == $nameCategory) {
                    echo '<div id="toast-changeNameCategory-error" class="toast-message"></div>';
                    $isDuplicate = true;
                    break;
                }
            }
            if (!$isDuplicate) {
                $sql1 = "INSERT INTO categories (name, description) VALUES('$nameCategory', '$descriptionCategory')";
                if (mysqli_query($conn, $sql1)) {
                    echo '<div id="toast-addCategory-success" class="toast-message"></div>';
                } else {
                    echo '<div id="toast-addCategory-error" class="toast-message"></div>';
                }
            }
        }
    }
    ?>

    <script src="./js/script-form-category.js"></script>
    <script src="./js/script-message-category.js"></script>
    <script src="./js/script-check-category.js"></script>
    <script>
        let currentEditCategoryId = null;

        // Function to show edit category modal
        function showEditCategoryModal(categoryId, categoryName, categoryDescription) {
            const modal = document.querySelector('.js-modal-editCategory');
            const nameInput = document.querySelector('#edit-category-name');
            const descriptionInput = document.querySelector('#edit-category-description');

            currentEditCategoryId = categoryId;
            nameInput.value = categoryName;
            descriptionInput.value = categoryDescription;
            modal.style.display = 'flex';
        }

        // Function to handle delete category
        function handleDeleteCategory(categoryId) {
            const modal = document.querySelector('.js-modal-deleteCategory');
            modal.style.display = 'flex';
            modal.dataset.categoryId = categoryId;
        }

        // Function to update category
        function updateCategory() {
            if (!currentEditCategoryId) return;

            const categoryName = document.querySelector('#edit-category-name').value.trim();
            const categoryDescription = document.querySelector('#edit-category-description').value.trim();

            if (!categoryName) {
                alert('Category name is required');
                return;
            }

            fetch('category_operations.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=update&category_id=${currentEditCategoryId}&category_name=${encodeURIComponent(categoryName)}&category_description=${encodeURIComponent(categoryDescription)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Category updated successfully!');
                        window.location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the category.');
                });
        }

        // Function to delete category
        function deleteCategory(categoryId) {
            fetch('category_operations.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=delete&category_id=${categoryId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Category deleted successfully!');
                        window.location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the category.');
                });
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Edit modal close
            const editCloseBtn = document.querySelector('.js-modal-editCategory-close');
            const editCancelBtn = document.querySelector('.js-cancel-edit-category');
            const editSaveBtn = document.querySelector('.js-save-category');
            const editModal = document.querySelector('.js-modal-editCategory');

            if (editCloseBtn) {
                editCloseBtn.addEventListener('click', () => {
                    editModal.style.display = 'none';
                });
            }

            if (editCancelBtn) {
                editCancelBtn.addEventListener('click', () => {
                    editModal.style.display = 'none';
                });
            }

            if (editSaveBtn) {
                editSaveBtn.addEventListener('click', updateCategory);
            }

            // Delete modal
            const deleteModal = document.querySelector('.js-modal-deleteCategory');
            const deleteCloseBtn = document.querySelector('.js-modal-deleteCategory-close');
            const confirmDeleteBtn = document.querySelector('.js-confirm-delete-category');
            const cancelDeleteBtn = document.querySelector('.js-cancel-delete-category');

            if (deleteCloseBtn) {
                deleteCloseBtn.addEventListener('click', () => {
                    deleteModal.style.display = 'none';
                });
            }

            if (cancelDeleteBtn) {
                cancelDeleteBtn.addEventListener('click', () => {
                    deleteModal.style.display = 'none';
                });
            }

            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', () => {
                    const categoryId = deleteModal.dataset.categoryId;
                    deleteModal.style.display = 'none';
                    deleteCategory(categoryId);
                });
            }

            // Close modals when clicking outside
            if (editModal) {
                editModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.style.display = 'none';
                    }
                });
            }

            if (deleteModal) {
                deleteModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.style.display = 'none';
                    }
                });
            }
        });

        function toastCategory() {
            toastAddCategorySuccess();
            toastAddCategoryError();
            toastNameCategoryError();
            toastDeleteCategorySuccess();
            toastDeleteCategoryError();
            toastChangeCategorySuccess();
            toastChangeCategoryError();
        }
        toastCategory();
    </script>
</body>

</html>
<?php
include "../config/connect.php";
$sql = "SELECT * FROM categories";
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
                        $sql = "SELECT * FROM categories LIMIT " . $currentData . ", 5";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                        ?>
                            <tr>
                                <td class="category-id"><?php echo $row['id'] ?></td>
                                <td class="category-name"><?php echo $row['name'] ?></td>
                                <td>
                                    <a href="quanlytheloai.php?page=<?php echo $page . "&idchangecategory=" . $row['id'] . "&formchangecategory=1" ?>" class="fa-solid fa-pen icon-change js-changeCategory"></a>
                                    <a href="quanlytheloai.php?page=<?php echo $page . "&iddelcategory=" . $row['id'] . "&formdelcategory=1" ?>" class="fas fa-trash icon-delete js-delete-category"></a>
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
    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["addCategory"])) {
            $nameCategory = $_POST["addCategory-name"];
            $isDuplicate = false;
            $sql2 = "SELECT * FROM categories";
            $names = mysqli_query($conn, $sql2);
            while ($category = mysqli_fetch_array($names)) {
                if ($category["name"] == $nameCategory) {
                    echo '<div id="toast-changeNameCategory-error" class="toast-message"></div>';
                    $isDuplicate = true;
                    break;
                }
            }
            if (!$isDuplicate) {
                $sql1 = "INSERT INTO category (name) VALUE('$nameCategory')";
                if (mysqli_query($conn, $sql1)) {
                    echo '<div id="toast-addCategory-success" class="toast-message"></div>';
                } else {
                    echo '<div id="toast-addCategory-error" class="toast-message"></div>';
                }
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['idchangecategory'])) {
        $idchange = $_GET['idchangecategory'];
        $sql4 = "SELECT * FROM categories WHERE id = " . $idchange;
        $query = mysqli_query($conn, $sql4);
        if ($query) {
            $row = mysqli_fetch_array($query);
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['formchangecategory'])) {
        echo '<div class="modal js-modal-category modal-change-category" style="display:flex;">
        <form action="quanlytheloai.php?page=' . $page . '&idchangecategory=' . (isset($_GET["idchangecategory"]) ? $_GET["idchangecategory"] : "") . '" method="post" class="modal-container js-modalCategory-container modal-container-category" enctype="multipart/form-data">
            <div class="modal-close js-modalCategory-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header">
                <i class="modal-heading-icon fa-solid fa-tags"></i>
                Change Category Information
            </header>

            <div class="modal-content  modal-content-category">
                <div class="modal-col">
                    <label for="category-name" class="modal-label" style="display: none;">
                        ID
                        <input value="' . $row["id"] . '" name="changeCategory-id" id="category-id" type="text" class="js-category-id modal-input modal-input-category" placeholder="ID..." required>
                    </label>
                    <label for="category-name" class="modal-label">
                        Name
                        <input value="' . $row["name"] . '" name="changeCategory-name" id="category-name" type="text" class="js-category-name modal-input modal-input-category" placeholder="Name..." required>
                        <span class="name-changeCategory-error check-error"></span>
                    </label>
                <div class="action-form">
                    <div class="cancel-book js-cancel-category">
                        Cancel
                    </div>
                    <button name="changeCategory" class="submit-book js-change-category" type="submit" onclick="checkChangeCategory()">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>';
    }
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["changeCategory"])) {
            $nameCategory = $_POST["changeCategory-name"];
            $idCategory = $_POST["changeCategory-id"];
            $isDuplicate = false;
            if ($_GET["idchangecategory"]) {
                $sql2 = "SELECT * FROM categories";
                $names = mysqli_query($conn, $sql2);
                while ($category = mysqli_fetch_array($names)) {
                    if ($category["name"] == $nameCategory && $category["id"] != $idCategory) {
                        echo '<div id="toast-changeNameCategory-error" class="toast-message"></div>';
                        $isDuplicate = true;
                        break;
                    }
                }
                if (!$isDuplicate) {
                    $sql1 = "UPDATE categories SET name = '$nameCategory' WHERE id = " . $_GET["idchangecategory"];
                    if (mysqli_query($conn, $sql1)) {
                        echo '<div id="toast-changeCategory-success" class="toast-message"></div>';
                        echo "<script>setTimeout(function(){
                            window.location = 'quanlytheloai.php?page=" . $_GET['page'] . "';
                        }, 2000)</script>";
                    } else {
                        echo '<div id="toast-changeCategory-error" class="toast-message"></div>';
                    }
                }
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['formdelcategory'])) {
        echo '<div class="modal-delete js-modal-deleteCategory">
        <form class="modal-delete-container js-modal-deleteCategory-container" method="post" action="quanlytheloai.php?page=' . $page . '&iddelcategory=' . (isset($_GET["iddelcategory"]) ? $_GET["iddelcategory"] : "") . '" enctype="multipart/form-data">
            <div class="modal-delete-close js-modal-deleteCategory-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal-delete-body">
                <p>Do you want to delete category?</p>
                <div class="btn-delete-choose">
                    <button type="submit" name="deleteCategory" class="btn-yes js-category-btn-yes">Yes</button>
                    <div class="btn-no js-category-btn-no">No</div>
                </div>
            </div>
        </form>
    </div>';
    }
    ?>

    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["deleteCategory"])) {
            $sql2 = "DELETE FROM categories WHERE id = " . $_GET['iddelcategory'];
            if (mysqli_query($conn, $sql2)) {
                echo '<div id="toast-deleteCategory-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                    window.location = 'quanlytheloai.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
            } else {
                echo '<div id="toast-deleteCategory-error" class="toast-message"></div>';
            }
        }
    }
    ?>
    <script src="./js/script-form-category.js"></script>
    <script src="./js/script-message-category.js"></script>
    <script src="./js/script-check-category.js"></script>
    <script>
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
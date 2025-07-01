<?php
include "../config/connect.php";
include "../services/jewelry_service.php";

$jewelryService = new JewelryService();

// Pagination setup
$sql = "SELECT COUNT(*) as total FROM jewelries";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$pageRow = $row['total'];
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
    <title>Jewelry Management - Admin</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/multi-select-tag.css">
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
            <li class="active">
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
                <h2>Jewelry Management</h2>
            </div>
            <div class="user-info">
                <img src="../images_web/avatar.png" alt="avatar">
            </div>
        </div>
        <div class="table-wrapper">
            <div class="table-header">
                <h3 class="main-title">
                    Jewelry Information
                </h3>
                <div class="jewelry-search">
                    <input type="text" name="search" id="searchInput" class="jewelry-text-search" placeholder="Search jewelry...">
                    <i class="fa-solid fa-magnifying-glass" id="searchButton"></i>
                </div>
                <div class="add-jewelry js-add-jewelry"><i class="fa-solid fa-plus icon-add"></i>Add Jewelry</div>
            </div>
            <div class="table-container" name="jewelry-table">
                <table id="table-jewelry">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Material</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($page == "") {
                            $currentData = 0;
                        } else {
                            $currentData = ($page - 1) * 5;
                        }

                        if (isset($_GET['search'])) {
                            $searchTerm = trim($_GET['search']);
                            $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);
                            $jewelries = searchJewelries($searchTerm, $page);
                        } else {
                            $sql = "SELECT * FROM jewelries LIMIT " . $currentData . ", 5";
                            $result = mysqli_query($conn, $sql);
                            $jewelries = [];
                            if ($result && $result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $jewelries[] = $row;
                                }
                            }
                        }

                        foreach ($jewelries as $jewelry) {
                        ?>
                            <tr>
                                <td class="jewelry-id"><?php echo $jewelry['id'] ?></td>
                                <td class="jewelry-name"><?php echo $jewelry['name'] ?></td>
                                <td class="jewelry-price"><?php echo '$' . $jewelry['price'] ?></td>
                                <td class="jewelry-category"><?php echo isset($jewelry['category']) ? $jewelry['category'] : 'N/A' ?></td>
                                <td class="jewelry-material"><?php echo isset($jewelry['material']) ? $jewelry['material'] : 'N/A' ?></td>
                                <td class="jewelry-stock"><?php echo isset($jewelry['stock']) ? $jewelry['stock'] : 'N/A' ?></td>
                                <td>
                                    <?php if (isset($jewelry['image']) && $jewelry['image']): ?>
                                        <img src="../images_jewelry/<?php echo $jewelry['image'] ?>" alt="jewelry" class="jewelry-img">
                                    <?php else: ?>
                                        <span>No image</span>
                                    <?php endif; ?>
                                </td>
                                <td class="jewelry-description"><?php echo isset($jewelry['description']) ? $jewelry['description'] : '' ?></td>
                                <td>
                                    <a href="jewelry_management.php?page=<?php echo $page . "&idchangejewelry=" . $jewelry['id'] . "&formchangejewelry=1" ?>" class="fa-solid fa-pen icon-change js-changeJewelry"></a>
                                    <a href="jewelry_management.php?page=<?php echo $page . "&iddeljewelry=" . $jewelry['id'] . "&formdeljewelry=1" ?>" class="fas fa-trash icon-delete js-delete-jewelry"></a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="jewelry_management.php?page=<?php echo (($page - 1) > 0) ? ($page - 1) : 1 ?>&search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "") ?>" class="prev">Prev</a>
                    <?php
                    for ($i = 0; $i < $numPage; $i++) {
                    ?>
                        <a href="jewelry_management.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "") ?>&page=<?php echo ($i + 1) ?>" class="<?php echo ($page == $i + 1) ? "page-current" : "" ?>"> <?php echo ($i + 1) ?> </a>
                    <?php } ?>
                    <a href="jewelry_management.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "") ?>&page=<?php echo (($page + 1) <= $numPage) ? ($page + 1) : $numPage ?>" class="next">Next</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('searchInput');
            var searchButton = document.getElementById('searchButton');
            searchButton.addEventListener('click', function() {
                var searchTerm = searchInput.value;
                window.location.href = 'jewelry_management.php?search=' + encodeURIComponent(searchTerm);
            });
        });
    </script>

    <?php
    function searchJewelries($searchTerm, $page)
    {
        include "../config/connect.php";
        $currentData = ($page - 1) * 5;
        $stmt = $conn->prepare("SELECT * FROM jewelries WHERE name LIKE ? LIMIT ?, 5");

        // Thêm dấu % cho tìm kiếm với LIKE
        $searchTerm = "%" . $searchTerm . "%";

        // Gán giá trị và thực thi truy vấn
        $stmt->bind_param("si", $searchTerm, $currentData);
        $stmt->execute();
        $result = $stmt->get_result();
        $jewelries = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jewelries[] = $row;
            }
        }
        $stmt->close();

        return $jewelries;
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['formdeljewelry'])) {
        echo '<div class="modal-delete js-modal-deleteJewelry">
            <form class="modal-delete-container js-modal-deleteJewelry-container" method="post"
            action="jewelry_management.php?page=' . $page . '&iddeljewelry=' . (isset($_GET["iddeljewelry"]) ? $_GET["iddeljewelry"] : "") . '" enctype="multipart/form-data">

            <div class="modal-delete-close js-modal-deleteJewelry-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal-delete-body">
                <p>Do you want to delete this jewelry?</p>
                <div class="btn-delete-choose">
                    <button type="submit" name="deleteJewelry" class="btn-yes js-jewelry-btn-yes">Yes</button>
                    <div class="btn-no js-jewelry-btn-no">No</div>
                </div>
            </div>
        </form>
        </div>';
    }
    ?>

    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["deleteJewelry"])) {
            $jewelryService = new JewelryService();
            if ($jewelryService->deleteJewelry($_GET['iddeljewelry'])) {
                echo '<div id="toast-delete-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                        window.location = 'jewelry_management.php?page=" . $_GET['page'] . "';
                    }, 2000)</script>";
            } else {
                echo '<div id="toast-delete-error" class="toast-message"></div>';
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['idchangejewelry'])) {
        $idchange = $_GET['idchangejewelry'];
        $jewelryService = new JewelryService();
        $jewelry = $jewelryService->getJewelryById($idchange);
    }
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jewelryService = new JewelryService();

        if (isset($_POST["changeJewelry"])) {
            $data = [
                'name' => $_POST["changeJewelry-name"],
                'price' => $_POST["changeJewelry-price"]
            ];

            if ($jewelryService->updateJewelry($_GET["idchangejewelry"], $data)) {
                echo '<div id="toast-change-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                        window.location = 'jewelry_management.php?page=" . $_GET['page'] . "';
                    }, 2000)</script>";
            } else {
                echo '<div id="toast-change-error" class="toast-message"></div>';
            }
        }

        if (isset($_POST["addJewelry"])) {
            $data = [
                'name' => $_POST["addJewelry-name"],
                'price' => $_POST["addJewelry-price"]
            ];

            if ($jewelryService->createJewelry($data)) {
                echo '<div id="toast-add-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                        window.location = 'jewelry_management.php?page=" . $_GET['page'] . "';
                    }, 2000)</script>";
            } else {
                echo '<div id="toast-add-error" class="toast-message"></div>';
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['formchangejewelry']) && isset($jewelry)) {
        echo '<div class="modal modal-changeJewelry js-modal-changeJewelry">
            <form class="modal-container js-modal-changeJewelry-container" method="post" action="jewelry_management.php?page=' . $page . '&idchangejewelry=' . (isset($_GET["idchangejewelry"]) ? $_GET["idchangejewelry"] : "") . '" enctype="multipart/form-data">
                <div class="modal-close js-modal-changeJewelry-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
    
                <header class="modal-header modal-header-jewelry">
                    <i class="modal-heading-icon fa-solid fa-gem"></i>
                    Change Jewelry Information
                </header>
    
                <div class="modal-content">
                    <div class="modal-twoCol">
                        <label for="jewelry-name" class="modal-label">
                            Name
                            <input value="' . $jewelry["name"] . '" id="jewelry-name" type="text" class="js-changeJewelry-name modal-input" placeholder="Name..." name="changeJewelry-name" required>
                            <span class="name-changeJewelry-error check-error"></span>
                        </label>
                        
                        <label for="jewelry-price" class="modal-label">
                            Price
                            <input value="' . $jewelry["price"] . '" id="jewelry-price" type="number" class="js-changeJewelry-price modal-input" placeholder="Price..." min="1" step="0.01" name="changeJewelry-price" required>
                            <span class="price-changeJewelry-error check-error"></span>
                        </label>
                    </div>
                    
                    <div class="action-form">
                        <div class="cancel-jewelry js-cancel-jewelry">
                            Cancel
                        </div>
                        <button class="submit-jewelry js-save-changedJewelry" type="submit" name="changeJewelry">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>';
    }
    ?>

    <div class="modal js-modal-addJewelry">
        <form class="modal-container js-modal-addJewelry-container" method="post" action="jewelry_management.php" enctype="multipart/form-data">
            <div class="modal-close js-modal-addJewelry-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header modal-header-jewelry">
                <i class="modal-heading-icon fa-solid fa-gem"></i>
                Add Jewelry
            </header>

            <div class="modal-content">
                <div class="modal-twoCol">
                    <label for="jewelry-name" class="modal-label">
                        Name
                        <input id="jewelry-name" name="addJewelry-name" type="text" class="js-addJewelry-name modal-input" placeholder="Jewelry name..." required>
                        <span class="name-addJewelry-error check-error"></span>
                    </label>

                    <label for="jewelry-price" class="modal-label">
                        Price
                        <input id="jewelry-price" name="addJewelry-price" type="number" class="js-addJewelry-price modal-input" placeholder="Price..." min="1" step="0.01" required>
                        <span class="price-addJewelry-error check-error"></span>
                    </label>
                </div>

                <div class="action-form">
                    <div class="cancel-jewelry js-cancel-jewelry">
                        Cancel
                    </div>
                    <button class="submit-jewelry js-add-jewelry-btn" type="submit" name="addJewelry">
                        Add Jewelry
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Jewelry modal handlers
        document.addEventListener('DOMContentLoaded', function() {
            // Add jewelry modal
            const addJewelryBtn = document.querySelector('.js-add-jewelry');
            const addJewelryModal = document.querySelector('.js-modal-addJewelry');
            const addJewelryCloseBtn = document.querySelector('.js-modal-addJewelry-close');
            const addJewelryCancelBtn = document.querySelector('.js-cancel-jewelry');

            if (addJewelryBtn) {
                addJewelryBtn.addEventListener('click', function() {
                    addJewelryModal.style.display = 'flex';
                });
            }

            if (addJewelryCloseBtn) {
                addJewelryCloseBtn.addEventListener('click', function() {
                    addJewelryModal.style.display = 'none';
                });
            }

            if (addJewelryCancelBtn) {
                addJewelryCancelBtn.addEventListener('click', function() {
                    addJewelryModal.style.display = 'none';
                });
            }

            // Change jewelry modal
            const changeJewelryModal = document.querySelector('.js-modal-changeJewelry');
            const changeJewelryCloseBtn = document.querySelector('.js-modal-changeJewelry-close');

            if (changeJewelryCloseBtn) {
                changeJewelryCloseBtn.addEventListener('click', function() {
                    window.location.href = 'jewelry_management.php?page=<?php echo $page; ?>';
                });
            }

            // Delete jewelry modal handlers
            const deleteJewelryModal = document.querySelector('.js-modal-deleteJewelry');
            const deleteJewelryCloseBtn = document.querySelector('.js-modal-deleteJewelry-close');
            const deleteJewelryNoBtn = document.querySelector('.js-jewelry-btn-no');

            if (deleteJewelryCloseBtn) {
                deleteJewelryCloseBtn.addEventListener('click', function() {
                    window.location.href = 'jewelry_management.php?page=<?php echo $page; ?>';
                });
            }

            if (deleteJewelryNoBtn) {
                deleteJewelryNoBtn.addEventListener('click', function() {
                    window.location.href = 'jewelry_management.php?page=<?php echo $page; ?>';
                });
            }
        });

        function toastJewelry() {
            // Toast message handlers for jewelry
            const toastAddSuccess = document.getElementById('toast-add-success');
            const toastAddError = document.getElementById('toast-add-error');
            const toastDeleteSuccess = document.getElementById('toast-delete-success');
            const toastDeleteError = document.getElementById('toast-delete-error');
            const toastChangeSuccess = document.getElementById('toast-change-success');
            const toastChangeError = document.getElementById('toast-change-error');

            if (toastAddSuccess) {
                toastAddSuccess.innerHTML = 'Jewelry added successfully!';
                toastAddSuccess.style.display = 'block';
                setTimeout(() => toastAddSuccess.style.display = 'none', 3000);
            }
            if (toastAddError) {
                toastAddError.innerHTML = 'Error adding jewelry!';
                toastAddError.style.display = 'block';
                setTimeout(() => toastAddError.style.display = 'none', 3000);
            }
            if (toastDeleteSuccess) {
                toastDeleteSuccess.innerHTML = 'Jewelry deleted successfully!';
                toastDeleteSuccess.style.display = 'block';
                setTimeout(() => toastDeleteSuccess.style.display = 'none', 3000);
            }
            if (toastDeleteError) {
                toastDeleteError.innerHTML = 'Error deleting jewelry!';
                toastDeleteError.style.display = 'block';
                setTimeout(() => toastDeleteError.style.display = 'none', 3000);
            }
            if (toastChangeSuccess) {
                toastChangeSuccess.innerHTML = 'Jewelry updated successfully!';
                toastChangeSuccess.style.display = 'block';
                setTimeout(() => toastChangeSuccess.style.display = 'none', 3000);
            }
            if (toastChangeError) {
                toastChangeError.innerHTML = 'Error updating jewelry!';
                toastChangeError.style.display = 'block';
                setTimeout(() => toastChangeError.style.display = 'none', 3000);
            }
        }
        toastJewelry();
    </script>

</body>

</html>
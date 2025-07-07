<?php
include "../config/connect.php";
$sql = "SELECT * FROM users";
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
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            <li class="active">
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
            <li>
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
                <h2>Customers Managerment</h2>
            </div>
            <div class="user-info">
                <img src="../images_web/avatar.png" alt="avatar">
            </div>
        </div>
        <div class="table-wrapper">
            <div class="table-header table-header-customer">
                <h3 class="main-title">
                    Customer Infomation
                </h3>
                <div class="customer-search">
                    <input type="text" name="search" id="searchInput" class="customer-text-search" placeholder="Search...">
                    <i class="fa-solid fa-magnifying-glass" id="searchButton"></i>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
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
                        if (isset($_GET['search'])) {
                            $searchTerm = trim($_GET['search']);
                            $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);
                            $result = searchBooks($searchTerm, $page);
                        } else {
                            $sql = "SELECT * FROM users LIMIT " . $currentData . ", 5";
                            $result = mysqli_query($conn, $sql);
                        }
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td class="customer-id"><?php echo $row['id'] ?></td>
                                <td class="customer-name"><?php echo $row['username'] ?></td>
                                <td class="customer-birthday"><?php echo $row['date_of_birth'] ?></td>
                                <td class="customer-address"><?php echo $row['address'] ?></td>
                                <td class="customer-phone"><?php echo $row['phone_number'] ?></td>
                                <td class="customer-email"><?php echo $row['email'] ?></td>
                                <td>
                                    <a href="quanlykhachhang.php?page=<?php echo $page . "&idchangecustomer=" . $row['id'] . "&formchangecustomer=1" ?>" class="fa-solid fa-pen icon-change js-changeCustomer"></a>
                                    <a href="quanlykhachhang.php?page=<?php echo $page . "&iddelcustomer=" . $row['id'] . "&formdelcustomer=1" ?>" class="fas fa-trash icon-delete js-delete-customer"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="quanlykhachhang.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "") ?> &page=<?php echo (($page - 1) > 0) ? ($page - 1) : 1 ?>" class="prev">Prev</a>
                    <?php
                    for ($i = 0; $i < $numPage; $i++) {
                    ?>
                        <a href="quanlykhachhang.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "") ?> &page=<?php echo ($i + 1) ?>" class="<?php echo ($page == $i + 1) ? "page-current" : "" ?>"> <?php echo ($i + 1) ?> </a>
                    <?php } ?>
                    <a href="quanlykhachhang.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "") ?> &page=<?php echo (($page + 1) <= $numPage) ? ($page + 1) : $numPage ?>" class="next">Next</a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var searchInput = document.getElementById('searchInput');
                var searchButton = document.getElementById('searchButton');
                searchButton.addEventListener('click', function() {
                    var searchTerm = searchInput.value;
                    window.location.href = 'quanlykhachhang.php?search=' + encodeURIComponent(searchTerm);
                });
            });
        </script>

        <?php
        function searchBooks($searchTerm, $page)
        {
            include "../config/connect.php";
            $currentData = ($page - 1) * 5;
            $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? LIMIT ?, 5");

            // Thêm dấu % cho tìm kiếm với LIKE
            $searchTerm = "%" . $searchTerm . "%";

            // Gán giá trị và thực thi truy vấn
            $stmt->bind_param("si", $searchTerm, $currentData);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            return $result;
        }
        ?>

        <?php
        include "../config/connect.php";
        if (isset($_GET['idchangecustomer'])) {
            $idchange = $_GET['idchangecustomer'];
            $sql4 = "SELECT * FROM users WHERE id = " . $idchange;
            $query = mysqli_query($conn, $sql4);
            if ($query) {
                $row = mysqli_fetch_array($query);
            }
        }
        ?>

        <?php
        include "../config/connect.php";
        if (isset($_GET['formchangecustomer'])) {
            echo '<div class="modal js-modal-customer modal-change-customer">
            <form action="quanlykhachhang.php?page=' . $page . '&idchangecustomer=' . (isset($_GET["idchangecustomer"]) ? $_GET["idchangecustomer"] : "") . '" method="post" class="modal-container js-modalCustomer-container modal-container-customer" enctype="multipart/form-data">
                <div class="modal-close js-modalCustomer-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
    
                <header class="modal-header">
                    <i class="modal-heading-icon fa-solid fa-user"></i>
                    Change Customer Information
                </header>
    
                <div class="modal-content">
                    <div class="modal-twoCol">
                        <label for="customer-name" class="modal-label" style="display: none;">
                            ID
                            <input value="' . $row["id"] . '" name="changeCustomer-id" id="customer-id" type="text" class="js-customer-id modal-input modal-input-customer" placeholder="ID..." required>
                        </label>
                        <label for="customer-name" class="modal-label">
                            Name
                            <input value="' . $row["username"] . '" name="changeCustomer-name" id="customer-name" type="text" class="js-customer-name modal-input modal-input-customer" placeholder="Name..." required>
                            <span class="name-changeCustomer-error check-error"></span>
                        </label>
    
                        <label for="customer-birthday" class="modal-label">
                            Date of birth
                            <input value="' . $row["date_of_birth"] . '" name="changeCustomer-birthday" id="customer-birthday" type="date" class="js-customer-birthday modal-input modal-input-customer" required>
                            <span class="birthday-changeCustomer-error check-error"></span>
                        </label>
        
                        <label for="customer-email" class="modal-label">
                            Email
                            <input value="' . $row["email"] . '" name="changeCustomer-email" id="customer-email" type="email" class="js-customer-email modal-input modal-input-customer" placeholder="Email..." required>
                            <span class="email-changeCustomer-error check-error"></span>
                        </label>
        
                        <label for="customer-phone" class="modal-label">
                            Phone
                            <input value="' . $row["phone"] . '" name="changeCustomer-phone" id="customer-phone" type="text" class="js-customer-phone modal-input modal-input-customer" placeholder="Phone..." required>
                            <span class="phone-changeCustomer-error check-error"></span>
                        </label>
                    </div>
                    <div class="modal-col">
                        <label for="customer-address" class="modal-label">
                            Address
                            <input value="' . $row["address"] . '" name="changeCustomer-address" id="customer-address" type="text" class="js-customer-address modal-input modal-input-customer" placeholder="Address..." required>
                            <span class="address-changeCustomer-error check-error"></span>
                        </label>
                    </div>
                    <div class="action-form">
                        <div class="cancel-book js-cancel-customer">
                            Cancel
                        </div>
                        <button name="changeCustomer" class="submit-book js-change-customer" type="submit" onclick="checkChangeCustomer()">
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
            if (isset($_POST["changeCustomer"])) {
                $idCustomer = $_POST["changeCustomer-id"];
                $nameCustomer = $_POST["changeCustomer-name"];
                $birthdayCustomer = $_POST["changeCustomer-birthday"];
                $emailCustomer = $_POST["changeCustomer-email"];
                $phoneCustomer = $_POST["changeCustomer-phone"];
                $addressCustomer = $_POST["changeCustomer-address"];
                $isDuplicate = false;
                $sql2 = "SELECT * FROM users";
                $names = mysqli_query($conn, $sql2);
                while ($customer = mysqli_fetch_array($names)) {
                    if ($customer["email"] == $emailCustomer && $customer["id"] != $idCustomer) {
                        echo '<div id="toast-changeNameCustomer-error" class="toast-message"></div>';
                        $isDuplicate = true;
                        break;
                    }
                }
                if (!$isDuplicate) {
                    if ($_GET["idchangecustomer"]) {
                        $sql1 = "UPDATE users SET username = '$nameCustomer', date_of_birth = '$birthdayCustomer', address = '$addressCustomer', 
                        phone = '$phoneCustomer', email = '$emailCustomer' WHERE id = " . $_GET["idchangecustomer"];
                        if (mysqli_query($conn, $sql1)) {
                            echo '<div id="toast-changeCustomer-success" class="toast-message"></div>';
                            echo "<script>setTimeout(function(){
                                window.location = 'quanlykhachhang.php?page=" . $_GET['page'] . "';
                            }, 2000)</script>";
                        } else {
                            echo '<div id="toast-changeCustomer-error" class="toast-message"></div>';
                        }
                    }
                }
            }
        }
        ?>

        <?php
        include "../config/connect.php";
        if (isset($_GET['formdelcustomer'])) {
            echo '<div class="modal-delete js-modal-deleteCustomer">
        <form class="modal-delete-container js-modal-deleteCustomer-container" method="post" action="quanlykhachhang.php?page=' . $page . '&iddelcustomer=' . (isset($_GET["iddelcustomer"]) ? $_GET["iddelcustomer"] : "") . '" enctype="multipart/form-data">
            <div class="modal-delete-close js-modal-deleteCustomer-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal-delete-body">
                <p>Do you want to delete customer?</p>
                <div class="btn-delete-choose">
                    <button type="submit" name="deleteCustomer" class="btn-yes js-customer-btn-yes">Yes</button>
                    <div class="btn-no js-customer-btn-no">No</div>
                </div>
            </div>
        </form>
    </div>';
        }
        ?>

        <?php
        include "../config/connect.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["deleteCustomer"])) {
                $sql2 = "DELETE FROM users WHERE id = " . $_GET['iddelcustomer'];
                if (mysqli_query($conn, $sql2)) {
                    echo '<div id="toast-deleteCustomer-success" class="toast-message"></div>';
                    echo "<script>setTimeout(function(){
                    window.location = 'quanlykhachhang.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
                } else {
                    echo '<div id="toast-deleteCustomer-error" class="toast-message"></div>';
                }
            }
        }
        ?>

        <script src="./js/script-form-qlkh.js"></script>
        <script src="./js/script-message-customer.js"></script>
        <script src="./js/script-check-changeCustomer.js"></script>
        <script>
            function toastCustomer() {
                toastChangeCustomerSuccess();
                toastChangeCustomerError();
                toastDeleteCustomerSuccess();
                toastDeleteCustomerError();
                toastNameCustomerError();
            }
            toastCustomer();
        </script>
</body>

</html>
<?php
include "../config/connect.php";
$sql = "SELECT * FROM users WHERE is_deleted = 0";
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
    <link rel="icon" type="image/x-icon" href="data:;base64,iVBORw0KGgo=">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            $sql = "SELECT * FROM users WHERE is_deleted = 0 LIMIT " . $currentData . ", 5";
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
                                    <a href="#"
                                        class="fa-solid fa-pen icon-change edit-customer-btn"
                                        data-customer-id="<?php echo $row['id'] ?>">
                                    </a>
                                    <a href="#"
                                        class="fas fa-trash icon-delete delete-customer-btn"
                                        data-customer-id="<?php echo $row['id'] ?>">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php
                        function searchBooks($searchTerm, $page)
                        {
                            include "../config/connect.php";
                            $currentData = ($page - 1) * 5;
                            $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? AND is_deleted = 0 LIMIT ?, 5");

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

        <!-- Edit Customer Modal -->
        <div id="editCustomerModal" class="modal js-modal-customer modal-change-customer" style="display: none;">
            <div class="modal-container js-modalCustomer-container modal-container-customer">
                <div class="modal-close js-modalCustomer-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>

                <header class="modal-header">
                    <i class="modal-heading-icon fa-solid fa-user"></i>
                    Edit Customer Information
                </header>

                <div class="modal-content">
                    <form id="editCustomerForm">
                        <input type="hidden" id="editCustomerId" name="id">

                        <div class="modal-twoCol">
                            <label for="editCustomerName" class="modal-label">
                                Name
                                <input name="username" id="editCustomerName" type="text" class="modal-input modal-input-customer" placeholder="Name..." required>
                                <span class="name-changeCustomer-error check-error"></span>
                            </label>

                            <label for="editCustomerBirthday" class="modal-label">
                                Date of birth
                                <input name="date_of_birth" id="editCustomerBirthday" type="date" class="modal-input modal-input-customer" required>
                                <span class="birthday-changeCustomer-error check-error"></span>
                            </label>

                            <label for="editCustomerEmail" class="modal-label">
                                Email
                                <input name="email" id="editCustomerEmail" type="email" class="modal-input modal-input-customer" placeholder="Email..." required>
                                <span class="email-changeCustomer-error check-error"></span>
                            </label>

                            <label for="editCustomerPhone" class="modal-label">
                                Phone
                                <input name="phone_number" id="editCustomerPhone" type="text" class="modal-input modal-input-customer" placeholder="Phone..." required>
                                <span class="phone-changeCustomer-error check-error"></span>
                            </label>
                        </div>

                        <div class="modal-col">
                            <label for="editCustomerAddress" class="modal-label">
                                Address
                                <input name="address" id="editCustomerAddress" type="text" class="modal-input modal-input-customer" placeholder="Address..." required>
                                <span class="address-changeCustomer-error check-error"></span>
                            </label>
                        </div>

                        <div class="action-form">
                            <div class="cancel-book js-cancel-customer">
                                Cancel
                            </div>
                            <button type="submit" class="submit-book js-change-customer">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Customer Modal -->
        <div id="deleteCustomerModal" class="modal-delete js-modal-deleteCustomer" style="display: none;">
            <div class="modal-delete-container js-modal-deleteCustomer-container">
                <div class="modal-delete-close js-modal-deleteCustomer-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="modal-delete-body">
                    <p>Do you want to delete this customer?</p>
                    <div class="btn-delete-choose">
                        <button type="button" id="confirmDeleteCustomer" class="btn-yes js-customer-btn-yes">Yes</button>
                        <div class="btn-no js-customer-btn-no">No</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Messages -->
        <div id="toast-customer-success" class="toast-message" style="display: none;"></div>
        <div id="toast-customer-error" class="toast-message" style="display: none;"></div>

        <script>
            $(document).ready(function() {
                let currentCustomerId = null;

                // Search functionality
                $('#searchInput').on('keypress', function(e) {
                    if (e.which === 13) {
                        performSearch();
                    }
                });

                $('#searchButton').on('click', function() {
                    performSearch();
                });

                function performSearch() {
                    var searchTerm = $('#searchInput').val();
                    window.location.href = 'quanlykhachhang.php?search=' + encodeURIComponent(searchTerm);
                }

                // Edit customer
                $('.edit-customer-btn').on('click', function(e) {
                    e.preventDefault();
                    currentCustomerId = $(this).data('customer-id');
                    loadCustomerData(currentCustomerId);
                });

                function loadCustomerData(customerId) {
                    $.post('customer_operations.php', {
                        action: 'get',
                        id: customerId
                    }, function(response) {
                        if (response.success) {
                            const customer = response.data;
                            $('#editCustomerId').val(customer.id);
                            $('#editCustomerName').val(customer.username);
                            $('#editCustomerBirthday').val(customer.date_of_birth);
                            $('#editCustomerEmail').val(customer.email);
                            $('#editCustomerPhone').val(customer.phone_number);
                            $('#editCustomerAddress').val(customer.address);
                            $('#editCustomerModal').show();
                        } else {
                            showToast(response.message, 'error');
                        }
                    }, 'json');
                }

                // Submit edit form
                $('#editCustomerForm').on('submit', function(e) {
                    e.preventDefault();

                    const formData = {
                        action: 'update',
                        id: $('#editCustomerId').val(),
                        username: $('#editCustomerName').val(),
                        date_of_birth: $('#editCustomerBirthday').val(),
                        email: $('#editCustomerEmail').val(),
                        phone_number: $('#editCustomerPhone').val(),
                        address: $('#editCustomerAddress').val()
                    };

                    $.post('customer_operations.php', formData, function(response) {
                        if (response.success) {
                            showToast(response.message, 'success');
                            $('#editCustomerModal').hide();
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast(response.message, 'error');
                        }
                    }, 'json');
                });

                // Delete customer
                $('.delete-customer-btn').on('click', function(e) {
                    e.preventDefault();
                    currentCustomerId = $(this).data('customer-id');
                    $('#deleteCustomerModal').show();
                });

                $('#confirmDeleteCustomer').on('click', function() {
                    $.post('customer_operations.php', {
                        action: 'delete',
                        id: currentCustomerId
                    }, function(response) {
                        if (response.success) {
                            showToast(response.message, 'success');
                            $('#deleteCustomerModal').hide();
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast(response.message, 'error');
                        }
                    }, 'json');
                });

                // Close modals
                $('.js-modalCustomer-close, .js-cancel-customer').on('click', function() {
                    $('#editCustomerModal').hide();
                });

                $('.js-modal-deleteCustomer-close, .js-customer-btn-no').on('click', function() {
                    $('#deleteCustomerModal').hide();
                });

                // Close modal when clicking outside
                $('.modal, .modal-delete').on('click', function(e) {
                    if (e.target === this) {
                        $(this).hide();
                    }
                });

                function showToast(message, type) {
                    const toastId = type === 'success' ? '#toast-customer-success' : '#toast-customer-error';
                    $(toastId).text(message).show();
                    setTimeout(() => {
                        $(toastId).hide();
                    }, 3000);
                }
            });
        </script>

</body>

</html>
<?php
include "../config/connect.php";

// Xử lý phân trang
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$limit = 5;
include "../config/connect.php";
$sql = "SELECT * FROM orders";
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
            <li>
                <a href="./quanlykhachhang.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li class="active">
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
                <h2>Orders Managerment</h2>
            </div>
            <div class="user-info">
                <img src="../images_web/avatar.png" alt="avatar">
            </div>
        </div>
        <div class="table-wrapper">
            <h3 class="main-title">
                Orders awaiting
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order date</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Phone_number</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Notes</th>
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
                        $sql = "SELECT * FROM orders LIMIT " . $currentData . ", 5";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $date_order = $row['created_at'];
                            $notes = $row['notes'];
                            $sql_address = "SELECT address FROM users WHERE id = " . $row['id'];
                            $address_result = mysqli_query($conn, $sql_address);
                            $address_row = mysqli_fetch_array($address_result);
                            $address = $address_row['address'];
                            $sql_name = "SELECT fullname FROM users WHERE id = " . $row['id'];
                            $name_result = mysqli_query($conn, $sql_name);
                            $name_row = mysqli_fetch_array($name_result);
                            $name = $name_row['fullname'];
                            $sql_phone_number = "SELECT phone_number FROM users WHERE id = " . $row['id'];
                            $phone_number_result = mysqli_query($conn, $sql_phone_number);
                            $phone_number_row = mysqli_fetch_array($phone_number_result);
                            $phone_number = $phone_number_row['phone_number'];
                            $sql_sumprice = "SELECT SUM(order_details.quantity * jewelries.price) as totalprice 
                            FROM jewelries 
                            INNER JOIN order_details ON jewelries.id = order_details.jewelry_id 
                            WHERE order_details.order_id = " . $row['id'];
                            $sumprice_result = mysqli_query($conn, $sql_sumprice);
                            $sumprice_row = mysqli_fetch_array($sumprice_result);
                            $sumprice = $sumprice_row['totalprice'];
                            $status = $row['status'];
                            $sql_namejewelry = "SELECT jewelries.name as name_jewelry 
                            FROM jewelries 
                            INNER JOIN order_details ON jewelries.id = order_details.jewelry_id 
                            WHERE order_details.order_id = " . $row['id'] . " 
                            LIMIT 1";
                            $namejewelry_result = mysqli_query($conn, $sql_namejewelry);
                            $namejewelry_row = mysqli_fetch_array($namejewelry_result);
                            $namejewelry = $namejewelry_row['name_jewelry'];
                        ?>
                            <tr>
                                <td class="order-id"><?php echo $id ?></td>
                                <td class="order-date"><?php echo $date_order ?></td>
                                <td class="order-name"><?php echo $name ?></td>
                                <td class="order-address"><?php echo $address ?></td>
                                <td class="order-phone_number"><?php echo $phone_number ?></td>
                                <td class="order-price"><?php echo $sumprice ?>VND</td>
                                <td class="order-status <?php echo $status ?>"><?php echo $status ?></td>
                                <td class="order-notes"><?php echo $notes ?></td>
                                <td>
                                    <a <?php echo ($status === 'đã hủy' || $status === 'hoàn tất') ?
                                            "href='quanlyhoadon.php?page={$page}&iddeleteorder={$id}&formdeleteorder=1&status={$status}'" :
                                            "href='quanlyhoadon.php?page={$page}&formcantdeleteorder=1'" ?>
                                        class="fas fa-trash icon-delete js-delete-order">
                                    </a>
                                    <a href="#"
                                        class="fa-regular fa-eye icon-detail js-detail-order"
                                        data-order-id="<?php echo $id ?>"
                                        data-status="<?php echo $status ?>"
                                        onclick="showOrderDetail(<?php echo $id ?>, '<?php echo $status ?>')">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="quanlyhoadon.php?page=<?php echo (($page - 1) > 0) ? ($page - 1) : 1 ?>" class="prev">Prev</a>
                    <?php
                    for ($i = 0; $i < $numPage; $i++) {
                    ?>
                        <a href="quanlyhoadon.php?page=<?php echo ($i + 1) ?>" class="<?php echo ($page == $i + 1) ? "page-current" : "" ?>"> <?php echo ($i + 1) ?> </a>
                    <?php } ?>
                    <a href="quanlyhoadon.php?page=<?php echo (($page + 1) <= $numPage) ? ($page + 1) : $numPage ?>" class="next">Next</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal template cho Order Detail -->
    <div class="modal js-modal-order-detail modal-order" style="display: none;">
        <div class="modal-container js-modal-order-detail-container">
            <div class="modal-close js-modal-order-detail-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header modal-header-books">
                <i class="modal-heading-icon fa-solid fa-book"></i>
                Order Detail
            </header>

            <div class="modal-content">
                <div class="modal-col header-order">
                    <label class="modal-label-order">Date Order: </label>
                    <p class="orderDetails-date"></p>
                </div>

                <div class="modal-col header-order">
                    <label class="modal-label-order">Order ID: </label>
                    <p class="orderDetails-id"></p>
                </div>

                <div class="modal-col content-order">
                    <label class="modal-label-order">Customer Name: </label>
                    <p class="orderDetails-name"></p>
                </div>

                <div class="modal-col content-order">
                    <label class="modal-label-order">Address: </label>
                    <p class="orderDetails-address"></p>
                </div>

                <div class="modal-col content-order">
                    <label class="modal-label-order">Phone Number: </label>
                    <p class="orderDetails-phone_number"></p>
                </div>

                <div class="modal-col content-order">
                    <label class="modal-label-order">Notes: </label>
                    <p class="orderDetails-notes"></p>
                </div>

                <div class="modal-col">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Jewelry Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-tbody">
                                <!-- Dynamic content will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-col content-order order-totals">
                    <label class="modal-label-order">Totals: </label>
                    <p class="orderDetails-totals"></p>
                </div>

                <div class="action-form">
                    <!-- Action buttons will be added dynamically based on status -->
                </div>
            </div>
        </div>
    </div>

    <?php
    include "../config/connect.php";
    if (isset($_GET['confirmApprove'])) {
        echo '<div class="modal-delete js-modal-confirmApprove" style="display:flex">
    <form class="modal-delete-container js-modal-confirmApprove-container" method="post"
    action="quanlyhoadon.php?page=' . $page . '&iddetailorder=' . (isset($_GET["iddetailorder"]) ? $_GET["iddetailorder"] : "") . '" enctype="multipart/form-data">
        <div class="modal-delete-close js-modal-confirmApprove-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="modal-delete-body">
            <p>Do you want to approve order?</p>
            <div class="btn-delete-choose">
                <button type=submit name="approveOrder" class="btn-yes js-confirmApprove-btn-yes">
                    Yes
                </button>
                <div class="btn-no js-confirmApprove-btn-no">
                    <a href="#">No</a>
                </div>
            </div>
        </div>
    </form>
</div>';
    }
    ?>

    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["approveOrder"])) {
            $sql2 = "UPDATE order_books SET status = 'Delivering' WHERE id = " . $_GET['iddetailorder'];
            if (mysqli_query($conn, $sql2)) {
                echo '<div id="toast-approve-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                    window.location = 'quanlyhoadon.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
            } else {
                echo '<div id="toast-approve-error" class="toast-message"></div>';
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['confirmCancelled'])) {
        echo '<div class="modal-delete js-modal-confirmCancelled" style="display:flex">
    <form class="modal-delete-container js-modal-confirmCancelled-container" method="post"
    action="quanlyhoadon.php?page=' . $page . '&iddetailorder=' . (isset($_GET["iddetailorder"]) ? $_GET["iddetailorder"] : "") . '" enctype="multipart/form-data">
        <div class="modal-delete-close js-modal-confirmCancelled-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="modal-delete-body">
            <p>Do you want to cancelled order?</p>
            <div class="btn-delete-choose">
                <button type=submit name="cancelledOrder" class="btn-yes js-confirmCancelled-btn-yes">
                    Yes
                </button>
                <div class="btn-no js-confirmCancelled-btn-no">
                    <a href="#">No</a>
                </div>
            </div>
        </div>
    </form>
</div>';
    }
    ?>

    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["cancelledOrder"])) {
            $sql3 = "UPDATE book
            JOIN order_details ON book.id_book = order_details.id_book
            JOIN order_books ON order_details.id = order_books.id
            SET book.quantity = book.quantity + order_details.total_amount
            WHERE order_books.id = " . $_GET['iddetailorder'];
            $sql2 = "UPDATE order_books SET status = 'Cancelled' WHERE id = " . $_GET['iddetailorder'];
            if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
                echo '<div id="toast-cancelled-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                    window.location = 'quanlyhoadon.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
            } else {
                echo '<div id="toast-cancelled-error" class="toast-message"></div>';
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['confirmComplete'])) {
        echo '<div class="modal-delete js-modal-confirmComplete" style="display:flex">
    <form class="modal-delete-container js-modal-confirmComplete-container" method="post"
    action="quanlyhoadon.php?page=' . $page . '&iddetailorder=' . (isset($_GET["iddetailorder"]) ? $_GET["iddetailorder"] : "") . '" enctype="multipart/form-data">
        <div class="modal-delete-close js-modal-confirmComplete-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="modal-delete-body">
            <p>Do you want to complete order?</p>
            <div class="btn-delete-choose">
                <button type=submit name="completeOrder" class="btn-yes js-confirmComplete-btn-yes">
                    Yes
                </button>
                <div class="btn-no js-confirmComplete-btn-no">
                    <a href="#">No</a>
                </div>
            </div>
        </div>
    </form>
</div>';
    }
    ?>

    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["completeOrder"])) {
            $sql2 = "UPDATE order_books SET status = 'Complete' WHERE id = " . $_GET['iddetailorder'];
            if (mysqli_query($conn, $sql2)) {
                echo '<div id="toast-completeOrder-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                    window.location = 'quanlyhoadon.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
            } else {
                echo '<div id="toast-completeOrder-error" class="toast-message"></div>';
            }
        }
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['formcantdeleteorder'])) {
        echo '<div id="toast-deleteOrder-error" class="toast-message"></div>';
        echo "<script>setTimeout(function(){
        window.location = 'quanlyhoadon.php?page=" . $_GET['page'] . "';
    }, 2000)</script>";
    }
    ?>

    <?php
    include "../config/connect.php";
    if (isset($_GET['formdeleteorder'])) {
        echo '<div class="modal-delete js-modal-deleteOrder" style="display:flex">
    <form class="modal-delete-container js-modal-deleteOrder-container" method="post"
    action="quanlyhoadon.php?page=' . $page . '&iddeleteorder=' . (isset($_GET["iddeleteorder"]) ? $_GET["iddeleteorder"] : "") . '" enctype="multipart/form-data">
        <div class="modal-delete-close js-modal-deleteOrder-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="modal-delete-body">
            <p>Do you want to delete order?</p>
            <div class="btn-delete-choose">
                <button type=submit name="deleteOrder" class="btn-yes js-order-btn-yes">
                    Yes
                </button>
                <div class="btn-no js-order-btn-no">
                    <a href="#">No</a>
                </div>
            </div>
        </div>
    </form>
</div>';
    }
    ?>

    <?php
    include "../config/connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["deleteOrder"])) {
            $sql2 = "DELETE FROM order_books WHERE id = " . $_GET['iddeleteorder'];
            if (mysqli_query($conn, $sql2)) {
                echo '<div id="toast-deleteOrder-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                    window.location = 'quanlyhoadon.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
            } else {
                echo '<div id="toast-cancelled-error" class="toast-message"></div>';
            }
        }
    }
    ?>

    <div id="toast"></div>
    <script>
        function showSuccessToast(title, message, type) {
            toast({
                title: title,
                message: message,
                type: type,
                duration: 5000
            });
        }

        // Function to show order detail modal
        function showOrderDetail(orderId, status) {
            // Show modal
            const modal = document.querySelector('.js-modal-order-detail');
            modal.style.display = 'flex';

            // Load order details via AJAX
            loadOrderDetails(orderId, status);
        }

        // Function to load order details
        function loadOrderDetails(orderId, status) {
            fetch(`get_order_details.php?id=${orderId}&status=${status}`)
                .then(response => response.json())
                .then(data => {
                    // Update modal content
                    document.querySelector('.orderDetails-date').textContent = data.date;
                    document.querySelector('.orderDetails-id').textContent = data.id;
                    document.querySelector('.orderDetails-name').textContent = data.name;
                    document.querySelector('.orderDetails-address').textContent = data.address;
                    document.querySelector('.orderDetails-phone_number').textContent = data.phone_number;
                    document.querySelector('.orderDetails-notes').textContent = data.notes;
                    document.querySelector('.orderDetails-totals').textContent = data.total + '$';

                    // Update order items table
                    const tbody = document.querySelector('.order-details-tbody');
                    tbody.innerHTML = '';
                    data.items.forEach(item => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${item.jewelry_name}</td>
                                <td>${item.category_name}</td>
                                <td>${item.quantity}</td>
                                <td>${item.price}$</td>
                                <td>${item.subtotal}$</td>
                            </tr>
                        `;
                    });

                    // Update action buttons based on status
                    updateActionButtons(orderId, status);
                })
                .catch(error => {
                    console.error('Error loading order details:', error);
                });
        }

        // Function to update action buttons
        function updateActionButtons(orderId, status) {
            const actionForm = document.querySelector('.action-form');

            if (status === 'chờ xác nhận') {
                actionForm.innerHTML = `
                    <a href="quanlyhoadon.php?page=<?php echo $page ?>&iddetailorder=${orderId}&confirmCancelled=1" 
                       class="cancel-book js-cancelled-order">Cancelled</a>
                    <a href="quanlyhoadon.php?page=<?php echo $page ?>&iddetailorder=${orderId}&confirmApprove=1" 
                       class="submit-book js-approve-order">Approve</a>
                `;
            } else if (status === 'đã giao hàng') {
                actionForm.innerHTML = `
                    <a href="quanlyhoadon.php?page=<?php echo $page ?>&iddetailorder=${orderId}&confirmComplete=1" 
                       class="submit-book js-complete-order">Complete</a>
                `;
            } else {
                actionForm.innerHTML = ''; // No actions for completed/cancelled orders
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Close modal when clicking X
            const closeBtn = document.querySelector('.js-modal-order-detail-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    document.querySelector('.js-modal-order-detail').style.display = 'none';
                });
            }

            // Close modal when clicking outside
            const modal = document.querySelector('.js-modal-order-detail');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <script src="./js/script-form-hoadon.js"></script>
    <script src="./js/script-message-order.js"></script>
    <script>
        function toastOrder() {
            toastApproveSuccess();
            toastApproveError();
            toastCancelledSuccess();
            toastCancelledError();
            toastDeleteOrderSuccess();
            toastDeleteOrderError();
            toastCompleteOrderSuccess();
            toastCompleteOrderError();
        }
        toastOrder();
    </script>
</body>

</html>
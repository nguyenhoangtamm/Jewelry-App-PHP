<?php
    include "connect.php";
    $sql = "SELECT * FROM order_books";
    $result = mysqli_query($conn, $sql);
    $pageRow = $result->num_rows;
    $numPage = ceil($pageRow/5);
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }else{
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
                <a href="./trangchu.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./quanlysach.php">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span>
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
                <a href="./quanlytacgia.php">
                    <i class="fa-solid fa-feather"></i>
                    <span>Author</span>
                </a>
            </li>
            <li>
                <a href="./quanlytheloai.php">
                    <i class="fa-solid fa-rectangle-list"></i>
                    <span>Category</span>
                </a>
            </li>
            <li  class="logout">
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
                                <th>Phone</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include "connect.php";
                            if($page==""){
                                $currentData = 0;
                            }
                            else{
                                $currentData = ($page-1)*5;
                            }
                            $sql = "SELECT * FROM order_books LIMIT " . $currentData . ", 5";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $id_order = $row['id_order'];
                                $date_order = $row['order_date'];
                                $notes = $row['notes'];
                                $sql_address = "SELECT address FROM customer WHERE id_customer = " . $row['id_customer'];
                                $address_result = mysqli_query($conn, $sql_address);
                                $address_row = mysqli_fetch_array($address_result);
                                $address = $address_row['address'];
                                $sql_name = "SELECT name_customer FROM customer WHERE id_customer = " . $row['id_customer'];
                                $name_result = mysqli_query($conn, $sql_name);
                                $name_row = mysqli_fetch_array($name_result);
                                $name = $name_row['name_customer'];
                                $sql_phone = "SELECT phone FROM customer WHERE id_customer = " . $row['id_customer'];
                                $phone_result = mysqli_query($conn, $sql_phone);
                                $phone_row = mysqli_fetch_array($phone_result);
                                $phone = $phone_row['phone'];
                                $sql_sumprice = "SELECT SUM(order_details.quantity * book.price) as totalprice FROM book, order_details, order_books WHERE book.id_book = order_details.id_book and order_details.id_order = order_books.id_order and order_books.id_order = ". $row['id_order'];
                                $sumprice_result = mysqli_query($conn, $sql_sumprice);
                                $sumprice_row = mysqli_fetch_array($sumprice_result);
                                $sumprice = $sumprice_row['totalprice'];
                                $status = $row['status'];
                                $sql_namebook = "SELECT name_book as name_book FROM book, order_details, order_books WHERE book.id_book = order_details.id_book and order_details.id_order = order_books.id_order and order_books.id_order = ". $row['id_order'];
                                $namebook_result = mysqli_query($conn, $sql_namebook);
                                $namebook_row = mysqli_fetch_array($namebook_result);
                                $namebook = $namebook_row['name_book'];
                            ?>
                            <tr>
                                <td class="order-id"><?php echo $id_order ?></td>
                                <td class="order-date"><?php echo $date_order ?></td>
                                <td class="order-name"><?php echo $name ?></td>
                                <td class="order-address"><?php echo $address ?></td>
                                <td class="order-phone"><?php echo $phone ?></td>
                                <td class="order-price"><?php echo $sumprice ?>$</td>
                                <td class="order-status <?php echo $status ?>"><?php echo $status ?></td>
                                <td class="order-notes"><?php echo $notes ?></td>
                                <td>
                                    <a <?php echo ($status === 'Cancelled' || $status === 'Complete') ? "href='quanlyhoadon.php?page={$page}&iddeleteorder={$id_order}&formdeleteorder=1&status={$status}'" : "href='quanlyhoadon.php?page={$page}&formcantdeleteorder=1'"?> class="fas fa-trash icon-delete js-delete-order"></a>
                                    <a href="quanlyhoadon.php?page=<?php echo $page . "&iddetailorder=" . $id_order . "&formdetailorder=1&status=".$status ?>" class="fa-regular fa-eye icon-detail js-detail-order"></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <a href="quanlyhoadon.php?page=<?php echo (($page -1)>0) ? ($page-1) : 1?>" class="prev">Prev</a>
                        <?php
                            for($i=0; $i<$numPage; $i++){
                            ?>
                                <a href="quanlyhoadon.php?page=<?php echo ($i+1)?>" class="<?php echo ($page==$i+1) ? "page-current" : ""?>"> <?php echo ($i+1)?> </a>
                            <?php } ?>
                        <a href="quanlyhoadon.php?page=<?php echo (($page + 1)<=$numPage) ? ($page+1) : $numPage?>" class="next">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include "connect.php";
if(isset($_GET['formdetailorder']) && $_GET['status'] === 'New') {
    $total = 0;
    $sql_date = "SELECT order_date FROM order_books WHERE id_order = " . $_GET['iddetailorder'];
    $date_result = mysqli_query($conn, $sql_date);
    $date_row = mysqli_fetch_array($date_result);
    $date = $date_row['order_date'];
    $sql_name = "SELECT name_customer FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $name_result = mysqli_query($conn, $sql_name);
    $name_row = mysqli_fetch_array($name_result);
    $name = $name_row['name_customer'];
    $sql_address = "SELECT address FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $address_result = mysqli_query($conn, $sql_address);
    $address_row = mysqli_fetch_array($address_result);
    $address = $address_row['address'];
    $sql_phone = "SELECT phone FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $phone_result = mysqli_query($conn, $sql_phone);
    $phone_row = mysqli_fetch_array($phone_result);
    $phone = $phone_row['phone'];
    $sql_notes = "SELECT notes FROM order_books WHERE id_order = " . $_GET['iddetailorder'];
    $notes_result = mysqli_query($conn, $sql_notes);
    $notes_row = mysqli_fetch_array($notes_result);
    $notes = $notes_row['notes'];
    echo '<div class="modal js-modal-dOrder-new modal-order">
            <form class="modal-container js-modal-dOrder-new-container">
                <div class="modal-close js-modal-dOrder-new-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
    
                <header class="modal-header modal-header-books">
                    <i class="modal-heading-icon fa-solid fa-book"></i>
                    Order Detail
                </header>
    
                <div class="modal-content">
                    <div class="modal-col header-order">
                        <label for="" class="modal-label-order">Date Order: </label>
                        <p class="orderDetails-date">'.$date.'</p>
                    </div>
    
                    <div class="modal-col header-order">
                        <label for="" class="modal-label-order">Order ID: </label>
                        <p class="orderDetails-id">'.$_GET["iddetailorder"].'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Customer Name: </label>
                        <p class="orderDetails-name">'.$name.'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Address: </label>
                        <p class="orderDetails-address">'.$address.'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Phone: </label>
                        <p class="orderDetails-phone">'.$phone.'</p>
                    </div>

                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Notes: </label>
                        <p class="orderDetails-notes">'.$notes.'</p>
                    </div>
    
                    <div class="modal-col">
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>';

    $sql = "SELECT * FROM order_details WHERE id_order = " . $_GET["iddetailorder"];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sql2 = "SELECT name_book, price FROM book, order_books, order_details 
                 WHERE book.id_book = ". $row['id_book'] ." 
                 AND order_details.id_order = order_books.id_order 
                 AND order_books.id_order = " . $row['id_order'];
        $result_namebook = mysqli_query($conn, $sql2);
        $row_namebook = mysqli_fetch_array($result_namebook);

        $sql3 = "SELECT name_category FROM book, order_books, order_details, category 
                 WHERE book.id_book = ". $row['id_book'] ." 
                 AND order_details.id_order = order_books.id_order 
                 AND order_books.id_order = " . $row['id_order'] ." AND book.id_category = category.id_category";
        $result_namecategory = mysqli_query($conn, $sql3);
        $row_namecategory = mysqli_fetch_array($result_namecategory);
        $subTotal = intval($row["quantity"])*$row_namebook["price"];
        $total += $subTotal;
        echo '<tr>
                <td class="dOrder-bookName">' . $row_namebook["name_book"] . '</td>
                <td class="dOrder-bookCategory">' . $row_namecategory["name_category"] . '</td>
                <td class="dOrder-bookQuantity">' . $row["quantity"] . '</td>
                <td class="dOrder-bookPrice">' . $row_namebook["price"] . '$</td>
                <td class="dOrder-total">' . $subTotal . '$</td>
            </tr>';
    }

    echo '              </tbody>
                    </table>
                </div>
            </div>
    
            <div class="modal-col content-order order-totals">
                <label for="" class="modal-label-order">Totals: </label>
                <p class="orderDetails-totals">'.$total.'$</p>
            </div>
            
            <div class="action-form">
                <a href="quanlyhoadon.php?page=' . $page . '&iddetailorder=' . $_GET["iddetailorder"] . '&confirmCancelled=1" class="cancel-book js-cancelled-order js-confirm-cancelled">Cancelled</a>
                <a href="quanlyhoadon.php?page=' . $page . '&iddetailorder=' . $_GET["iddetailorder"] . '&confirmApprove=1" class="submit-book js-approve-order js-confirm-approve">Approve</a>
            </div>
        </div>
    </form>
</div>';
}
?>

<?php
include "connect.php";
if(isset($_GET['formdetailorder']) && $_GET['status'] === 'Delivering') {
    $total = 0;
    $sql_date = "SELECT order_date FROM order_books WHERE id_order = " . $_GET['iddetailorder'];
    $date_result = mysqli_query($conn, $sql_date);
    $date_row = mysqli_fetch_array($date_result);
    $date = $date_row['order_date'];
    $sql_name = "SELECT name_customer FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $name_result = mysqli_query($conn, $sql_name);
    $name_row = mysqli_fetch_array($name_result);
    $name = $name_row['name_customer'];
    $sql_address = "SELECT address FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $address_result = mysqli_query($conn, $sql_address);
    $address_row = mysqli_fetch_array($address_result);
    $address = $address_row['address'];
    $sql_phone = "SELECT phone FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $phone_result = mysqli_query($conn, $sql_phone);
    $phone_row = mysqli_fetch_array($phone_result);
    $phone = $phone_row['phone'];
    $sql_notes = "SELECT notes FROM order_books WHERE id_order = " . $_GET['iddetailorder'];
    $notes_result = mysqli_query($conn, $sql_notes);
    $notes_row = mysqli_fetch_array($notes_result);
    $notes = $notes_row['notes'];
    echo '<div class="modal js-modal-dOrder-deliver modal-order">
            <form class="modal-container js-modal-dOrder-deliver-container">
                <div class="modal-close js-modal-dOrder-deliver-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>

                <header class="modal-header modal-header-books">
                    <i class="modal-heading-icon fa-solid fa-book"></i>
                    Order Detail
                </header>
    
                <div class="modal-content">
                    <div class="modal-col header-order">
                        <label for="" class="modal-label-order">Date Order: </label>
                        <p class="orderDetails-date">'.$date.'</p>
                    </div>
    
                    <div class="modal-col header-order">
                        <label for="" class="modal-label-order">Order ID: </label>
                        <p class="orderDetails-id">'.$_GET["iddetailorder"].'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Customer Name: </label>
                        <p class="orderDetails-name">'.$name.'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Address: </label>
                        <p class="orderDetails-address">'.$address.'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Phone: </label>
                        <p class="orderDetails-phone">'.$phone.'</p>
                    </div>

                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Notes: </label>
                        <p class="orderDetails-notes">'.$notes.'</p>
                    </div>
    
                    <div class="modal-col">
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>';

    $sql = "SELECT * FROM order_details WHERE id_order = " . $_GET["iddetailorder"];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sql2 = "SELECT name_book, price FROM book, order_books, order_details 
                 WHERE book.id_book = ". $row['id_book'] ." 
                 AND order_details.id_order = order_books.id_order 
                 AND order_books.id_order = " . $row['id_order'];
        $result_namebook = mysqli_query($conn, $sql2);
        $row_namebook = mysqli_fetch_array($result_namebook);

        $sql3 = "SELECT name_category FROM book, order_books, order_details, category 
                 WHERE book.id_book = ". $row['id_book'] ." 
                 AND order_details.id_order = order_books.id_order 
                 AND order_books.id_order = " . $row['id_order'] ." AND book.id_category = category.id_category";
        $result_namecategory = mysqli_query($conn, $sql3);
        $row_namecategory = mysqli_fetch_array($result_namecategory);
        $subTotal = intval($row["quantity"])*$row_namebook["price"];
        $total += $subTotal;
        echo '<tr>
                <td class="dOrder-bookName">' . $row_namebook["name_book"] . '</td>
                <td class="dOrder-bookCategory">' . $row_namecategory["name_category"] . '</td>
                <td class="dOrder-bookQuantity">' . $row["quantity"] . '</td>
                <td class="dOrder-bookPrice">' . $row_namebook["price"] . '$</td>
                <td class="dOrder-total">' . $subTotal . '$</td>
            </tr>';
    }

    echo '              </tbody>
                    </table>
                </div>
            </div>
    
            <div class="modal-col content-order order-totals">
                <label for="" class="modal-label-order">Totals: </label>
                <p class="orderDetails-totals">'.$total.'$</p>
            </div>
            <div class="action-form">
                    <a href="quanlyhoadon.php?page=' . $page . '&iddetailorder=' . $_GET["iddetailorder"] . '&confirmComplete=1" class="submit-book js-complete-order js-confirm-complete">Complete</a>
            </div>
        </div>
    </form>
</div>';
}
?>

<?php
include "connect.php";
if(isset($_GET['formdetailorder']) && ($_GET['status'] === 'Complete' || $_GET['status'] === 'Cancelled')) {
    $total = 0;
    $sql_date = "SELECT order_date FROM order_books WHERE id_order = " . $_GET['iddetailorder'];
    $date_result = mysqli_query($conn, $sql_date);
    $date_row = mysqli_fetch_array($date_result);
    $date = $date_row['order_date'];
    $sql_name = "SELECT name_customer FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $name_result = mysqli_query($conn, $sql_name);
    $name_row = mysqli_fetch_array($name_result);
    $name = $name_row['name_customer'];
    $sql_address = "SELECT address FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $address_result = mysqli_query($conn, $sql_address);
    $address_row = mysqli_fetch_array($address_result);
    $address = $address_row['address'];
    $sql_phone = "SELECT phone FROM customer, order_books WHERE customer.id_customer = order_books.id_customer AND order_books.id_order = " . $_GET['iddetailorder'];
    $phone_result = mysqli_query($conn, $sql_phone);
    $phone_row = mysqli_fetch_array($phone_result);
    $phone = $phone_row['phone'];
    $sql_notes = "SELECT notes FROM order_books WHERE id_order = " . $_GET['iddetailorder'];
    $notes_result = mysqli_query($conn, $sql_notes);
    $notes_row = mysqli_fetch_array($notes_result);
    $notes = $notes_row['notes'];
    echo '<div class="modal js-modal-dOrder-complete modal-order">
            <div class="modal-container js-modal-dOrder-complete-container">
                <div class="modal-close js-modal-dOrder-complete-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>

                <header class="modal-header modal-header-books">
                    <i class="modal-heading-icon fa-solid fa-book"></i>
                    Order Detail
                </header>
    
                <div class="modal-content">
                    <div class="modal-col header-order">
                        <label for="" class="modal-label-order">Date Order: </label>
                        <p class="orderDetails-date">'.$date.'</p>
                    </div>
    
                    <div class="modal-col header-order">
                        <label for="" class="modal-label-order">Order ID: </label>
                        <p class="orderDetails-id">'.$_GET["iddetailorder"].'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Customer Name: </label>
                        <p class="orderDetails-name">'.$name.'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Address: </label>
                        <p class="orderDetails-address">'.$address.'</p>
                    </div>
    
                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Phone: </label>
                        <p class="orderDetails-phone">'.$phone.'</p>
                    </div>

                    <div class="modal-col content-order">
                        <label for="" class="modal-label-order">Notes: </label>
                        <p class="orderDetails-notes">'.$notes.'</p>
                    </div>
    
                    <div class="modal-col">
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>';

    $sql = "SELECT * FROM order_details WHERE id_order = " . $_GET["iddetailorder"];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sql2 = "SELECT name_book, price FROM book, order_books, order_details 
                 WHERE book.id_book = ". $row['id_book'] ." 
                 AND order_details.id_order = order_books.id_order 
                 AND order_books.id_order = " . $row['id_order'];
        $result_namebook = mysqli_query($conn, $sql2);
        $row_namebook = mysqli_fetch_array($result_namebook);

        $sql3 = "SELECT name_category FROM book, order_books, order_details, category 
                 WHERE book.id_book = ". $row['id_book'] ." 
                 AND order_details.id_order = order_books.id_order 
                 AND order_books.id_order = " . $row['id_order'] ." AND book.id_category = category.id_category";
        $result_namecategory = mysqli_query($conn, $sql3);
        $row_namecategory = mysqli_fetch_array($result_namecategory);
        $subTotal = intval($row["quantity"])*$row_namebook["price"];
        $total += $subTotal;
        echo '<tr>
                <td class="dOrder-bookName">' . $row_namebook["name_book"] . '</td>
                <td class="dOrder-bookCategory">' . $row_namecategory["name_category"] . '</td>
                <td class="dOrder-bookQuantity">' . $row["quantity"] . '</td>
                <td class="dOrder-bookPrice">' . $row_namebook["price"] . '$</td>
                <td class="dOrder-total">' . $subTotal . '$</td>
            </tr>';
    }

    echo '              </tbody>
                    </table>
                </div>
            </div>
    
            <div class="modal-col content-order order-totals">
                <label for="" class="modal-label-order">Totals: </label>
                <p class="orderDetails-totals">'.$total.'$</p>
            </div>
        </div>
    </form>
</div>';
}
?>

<?php
include "connect.php";
if(isset($_GET['confirmApprove'])){
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
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["approveOrder"])){
            $sql2 = "UPDATE order_books SET status = 'Delivering' WHERE id_order = " . $_GET['iddetailorder'];
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
include "connect.php";
if(isset($_GET['confirmCancelled'])){
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
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["cancelledOrder"])){
            $sql3 = "UPDATE book
            JOIN order_details ON book.id_book = order_details.id_book
            JOIN order_books ON order_details.id_order = order_books.id_order
            SET book.quantity = book.quantity + order_details.quantity
            WHERE order_books.id_order = " . $_GET['iddetailorder'];
            $sql2 = "UPDATE order_books SET status = 'Cancelled' WHERE id_order = " . $_GET['iddetailorder'];
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
include "connect.php";
if(isset($_GET['confirmComplete'])){
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
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["completeOrder"])){
            $sql2 = "UPDATE order_books SET status = 'Complete' WHERE id_order = " . $_GET['iddetailorder'];
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
include "connect.php";
if(isset($_GET['formcantdeleteorder'])){
    echo '<div id="toast-deleteOrder-error" class="toast-message"></div>';
    echo "<script>setTimeout(function(){
        window.location = 'quanlyhoadon.php?page=" . $_GET['page'] . "';
    }, 2000)</script>";
}
?>

<?php
include "connect.php";
if(isset($_GET['formdeleteorder'])){
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
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["deleteOrder"])){
            $sql2 = "DELETE FROM order_books WHERE id_order = " . $_GET['iddeleteorder'];
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
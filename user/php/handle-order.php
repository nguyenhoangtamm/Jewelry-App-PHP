<?php include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["idOrderView"])) {
        // View order customer
        $idOrder = $_POST["idOrderView"];

        $sqlOrder = "SELECT name_book, order_date, notes, order_details.quantity, price
        FROM `order_details` INNER JOIN `order_books` ON order_details.id_order = order_books.id_order
        INNER JOIN `book` ON order_details.id_book = book.id_book 
        WHERE order_books.id_order = $idOrder";
        $resultOrder = $conn->query($sqlOrder);

        $data = $resultOrder->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    } elseif (isset($_POST["idOrderDelete"])) {
        // Delleted order customer
        $idOrderDelete = $_POST["idOrderDelete"];
        $sqlCompleteOrder = "SELECT * FROM `order_books` WHERE id_order = $idOrderDelete AND status != 'Complete'";
        $result = $conn->query($sqlCompleteOrder);
        if ($result->num_rows > 0) {
            $sqlOrderDetail = "SELECT book.id_book, book.quantity AS 'quantity_old', order_details.quantity AS 'quantity_sell'
                FROM `order_details` INNER JOIN `book` ON order_details.id_book = book.id_book
                WHERE id_order = $idOrderDelete";
            $resultOrderDetail = $conn->query($sqlOrderDetail);

            while ($row = $resultOrderDetail->fetch_assoc()) {
                $quantityOld = floatval($row["quantity_old"]);
                $quantitySell = floatval($row["quantity_sell"]);
                $quantityNew = $quantityOld + $quantitySell;
                $idBook = $row["id_book"];

                $sqlUpdate = "UPDATE `book` SET `quantity` = $quantityNew WHERE id_book = $idBook;";
                $conn->query($sqlUpdate);
            }
        }

        $sqlDelete = "DELETE FROM `order_books` WHERE id_order = $idOrderDelete";
        if ($conn->query($sqlDelete)) {
            echo json_encode(["noError" => true]);
        } else {
            echo json_encode(["noError" => false]);
        }
    } elseif (isset($_POST["placeOrder"]) && isset($_POST["messageOrder"])) {
        // Place order 
        session_start();
        $idCutomer = $_SESSION['customer'];
        $sqlInfoCustomer = "SELECT * FROM `customer` WHERE id_customer = $idCutomer AND full_info = 1";
        $result = $conn->query($sqlInfoCustomer);
        if ($result->num_rows > 0) {
            $message = $_POST["messageOrder"];
            $date = $date = date("Y-m-d");
            $insertOrder = "INSERT INTO `order_books`(`id_customer`, `order_date`, `status`, `notes`) 
                VALUES ('$idCutomer', '$date', 'New', '$message')";
            $conn->query($insertOrder);
            $idOrder = $conn->insert_id;

            $sqlShopping = "SELECT book.id_book, book.quantity AS 'quantity_old', shopping.quantity AS 'quantity_sell'
                FROM `shopping` INNER JOIN `book` ON shopping.id_book = book.id_book 
                WHERE id_customer = $idCutomer";
            $resultShopping = $conn->query($sqlShopping);

            while ($row = $resultShopping->fetch_assoc()) {
                $quantityOld = floatval($row["quantity_old"]);
                $quantitySell = floatval($row["quantity_sell"]);
                $quantityNew = $quantityOld - $quantitySell;
                $idBook = $row["id_book"];

                $insertDetails = "INSERT INTO `order_details`(`id_order`, `id_book`, `quantity`) 
                VALUES ($idOrder, $idBook, $quantitySell);";
                $conn->query($insertDetails);

                $sqlUpdate = "UPDATE `book` SET `quantity` = $quantityNew WHERE id_book = $idBook;";
                $conn->query($sqlUpdate);
            }

            $clearShopping = "DELETE FROM `shopping` WHERE `id_customer` = $idCutomer";
            $conn->query($clearShopping);

            echo json_encode(["noError" => true]);
        } else {
            echo json_encode(["noError" => false]);
        }
    }
    $conn->close();
}

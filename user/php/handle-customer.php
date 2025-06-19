<?php include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['loadDataCustomer']) && $_POST['loadDataCustomer'] === "customer") {
        // Load data my account customer
        session_start();
        $idCustomer = $_SESSION['customer'];
        $sqlCustomer = "SELECT `name_customer`, `date_birth`, `address`, `phone`, `email` 
            FROM `customer` WHERE id_customer = $idCustomer";
        $resultCustomer = $conn->query($sqlCustomer);

        $sqlOrder = "SELECT id_order, order_date, name_customer, status 
            FROM `order_books` INNER JOIN `customer` ON order_books.id_customer = customer.id_customer 
            WHERE customer.id_customer = $idCustomer ORDER BY id_order DESC";
        $resulteOrder = $conn->query($sqlOrder);

        $dataCustomer = $resultCustomer->fetch_all(MYSQLI_ASSOC);
        $dataOrder = $resulteOrder->fetch_all(MYSQLI_ASSOC);

        echo json_encode(["infoCustomer" => $dataCustomer, "customerOrder" => $dataOrder]);
    } elseif (
        isset($_POST['name']) && isset($_POST['birthDate']) && isset($_POST['address'])
        && isset($_POST['email']) && isset($_POST['phone'])
    ) {
        // Update info Customer
        session_start();
        $idCustomer = $_SESSION['customer'];

        $nameCustomer = $_POST['name'];
        $birthDateCustomer = $_POST['birthDate'];
        $addressCustomer = $_POST['address'];
        $emailCustomer = $_POST['email'];
        $phoneCustomer = $_POST['phone'];

        $errorMessage = [];
        $sqlEmail = "SELECT * FROM `customer` WHERE email = '$emailCustomer' AND id_customer != $idCustomer";
        $resultEmail = $conn->query($sqlEmail);
        if ($resultEmail->num_rows == 0) {
            $slqUpdate = "UPDATE `customer` SET `name_customer` = '$nameCustomer', `date_birth` = '$birthDateCustomer', 
                `address` = '$addressCustomer', `phone` = '$phoneCustomer', `email` = '$emailCustomer', `full_info` = 1 
                WHERE id_customer = $idCustomer";
            $conn->query($slqUpdate);
            echo json_encode(["error" => false]);
        } else {
            echo json_encode(["error" => true, "errorEmail" => "Gmail is already taken"]);
        }
    } elseif (isset($_POST['currentPass']) && isset($_POST['newPass'])) {
        // Update password account customer
        session_start();
        $idCustomer = $_SESSION['customer'];

        $currentPass = $_POST['currentPass'];
        $newPass = $_POST['newPass'];

        $sqlPass = "SELECT * FROM `account` WHERE password = '$currentPass' AND id_customer = $idCustomer";
        $resultPass = $conn->query($sqlPass);
        if ($resultPass->num_rows > 0) {
            $slqUpdate = "UPDATE `account` SET `password` = '$newPass' WHERE id_customer = $idCustomer";
            $conn->query($slqUpdate);
            echo json_encode(["error" => false]);
        } else {
            echo json_encode(["error" => true, "errorPass" => "Current password is incorrect"]);
        }
    }

    $conn->close();
}

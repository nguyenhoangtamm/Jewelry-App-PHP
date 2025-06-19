<?php include("./connect.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['loadCountCart'])) {
        session_start();
        if (isset($_SESSION['customer'])) {
            $idCutomer = $_SESSION['customer'];
            $sqlCartCount = "SELECT * FROM `shopping` WHERE id_customer = $idCutomer";
            $result = $conn->query($sqlCartCount);
            $num = $result->num_rows;
            echo json_encode(["noError" => true, "countCart" => $num]);
        } else {
            echo json_encode(["noError" => false, "countCart" => 0]);
        }
    } elseif (isset($_POST['checkCustomer']) && isset($_POST['idBook']) && isset($_POST['quantity'])) {
        // Check customer login before add product
        $errorMessage = [];
        session_start();
        if (isset($_SESSION['customer'])) {
            $idCutomer = $_SESSION['customer'];
            $idBook = $_POST['idBook'];
            $quantityShopping = floatval($_POST['quantity']);

            $sqlProduct = "SELECT id_book, quantity FROM `book` WHERE id_book = $idBook";
            $resultProduct = $conn->query($sqlProduct);
            $rowProduct = $resultProduct->fetch_array();
            $quantityProduct = floatval($rowProduct['quantity']);

            $sqlShopping = "SELECT * FROM `shopping` WHERE id_customer = $idCutomer AND id_book = $idBook";
            $result = $conn->query($sqlShopping);
            if (($result->num_rows) > 0) {
                $rowShopping = $result->fetch_array();
                $quantitySell = floatval($rowShopping['quantity']) + $quantityShopping;

                if ($quantitySell <= $quantityProduct) {
                    $sqlUpdate = "UPDATE `shopping` SET `quantity` = $quantitySell 
                        WHERE id_customer = $idCutomer AND id_book = $idBook";
                    $conn->query($sqlUpdate);
                } else {
                    $errorMessage["noError"] = false;
                    $errorMessage["msgError"] = "Not enough product quantity to supply";
                }
            } else {
                if ($quantityShopping <= $quantityProduct) {
                    $sqlInsert = "INSERT INTO `shopping`(`id_book`, `id_customer`, `quantity`) 
                        VALUES ('$idBook', '$idCutomer',  $quantityShopping)";
                    $conn->query($sqlInsert);
                } else {
                    $errorMessage["noError"] = false;
                    $errorMessage["msgError"] = "Not enough product quantity to supply";
                }
            }
            if (empty($errorMessage)) {
                $sqlCartCount = "SELECT * FROM `shopping` WHERE id_customer = $idCutomer";
                $result = $conn->query($sqlCartCount);
                $num = $result->num_rows;
                $errorMessage["noError"] = true;
                $errorMessage["countCart"] = $num;
                echo json_encode($errorMessage);
            } else {
                echo json_encode($errorMessage);
            }
        } else {
            $errorMessage["noError"] = false;
            $errorMessage["msgError"] = "Login to buy products";
            echo json_encode($errorMessage);
        }
    } elseif (isset($_POST['loadDataOrder'])) {
        // Load shopping cart
        session_start();
        $idCutomer = $_SESSION['customer'];
        $sqlLoad = "SELECT id_shopping, name_book, image_book, shopping.quantity, price 
            FROM `shopping` INNER JOIN `book` ON shopping.id_book = book.id_book 
            WHERE id_customer = $idCutomer";
        $result = $conn->query($sqlLoad);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['data' => $data]);
    } elseif (isset($_POST['idShopping']) && isset($_POST['valueQuantity'])) {
        // Update quantity shopping cart
        $errorMessage = [];
        session_start();
        $idCutomer = $_SESSION['customer'];

        $idShopping = $_POST['idShopping'];
        $quantityShopping = floatval($_POST['valueQuantity']);

        $sqlProduct = "SELECT book.id_book, book.quantity FROM `shopping` INNER JOIN `book` 
            ON shopping.id_book = book.id_book WHERE id_shopping = $idShopping";
        $resultProduct = $conn->query($sqlProduct);
        $rowProduct = $resultProduct->fetch_array();
        $quantityProduct = floatval($rowProduct['quantity']);

        if ($quantityShopping <= $quantityProduct) {
            $sqlUpdate = "UPDATE `shopping` SET `quantity` = $quantityShopping 
                WHERE id_customer = $idCutomer AND id_shopping = $idShopping";
            $conn->query($sqlUpdate);
            $errorMessage["noError"] = true;
            echo json_encode($errorMessage);
        } else {
            $errorMessage["noError"] = false;
            $errorMessage["msgError"] = "Not enough product quantity to supply";
            echo json_encode($errorMessage);
        }
    } elseif (isset($_POST['idDeleteShopping'])) {
        $idDelete = $_POST['idDeleteShopping'];
        $sqlDelete = "DELETE FROM `shopping` WHERE id_shopping = $idDelete";
        if ($conn->query($sqlDelete)) {
            session_start();
            $idCutomer = $_SESSION['customer'];
            $sqlCartCount = "SELECT * FROM `shopping` WHERE id_customer = $idCutomer";
            $result = $conn->query($sqlCartCount);
            $num = $result->num_rows;
            echo json_encode(["noError" => true, "countCart" => $num]);
        } else {
            echo json_encode(["noError" => false]);
        }
    }
    $conn->close();
}

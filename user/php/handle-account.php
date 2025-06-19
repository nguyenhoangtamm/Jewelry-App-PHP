<?php include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['userLoginAccount']) && isset($_POST['passLoginAccount'])) {
        // Login Account
        $userName = $_POST['userLoginAccount'];
        $passWord = $_POST['passLoginAccount'];
        $sql = "SELECT * FROM `account` WHERE username = '$userName' and password = '$passWord'";
        $result = $conn->query($sql);
        if (($result->num_rows) > 0) {
            $row = $result->fetch_array();
            if ($row['description'] === "user") {
                session_start();
                $_SESSION["customer"] = $row['id_customer'];
                echo "./user/index.php";
            } else {
                echo "./admin/trangchu.php";
            }
        } else {
            echo false;
        }
    } elseif (isset($_POST["checkUser"]) && isset($_POST["checkEmail"])) {
        // Check username and email address create 
        $errorMessage = [];
        $userName = $_POST["checkUser"];
        $email = $_POST["checkEmail"];
        $sqlUser = "SELECT * FROM `account` WHERE username = '$userName'";
        $resultUser = $conn->query($sqlUser);
        if ($resultUser->num_rows > 0) {
            $errorMessage['0'] = "Username is already taken";
        }

        $sqlEmail = "SELECT * FROM `customer` WHERE email = '$email'";
        $resultEmail = $conn->query($sqlEmail);
        if ($resultEmail->num_rows > 0) {
            $errorMessage['1'] = "Gmail is already taken";
        }
        if (empty($errorMessage)) {
            echo json_encode(["error" => false]);
        } else {
            echo json_encode(["error" => true, "message" => $errorMessage]);
        }
    } elseif (
        isset($_POST["userCreateAccount"]) && isset($_POST["emailCreateAccount"])
        && isset($_POST["passCreateAccount"])
    ) {
        // Create Account
        $userName = $_POST["userCreateAccount"];
        $passWord = $_POST["passCreateAccount"];
        $email = $_POST["emailCreateAccount"];

        $date = date("Y-m-d");
        $sqlInsertCustomer = "INSERT INTO `customer`(`date_birth`, `email`,  `full_info`) 
                VALUES ('$date', '$email', '0')";
        $conn->query($sqlInsertCustomer);

        $idCustomer = $conn->insert_id;
        $sqlCreateAccount = "INSERT INTO `account`(`username`, `password`, `id_customer`, `description`) 
                VALUES  ('$userName', '$passWord', '$idCustomer', 'user')";
        if ($conn->query($sqlCreateAccount)) {
            echo true;
        } else {
            echo false;
        }
    } elseif (isset($_POST["userChange"]) && isset($_POST["emailChange"])) {
        // Check email and username Password Recovery
        $userChange = $_POST["userChange"];
        $emailChange = $_POST["emailChange"];
        $sql = "SELECT id_account FROM `account` INNER JOIN customer ON account.id_customer = customer.id_customer
        WHERE username = '$userChange' AND email = '$emailChange'";
        $result = $conn->query($sql);
        if (($result->num_rows) > 0) {
            $row = $result->fetch_array();
            session_start();
            $_SESSION["accountChange"] = $row['id_account'];
            echo json_encode(["noError" => true]);
        } else {
            echo json_encode(["noError" => false]);
        }
    } elseif (isset($_POST['newPass'])) {
        // Create new password (Password Recovery)
        $newPass = $_POST['newPass'];
        session_start();
        $idChange = $_SESSION["accountChange"];
        unset($_SESSION["accountChange"]);
        $sql = "UPDATE `account` SET `password`= '$newPass' WHERE id_account = $idChange";
        if ($conn->query($sql)) {
            echo true;
        } else {
            echo false;
        }
    } elseif (isset($_POST['logOut'])) {
        // Logout Account Customer
        session_start();
        unset($_SESSION['customer']);
        echo json_encode(["noError" => true]);
    }

    $conn->close();
}

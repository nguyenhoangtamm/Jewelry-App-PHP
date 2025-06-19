<?php
    if(isset($_POST['selectedValue'])) {
        include "connect.php";
        $selectedYear = isset($_POST['selectedValue']) ? $_POST['selectedValue'] : '2023';
        $sql = "SELECT MONTH(order_books.order_date) AS month, SUM(order_details.quantity * book.price) AS total_income FROM order_books JOIN order_details ON order_books.id_order = order_details.id_order JOIN book ON order_details.id_book = book.id_book WHERE YEAR(order_books.order_date) = $selectedYear AND order_books.status = 'Complete' GROUP BY MONTH(order_books.order_date)";
        $result = $conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array('label' => date("F", mktime(0, 0, 0, $row['month'], 1)), 'value' => $row['total_income']);
        }
        // Chuyển dữ liệu thành JSON
        $json_data = json_encode($data);
        echo $json_data;
    }
?>

<?php
    if(isset($_POST['selectedValueNumBook'])) {
        include "connect.php";
        $selectedYear = isset($_POST['selectedValueNumBook']) ? $_POST['selectedValueNumBook'] : '2023';
        $sql = "SELECT category.name_category as category, SUM(order_details.quantity) AS total_book FROM order_books JOIN order_details ON order_books.id_order = order_details.id_order JOIN book ON order_details.id_book = book.id_book
        JOIN category ON book.id_category = category.id_category WHERE YEAR(order_books.order_date) =  $selectedYear AND order_books.status = 'Complete' GROUP BY category.name_category";
        $result = $conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array('label' => $row['category'], 'value' => $row['total_book']);
        }
        $json_data_numBook = json_encode($data);
        echo $json_data_numBook;
    }
?>
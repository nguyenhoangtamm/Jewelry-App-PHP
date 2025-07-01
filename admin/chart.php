<?php
if (isset($_POST['selectedValue'])) {
    include "connect.php";
    $selectedYear = isset($_POST['selectedValue']) ? $_POST['selectedValue'] : '2023';
    $sql = "SELECT MONTH(order_jewelry.order_date) AS month, SUM(order_details.quantity * jewelries.price) AS total_income FROM order_jewelry JOIN order_details ON order_jewelry.id_order = order_details.id_order JOIN jewelries ON order_details.id_jewelry = jewelries.id WHERE YEAR(order_jewelry.order_date) = $selectedYear AND order_jewelry.status = 'Complete' GROUP BY MONTH(order_jewelry.order_date)";
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
if (isset($_POST['selectedValueNumJewelry'])) {
    include "connect.php";
    $selectedYear = isset($_POST['selectedValueNumJewelry']) ? $_POST['selectedValueNumJewelry'] : '2023';
    $sql = "SELECT jewelries.category as category, SUM(order_details.quantity) AS total_jewelry FROM order_jewelry JOIN order_details ON order_jewelry.id_order = order_details.id_order JOIN jewelries ON order_details.id_jewelry = jewelries.id WHERE YEAR(order_jewelry.order_date) =  $selectedYear AND order_jewelry.status = 'Complete' GROUP BY jewelries.category";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array('label' => $row['category'], 'value' => $row['total_jewelry']);
    }
    $json_data_numJewelry = json_encode($data);
    echo $json_data_numJewelry;
}
?>
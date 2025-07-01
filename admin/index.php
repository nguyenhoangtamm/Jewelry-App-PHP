<?php
$income = 0;
include "../config/connect.php";
$sql = "SELECT SUM(jewelries.price*order_details.quantity) as income FROM jewelries, orders, order_details
    WHERE orders.id=order_details.id AND order_details.jewelry_id = jewelries.id AND orders.status = 'Complete'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $income += $row['income'];
        }
    } else {
        echo "No rows returned.";
    }
} else {
    echo "Query failed: " . mysqli_error($conn);
}
$conn->close();
?>

<?php
$count_customer = 0;
include "../config/connect.php";
$sql = "SELECT COUNT(id) as count_customer FROM users";
$result = mysqli_query($conn, $sql);
if ($result) {
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $count_customer += $row['count_customer'];
        }
    } else {
        echo "No rows returned.";
    }
} else {
    echo "Query failed: " . mysqli_error($conn);
}
$conn->close();
?>

<?php
$count_order = 0;
include "../config/connect.php";
$sql = "SELECT COUNT(id) as count_order FROM orders";
$result = mysqli_query($conn, $sql);
if ($result) {
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $count_order += $row['count_order'];
        }
    } else {
        echo "No rows returned.";
    }
} else {
    echo "Query failed: " . mysqli_error($conn);
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <ul class="menu">
            <li class="active">
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
            <li>
                <a href="./quanlyhoadon.php">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Orders</span>
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
                <h2>Dashboard</h2>
            </div>
            <div class="user-info">
                <img src="../images_web/avatar.png" alt="avatar">
            </div>
        </div>
        <div class="card-container">
            <h3 class="main-title">
                Data
            </h3>
            <div class="card-wrapper">
                <div class="payment-card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">
                                Income
                            </span>
                            <span class="amount-value">
                                <?php echo $income ?>
                            </span>
                        </div>
                        <i class="fas fa-dollar-sign icon dark-blue"></i>
                    </div>
                </div>
                <div class="payment-card light-purple">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">
                                Orders
                            </span>
                            <span class="amount-value">
                                <?php echo $count_order ?>
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                </div>
                <div class="payment-card light-green">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">
                                Customers
                            </span>
                            <span class="amount-value">
                                <?php echo $count_customer ?>
                            </span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-wrapper income-statistical">
            <h3 class="main-title">
                Income
            </h3>
            <div class="combobox-select-year">
                <label for="selected-year-income">Year</label>
                <select id="selected-year-income">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024" selected>2024</option>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="lineChart-income-month"></canvas>
                <canvas id="lineChart-income-year"></canvas>
            </div>
        </div>
        <div class="table-wrapper books-statistical">
            <h3 class="main-title">
                Number of jewelry categories sold
            </h3>
            <div class="combobox-select-year">
                <label for="selected-year-numJewelry">Year</label>
                <select id="selected-year-numJewelry">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024" selected>2024</option>
                </select>
            </div>
            <div class="chart-container chart-container-pie">
                <canvas id="pieChart-categoryJewelrySold-month"></canvas>
                <canvas id="barChart-categoryJewelrySold-month"></canvas>
            </div>
        </div>

        <script>
            var comboBox = document.getElementById('selected-year-income');
            comboBox.addEventListener('change', function() {
                var selectedValue = comboBox.value;
                $.ajax({
                    url: 'chart.php',
                    type: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        var oldChart = Chart.getChart("lineChart-income-month");
                        if (oldChart) {
                            oldChart.destroy();
                        }
                        var ctx = document.getElementById('lineChart-income-month').getContext('2d');

                        // Tạo mảng cho nhãn và giá trị từ dữ liệu JSON
                        var labels = data.map(function(item) {
                            return item.label;
                        });

                        var values = data.map(function(item) {
                            return item.value;
                        });

                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Monthly Revenue',
                                    data: values,
                                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            }
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        </script>
        <?php
        include "../config/connect.php";
        $sql = "SELECT MONTH(orders.order_date) AS month, SUM(order_details.quantity * jewelries.price) AS total_income FROM orders JOIN order_details ON orders.id = order_details.id JOIN jewelries ON order_details.jewelry_id = jewelries.id WHERE YEAR(orders.order_date) = 2023 AND orders.status = 'Complete' GROUP BY MONTH(orders.order_date)";
        $result = $conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array('label' => date("F", mktime(0, 0, 0, $row['month'], 1)), 'value' => $row['total_income']);
        }
        $json_data = json_encode($data);
        ?>
        <script>
            var jsonData = <?php echo $json_data; ?>;
            var oldChart = Chart.getChart("lineChart-income-month");
            if (oldChart) {
                oldChart.destroy();
            }
            var ctx = document.getElementById('lineChart-income-month').getContext('2d');

            var labels = jsonData.map(function(item) {
                return item.label;
            });

            var values = jsonData.map(function(item) {
                return item.value;
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(255, 100, 86, 0.8)',
                            'rgba(200, 150, 86, 0.8)',
                            'rgba(255, 206, 150, 0.8)',
                            'rgba(50, 100, 255, 0.8)',
                            'rgba(50, 100, 200, 0.8)',
                            'rgba(50, 100, 100, 0.8)',
                            'rgba(50, 160, 100, 0.8)',
                            'rgba(100, 200, 200, 0.8)',
                            'rgba(50, 200, 200, 0.8)',
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });
        </script>

        <?php
        include "../config/connect.php";
        $sql = "SELECT YEAR(orders.order_date) AS year, SUM(order_details.quantity * jewelries.price) AS total_income FROM orders JOIN order_details ON orders.id = order_details.id JOIN jewelries ON order_details.jewelry_id = jewelries.id WHERE orders.status = 'Complete' GROUP BY YEAR(orders.order_date)";
        $result = $conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array('label' => $row['year'], 'value' => $row['total_income']);
        }
        $json_data = json_encode($data);
        ?>
        <script>
            var jsonData = <?php echo $json_data; ?>;
            var oldChart = Chart.getChart("lineChart-income-year");
            if (oldChart) {
                oldChart.destroy();
            }
            var ctx = document.getElementById('lineChart-income-year').getContext('2d');

            var labels = jsonData.map(function(item) {
                return item.label;
            });

            var values = jsonData.map(function(item) {
                return item.value;
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Year Revenue',
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(255, 100, 86, 0.8)',
                            'rgba(200, 150, 86, 0.8)',
                            'rgba(255, 206, 150, 0.8)',
                            'rgba(50, 100, 255, 0.8)',
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });
        </script>
        <?php
        include "../config/connect.php";
        $sql = "SELECT jewelries.category as category, SUM(order_details.quantity) AS total_jewelry FROM orders JOIN order_details ON orders.id = order_details.id JOIN jewelries ON order_details.jewelry_id = jewelries.id WHERE YEAR(orders.order_date) = 2023 AND orders.status = 'Complete' GROUP BY jewelries.category";
        $result = $conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array('label' => $row['category'], 'value' => $row['total_jewelry']);
        }
        $json_data = json_encode($data);
        ?>
        <script>
            var jsonData = <?php echo $json_data; ?>;
            var oldChart = Chart.getChart("barChart-categoryJewelrySold-month");
            if (oldChart) {
                oldChart.destroy();
            }
            var ctx = document.getElementById('barChart-categoryJewelrySold-month').getContext('2d');

            var labels = jsonData.map(function(item) {
                return item.label;
            });

            var values = jsonData.map(function(item) {
                return item.value;
            });
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantity Category Jewelry Sold',
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(255, 100, 86, 0.8)',
                            'rgba(200, 150, 86, 0.8)',
                            'rgba(255, 206, 150, 0.8)',
                            'rgba(50, 100, 255, 0.8)',
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
            });
        </script>

        <script>
            var jsonData = <?php echo $json_data; ?>;
            var oldChart = Chart.getChart("pieChart-categoryJewelrySold-month");
            if (oldChart) {
                oldChart.destroy();
            }
            var ctx = document.getElementById('pieChart-categoryJewelrySold-month').getContext('2d');

            var labels = jsonData.map(function(item) {
                return item.label;
            });

            var values = jsonData.map(function(item) {
                return item.value;
            });

            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantity Category Jewelry Sold',
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(255, 100, 86, 0.8)',
                            'rgba(200, 150, 86, 0.8)',
                            'rgba(255, 206, 150, 0.8)',
                            'rgba(50, 100, 255, 0.8)',
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });
        </script>

        <script>
            var comboBoxNumJewelry = document.getElementById('selected-year-numJewelry');
            comboBoxNumJewelry.addEventListener('change', function() {
                var selectedValueNumJewelry = comboBoxNumJewelry.value;
                $.ajax({
                    url: 'chart.php',
                    type: 'POST',
                    data: {
                        selectedValueNumJewelry: selectedValueNumJewelry
                    },
                    success: function(response) {
                        // Hủy biểu đồ cũ trước khi tạo biểu đồ mới
                        var oldChart = Chart.getChart("barChart-categoryJewelrySold-month");
                        if (oldChart) {
                            oldChart.destroy();
                        }
                        var data = JSON.parse(response);
                        var ctx = document.getElementById('barChart-categoryJewelrySold-month').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.map(item => item.label),
                                datasets: [{
                                    label: 'Quantity Category Jewelry Sold',
                                    data: data.map(item => item.value),
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(255, 206, 86, 0.8)',
                                        'rgba(255, 100, 86, 0.8)',
                                        'rgba(200, 150, 86, 0.8)',
                                        'rgba(255, 206, 150, 0.8)',
                                        'rgba(50, 100, 255, 0.8)',
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        </script>

        <script>
            var comboBoxNumJewelry = document.getElementById('selected-year-numJewelry');
            comboBoxNumJewelry.addEventListener('change', function() {
                var selectedValueNumJewelry = comboBoxNumJewelry.value;
                $.ajax({
                    url: 'chart.php',
                    type: 'POST',
                    data: {
                        selectedValueNumJewelry: selectedValueNumJewelry
                    },
                    success: function(response) {
                        var oldChart = Chart.getChart("pieChart-categoryJewelrySold-month");
                        if (oldChart) {
                            oldChart.destroy();
                        }
                        var data = JSON.parse(response);
                        var ctx = document.getElementById('pieChart-categoryJewelrySold-month').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: data.map(item => item.label),
                                datasets: [{
                                    label: 'Quantity Category Jewelry Sold',
                                    data: data.map(item => item.value),
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(255, 206, 86, 0.8)',
                                        'rgba(255, 100, 86, 0.8)',
                                        'rgba(200, 150, 86, 0.8)',
                                        'rgba(255, 206, 150, 0.8)',
                                        'rgba(50, 100, 255, 0.8)',
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        </script>
</body>

</html>
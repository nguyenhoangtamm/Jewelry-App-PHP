    <?php
    // include 'php/connect.php';

    // $sql = "SELECT * FROM users";
    // $result = mysqli_query($conn, $sql);
    include '../services/jewelry_service.php';
    $service = new JewelryService();
    $all = $service->getAllJewelry();
    $one = $service->getJewelryById(2);

    ob_start();
    ?>
    <!-- Viết giao diện trang con ở đây -->
    <h1>Chào mừng đến với Jewelry Store!</h1>
    <p>Đây là trang chủ với trang sức đầu tiên: 
        <?php echo isset($one['name']) ? htmlspecialchars($one['name']) : 'Không có dữ liệu'; ?>
    </p>

    <h2>Danh sách trang sức</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <!-- Thêm các cột khác nếu cần -->
        </tr>
        <?php foreach ($all as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <!-- Thêm các cột khác nếu cần -->
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
    $content = ob_get_clean();
    $title = "Trang chủ";
    include "layouts/layout.php";
    ?>
<?php
ob_start();
?>
<!-- Viết giao diện trang con ở đây -->
<h1>Chào mừng đến với Book Store!</h1>
<p>Đây là trang chủ.</p>
<?php
$content = ob_get_clean();
$title = "Trang chủ";
include "layouts/layout.php";
?>
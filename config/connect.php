<?php
    $conn = new mysqli('localhost', 'root', '', 'jewelry_shop');
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

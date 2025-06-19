<?php
    $conn = new mysqli('localhost', 'root', '', 'books_db');
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

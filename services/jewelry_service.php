<?php
include '../config/connect.php';

class JewelryService
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    // Lấy tất cả jewelry
    public function getAllJewelry()
    {
        $sql = "SELECT * FROM jewelries";
        $result = $this->conn->query($sql);
        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

    // Lấy jewelry theo ID
    public function getJewelryById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM jewelries WHERE id = $id";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    // Thêm mới jewelry
    public function createJewelry($data)
    {
        $name = $this->conn->real_escape_string($data['name']);
        $price = (float)$data['price'];
        $sql = "INSERT INTO jewelries (name, price) VALUES ('$name', $price)";
        if ($this->conn->query($sql)) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // Cập nhật jewelry
    public function updateJewelry($id, $data)
    {
        $id = (int)$id;
        $name = $this->conn->real_escape_string($data['name']);
        $price = (float)$data['price'];
        $sql = "UPDATE jewelries SET name='$name', price=$price WHERE id=$id";
        return $this->conn->query($sql);
    }

    // Xóa jewelry
    public function deleteJewelry($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM jewelries WHERE id=$id";
        return $this->conn->query($sql);
    }
    // Pagination
    public function getJewelryByPage($page, $limit = 8)
    {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM jewelries LIMIT $offset, $limit";
        $result = $this->conn->query($sql);
        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }
}

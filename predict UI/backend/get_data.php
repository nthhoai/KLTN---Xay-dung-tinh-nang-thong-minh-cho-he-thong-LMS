<?php
include 'condb.php';

// Lấy dữ liệu từ bảng bất kỳ
if (isset($_GET['table'])) {
    $table = $_GET['table'];
    $sql = "SELECT * FROM $table";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM $table WHERE id = $id";
    }

    if ($_GET['table'] == 'student_performance'){
        $sql = "SELECT student.*, performances.*
        FROM student 
        JOIN performances ON student.maHV = performances.maHV";
    }

    
}


$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = [];
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);

// Đóng kết nối đến cơ sở dữ liệu
$result->close();

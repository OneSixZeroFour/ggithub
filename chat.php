<?php
//php的header来定义一个php页面为utf编码或GBK编码 
//
header('Content-type: text/html;charset=utf-8');
$type = $_GET['type'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

mysql_query('set names utf8');

// 查询记录
if ($type == 'query') {
    //查询数据库表list
    $sql = "select * from list";
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
} else if ($type == 'send') {
    $sender = $_GET['sender'];
    $msg = $_GET['msg'];
    $sql = "insert into list (name, content) values ('$sender', '$msg')";
    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

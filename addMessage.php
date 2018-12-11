<?php
session_start();
header("Content-type: text/html; charset=utf-8");
error_reporting(0);
include('waf.php');
// 获取用户输入和选择的时间以及用户名
$date = $_POST['date'];
$message = $_POST['message'];
$usnm = $_SESSION['username'];
$user = $_SESSION['username'];
$xss = strstr($message, '<');
$sqlmap = strstr($message, '\'');
$sql1 = strstr($message, '"');

if($xss || $sqlmap || $sql1)
{
    echo "<script>alert('请勿在留言中使用敏感字符！')</script>";
    header("Refresh:0;url=./addMessage.html");
    exit();
}
if(!$user)
{
    echo "<script>alert('请登录！')</script>";
    header("Refresh:0;url=./login.html");
}
//echo $date . $message;

// 数据库数据
$servername = "localhost";
$username = "root";
$password = "xjw276...";
$dbname = "Messagedb";

// 添加至数据库
// 1.创建连接
$dbname = "MessageDB";
$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
//echo '连接成功';

// 当前日期
//$currentDate = date("Y/m/d");
global $message, $date;

$sql = "INSERT INTO Messages (date, content,username) VALUES ('$date', '$message','$usnm')";

if ($conn->query($sql) === TRUE) {
//    echo "新记录插入成功";
    echo "<script>alert('留言成功！')</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 关闭数据库
$conn->close();

?>


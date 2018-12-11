
<center>
    <body background = "./bj.jpg">
    <h1 style="margin-left:800px;font-size:15px"><a href = "exit.php" >退出登录</a></h1>
    <h1>

    用户列表
</h1>
    <a href="showUsersForAdmin.php">刷新列表</a>
<hr style="width: 90%;"/>
<table border = "1" width = "700" >
    <tr>
        <th>用户id</th>
        <th>用户名</th>
        <th>用户类型</th>
        <th>操作</th>
        <th>重置密码</th>
    </tr>
<?php
session_start();
$user = $_SESSION['username'];
$admin = $_SESSION['admin'];
if(!$admin)
{
    echo "<script>alert('越权使用！')</script>";
    exit();
}
header("Content-type: text/html; charset=utf-8");

// 从数据库取出数据
$servername = "localhost";
$username = "root";
$password = "xjw276...";
$dbname = "Messagedb";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT id, username,admin FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - date: " . $row["date"]. " " . $row["content"]. "<br>";
        echo "<tr style='text-align: center'>";
        echo "<td>{$row["id"]}</td>";
        echo "<td>{$row["username"]}</td>";
        if($row["admin"])
            echo "<td>管理员</td>";
        else
            echo "<td>普通用户</td>";
        if($row["admin"])
            echo "<td><a href='delAdmin.php?id={$row['id']}'>取消管理员</a></td>";
        else
            echo "<td><a href='addAdmin.php?id={$row['id']}'>设为管理员</a></td>";
        /*echo "<td><a href='repasswd.html;$SESSION['newpass'] = $id'>重置密码</a></td>";*/ 
        echo "</tr>";
        echo "<br/>";
    }
}
else {
    echo "0 结果";
}
    $conn->close();
?>
</table>
</center>




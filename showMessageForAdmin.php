
<center>
    <body background = "./bj.jpg">
    <h1 style="margin-left:800px;font-size:15px"><a href = "exit.php" >退出登录</a></h1>
<h1>
    留言列表
</h1>
    <a href="showMessageForAdmin.php">刷新列表</a>
<hr style="width: 90%;"/>
<table border = "1" width = "700" >
    <tr>
        <th>留言id</th>
        <th>留言时间</th>
        <th>留言内容</th>
        <th>留言用户</th>
        <th>操作</th>
    </tr>
    <?php
    session_start();
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

$sql = "SELECT id, date, content FROM Messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - date: " . $row["date"]. " " . $row["content"]. "<br>";
        echo "<tr style='text-align: center'>";
        echo "<td>{$row["id"]}</td>";
        echo "<td>{$row["date"]}</td>";
        echo "<td>{$row["content"]}</td>";
        echo "<td><a href='deleteItem.php?id={$row['id']}'>删除</a></td>";
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




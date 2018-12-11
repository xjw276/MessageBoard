<?php
error_reporting(0);
include('waf.php');
header("Content-type: text/html; charset=utf-8");
session_start(); // 登录之后要把所包含登录的页面连接起来，开启session
// 数据库参数
$link = mysqli_connect('localhost','root','xjw276...','messagedb');

// 取得用户名和密码
$username = $_POST['username'];
$password = md5($_POST['password']);
$authcode = $_POST['auchcode'];

//检查验证码

if($_SESSION['code']== $_POST['authcode'])
    ;
else
{
    echo "<script>alert('验证码输入错误！')</script>";
    header("Refresh:0;url=./login.html");
    close();
}

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
// 连接成功,查找匹配的用户名

    $sql="select password,admin from users where username = '$username'";      //从数据库查询信息
    $que=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($que);
if(@$row)
{
        // 比对密码
        $pwd = $row["password"];
        if ($pwd == $password)
        {
            $flag = 1;
            $admin = $row["admin"];
        }
        else
        {
            $flag = 0;
        }
}
else
    {
    $flag = 0;
    }
//校验用户名密码

if ($flag == 1)
    {
        //保存当前登录的用户及权限

        $_SESSION['username']=$username;
        $_SESSION['admin'] = $admin;
        //判断是否为管理员用户
        if($admin)
        // 登录成功跳转到首页
            header('location:./admin.php');
        else
            header('location:./use.php');
    }
else
    {
        echo "<script>alert('用户名或密码错误，请重新输入！')</script>";
        header("Refresh:0;url=./login.html");
    }


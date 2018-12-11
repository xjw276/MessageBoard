<?php

header("Content-type: text/html; charset=utf-8");
session_start();
unset($_SESSION['username']);
unset($_SESSION['admin']);
header("location: login.html");
?>
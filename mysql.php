<?php
    header('conten-type:text/html;charset=utf-8');
    $conn=mysqli_connect("localhost","root","root");
    if(!$conn)
    {
        die("数据库连接失败");
    }
    mysqli_select_db($conn,"liuyan");
    mysqli_query($conn,"set names utf-8");
    
?>
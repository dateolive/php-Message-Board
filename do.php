<?php
    header('conten-type:text/html;charset=utf-8');
    $arr=$_POST;
    //print_r($arr);Array ( [username] => root [face] => 1 [msg] => dd )
    $conn=mysqli_connect("localhost","root","root");
    $qqurl="https://api.vvhan.com/api/qt?qq=";
    if($arr['userqq']!='')
    $qqurl.=$arr['userqq'];
    else{
        $qqurl.='1';
    }
    if(!$conn)
    {
        die("数据库连接失败");
    }
    mysqli_select_db($conn,"liuyan");
    mysqli_query($conn,"set names utf8mb4");

   if(htmlspecialchars($arr['username'])==''||htmlspecialchars($arr['msg'])=='')
    {
        echo "<script>alert('请填写完整的信息');location.href='message.php';</script>";
    }
    else
    {
        $sql="insert into obj_message set name='".$arr['username']."',head_image='".$qqurl."',word='".$arr['msg']."',time='".date("Y-m-d H-i-s")."',site='".$arr['usersite']."',email='".$arr['email']."'";
        $rst=mysqli_query($conn,$sql);
        if($rst)
        {
            echo "<script>alert('留言成功');location.href='message.php';</script>";

        }
        else
        {
            echo "<script>alert('留言失败');location.href='message.php';</script>";
        }
    }
    

    
?>
<?php
    header('conten-type:text/html;charset=utf-8');
    $arr=$_POST;
    //print_r($arr);Array ( [username] => root [face] => 1 [msg] => dd )
    $conn=mysqli_connect("localhost","root","root");
    if(!$conn)
    {
        die("数据库连接失败");
    }
    mysqli_select_db($conn,"liuyan");
    mysqli_query($conn,"set names utf-8");
    
   if(htmlspecialchars($arr['username'])==''||htmlspecialchars($arr['msg'])==''||$arr['face']=='')
    {
        echo "<script>alert('请填写完整的信息');location.href='message.php';</script>";
    }
    else if(strlen(htmlspecialchars($arr['msg']))>150*3||strlen(htmlspecialchars($arr['username']))>3*8){
        
        echo "<script>alert('留言字数收到限制，字数最高限制是150个 or 昵称字数受到限制，请输入10个字之内的昵称');location.href='message.php';</script>";
    }
    else
    {
        $sql="insert into obj_message set name='".htmlspecialchars($arr['username'])."',head_image='".$arr['face']."',word='".htmlspecialchars($arr['msg'])."',time='".date("Y-m-d H-i-s")."'";
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
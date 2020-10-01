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
    function avoidhit($str){
        //$str = trim($str);  //清理空格  
        //$str = strip_tags($str);   //过滤html标签  
          //将字符内容转化为html实体  
        $str = addslashes($str);  //防止SQL注入
        return $str;
    }
   if(avoidhit($arr['username'])==''||avoidhit($arr['msg'])=='')
    {
        echo "<script>alert('请填写完整的信息');location.href='message.php';</script>";
    }
    else
    {
        $sql="insert into obj_message set name='".avoidhit($arr['username'])."',head_image='".avoidhit($qqurl)."',word='".avoidhit($arr['msg'])."',time='".date("Y-m-d H-i-s")."',site='".avoidhit($arr['usersite'])."',email='".avoidhit($arr['email'])."'";
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
<?php
 require "mysql.php";
$del_id =$_GET['hid'];
echo $del_id;
$del_sql="DELETE FROM obj_message WHERE ID='$del_id'";
$del_query=@mysqli_query($conn,$del_sql);
if($del_query)
{ 
    echo "<script>alert('删除成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
else
{
    echo "删除失败";
}


  


?>
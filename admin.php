<?php
session_start();
header('Content-type:text/html;charset=utf-8');
if(isset($_SESSION['username']) && $_SESSION['username']=="root")
{
    echo "亲爱的{$_SESSION['username']}您好，欢迎回来!&nbsp;&nbsp;";
    echo "<a href='loginout.php'>注销</a>";
}
else
{
    echo "<title>请重新登录</title>
    <h3>管理员已退出，请选择重新登录或者前往留言主页<h3>
    <a href='login.php'>重新登录</a><br/>
    <a href='message.php'>留言主页</a>
    
    ";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    
	<style type="text/css">
      body {
      
        background-color: #f4f5fd;
      }
     #detail{
       margin:auto;
       height:auto;
       margin-bottom:20px;
       width:80%;
     }
     #detail .msg{
       clear:both;
       padding:10px; 
       height:100px;
       border-bottom:1px solid #ccc;
       margin-top:10px;
       
     }
     .username{
        width:15%;
        float: left;
        color:#3CB371;
     }
     .username img{
     	 /*width:50px;*/

        
        width: 50px;
        height:50px;
        border: 1px solid #000;
        /*margin: 50px auto 0;*/
        
        border-radius: 100px;
        transform: rotate(odeg);
        transition: all 1s ease;
        
        
     }
     .username img:hover{
        transform: rotate(360deg);
        }

     .content{
     	 width:50%;/*50*/
     	 float:left;
       word-break:break-all;
       background-color: #ECECFF;
       border-radius: 25px;
       padding: 10px;
     }
     .date{
     	 width:23%;
       text-align:center;
     	 float:left;
     }
     .date div{
       color:red;
       width:100px;
       padding:4px;
       background: #ccc;
       margin-left:70px;
       display:none;
     }
     .date div:hover{
       cursor:pointer;
     }
	</style>
</head>
<body>
	<div id="detail">

    <?php
    require "mysql.php";
    if(isset($_SESSION['username']) && $_SESSION['username']=="root")
    {
        
              
        $sql="select * from obj_message";
        $rst=mysqli_query($conn,$sql);
        while($arr=mysqli_fetch_assoc($rst))
        {
    
        
      ?>
    
        <div class="msg">
          <div class="username">
            <img src="images/0<?php echo $arr['head_image'];?>.jpg"><br><?php echo $arr['name'];?>
          </div>
          
          <div class="content"><?php echo $arr['word'];?></div>
          
          <div class="date">
          <?php echo $arr['time'];?><br>
          <br>
          <?php echo "留言的id:".$arr['id']?>
          <br>
          </div>
          
        </div>
        
     
       
        <?php    }?>
             
        <div>
	<form name="form_msg" method="post">
    <h3>删除留言</h3>

			<tr>
				<td>删除的id</td>
				<td><input type="text" name="id"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="删除" ></td>
			</tr>
		
    </form>
   
  </div>

   <?php }
  
    ?>

    </div>

 
</body>
</html>

<?php
    include_once("mysql.php");
    if(@$_POST['id'])
    {
        $del=$_POST['id'];
        $del_sql="DELETE FROM obj_message WHERE ID='$del'";
        $del_query=@mysqli_query($conn,$del_sql);
        if($del_query)
        {
            echo "删除成功！3秒后返回管理页面...";
            header("refresh:3;url='admin.php'");
            
        }
        else
        {
            echo "删除失败";
        }


    }


?>

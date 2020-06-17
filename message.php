<?php
  header('conten-type:text/html;charset=utf-8');
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  
	<title>留言板</title>
	
	<style type="text/css">
      body {
      
        background-color: #f4f5fd;
      }
      .table{
        
        margin-left:auto;
        margin-right:auto;
        max-width: 500px;
        background: #FFF;
        padding: 20px 30px 20px 30px;
        font: 12px "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #888;
        text-shadow: 1px 1px 1px #FFF;
        border:1px solid #DDD;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;


      }
	   .table img{
        width:50px;
        height:50px;
        border: 1px solid #000;
        /*margin: 50px auto 0;*/
        
        border-radius: 80px;
        transform: rotate(odeg);
       

	   }
    
     
     input[name=username],textarea{
       width:400px;
       border:1px solid #ccc;
     }
     textarea{
     	 height:150px;
     }
     h3{
       text-align:center;
       cursor:pointer;
       color:#000000;
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
     .btns { 
       width:143px; 
       height:40px; 
       background:#B9B9FF; 
       no-repeat left top; 
       color:#FFF;
       
        } 

	</style>
</head>
<body>
	<div id="detail">
  <h5>
  <a href='login.php'>管理员登录</a>
  <h5>
  <?php
    include_once("mysql.php");
    
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
      </div>
    </div>
    <?php    }?>
    </div>

<div>
	<form name="form_msg" method="post" action="do.php" class="table">
    <h3>留下您最宝贵的留言</h3>
		<table class="">
	    <tr>
				<td width="30%">昵称</td>
				<td><input type="text" name="username"></td>
        
			</tr>
			 <tr>
				<td width="30%">头像</td>
				<td>
				  <input type="radio" name="face" value="1" checked><img src="images/01.jpg">
				  <input type="radio" name="face" value="2"><img src="images/02.jpg">
				  <input type="radio" name="face" value="3"><img src="images/03.jpg">
				  <input type="radio" name="face" value="4"><img src="images/04.jpg">
				  <input type="radio" name="face" value="5"><img src="images/05.jpg">
				  
				</td>
			</tr>
			<tr>
				<td>内容</td>
				<td><textarea name="msg"></textarea></td>
			</tr>
      
			<tr>
      <td></td>
     
      
				<td colspan="2"><input type="submit" class="btns" value="写好了" ></td>
        
			</tr>
		</table>
	</form>
  </div>
</body>
</html>
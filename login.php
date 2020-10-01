<?php
    include_once("mysql.php");
    session_start();
    header('Content-type:text/html;charset=utf-8');
   
    if(isset($_SESSION['username']) && $_SESSION['username']=="root")
    {
        exit("您已经登录了，请不要重新登录");
    }

    if(isset($_POST['submit']))
    {
        if(isset($_REQUEST['yzm'])){
            
            //strtolower()小写函数
            if(strtolower($_REQUEST['yzm'])== $_SESSION['yzm']){



    if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username']==="root" && $_POST['password']==="357159.")
    {
            $_SESSION['username']=$_POST['username'];    
            header('Location:skip.php?url=admin.php&info=登录成功，正在跳转中');
        
    
    }
}
else
{
    header('Location:skip.php?url=login.php&info=验证码失败');
}
        }

    else
    {
        
        header('Location:skip.php?url=login.php&info=sorry！登录失败');
    }
    }


?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css_login/style.css">
	<title>登录界面</title>
	</head>
<body>

<form method="post" action="login.php" class="content">
        <div class="form sign-in">
            <h2>欢迎回来</h2>
            <label>
                <span>账号</span>
                <input type="text" name="username" />
            </label>
            <label>
                <span>密码</span>
                <input type="password" name="password" />
            </label>
            <label>
                
            <input type="text" name="yzm" placeholder="请输入图片中的验证码">
            <img src="yzm.php"  onclick="this.src='yzm.php?'+new Date().getTime();" alt="" width="100" height="50">
            </label>
            <button type="submit" class="submit" name="submit">登 录</button>
            
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                <div class="img__text m--up">
                    <h2>管理员登录界面</h2>
                    <p>验证码点击可刷新！</p>
                </div>
                </div>
                </div>
                </div>
            </form>
    <script src="js/script.js"></script>


</body>
</html>





	






	


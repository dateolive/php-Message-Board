<?php
session_start();
header('Content-type:text/html;charset=utf-8');
if(isset($_SESSION['username']) && $_SESSION['username']==="root")
{
  
    session_unset();//释放所有变量
    session_destroy();//销毁一个会话中的全部数据
    setcookie(session_name(),'',time()-3600,'/');//销毁保存在客户端的卡号
    header('Location:skip.php?url=admin.php&info=注销成功，正在跳转中');
}
    else
    {
        header('Location:skip.php?url=admin.php&info=注销失败，请稍后尝试');
    }


?>
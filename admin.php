<?php
session_start();
header('Content-type:text/html;charset=utf-8');
if(isset($_SESSION['username']) && $_SESSION['username']=="root")
{
    echo "亲爱的{$_SESSION['username']}您好，欢迎回来!&nbsp;&nbsp;";
    echo "<a href='loginout.php'>注销</a>";
    echo "<a href='message.php' style='float:right;'>前台页面</a>";
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.staticfile.org/angular.js/1.4.6/angular.min.js"></script>
   <script src="js/echo.js"></script>
  <link href="css/zzsc.css" rel="stylesheet" type="text/css" />
  <link href="css/card.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/OwO.min.css">
  <script src="js/zzsc.js"></script>  
  <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
	<style type="text/css">
	</style>
</head>
<body>
<div class="main">
    <div class="container">

    <?php
    require "mysql.php";
    if(isset($_SESSION['username']) && $_SESSION['username']=="root")
    {
      function comment($pageNum = 1, $pageSize = 5)
      {

        $array = array();

        $coon = mysqli_connect("localhost", "liuyan", "357159.");
        mysqli_select_db($coon, "liuyan");
        mysqli_set_charset($coon, "utf8mb4");

        // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度

        $rs = "select * from obj_message limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;

        $r = mysqli_query($coon, $rs);

        while ($obj = mysqli_fetch_object($r)) {

          $array[] = $obj;
        }

        mysqli_close($coon, "root");

        return $array;
      }
      function allcomments()
      {

        $coon = mysqli_connect("localhost", "liuyan", "357159.");

        mysqli_select_db($coon, "liuyan");

        mysqli_set_charset($coon, "utf8mb4");

        $rs = "select count(*) num from obj_message"; 

        $r = mysqli_query($coon, $rs);

        $obj = mysqli_fetch_object($r);

        mysqli_close($coon, "liuyan");

        return $obj->num;
      }

      @$allNum = allcomments();
      @$pageSize = 5; //约定每页显示几条信息
      @$pageNum = empty($_GET["pageNum"]) ? 1 : $_GET["pageNum"];
      @$endPage = ceil($allNum / $pageSize); //总页数
      @$array = comment($pageNum, $pageSize);
      ?>
      <div class="info"><div class="col"> <span class="count"><?php echo $allNum; ?></span> comments here</div></div>
      <?php 
      function qqfaceReplace($str) {
        $str = str_replace ( ">", '<,', $str ); 
        $str = str_replace ( ">", '>,', $str );
        $str = str_replace ( "\n", '>,br/>,', $str );   
        $str = preg_replace ( "[\[em_([0-9]*)\]]", "<img src=\"/arclist/$1.gif\" />", $str );
        return $str;
      }
      function isImgs($str){
            $preg = '/<img.*?src=/';
            return preg_match($preg,$str);
        }
        foreach ($array as $key => $values) {
          $message=$values->word;
       // $preg = "/<script[\s\S]*?<\/script>/i";
   
        /*$message = preg_replace($preg,"js攻击无效",$message,-1); 
        $site=preg_replace($preg,"www.datealive.top",$values->site,-1); 
        $name=preg_replace($preg,"js攻击无效",$values->name,-1); */
        if(!isImgs($message)){
            $message=htmlspecialchars($message);
        }
        ?>
        <ul class="vlist">
          <li class="vcard" style="margin-bottom: .5em">
            <div class="vcomment-body">
              <div class="vhead"><img class="vavatar lazy" src="images/loading.gif" data-echo="<?php echo $values->head_image; ?>">
               <a class="vater" href="delete.php?hid=<?php echo $values->id ?>">Delete</a>
                <div class="vmeta-info"><a class="vname" href="//<?php echo $site; ?>" target="_blank" rel="nofollow"> <?php echo $name; ?></a><span class="spacer">·</span><span class="vtime"><?php echo $values->time; ?></span></div>
              </div>
              <section class="text-wrapper">
                <div class="vcomment">
                  <p><?php 
                  echo $message; ?></p>
                </div>
              </section>
            </div>
          </li>
        </ul>
      <?php    } ?>
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="?pageNum=<?php echo $pageNum == 1 ? 1 : ($pageNum - 1) ?>"><span aria-hidden="true">&larr;</span> 前一页</a></li>
    <li class="next"><a href="?pageNum=<?php echo $pageNum == $endPage ? $endPage : ($pageNum + 1) ?>">下一页 <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>        

   <?php }
  
    ?>
    </div>
    </div>
</div>
    <a href="#0" class="cd-top">Top</a>
<script>
    Echo.init({
      offset: 0, //离可视区域多少像素的图片可以被加载
      throttle: 100 //图片延时多少毫秒加载
    });
</script>
</body>
</html>




<?php
header('conten-type:text/html;charset=utf-8');
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
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
  <title>项目--留言板</title>
  <style type="text/css">
  </style>
</head>

<body>
  <div class="main">
    <div class="container">
      <?php
      function comment($pageNum = 1, $pageSize = 5)
      {

        $array = array();

        $coon = mysqli_connect("localhost", "root", "root");
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

        $coon = mysqli_connect("localhost", "root", "root");

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
      <div class="info">
        <div class="col"> <span class="count"><?php echo $allNum; ?></span> comments here</div>
      </div>
      <?php
      function qqfaceReplace($str)
      {
        $str = str_replace(">", '<,', $str);
        $str = str_replace(">", '>,', $str);
        $str = str_replace("\n", '>,br/>,', $str);
        $str = preg_replace("[\[em_([0-9]*)\]]", "<img src=\"/arclist/$1.gif\" />", $str);
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
      <div class="row">
        <div class="col-lg-12 offset-lg-1">
          <div class="contact-box">
            <form name="form_msg" method="post" action="do.php">
              <div class="form-group row">
                <div class="col-lg-6"><input type="text" class="form-control" id="name" name="username" placeholder="姓名*" required=""></div>
                <div class="col-lg-6"><input type="email" class="form-control" id="email" name="email" placeholder="Email*" required=""></div>
              </div>
              <div class="form-group row">
                <div class="col-lg-6"><input type="text" class="form-control" id="site" name="usersite" placeholder="网站(www开头)" required=""></div>
                <div class="col-lg-6"><input type="text" class="form-control" id="qq" name="userqq" placeholder="QQ*" required=""></div>
              </div>

              <div class="form-group"><textarea class="form-control" id="message" name="msg" rows="10" placeholder="留言内容*" required=""></textarea></div>
              <div class="OwO"></div>
              <br>
              <div class="text-center">
                <button type="submit">提 交</button>
              </div>
              <div id="form-messages"></div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <a href="#0" class="cd-top">Top</a>
  <script src="js/OwO.min.js"></script>
  <script>
    var OwO_demo = new OwO({
      logo: 'OωO表情',
      container: document.getElementsByClassName('OwO')[0],
      target: document.getElementById('message'),
      api: 'OwO.json',
      position: 'down',
      width: '100%',
      maxHeight: '250px'
    });
    Echo.init({
      offset: 0, //离可视区域多少像素的图片可以被加载
      throttle: 100 //图片延时多少毫秒加载
    });
  </script>
</body>

</html>

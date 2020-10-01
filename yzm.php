<?php
    session_start();
    
    
    $width=120;
    $height=40;
    $element=array('a','b','c','d','e','f','g','h','i','j','k','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
    $string="";
    for($i=0;$i<5;$i++)
    {
        $string.=$element[rand(0,sizeof($element)-1)];
    }
    
    $_SESSION['yzm'] = $string;
    $img=imagecreatetruecolor($width,$height);
    $color_Bg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
    $color_Border=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
    $color_point=imagecolorallocate($img,rand(100,200),rand(100,200),rand(100,200));
    $color_line=imagecolorallocate($img,rand(100,200),rand(100,200),rand(100,200));
    $color_word=imagecolorallocate($img,rand(10,100),rand(10,100),rand(10,100));
    imagefill($img,0,0,$color_Bg);
    imagerectangle($img,0,0,$width-1,$height-1,$color_Border);
    for($i=0;$i<100;$i++)
    {
        imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),$color_point);
    }
    for($i=0;$i<3;$i++)
    {
        imageline($img,rand(0,($width-1)/2),rand(0,$height-1),rand(($width-1)/2,$width-1),rand(0,$height-1),$color_line);
    
    }
    //imagestring($img,5,0,0,'abcd',$color_word);
    imagettftext($img,20,rand(-5,5),rand(5,15),rand(30,35),$color_point,'./font/dungeon.TTF',$string);
    
    header("Content-type:image/jpeg");
    ob_clean();
    imagejpeg($img);
    imagedestory($img);

?>

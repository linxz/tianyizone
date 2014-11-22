<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>计算固定宽度内可容纳的图片数量以及图片尺寸 - 林小志 - CSS小工具</title>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="keywords" content="css那些事儿,林小志,linxz,页面仔,网站重构,webrebuild,腾讯,webteam,isd,林友赛,图片列表,等宽列表,css工具" />
<meta name="description" content="计算在固定宽度内出现的图片数量的个数，并且保持两端宽度相同，图片的间距也是相同。" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<style type="text/css">
body {background-color: #FFFFFF;}
div,ul,li {margin: 0;padding: 0;list-style: none;}
label {display: block;}
dd strong {font-size:21px;color:#f00;}
dd em {font-style: normal;font-size: 18px;color: #006cee;}
button.clean-gray {
  background-color: #eeeeee;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #eeeeee), color-stop(100%, #cccccc));
  background-image: -webkit-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -ms-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -o-linear-gradient(top, #eeeeee, #cccccc);
  background-image: linear-gradient(top, #eeeeee, #cccccc);
  border: 1px solid #ccc;
  border-bottom: 1px solid #bbb;
  border-radius: 3px;
  color: #333;
  font: bold 13px/1 "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Verdana, sans-serif;
  padding: 8px 25px;
  text-align: center;
  text-shadow: 0 1px 0 #eee;
  cursor: pointer;}
button.clean-gray:hover {
    background-color: #dddddd;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #dddddd), color-stop(100%, #bbbbbb));
    background-image: -webkit-linear-gradient(top, #dddddd, #bbbbbb);
    background-image: -moz-linear-gradient(top, #dddddd, #bbbbbb);
    background-image: -ms-linear-gradient(top, #dddddd, #bbbbbb);
    background-image: -o-linear-gradient(top, #dddddd, #bbbbbb);
    background-image: linear-gradient(top, #dddddd, #bbbbbb);
    border: 1px solid #bbb;
    border-bottom: 1px solid #999;
    cursor: pointer;
    text-shadow: 0 1px 0 #ddd; }
button.clean-gray:active {
    border: 1px solid #aaa;
    border-bottom: 1px solid #888;
    -webkit-box-shadow: inset 0 0 5px 2px #aaaaaa, 0 1px 0 0 #eeeeee;
    box-shadow: inset 0 0 5px 2px #aaaaaa, 0 1px 0 0 #eeeeee; }
h3 {clear: both;padding-top: 15px;}
textarea {width: 80%;height: 330px;margin-left:10px;padding:10px;color:#636363;border:1px solid #dedede;background:none;resize: none;}
.img_box {float:left;overflow:hidden;background-color:#cbcaca;zoom: 1;}
.img_box ul {overflow: hidden;zoom: 1;}
.img_box li {float: left;_display:inline;}
.img_box img {display: block;}
</style>
</head>

<body>
<?php
	$box_width = isset($_GET['box_width']) ? htmlspecialchars($_GET['box_width']) : 950; //容器外层的宽度
	$box_padding = isset($_GET['box_padding']) ? htmlspecialchars($_GET['box_padding']) : 0; //容器内部的间距padding值
	$box_border = isset($_GET['box_border']) ? htmlspecialchars($_GET['box_border']) : 0; //容器内部的间距padding值
	$box_w_result = $box_width - $box_padding * 2 - $box_border * 2; //外网容器的最后宽度
	//外围容器最后宽度的值 = 盒模型的宽度 - 容器的左右padding值 - 容器的左右边框border值
	$img_num = isset($_GET['img_num']) ? htmlspecialchars($_GET['img_num']) : 10; //图片的数量
	$img_margin = isset($_GET['img_margin']) ? htmlspecialchars($_GET['img_margin']) : 10; //图片之间的间距，坐间距margin-left值
	$img_width = floor(($box_width - $box_padding * 2 - $box_border * 2 + $img_margin) / $img_num - $img_margin); //图片的宽度
	//图片最后的宽度值 = （盒模型的宽度 - 容器的左右padding值 - 容器的左右边框border值 + 通过ul负边距出去的margin-left值）/ 图片的数量 - 图片的间距margin-left
	//     80      =  (    950    -       20*2       -       10*2         +        10                  ) /    10    -        10
	//     80      =  (    950    -       40         -       20           +        10                  ) /    10    -        10
	//     80      =  (                   890                             +        10                  ) /    10    -        10
	//     80      =  (                                   900                                          ) /    10    -        10
	//     80      =                                               90                        -                               10
?>

<form action="" method="get">
	<label>容器外围宽度：<input type="number" step="1" name="box_width" value="<?php echo $box_width;?>" />px</label>
	<label>容器外围与图片列表之间的间距（padding)：<input type="number" step="1" name="box_padding" value="<?php echo $box_padding;?>" />px</label>
	<label>容器的边框尺寸（border）：<input type="number" step="1" name="box_border" value="<?php echo $box_border;?>" />px</label>
	<label>图片的数量：<input type="number" step="1" min="1" value="<?php echo $img_num;?>" name="img_num" />张</label>
	<label>图片之间的间距（margin-left）：<input type="number" step="1" value="<?php echo $img_margin;?>" name="img_margin" />px</label>
	<button type="submit" class="clean-gray">提交</button>
</form>

<dl>
	<dt>结果：</dt>
	<dd>当外围容器div的宽度width=<em><?php echo $box_width;?>px</em>时，减去内部左右间距（padding-left &amp; padding-right）之和<em><?php echo $box_padding;?></em> + <em><?php echo $box_padding;?></em> = <em><?php echo $box_padding * 2;?>px</em>和左右边框（border-left &amp; border-right）之和<em><?php echo $box_border;?></em> + <em><?php echo $box_border;?></em> = <em><?php echo $box_border * 2;?>px</em>，最后的容器内可放图片的宽度为<strong><?php echo $box_w_result;?>px</strong></dd>
	<dd>在这个<strong><?php echo $box_w_result;?>px</strong>可用宽度的div中，如果li的左间距（margin-left）是<em><?php echo $img_margin;?>px</em>时，需要容纳<strong style="font-size:30px;"><?php echo $img_num;?></strong>张图片的话，图片宽度为<strong style="font-size:30px;"><?php echo $img_width;?>px</strong></dd>
</dl>

<div class="img_box" style="width:<?php echo $box_w_result;?>px;padding:<?php echo $box_padding;?>px;<?php if($box_border == 0){echo 'border:0 none;';}else{echo 'border:'.$box_border.'px solid #FF0000;';}?>">
	<ul style="margin-left:-<?php echo $img_margin;?>px">
		<?php for($i=1;$i<=$img_num;$i++) {?>
		<li style="margin-left:<?php echo $img_margin;?>px"><img src="http://lorempixel.com/<?php echo $img_width;?>/<?php echo $img_width;?>" alt="" /></li>
		<?php }?>
	</ul>
</div>
<div class="code_box">
	<h3>最终参考代码如下：</h3>
	<p>以下代码仅供参考，具体的还是需要根据实际情况进行修改调整。</p>
<textarea rows="5" cols="8" readonly="readonly"><style type="text/css">
div,ul,li {margin: 0;padding: 0;list-style: none;}
.img_box {float:left;overflow:hidden;background-color:#cbcaca;zoom: 1;width:<?php echo $box_w_result;?>px;padding:<?php echo $box_padding;?>px;<?php if($box_border == 0){echo 'border:0 none;';}else{echo 'border:'.$box_border.'px solid #FF0000;';}?>}
.img_box ul {overflow: hidden;zoom: 1;margin-left:-<?php echo $img_margin;?>px;}
.img_box li {float: left;_display:inline;margin-left:<?php echo $img_margin;?>px;}
.img_box img {display: block;}
</style>

<div class="img_box" style="width:<?php echo $box_w_result;?>px;padding:<?php echo $box_padding;?>px;<?php if($box_border == 0){echo 'border:0 none;';}else{echo 'border:'.$box_border.'px solid #FF0000;';}?>">
	<ul>
	<?php for($i=1;$i<=$img_num;$i++) {?>
	<li><img src="http://lorempixel.com/<?php echo $img_width;?>/<?php echo $img_width;?>" alt="" /></li>
	<?php }?>
</ul>
</div></textarea>
</div>
</body>
</html>

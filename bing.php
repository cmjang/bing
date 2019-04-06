<?php
function saveImage($path) {
	if(!preg_match('/\/([^\/]+\.[a-z]{3,4})$/i',$path,$matches))
		die('Use image please');
	$image_name = strToLower($matches[1]);
	$ch = curl_init ($path);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	$img = curl_exec ($ch);
	curl_close ($ch);
//$image_name就是要保存到什么路径,默认只写文件名的话保存到根目录
 $fp = fopen($image_name,'w');//保存的文件名称用的是链接里面的名称
 fwrite($fp, $img);
 fclose($fp);
}
$str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1');
$array = json_decode($str);
$imgurl = $array->{"images"}[0]->{"url"};
if($imgurl){
	$pic = 'http://cn.bing.com'.$imgurl;
	saveImage($pic);
			//exit();
}
return 1;
?>
<?php

header("Content-type: text/html; charset=utf-8"); 

error_reporting(E_ALL ^ E_NOTICE);// 显示除去 E_NOTICE 之外的所有错误信息
$uid = $_GET["uid"];
$target = $_GET["target"];


function curl_get_https($url){
	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);// TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
	$tmpInfo = curl_exec($curl); // 返回api的json对象
	curl_close($curl);
	return $tmpInfo; // 返回json对象
}


if ($uid != null) {
	$file_contents = curl_get_https('https://api.bilibili.com/x/web-interface/card?mid=' . $uid);
	$arr = json_decode($file_contents,true);
		
}
?>

<script>
function show(){
//	var date = new Date(); //日期对象
//	var now = "";
//	now = date.getFullYear()+"-"; //读英文就行了
//	now = now + (date.getMonth()+1)+"-"; //取月的时候取的是当前月-1如果想取当前月+1就可以了
//	now = now + date.getDate()+" ";
//	now = now + date.getHours()+":";
//	now = now + date.getMinutes()+":";
//	now = now + date.getSeconds();
	
//	document.getElementById("nowDiv").innerHTML = '<?php echo date('Y-m-d H:i:s', time());?>'; //div的html是now这个字符串

//	setTimeout("show()",1000);

}
</script>


<header>
	<title><?php echo $arr['data']['card']['name'] . "万粉达成"?></title>
	<meta name="referrer" content="no-referrer" />
</header>


<body onload=show()>
<center>
	<img src=<?php echo $arr['data']['card']['face']; ?> />
	<br/>
	<?php
		echo $arr['data']['card']['name'] . "</br>";
		echo "粉丝数：" . $arr['data']['follower'] . "</br>";
		echo "目标：" . $target . "万<br/>";
		echo date('Y-m-d H:i:s', time());
	?>
	<div id="achievedDiv"></div>
	<!--<div id="nowDiv"></div>-->
</center>

</body>

<script language="JavaScript">

if(parseFloat(<?php echo $arr['data']['follower'];?>)<parseFloat(<?php echo $target;?>)*10000){
	document.getElementById("achievedDiv").innerHTML = "要来力！";
	setTimeout(function(){location.reload(true)},1000); //指定1秒刷新一次
}else{
	document.getElementById("achievedDiv").innerHTML = "亚达贼！！！";

}
</script>
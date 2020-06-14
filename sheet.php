<?php
include('Mobile_Detect.php');
include('BrowserDetection.php');
include('db.php');
session_start();
$user_name = $_SESSION['userNameX'];
$browser=new Wolfcast\BrowserDetection;
$browser_name=$browser->getName();
$browser_version=$browser->getVersion();

$detect=new Mobile_Detect();

if($detect->isMobile()){
	$type='Mobile';
}elseif($detect->isTablet()){
	$type='Tablet';
}else{
	$type='PC';
}

if($detect->isiOS()){
	$os='IOS';
}elseif($detect->isAndroidOS()){
	$os='Android';
}else{
	$os='Window';
}

$sql="insert into visitor(uname,browser_name,browser_version,type,os) values('$user_name','$browser_name','$browser_version','$type','$os')";
mysqli_query($dbc,$sql);
?>
<html>
<title>Document Page</title>
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="src/css/font.css" rel="stylesheet">
    <link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
	<a href="visited_user.php">View Visited User History</a>
	<pre>
		 	 	 	 	      SAMPLE DOCUMENT 
 
 
		Today’s Artificial Intelligence (AI) has far surpassed the hype of blockchain and quantum computing.
		This is due to the fact that huge computing resources are easily available to the common man. 
		The developers now take advantage of this in creating new Machine Learning models and to re-train 
		the existing models for better performance and results. The easy availability of High Performance 
		Computing (HPC) has resulted in a sudden increased demand for IT professionals having Machine
		Learning skills. 
 
		When you tag a face in a Facebook photo, it is AI that is running behind the scenes and identifying
		faces in a picture. Face tagging is now omnipresent in several applications that display pictures 
		with human faces. Why just human faces? There are several applications that detect objects such as
		cats, dogs, bottles, cars, etc. We have autonomous cars running on our roads that detect objects 
		in real time to steer the car. When you travel, you use Google Directions to learn the real-time 
		traffic situations and follow the best path suggested by Google at that point of time. This is yet 
		another implementation of object detection technique in real time. Let us consider the example of
		Google Translate application that we typically use while visiting foreign countries. Google’s
		online translator app on your mobile helps you communicate with the local people speaking a 
		language that is foreign to you. There are several applications of AI that we use practically 
		today. In fact, each one of us use AI in many parts of our lives, even without our knowledge.
		Today’s AI can perform extremely complex jobs with a great accuracy and speed. Let us discuss 
		an example of complex task to understand what capabilities are expected in an AI application 
		that you would be developing today for your clients. 
</pre>
<form method="post" action="index.php">
	<table align="center">
		<tr>
			<td><input type="submit" align="center" value="LogOut" style="height:20px;width=30%"></td>
		</tr>
	</table>		
</form>
</body>
</html>

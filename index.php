<!DOCTYPE html>
<html lang="en">
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
	<?php

	$userLoginDone = "no";
	
	if(isset($_POST['UserLogin'])){
		include 'db.php';
		$email = $_POST['userEmail'];
		$password = $_POST['userPass'];
		$userLoginQuery="select uname as name from register where email='$email' and pwd='$password';";
		$res=mysqli_query($dbc,$userLoginQuery);
		$count=mysqli_num_rows($res);
		session_start();
		if($count!=0){
			$data = mysqli_fetch_array($res);
			$uname = $data['name'];
			$uname = explode(" ", $uname);
			$_SESSION['userNameX'] = $uname[0];
			header('location:sheet.php');
		}
		else{
			$userLoginDone = "failed";
			echo '<script type="text/javascript">';
			echo ' alert("Invalid Credentials")';  //not showing an alert box.
			echo '</script>';
		}
	}
	
	?>
	<br><br>
	<table align="center" style="width:40%" bgcolor="">
		<td align="center">
        <div align="center" style="font-size:35px">LOGIN</div>
        <form method="post">
        <br>
		<input type="text" class="login" placeholder="Email ID" id="userEmail" name="userEmail" maxlength="50"/>
        <br><br>
		<input type="Password" class="login" placeholder="Password" id="userPass" name="userPass" maxlength="20"/>
        <div id="validationText" align="center" style="margin-top:0%; margin-bottom:3%" class="valError">
			
		</div>
		
        <table>
        <tr>
          <td width="60%">
			<input type="button" class="loginBtn" value="Login" name="" id="userLoginBtn" onclick="validateUserLogin();">
			<input type="submit" hidden disabled class="" value="UserLogin" name="UserLogin" id="userLoginFinal">
          </td>
          <td width="10%"></td>
          <td width="55%">
			<input type="reset" class="loginBtn" value="Reset" name="" id="userResetBtn" onclick="resetUserValidation();">
          </td>
        </tr>
        <tr>
        	<td>Not a Member?<a href="register.php">Click Here</a></td>
        </tr>
      </form>
      </table>
</body>
	
<script>
		function resetUserValidation(){
		document.getElementById("validationText").innerHTML = "";
		document.getElementById("userEmail").style="";
		document.getElementById("userPass").style="";
	}

function validateUserLogin(){
	resetUserValidation();
	
	var email = document.getElementById("userEmail").value;
	var pass = document.getElementById("userPass").value;
	
	if(isEmpty(email) && isEmpty(pass)){
		document.getElementById("validationText").innerHTML = "<br>All Fields are empty<br>";
		document.getElementById("userEmail").style=" border-color:red;";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else if(isEmpty(email)){
		document.getElementById("validationText").innerHTML = "<br>Email ID Empty<br>";
		document.getElementById("userEmail").style=" border-color:red;";
	}
	else if(!isEmail(email)){
		document.getElementById("validationText").innerHTML = "<br>Email ID Invalid<br>";		
		document.getElementById("userEmail").style=" border-color:red;";
	}
	else if(isEmpty(pass)){
		document.getElementById("validationText").innerHTML = "<br>Password Empty<br>";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else if(pass.length<6){
		document.getElementById("validationText").innerHTML = "<br>Password should contain minimum 6 characters<br>";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else if(!isPassword(pass)){
		document.getElementById("validationText").innerHTML = "<br>Password should be Alphanumeric<br>";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else{
		document.getElementById('userLoginFinal').disabled = false;
		document.getElementById('userLoginFinal').click();
	}

}
<?php
	if($userLoginDone == "failed"){
	}
	?>
</script>	
<script src="src/js/fabrica.js"></script>
</html>
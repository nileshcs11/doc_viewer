<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta Tages -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
    <title>Registration</title>
</head>
<body>
 <?php
	$userExists = "no";
	$regDone = "no";
	
	if(isset($_POST['RegisterUser'])){
		include 'db.php';
		$u_email = $_POST['emailID'];
		$u_uname = $_POST['uname'];
		$emailExistsQuery="SELECT name FROM register WHERE email = '$u_email'";
		$unameExistsQuery="SELECT name FROM register WHERE uname = '$u_uname'";
		$res=mysqli_query($dbc,$emailExistsQuery);
		$res2=mysqli_query($dbc,$unameExistsQuery);
		$count=mysqli_num_rows($res);
		$count2=mysqli_num_rows($res2);
		if($count!=0 || $count2!=0){
			header('location:register.php?userExists=true');
		}
		else{
			$u_name = $_POST['name'];
			$u_pass = $_POST['pwd'];
			$registerQuery = "INSERT INTO register(name, uname,email,pwd) VALUES('$u_name', '$u_uname', '$u_email', '$u_pass');";
			$result = mysqli_query($dbc,$registerQuery);
			if($result)
			{
				header('location:index.php');
			}			
		}
	}
	else if(isset($_GET['userExists'])){
		$userExists="yes";
	}
	
 ?>
  <br> <br>


      <!-- Registration Section -->

        <div align="center" style="font-size:35px">REGISTRATION</div>
        <br>
		<center style="font-size:20px">
		
		<br>
        <form autocomplete="off" method="post">
        <input type="text" class="register" id="name" name="name" maxlength="30" placeholder="Name" autocomplete="off"/>
        <br><br>
        <input type="text" class="register" id="uname" name="uname" maxlength="10" placeholder="username"/>
        <br><br>
        <input type="email" class="register" id="emailID" name="emailID" maxlength="30" placeholder="Email ID"/>
        <br><br>
        <input type="password" class="register" id="password" name="pwd" maxlength="70" placeholder="Password"/>
        <br><br>
		
        <div id="validationText" align="center" style="margin-top:0%; margin-bottom:3%" class="valError">
		</div>

        <table>
        <tr>
          <td width="45%">
            <input type="button" class="registerBtn" value="Register" name="" id="userRegBtn" onclick="validateForm();">
			<input type="submit" hidden disabled value="RegisterUser" name="RegisterUser" id="registerUserFinal">
          </td>
          <td width="10%">
          <td width="45%">
            <input type="reset" class="registerBtn" value="Reset" name="" id="userReset">
          </td>
        </tr>
      </form>
      </table>
</center>

<br>
<br>	
   <div id="regDoneModal" class="w3-modal">
	<div class="w3-modal-content">
	  <div align="center" class="w3-container">
		<span onclick="document.getElementById('regDoneModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
		<p>Registration Done Successfully!</p>
		<table>
			<tr>
				<td></td>
				<td>
					<input type="button" class="loginBtn" value="Login" name="" id="" onclick="window.location.href = 'index.php';">
				</td>
				<td>    </td>
				<td>
					<input type="button" class="loginBtn" value=" Close " name="" id="" onclick="document.getElementById('regDoneModal').style.display='none'">
				</td>
			</tr>
		</table>
		<br>
	  </div>
	</div>
</div>
	
</body>
<script>
const name = document.getElementById("name");
const uname = document.getElementById("uname");
const email = document.getElementById("emailID");
const pass = document.getElementById("password");
function resetValidation(){
	document.getElementById("validationText").innerHTML = "";
	document.getElementById("name").style="";
	document.getElementById("uname").style="";
	document.getElementById("emailID").style="";
	document.getElementById("password").style="";
}

function validateForm(){
	resetValidation();

	var name = document.getElementById("name").value;
	
	var emailID = document.getElementById("emailID").value;
	var uname = document.getElementById("uname").value;
	var pass = document.getElementById("password").value;
	
	if(isEmpty(name)  && isEmpty(uname) && isEmpty(emailID) && isEmpty(password) ){
		document.getElementById("validationText").innerHTML = "<br>All Fields are empty<br>";
		document.getElementById("name").style="border-color:red;";
		document.getElementById("uname").style="border-color:red;";
		document.getElementById("emailID").style="border-color:red;";
		
		
		document.getElementById("password").style="border-color:red;";
		
	}
	else if(isEmpty(name)){
		document.getElementById("validationText").innerHTML = "<br>Name Empty<br>";
		document.getElementById("name").style="border-color:red;";
	}
	else if(isNumber(name)){
		document.getElementById("validationText").innerHTML = "<br>Name Invalid<br>";
		document.getElementById("name").style="border-color:red;";
	}
	else if(isEmpty(uname)){
		document.getElementById("validationText").innerHTML = "<br>username Empty<br>";
		document.getElementById("emailID").style="border-color:red;";
	}
	else if(isEmpty(emailID)){
		document.getElementById("validationText").innerHTML = "<br>Email ID Empty<br>";
		document.getElementById("emailID").style="border-color:red;";
	}
	else if(!isEmail(emailID)){
		speak('Email ID Invalid');
		document.getElementById("validationText").innerHTML = "<br>Email ID Invalid<br>";
		document.getElementById("emailID").style="border-color:red;";
	}
	else if(isEmpty(pass)){
		speak('Password Empty');
		document.getElementById("validationText").innerHTML = "<br>Password Empty<br>";
		document.getElementById("pass").style=" border-color:red;";
	}
	else if(pass.length<6){
		speak('Password should contain minimum 6 characters');
		document.getElementById("validationText").innerHTML = "<br>Password should contain minimum 6 characters<br>";
		document.getElementById("pass").style=" border-color:red;";
	}
	else if(!isPassword(pass)){
		document.getElementById("validationText").innerHTML = "<br>Password should be Alphanumeric<br>";
		document.getElementById("pass").style=" border-color:red;";
	}
	else{
		document.getElementById('registerUserFinal').disabled = false;
		document.getElementById('registerUserFinal').click();
	}

}

</script>

<?php

if($userExists=="yes"){
?>
	<script>
	document.getElementById("validationText").innerHTML = "<br>User Already Exists<br>";
	document.getElementById("emailID").style="border-color:red;";
	</script>
<?php
}
?>
<script src="src/js/fabrica.js"></script>
</html>
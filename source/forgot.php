<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
$con = mysql_connect('internal-db.s92997.gridserver.com', 'db92997_phpcms', 'phpcms234') or die(mysql_error());
$db = mysql_select_db('db92997_phpcms', $con) or die(mysql_error());

//include out functions file giving us access to the protect() function made earlier
include "./functions.php";

?>
<html>
	<head>
		<title>Login with Users Online Tutorial</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
		
		//Check to see if the forms submitted
		if($_POST['submit']){
			//if it is continue checks
			
			//store the posted email to variable after protection
			$email = protect($_POST['email']);
			
			//check if the email box was not filled in
			if(!$email){
				//if it wasn't display error message
				echo "<center>You need to fill in your <b>E-mail</b> address!</center>";
			}else{
				//else continue checking
				
				//set the format to check the email against
				$checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
				
				//check if the email doesnt match the required format
	            if(!preg_match($checkemail, $email)){
	            	//if not then display error message
	                echo "<center><b>E-mail</b> is not valid, must be name@server.tld!</center>";
	            }else{
	            	//otherwise continue checking
	            	
	            	//select all rows from the database where the emails match
	            	$res = mysql_query("SELECT * FROM `users` WHERE `email` = '".$email."'");
	            	$num = mysql_num_rows($res);
	            	
	            	//check if the number of row matched is equal to 0
	            	if($num == 0){
	            		//if it is display error message
						echo "<center>The <b>E-mail</b> you supplied does not exist in our database!</center>";
					}else{
						//otherwise complete forgot pass function
						
						//split the row into an associative array
						$row = mysql_fetch_assoc($res);
						
						//send email containing their password to their email address
						mail($email, 'Forgotten Password', "Here is your password: ".$row['password']."\n\nPlease try not too lose it again!", 'From: noreply@yourwebsitehere.co.uk');
						
						//display success message
						echo "<center>An email has been sent too your email address containing your password!</center>";
					}
				}
			}
		}
		
		?>
		<div id="border">
			<form action="forgot.php" method="post">
				<table cellpadding="2" cellspacing="0" border="0">
					<tr>
						<td>Email: </td>
						<td><input type="text" name="email" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="submit" value="Send" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="register.php">Register</a> | <a href="login.php">Login</a></a></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
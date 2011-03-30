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
		
		//check if the login session does no exist
		if(!$_SESSION['uid']){
			//if it doesn't display an error message
			echo "<center>You need to be logged in to log out!</center>";
		}else{
			//if it does continue checking
			
			//update to set this users online field to the current time
			mysql_query("UPDATE `users` SET `online` = '".date('U')."' WHERE `id` = '".$_SESSION['uid']."'");
			
			//destroy all sessions canceling the login session
			session_destroy();
			
			//display success message
			echo "<center>You have successfully logged out!</center>";
		}
		
		?>
	</body>
</html>
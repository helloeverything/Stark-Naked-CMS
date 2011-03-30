<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stark Naked CMS</title>
<link rel="stylesheet" href="sources/styles.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<body>

<div id="container">
		<?php include "nav.php";?>

	<div id="header">
		<h1>Stark Naked CMS</h1>
		<p></p>
	</div>
	<div id="nav">
		<ul>
			<?php
				// Load in our navigation links from the MySQL database
				require("sources/connection.php");
				$sql = "SELECT name, url, title FROM nav";
				$result = $conn->query($sql) or die(mysqli_error());
				if($result){
					while($row = $result->fetch_object()){
						echo "<li><a href='{$row->url}' title='{$row->title}'>{$row->name}</a></li>";					
					}
				}
			
			?>
		</ul>
	</div>
	
	<div id="content">
		<?php
			// Load in the content of the current viewing page from the MySQL database
			$page = (isset($_GET['page'])) ? $_GET['page'] : "1";
			$sql = "SELECT name, content FROM pages WHERE id='$page'";
			$result = $conn->query($sql) or die(mysqli_error());
			if($result){
				$row = $result->fetch_object();
				echo $row->content;
			}
	
		?>
		<div class="reg-btn">
		<a href="register.php" class="button blue">Register with Us... it's free!</a> 
	</div>
	
	</div>

			
</div>
	<div id="footer">
		<p>&copy; 2011 Designed using valid <a href="http://validator.w3.org/check/referer" title="valid XHTML strict">XHTML</a> and <a href="http://jigsaw.w3.org/css-validator/check/referer" title="CSS">CSS</a></p>
	</div>
</body>
</html>

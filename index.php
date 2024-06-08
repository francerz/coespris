<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>COESPRIS - STS</title>
	<link rel="icon" type="image/png" href="assets/img/favicon.png"/>
</head>
<body style='overflow:hidden; margin:0px'>
	<?php if (isset($_SESSION['username'])) {?>
		<iframe src='./menu.php' style='position:absolute; border:none; width:100%; height:100%'></iframe>
	<?php }else{ ?>
		<iframe src='./login.php' style='position:absolute; border:none; width:100%; height:100%'></iframe>
	<?php }?>
</body>
</html>
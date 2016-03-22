<?php
	session_start();
	session_regenerate_id();
 
	if (empty($_SESSION['login'])) {
		header('Location: login.php');
		exit;
	} else {
		$login_status = '
    		<ul class="nav navbar-nav navbar-right">
      			<li><a href=""><span class="glyphicon glyphicon-user"></span>'. htmlspecialchars($_SESSION['user']['username']).'</a></li>
      			<li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
    		</ul>
		';
	}
?>
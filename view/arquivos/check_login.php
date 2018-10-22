<?php
	session_start();

	if(isset($_SESSION['login'])){
		$login = 1;
	}else{
		$login = 0;
	}
?>
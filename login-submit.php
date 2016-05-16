<?php 
	include_once 'security.php';

	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	/*** check if the users is already logged in ***/
	if(login())
	{
		if (!empty($_SESSION['usertype'])) {
			if($_SESSION['usertype']=="client"){
			header("Location: client/index.php");
			exit;
			} else if($_SESSION['usertype']=="admin"){
				header("Location: admin/index.php");
				exit;
			} else if($_SESSION['usertype']=="controleur"){
				header("Location: controleur/index.php");
				exit;
			}
		}
		

	    header("Location: index.php");
    	exit;
	} else {
		header("Location: login.php");
    exit;
	}
?>
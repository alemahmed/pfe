<?php


	include_once 'dbconfig.php';

	$type = '';

	function Login()
	{
	    if(empty($_POST['username']))
	    {
	        //"UserName is empty!
	        return false;
	    }
	     
	    if(empty($_POST['password']))
	    {
	        //Password is empty!
	        return false;
	    }
	     
	    $username = trim($_POST['username']);
	    $password = trim($_POST['password']);
	    $hashed_password=sha1($password);
	    $type = trim($_POST['type']);
	     
	    if(!CheckLoginInDB($username,$hashed_password,$type))
	    {
	        return false;
	    }
	     
	    session_start();
	     
	    $_SESSION['username'] = $username;
		$_SESSION['usertype'] = $type;

	    return true;
	}

	function CheckLoginInDB($username,$password,$type)
	{
	    $qry = "SELECT * FROM account".
	        	" where username='$username' and password='$password' and type='$type' ";
	     
	    $result = mysql_query($qry);
	     
	    if(!$result || mysql_num_rows($result) <= 0)
	    {
	        print_r("Error logging in. ".
	            "The username or password does not match");
	        return false;
	    }

	    return true;
	}

	function CheckLogin()
	{
	     if(!isset($_SESSION)) 
	    { 
	        session_start(); 
	    }
	      
	     if(empty($_SESSION['username']))
	     {
	        return false;
	     }
	     return true;
	}

	function Logout()
	{
	     session_start();
	 
	     // Unset all of the session variables.
		session_unset();

		// Destroy the session.
		session_destroy();
	}

  ?>
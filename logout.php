<?php

session_start();

if(isset($_SESSION['mail']))
{
	unset($_SESSION['mail']);

}

header("Location: signin.php");
die;
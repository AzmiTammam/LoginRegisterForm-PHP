<?php 

function isLoggedIn()
{
	if (isset($_SESSION['name'])) {
		return true;
	}else{
		return false;
	}
}

function isLoggedInAdmin()
{
	if (isset($_SESSION['isAdmin'])) {
		return true;
	}else{
		return false;
	}
}

?>
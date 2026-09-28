<?php
global $root;

if (preg_match("/user.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: " .$root."index.php");
  die();
}

class user{
 	var 	$id
 		,	$username
 		,	$token
	 	,	$userType
 		,	$firsname
 		,	$surname
 		
 		,	$account_verified
 		,	$fb_userid
 		,	$privacy1
 		,	$privacy2
 		,	$Address
 		,	$City
 		,	$Country
 		,	$Telephone;
 		
 	function __to__toStringString(){
 		echo $this->username;
 	}	

}
?>

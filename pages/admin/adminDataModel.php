<?php
/**
 * Evito che accedano direttamente al file
 */
if (preg_match("/adminDataModel.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: ../index.php");
  die();
}

require "model/page.php";

class pageAdmin extends page{

	var 	$menuAdmin
		,	$investments;
			
		
	function __construct(){
		$this->pageTitle = "Admin";
	}
	
}
?>
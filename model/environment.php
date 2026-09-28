<?php
if (preg_match("/environment.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: ".$root."index.php");
  die();
}
	global $root, $isDevelopment;

	
	//to select the setup preference from DB enable the followin code

    /*
	$query = "select template,page_start,desc_brief from options";
	$result = $result=$database->db_query($query);
	$options = $database->db_fetch_row($result);
	
	//menu with user setup
	//$menu = new menu($_SESSION['user_type']);
	
    $template 	= $options["template"];
    $page 		= $options["page_start"];
    $about		= $options["desc_breve"];
    */

	$step 		= "index";
    $currentPageTitle = "";
	$isMobile = false;
	$isMobileBrowser = false;

	//Depending on the OS choose different date formats
	$formatExtendedDate = "%A %d %B";
	
	// Define variables for confrontations
	if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
		setlocale(LC_TIME,'ita','it_IT.utf8');  // setlocale(LC_TIME,"ita", "it_IT.utf8");
		$formatExtendedDate = "%A %d %B";
	} else {  //setlocale(LC_TIME, "it_IT", "it", "it_IT.utf8");
		setlocale(LC_TIME,"it_IT","it_IT.utf8");
		$formatExtendedDate = "%A %e %B";
	}
	
	$otoday=date("Y-m-d");		
	
	//user management
	$user = new user();
	$user_profile = null;

?>
<?php
/*main config file*/
//Block direct access to file
if (preg_match("/mainConfig.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: index.php");
  die();
}
$isDevelopment = false;
if (strrpos(getBaseURL(), "localhost") >0)
{
$isDevelopment = true;
}
$dbName = "sensuspr";
$dbUser = "gabriele";
$dbPass = "password";
$dbIP = "localhost";

// Define here you own values
$config = array(
	"db_name" => "sensuspr",
	"db_user" => "gabriele",
	"db_password" => "password",
	"db_host" => "localhost"
);                
$applicationURL = "/";
$_SESSION['applicationURL'] = $applicationURL;
if($isDevelopment){
	$dbIP = "localhost";
	$dbUser = "root";
	$dbPass = "";
	$dbName = "sensuspr";
	$config = array(
	"db_name" => "sensuspr",
	"db_user" => "root",
	"db_password" => "",
	"db_host" => "localhost"
);     
    
    //change this to the correct URL
	$applicationURL = "/sensuspr/";
}
$page = "";

/* Common META TAG */

$myHost = "";
$copyright = "© ".date("Y")." SET HERE COPYRIGHT";
$author= "SET HERE AUTHOR";
$generator = "";
$language = "en"; //set the website main language here

// global variables for inc_head.php data
    global $languagemain;
    global $authorhead;
    global $copyrighthead;
    $languagemain=$language;
    $authorhead=$author;
    $copyrighthead=$copyright;

$isDebug = false;
?>
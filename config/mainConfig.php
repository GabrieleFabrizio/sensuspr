<?php
/*main config file*/
//Block direct access to file
if (preg_match("/mainConfig.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: index.php");
  die();
}

// required by bluehost to explicit the Session path: for bluehost must be set: "/home2/kitesus1/public_html/cgi-bin/tmp"
// for local server nothing
$sessionpath = "";

$isDevelopment = false;
if (strrpos(getBaseURL(), "localhost") > 0) {
    $isDevelopment = true;
}

$dbName = getenv('DB_NAME') ?: 'sensuspr';
$dbUser = getenv('DB_USER') ?: '';
$dbPass = getenv('DB_PASSWORD') ?: '';
$dbIP   = getenv('DB_HOST') ?: 'db';

$config = array(
    "db_name"     => $dbName,
    "db_user"     => $dbUser,
    "db_password" => $dbPass,
    "db_host"     => $dbIP
);

$applicationURL = "/";
$_SESSION['applicationURL'] = $applicationURL;
$page = "";

/* Common META TAG */

$myHost = "";
$copyright = "© ".date("Y")." Sensuspr";
$author    = "sensuspr";
$generator = "";
$language  = "en";

// Default email for automated site email sending
global $sendName;
global $primaryEmail;
global $secondaryEmail;
global $sendEmail;
$sendName       = getenv('SEND_NAME')        ?: 'Sensus PR';
$primaryEmail   = getenv('PRIMARY_EMAIL')    ?: 'pr@sensuspr.com';
$secondaryEmail = getenv('SECONDARY_EMAIL')  ?: 'info@sensuspr.com';
$sendEmail      = getenv('SEND_EMAIL')       ?: 'pr@sensuspr.com';

$isDebug = false;

<?php
global $root;
if (preg_match("/loginController.php/",$_SERVER['PHP_SELF'])) {
  //Header("Location: ../index.php");
  //die();
}

error_reporting (E_ALL ^ E_NOTICE);
include("../utilities.php");
include("../config/mainConfig.php");
include("../model/db.php");
include_once("../utilities.php");
$root= getBaseURL().$applicationURL; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($isDevelopment) && $isDevelopment) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}

function getClientIp(){
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($parts[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function enforceMethod($expected){
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    if (strtoupper($method) !== strtoupper($expected)) {
        header('HTTP/1.1 405 Method Not Allowed');
        exit;
    }
}

function throttleOrDie($key, $maxRequests, $windowSeconds){
    $ip = getClientIp();
    $now = time();
    $safeKey = preg_replace('/[^a-zA-Z0-9_\-]/', '_', (string)$key);
    $fname = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'sensuspr_rl_' . sha1($safeKey . '|' . $ip) . '.json';
    $data = ['start' => $now, 'count' => 0];
    if (is_file($fname)) {
        $raw = @file_get_contents($fname);
        $decoded = json_decode((string)$raw, true);
        if (is_array($decoded) && isset($decoded['start']) && isset($decoded['count'])) {
            $data = $decoded;
        }
    }
    if (($now - (int)$data['start']) >= $windowSeconds) {
        $data = ['start' => $now, 'count' => 0];
    }
    $data['count'] = (int)$data['count'] + 1;
    @file_put_contents($fname, json_encode($data));
    if ($data['count'] > $maxRequests) {
        header('HTTP/1.1 429 Too Many Requests');
        exit;
    }
}

$action = $_GET['action'];
$database = new database();

switch ($action) {
    case "registrazione":
        registrazione();
        break;
    case "registrazioneConfirm":
        registrazioneConfirm();
        break;  
    case "sendpassword":
        sendpassword();
        break; 
    case "changepassword":
        changepassword();
        break;      
    case "sendpasswordConfirm":
        sendpasswordConfirm();
        break;   
    case "login":
        login();
        break;
    case "logout":
        logout();
        break;
    default:
        print "Error: $action.";
        break;
}

function login() {
    global $database,$dbIP,$dbName,$dbUser,$dbPass;
    enforceMethod('POST');
    throttleOrDie('login', 25, 60);
    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    $currentPage=$_REQUEST['currentPage'] ?? '';

    $connected=false;
    $crypted_pass = hash('sha256', $password);
    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }
    $usernameEsc = mysqli_real_escape_string($database->connection, (string)$username);
    $passEsc = mysqli_real_escape_string($database->connection, (string)$crypted_pass);
    $query = "SELECT id, login_name,type,email, firstname, lastname, token FROM userprofile WHERE login_name=\"$usernameEsc\" AND password_hash=\"$passEsc\" AND account_verified=\"Y\" ";
    $resource = $database->db_query($query);
    $resources_num = mysqli_num_rows($resource);
    $row_user=$database->db_fetch_row($resource);

    if ($resources_num == 1) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['authorized']='true';
        $_SESSION['user_username']= $row_user['login_name'];
        $_SESSION['user_type']= $row_user['type'];
        $_SESSION['user_email']= $row_user['email'];
        $_SESSION['UtenteID']= $row_user['id'];
        $_SESSION['firstname']= $row_user['firstname'];
        $_SESSION['lastname']= $row_user['lastname'];

        $database->db_close();   
        $currentPage = str_replace("&error=LOG_", "&err=", $currentPage);

        if (strlen($currentPage)>5)
            {
            header("Location: $currentPage"); 
            exit;
            }
        else
            {
            header("Location: ../"); 
            exit;
            }  
    }
    else
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['LOGIN_ERROR']="true";
        $_SESSION['authorized']='false';
        $_SESSION['UtenteID']=0;
        $_SESSION['user_username']= "";
        $_SESSION['user_type']= "";
        $_SESSION['user_email']= "";

        $database->db_close();   
        header("Location: ../index.php?page=login&error=LOG_01");exit;
    }
}

function logout(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION["authorized"]);

    $_SESSION['user_username']= "";
    $_SESSION['user_type']= 1;
    $_SESSION['user_email']= "";

    session_destroy();
    header('Location: ../');
}

function usernameValidation($username){
    $error = 0;

    if (strrpos($username, " ") === true) {
        return 0;
    }

    if( strlen($username) < 4 ) {
        return 0;
    }

    if( strlen($username) > 15 ) {
        return 0;
    }

    if( strlen($username) > 4 AND strlen($username) < 15 ) {
        return 1;
    }
}

function registrazioneConfirm(){
    global $database,$dbIP,$dbName,$dbUser,$dbPass,$sendName,$primaryEmail;
    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }

    if (false == isset($_GET['t']) || false == isset($_GET['u']))
    {
        header('Location: ../index.php');
    }
    $confirm_user=$_GET['u'];
    $confirm_token=$_GET['t'];

    $confirmUserEsc = mysqli_real_escape_string($database->connection, (string)$confirm_user);
    $confirmTokenEsc = mysqli_real_escape_string($database->connection, (string)$confirm_token);
    $query = "SELECT * FROM userprofile WHERE login_name=\"$confirmUserEsc\" AND token=\"$confirmTokenEsc\" AND account_verified = 'N' ";
    $res = $database->db_query($query);
    $res_num = mysqli_num_rows($res);
    $row_user=$database->db_fetch_row($res);

    if ($res_num != 1) {
        header('Location: ../index.php');
    }

    if ($res_num == 1) {
        $logg=$row_user['login_name'];
        $emailfin=$row_user['email'];
        $nome=$row_user['firstname'];

        $queryUpdate = "UPDATE userprofile SET account_verified = 'Y' WHERE login_name=\"$confirmUserEsc\" AND token=\"$confirmTokenEsc\" AND account_verified = 'N' ";

        $database->db_query($queryUpdate);

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . $sendName . ' <' . $primaryEmail . '>' . "\r\n";

        $subject = $sendName . ' - User registration confirmed';
        $emailText = "<font face=\"verdana\" size=\"2\"><p>Dear <b>".$nome."</b>,<br/><br/>Your account has been confirmed and you are now a registered member of ".$sendName.".</p>"
                            . "<p>Thank you for joining us.</p></font>"
                            . "<p><font size=\"2\">In case of problems feel free to contact us at <a href=\"mailto:".$primaryEmail."\">".$primaryEmail."</a></font></p>";

        mail($emailfin, $subject, $emailText, $headers);

        $database->db_close();
        header("Location: ../index.php?page=registrazione&step=confirm");
    }
}

function registrazione(){
    global $database,$dbIP,$dbName,$dbUser,$dbPass,$root, $isDevelopment,$sendName,$primaryEmail;
    enforceMethod('POST');
    throttleOrDie('registrazione', 10, 60);
    include("../config/xcapkeys.php");
    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }

    $errorMessage = "";

    $reg_username=$_POST['nick'];
    $reg_mail=$_POST['email'];
    $reg_sex=$_POST['sesso'];
    $reg_pass1=$_POST['passwd'];
    $reg_pass2=$_POST['REpasswd'];
    $reg_firstname=$_POST['firstname'];
    $reg_lastname=$_POST['lastname'];
    $reg_address=$_POST['address'];
    $reg_city=$_POST['city'];
    $reg_country=$_POST['country'];
    $reg_telephone=$_POST['telephone'];
    $reg_ok1=$_POST['Ok_1'];
    $reg_ok2=$_POST['Ok_2'];
    if ($_POST['newsletter']=="yes")
        { 
        $reg_newsletter=1;
        } else {
        $reg_newsletter=0;
        }
    $reg_rechaptaresp= $_POST['g-recaptcha-response'];  

    if ($reg_ok1=="N" Or $reg_ok2=="N") 
    { 
        header("Location: ../index.php?page=registrazione&error=REG_07");
        exit;
    } else
    {
        if(usernameValidation($reg_username) > 0 && strlen($reg_mail) > 0 && passwordValidation($reg_pass1) > 0 && passwordValidation($reg_pass2) > 0 && ($reg_pass1 == $reg_pass2))
        { 
            $regUsernameEsc = mysqli_real_escape_string($database->connection, (string)$reg_username);
            $regMailEsc = mysqli_real_escape_string($database->connection, (string)$reg_mail);
            $res = $database->db_query("SELECT id FROM userprofile WHERE login_name=\"$regUsernameEsc\" OR email=\"$regMailEsc\" ");
            $res_num = mysqli_num_rows($res);    

            if($res_num >0){
                header("Location: ../index.php?page=registrazione&error=REG_01");exit;
            }else{
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=".urlencode((string)$privateKey)."&response=".urlencode((string)$reg_rechaptaresp)."&remoteip=".urlencode((string)($_SERVER['REMOTE_ADDR'] ?? ''));
                $context = stream_context_create(['http' => ['timeout' => 3]]);
                $response=@file_get_contents($url, false, $context);

                $rchapver =json_decode($response); 

                if ($rchapver->{'success'}!=true) {
                    header("Location: ../index.php?page=registrazione&error=REG_02");
                    exit;
                } 
                else
                {
                    $livellofree=20;
                    $passHash = hash('sha256', $reg_pass1); 
                    $activationToken = hash('sha256',time().'_'.$reg_mail);
                    $regFirstnameEsc = mysqli_real_escape_string($database->connection, (string)$reg_firstname);
                    $regLastnameEsc = mysqli_real_escape_string($database->connection, (string)$reg_lastname);
                    $regAddressEsc = mysqli_real_escape_string($database->connection, (string)$reg_address);
                    $regCityEsc = mysqli_real_escape_string($database->connection, (string)$reg_city);
                    $regTelephoneEsc = mysqli_real_escape_string($database->connection, (string)$reg_telephone);
                    $regCountryEsc = mysqli_real_escape_string($database->connection, (string)$reg_country);
                    $regNewsletterEsc = mysqli_real_escape_string($database->connection, (string)$reg_newsletter);
                    $query = "INSERT INTO userprofile (token, login_name, password_hash, email, type, firstname,lastname,address,city,telephone,country, newsletter) VALUES"
                            ."(\"$activationToken\", \"$regUsernameEsc\", \"$passHash\", \"$regMailEsc\",  \"$livellofree\",  \"$regFirstnameEsc\",  \"$regLastnameEsc\",  \"$regAddressEsc\",  \"$regCityEsc\",  \"$regTelephoneEsc\",  \"$regCountryEsc\", \"$regNewsletterEsc\" )";

                    $database->db_query($query);

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    $headers .= 'From: ' . $sendName . ' <' . $primaryEmail . '>' . "\r\n";

                    $subject = $sendName . ' - User registration';
                    $emailText = "<font face=\"verdana\" size=\"2\"><p>Dear {$reg_username},</p>"
                                . "<p>Thank you for registering! You have one more step to go before you become a Full Member of ".$sendName.".</p>"
                                . "<p>in order to activate your account, please click the link below:</p></font>"
                                . "<p><a href=\"{$root}controllers/loginController.php?action=registrazioneConfirm"
                                . '&u='.$reg_username.'&t='.$activationToken."\">Click here</a></p>"
                                . "<p><font face=\"verdana\" size=\"2\"><b>in case of problems feel free to contact us here: <a href=\"mailto:".$primaryEmail."\">".$primaryEmail."</a></b></font></p>";

                    mail($reg_mail, $subject, $emailText, $headers);

                    if($isDevelopment)
                        echo "<br>".$reg_mail."<br><br>".$emailText."<br><br><br><br>";   
                    else
                        header("Location: ../index.php?page=registrazione&step=mail");exit;         
                }
            }   
        }else {
            if (passwordValidation($reg_pass1) < 1 Or passwordValidation($reg_pass2) < 1)
               { 
                header("Location: ../index.php?page=registrazione&error=REG_04");
                }
            if (usernameValidation($reg_username) == false)
               { 
                header("Location: ../index.php?page=registrazione&error=REG_05");
                }  
            header("Location: ../index.php?page=registrazione&error=REG_03");   
            exit;   
        } 
    }
    $database->db_close();   
}

function sendpassword(){
    global $database,$dbIP,$dbName,$dbUser,$dbPass,$root,$sendName,$primaryEmail;
    enforceMethod('POST');
    throttleOrDie('sendpassword', 8, 60);

    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }

    $username_sp=$_REQUEST['username_sp'];
    $mail_sp=$_REQUEST['mail_sp'];

    if ( strlen($username_sp) == 0 || strlen($mail_sp) == 0 ){
        header("Location: ../index.php?page=login&step=pwdimenticata&error=PWD_01");exit;
    }elseif ( strlen($username_sp) > 0 && strlen($mail_sp) > 0 ){

        $usernameSpEsc = mysqli_real_escape_string($database->connection, (string)$username_sp);
        $mailSpEsc = mysqli_real_escape_string($database->connection, (string)$mail_sp);
        $res = $database->db_query("SELECT id, login_name,email, firstname, lastname, token FROM userprofile WHERE login_name=\"$usernameSpEsc\" AND email=\"$mailSpEsc\" ");
        $row_user=$database->db_fetch_row($res);
        $res_num = mysqli_num_rows($res);

        if ($res_num == 1) {
            $randPassword = substr(md5(microtime()),rand(0,26),8);

            $newHash = hash('sha256', $randPassword);
            $id = (int)$row_user['id'];
            $newHashEsc = mysqli_real_escape_string($database->connection, (string)$newHash);
            $database->db_query("UPDATE userprofile SET password_hash = '" . $newHashEsc . "', account_verified = 'X' WHERE id = ".$id);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From: ' . $sendName . ' <' . $primaryEmail . '>' . "\r\n";

            $subject = $sendName . ' - Password recover';
            $emailText = "<p>Dear {$row_user['login_name']},</p>"
                        . "<p>In order to recover your password, please click on the link below:</p>"
                        . "<p><a href=\"{$root}controllers/loginController.php?action=sendpasswordConfirm"
                        . '&u='.$row_user['login_name'].'&t='.$row_user['token']."\">Clicca her to activate your account.</a></p>"
                        . "<p>Your new password is: {$randPassword}.</p>";

            mail($row_user['email'], $subject, $emailText, $headers);

            header("Location: ../index.php?page=login&step=mail");exit;
        }else {
            header("Location: ../index.php?page=login&step=pwdimenticata&error=PWD_02");    exit;                       
        }
    }

    $database->db_close();
}

function sendpasswordConfirm(){
    global $database,$dbIP,$dbName,$dbUser,$dbPass;
    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }

    if (false == isset($_GET['t']) || false == isset($_GET['u']))
    {
        header('Location: ../index.php');
    }
    $confirm_user=$_GET['u'];
    $confirm_token=$_GET['t'];

    $confirmUserEsc = mysqli_real_escape_string($database->connection, (string)$confirm_user);
    $confirmTokenEsc = mysqli_real_escape_string($database->connection, (string)$confirm_token);
    $res = $database->db_query("SELECT id, login_name,email, firstname, lastname FROM userprofile WHERE login_name=\"$confirmUserEsc\" AND token=\"$confirmTokenEsc\" AND account_verified = 'X' ");
    $res_num = mysqli_num_rows($res);
    $row_user=$database->db_fetch_row($res);

    if ($res_num != 1) {
        header('Location: ../index.php');
    }

    if ($res_num == 1) {
        $database->db_query("UPDATE userprofile SET account_verified = 'Y' WHERE login_name=\"$confirmUserEsc\" AND token=\"$confirmTokenEsc\" AND account_verified = 'X' ");
    }

    $database->db_close();
    header("Location: ../index.php?page=login&step=sendpasswordConfirm");
}

function changepassword(){
    global $database,$dbIP,$dbName,$dbUser,$dbPass,$sendName,$primaryEmail;
    enforceMethod('POST');
    throttleOrDie('changepassword', 12, 60);

    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];    
    $newPassword1=$_REQUEST['newPassword1'];
    $newPassword2=$_REQUEST['newPassword2'];

    $crypted_pass = hash('sha256', $password);

    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }

    $usernameEsc = mysqli_real_escape_string($database->connection, (string)$username);
    $passEsc = mysqli_real_escape_string($database->connection, (string)$crypted_pass);
    $resource = $database->db_query("SELECT id, email FROM userprofile WHERE login_name=\"$usernameEsc\" AND password_hash=\"$passEsc\" AND account_verified=\"Y\" ");
    $resources_num = mysqli_num_rows($resource);
    $row_user=$database->db_fetch_row($resource);

    if ($resources_num == 1) {

        if($newPassword1 != $newPassword2){
            $database->db_close();   
            header("Location: ../index.php?page=login&error=CPWD_02");
        }else if(!passwordValidation($newPassword1)){
            $database->db_close();   
            header("Location: ../index.php?page=login&error=CPWD_03");
        }else{
            $newHash = hash('sha256', $newPassword1);
            $newHashEsc = mysqli_real_escape_string($database->connection, (string)$newHash);
            $database->db_query("UPDATE userprofile SET password_hash = '" . $newHashEsc . "' where id= " . (int)$row_user['id']);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From: ' . $sendName . ' <' . $primaryEmail . '>' . "\r\n";

            $subject = $sendName . ' - Change password';
            $emailText = "<p>Dear {$username},</p>"
                        . "<p>on ".$sendName." website your password has been changed.</p>"
                        . "<p>In case you didn't ask for a new password please contact us.</p>"
                        . "<p>Thank you</p>";

            mail($row_user['email'], $subject, $emailText, $headers);

            header("Location: ../index.php?page=login&error=INFO01&errortype=3");
        }
    }else{
        $database->db_close();   
        header("Location: ../index.php?page=login&error=CPWD_01");
    }
}

function passwordValidation($password){
    $error = array();

    if (strrpos($password, " ") === true) {
        $error[] = 'Space are not admitted!';
    }

    if( strlen($password) < 6 ) {
        $error[] = 'Password must be longer than 6 characters!';
    }

    if( strlen($password) > 20 ) {
        $error[] = 'Password cannot be longer than 20 characters!';
    }

    if( !preg_match("#[a-z]+#", $password) ) {
        $error[] = 'Password must contain at least one letter!';
    }

    $errors=implode('<br />', $error);

    if(count($error) == 0)
        return true;
    else
        return false;
}
?>
<?php 
/**
 * Avoid direct access to controller file
*/
if (preg_match("/controller.php/",$_SERVER['PHP_SELF'])) {
  $gotohome = $_SERVER['HTTP_HOST'];
  Header("Location: ../../unauthorized");
  die();
}
    /*** Meta page elements (set them here if they are unique for the page or copy them in the various steps for subpages) ****/
    $meta = new metaData();
    $meta->pageTitle = "Contact Sensus PR";
    $meta->pageMetaDescription = "Sensus PR: We have extensive experience in PR, Digital Marketing and Communications. We use hands-on approach, in-depth analysis of the product and targeted communication strategies to achieve the maximum exposure effect for our clients. We are also trained in communications crisis management, helping our clients deal with high pressure situations.";
    $meta->pageMetaKeywords	 = "Page Keywords"; 
    $meta->pageMetaRevisit = "1 DAYS";
    $meta->author = "Sensus PR";
    $meta->twitterSite = '@SensusPR';
    $meta->twitterCreator = '@SensusPR';
    $meta->ogpageTitle = $meta->pageTitle;
    $meta->pageType = "website";
    $meta->pageMetaImage = $root."img/login-logo.png";
    $meta->ogpageDescription = $meta->pageMetaDescription;
    $meta->ogUrl = $root;
    $meta->pageMetaUrl = $root;

    // Structured data for google search indexing
    // General variables
    $strut = new strut();
    global $strut;
    $strut->type = ""; //choose between Review/LocalBusiness/Product (case sensitive variables) if not set this structured data won't appear in the page
    $strut->title = "";
    $strut->url = "";
    $strut->descr = "";

    // if type is Review add the following variables
    $strut->auth = "author";
    $strut->written = "date"; //date format mm/dd/yyyy
    $strut->upd = "date";

    // if type is LocalBusiness add the following variables
    $strut->address = "address";
    $strut->Locality = "locality";
    $strut->region = "region";
    $strut->country = "country";

    // if type is Product add the following variables
    $strut->price = "";
    $strut->currency = "";  // USD/EU/BP...

    /*** End of Meta elements ***/

    /******** Start step selection ********/

    switch ($step) {
    case "index":
        break;

      case "SendRequestInfo":

        include ("./config/xcapkeys.php");

        $captchaToken = $_GET["recaptcha_challenge_field"] ?? '';
        if (empty($captchaToken)) {
            echo "captcha-error";
            break;
        }

        $response  = curlRequest("https://www.google.com/recaptcha/api/siteverify?secret=" . $privateKey . "&response=" . $captchaToken . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $rchapver  = json_decode($response);

        if (!$rchapver || $rchapver->success !== true) {
            echo "captcha-error";
            break;
        }

        $name  = sanitize_xss($_GET['name']    ?? '');
        $email = sanitize_xss($_GET['email']   ?? '');
        $phone = sanitize_xss($_GET['phone']   ?? '');
        $text  = sanitize_xss($_GET['message'] ?? '');
        $ip    = sanitize_xss($_GET['ipaddress'] ?? '');

        if (empty($name) || empty($email) || empty($text)) {
            echo "No correct data";
            break;
        }

        global $sendEmail;
        $timeDate = date("Y-m-d H:i", time() + 7200) . " GMT +2h";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . $name . ' <' . $email . '>' . "\r\n";

        $subject   = 'Sensuspr WebForm request from ' . $name;
        $emailText = "<h1><font color=\"#2f65af\">Sensus PR Website</font></h1>"
                   . "<p>Name: <b>{$name}</b></p>"
                   . "<p>Email: <b>{$email}</b></p>"
                   . "<p>Telephone: <b>{$phone}</b></p>"
                   . "<p>Ip Address: <b>{$ip}</b></p>"
                   . "<p>Date and time: <b>{$timeDate}</b></p>"
                   . "<h3>Request:</h3><p><i>{$text}</i></p>"
                   . "<p><i><b>SensusPR website automation</b></i></p>";

        if (mail($sendEmail, $subject, $emailText, $headers)) {
            echo "success";
        } else {
            echo "fail";
        }

        break;
            
    default:
        print "Errore di richiesta azione: $step.";
        break;
	}		
	
    /*** end of step selection ***/
	
	// database functions

	function getTestimonials() {
    global $database;
    $query = "SELECT * FROM testimonials";
    $testim = $database->db_query($query);
    return $database->db_fetch_allrows($testim);
  }
?>
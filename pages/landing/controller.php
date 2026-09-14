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
    $meta->pageTitle = "Sensus PR";
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
    $strut->auth = "SensusPr";
    $strut->written = "01/07/2025"; //date format mm/dd/yyyy
    $strut->upd = "01/07/2025";

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
        //testimonials from db
        global $testimonials;
        $testimonials = getTestimonials();
        //client logos from db
        global $clients;
        $clients = getClients();
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
  function getClients() {
    global $database;
    $query = "SELECT * FROM clients ORDER BY VISORDER DESC";
    $clients = $database->db_query($query);
    return $database->db_fetch_allrows($clients);
  }

?>
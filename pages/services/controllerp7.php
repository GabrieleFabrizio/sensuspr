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
    
    $meta->pageTitle = "Sensus PR Services";
    $meta->pageMetaDescription = "At Sensus PR, we specialize in delivering top-notch public relations solutions tailored to your unique needs.";
    $meta->pageMetaKeywords	 = "international PR; brand growth ; digital marketing; pr crisis management; seo management; reputation management"; 
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
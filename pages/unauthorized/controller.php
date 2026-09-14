<?php 

/******** Start step selection ********/

    switch ($step) {
    case "index":

        $pageCanonical = '<link rel="canonical" href="'.$root.'unauthorized" />';
        $breadCrumbs = array (
            array (
                'NAME' => 'Home',
                'LINK' => ''
            ),
            array (
                'NAME' => 'Unauthorised page access',
                'LINK' => 'unauthorized'
            )
            );

        //meta elements
        $meta = new metaData();
        $meta->pageTitle = "Kitesurf Culture | Unauthorised page access";
        $meta->pageMetaDescription = "Kitesurf Culture | Unauthorised page access";
        $meta->pageMetaKeywords = "Unauthorised page access";
        $meta->pageMetaImage = $root.'imgs/icons/logo_main.png';
        $meta->pageType = 'website';
        $meta->pageMetaUrl = $root.'unauthorized';
        $meta->author = "kitesurfculture";
        $meta->pageMetaRevisit = "1 MONTHS";
        $meta->author = 'Kitesurf Culture';
        $meta->pageMetaRevisit = "1 MONTHS";

    break; 
            
    default:
        print "Errore di richiesta azione: $step.";        
    break;
	}		
	
    /*** end of step selection ***/
	
	
	
?>

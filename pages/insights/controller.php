<?php
/**
 * Avoid direct access to controller file
*/
if (preg_match("/controller.php/",$_SERVER['PHP_SELF'])) {
  $gotohome = $_SERVER['HTTP_HOST'];
  Header("Location: ../../unauthorized");
  die();
}
	//page access clearence access verification
	if(!isLegal("news")) {
    Header("Location: index.php?page=unauthorized");}
	
	 	
	$meta = new metaData();
    global $meta;
    $meta->pageTitle = "Sensus PR Insights";
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
	/*============================================ Inizio CASE ================================================= */
	
	// getGlobalInfo();
    
    switch ($step) {
    case "index":
        case "index":
        $Blog = new blog();
        global $Blog;
        $Blog->pageTitle = "Insights";
        $Blog->pageMetaDescription = "Sensus PR Insights";
        $Blog->pageMetaKeywords	 = "Sensus PR Insights"; 

        $Blog->latest = getLatestBlog();
        $Blog->categories = getAllPresentCategories();
        $Blog->AllBlogs = getListOfBlogs();

        /*
        $pagination = $_GET['pagination']; //richiesta parametro per avere la paginazione ajax 
        if ($pagination=="" or $pagination==0) {$Blog->AllBlogs = getListOfBlogsinit(); } 
            else {$Blog->AllBlogs = getListOfBlogspag($pagination);} 
        $Blog->totalBlogs = getListOfBlogs(); // serve per il calcolo totale dei blogposts
        $blog->paginnum = 1; */

        break;

    case "category":
        // set all the properties for the header of the page if not admin page
        // set all the properties for the header of the page if not admin page
        global $theme ;
        $theme['view'] = 'Y';
        $theme['height'] = ".5"; // 1 or .5 for half size window
        $theme['video'] = $root."videoBG/bubbleswhite.mp4";
        $theme['videolr'] = "videoBG/bubbleswhite_light.mp4";
        $theme['img'] = $root."img/bubbleswhite.jpg";
        $theme['mainQuote'] = "Insights";
        $theme['subQuote'] = "The latest from our company";
        $theme['contLink'] = "";
        $theme['logoColor'] = "B"; // put W for white
        $theme['textColor'] = "B";
        $theme['socialColor'] = "B";
        $theme['grayscale'] = "Y";
        
        $cat = $_GET['category'];
        $catNumber = getCatIdByName($cat);
        $Blog = new stdClass();
        $Blog->latest = getLatestBlogCat($catNumber);
        $Blog->categories = getAllPresentCategories();
        $Blog->AllBlogs = getListOfBlogsCat($catNumber);
        
        /*
        $pagination = $_GET['pagination']; //richiesta parametro per avere la paginazione ajax 
        if ($pagination=="" or $pagination==0) {$Blog->AllBlogs = getListOfBlogsinitCat($catNumber); } 
            else {$Blog->AllBlogs = getListOfBlogspagCat($catNumber,$pagination);} 
        $Blog->totalBlogs = getListOfBlogs(); // serve per il calcolo totale dei blogposts
        $blog->paginnum = 1; */
        break;
    
            
    case "indexpaging":
        $Blog = new stdClass();
    	global $Blog;
        $pagination = $_GET['pagination']; //richiesta parametro per avere la paginazione ajax
        if ($pagination=="" or $pagination==0) {$Blog->AllBlogs = getListOfBlogsinit(); } 
            else {$Blog->AllBlogs = getListOfBlogspag($pagination);} 
        $Blog->totalBlogs = getListOfBlogs(); // serve per il calcolo totale dei blogposts
        $blog->paginnum = $pagination;
    
        break;     
                
    case "singleBlog":
        $Blog = new stdClass();
       global $Blog;
       $ID = $_GET['idBlog'];
	    $Blog->SingleBlog = getSingleBlog($ID);   
        $IdSx =strval(intval($ID)-1);
        $IdDx =strval(intval($ID)+1);
        filelog ('zzval.txt', $IdSx." - ".$idDx);
        $Blog->prevBlog = getSingleBlog($IdSx); 
        $Blog->segBlog = getSingleBlog($IdDx); 
      
       
       foreach($Blog->SingleBlog as $singleBlog) {
        $Blog->pageTitle = $singleBlog['TITLE'];
        $Blog->pageMetaKeywords =  strip_tags($singleBlog['KEYWORDS'],"");
		$Blog->pageMetaDescription = strip_tags($singleBlog['METADESCR'],"");
		$Blog->pageMetaRevisit= "1 DAYS";	
           
        }	
			          
    case "singleBlogContent":
        $Blog = new stdClass();
    	global $Blog;
        $ID = $_GET['idBlog'];
        $Blog->ActualBlogID = $ID;
        $Blog->SingleBlog = getSingleBlog($ID);        
       
       foreach($Blog->SingleBlog as $singleBlog) {
        $Blog->pageTitle = $singleBlog['TITLE'];
        $Blog->pageMetaKeywords =  strip_tags($singleBlog['KEYWORDS'],"");
		$Blog->pageMetaDescription = strip_tags($singleBlog['METADESCR'],"");
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', file_get_contents($root."docs/blog/".$singleBlog["ID"]."_".$singleBlog["FILENAME"]), $matches);
        $first_img = $matches [1] [0];
        $Blog->pageMetaImage =  $first_img;
		$Blog->pageMetaRevisit= "1 DAYS";	
                     
        }		

        break;
    case "singleBlogShare":
        $strut = new strut();
        $Blog = new stdClass();
    	global $Blog;
        $ID = $_GET['idBlog'];
        $Blog->ActualBlogID = $ID;
        $Blog->SingleBlog = getSingleBlog($ID);   
        $IdSx =strval(intval($ID)-1);
        $IdDx =strval(intval($ID)+1);
        $Blog->prevBlog = getSingleBlog($IdSx)[0]; 
        $Blog->segBlog = getSingleBlog($IdDx)[0];     
       
       foreach($Blog->SingleBlog as $singleBlog) {
        $Blog->pageTitle = $singleBlog['TITLE'];
        $Blog->pageMetaKeywords =  strip_tags($singleBlog['KEYWORDS'],"");
		$Blog->pageMetaDescription = strip_tags($singleBlog['METADESCR'],"");
        
        $strut->type = "Review";
        $strut->title = $singleBlog['TITLE'];
        $cleantitle=cleanname($singleBlog['TITLE']);
        $strut->url = "Blog/".$ID."/".$cleantitle;
        $strut->descr = strip_tags($singleBlog['METADESCR'],"");
        $strut->auth = $singleBlog['AUTHOR_NAME'];
        $strut->written = $singleBlog['POST_DATE'];
        $strut->upd = $singleBlog['POST_DATE'];
		
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', file_get_contents($root."docs/blog/".$singleBlog["ID"]."_".$singleBlog["FILENAME"]), $matches);
        $first_img = $matches [1] [0];
        $Blog->pageMetaImage =  $first_img;
		                                      
                                               
		$Blog->pageMetaRevisit= "1 DAYS";			
        }		
			       
        break;
        
	default:
        print "Errore di richiesta azione: |$step.|";
        break;
	}
/*============================================ Fine CASE ================================================= */	
	
	
/**
 * METODI DI ACCESSO AL DATABASE
 */	
    
	 function getListOfBlogs(){
		global $database;
		$query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0
        ORDER BY b.POST_DATE DESC, b.ID DESC";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

	 function getListOfBlogsinit(){
		global $database;
		$query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0
        ORDER BY b.POST_DATE DESC, b.ID DESC LIMIT 0, 6";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

    function getListOfBlogsCat($ct){
		global $database;
		$query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0 AND (POSTCATEG1 = ".$ct." OR POSTCATEG2 = ".$ct." OR POSTCATEG3 = ".$ct.")
        ORDER BY b.POST_DATE DESC, b.ID DESC";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

    function getListOfBlogsinitCat($ct){
		global $database;
		$query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0 AND (POSTCATEG1 = ".$ct." OR POSTCATEG2 = ".$ct." OR POSTCATEG3 = ".$ct.")
        ORDER BY b.POST_DATE DESC, b.ID DESC LIMIT 0, 6";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

	 function getListOfBlogspag($pagination){
		global $database;
        $inlim = $pagination * 6;
		$query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0
        ORDER BY b.POST_DATE DESC, b.ID DESC LIMIT ".$inlim.", 6";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}
    
    function getListOfBlogspagCat($ct,$pagination) {
		global $database;
        $inlim = $pagination * 6;
		$query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0 AND (POSTCATEG1 = ".$ct." OR POSTCATEG2 = ".$ct." OR POSTCATEG3 = ".$ct.")
        ORDER BY b.POST_DATE DESC, b.ID DESC LIMIT ".$inlim.", 6";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

    function getSingleBlog($ID){
		global $database;
		$query = "SELECT * from blog WHERE ID=".$ID;
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

    function getLatestBlog(){
		global $database;
        $query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0
        ORDER BY b.POST_DATE DESC, b.ID DESC
        LIMIT 1";
		$result=$database->db_query($query);
		$arr = $database->db_fetch_allrows($result);
        return $arr[0];
	}

    function getLatestBlogCat($ct){
		global $database;
        $query = "SELECT b.*, bc.NAME AS MAINCAT
        FROM blog AS b
        JOIN blogcategories AS bc ON b.POSTCATEG1 = bc.ID
        WHERE b.CATEGORY >0 AND (POSTCATEG1 = ".$ct." OR POSTCATEG2 = ".$ct." OR POSTCATEG3 = ".$ct.")
        ORDER BY b.POST_DATE DESC, b.ID DESC
        LIMIT 1";
		$result=$database->db_query($query);
		$arr = $database->db_fetch_allrows($result);
        return $arr[0];
	}

    function getAllCategories() {
        global $database;
		$query = "SELECT * from blogcategories";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
    }

    function getAllPresentCategories() {
        global $database;
        $query = "SELECT *
        FROM blogcategories
        WHERE ID IN (
            SELECT POSTCATEG1
            FROM blog
            UNION
            SELECT POSTCATEG2
            FROM blog
            UNION
            SELECT POSTCATEG3
            FROM blog
        );";
        $result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
    }
	
    function getCatIdByName($cat) {
        global $database;
        $query = "SELECT ID from blogcategories WHERE NAME='".$cat."'";
        $result=$database->db_query($query);
		$res = $database->db_fetch_allrows($result);
        return $res[0]['ID'];
    }
?>
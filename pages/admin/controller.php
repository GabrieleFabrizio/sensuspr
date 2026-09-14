<?php

global $root;
/**
 * Avoid direct access to controller file
*/
if (preg_match("/controller.php/",$_SERVER['PHP_SELF'])) {
  $gotohome = $_SERVER['HTTP_HOST'];
  Header("Location: ../../unauthorized");
  die();
}
	//page access clearence access verification
	if(!isLegal("admin"))
    {
        Header("Location: unauthorized");
        die();
    }

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    function verifyCsrfOrDie(){
        $token = $_POST['csrf'] ?? $_GET['csrf'] ?? '';
        if (empty($_SESSION['csrf_token']) || !is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
            header('HTTP/1.1 403 Forbidden');
            die('Invalid or missing CSRF token');
        }
    }

// class page definition request
class page {

	var $pageTitle, $pageMetaKeywords, $pageMetaDescription, $pageMetaRevisit, $color;

}

class pageAdmin extends page{

	var 	$menuAdmin
		,	$infoData;
			
		
	function __construct(){
		$this->pageTitle = "Admin";
	}
	
}

	$menuAdmin = null;
	
	function getMenu(){		
		global $menuAdmin;

	}
 	
    $indexopt = "Y";
    
    
/*============================================ Inizio CASE ================================================= */
switch ($step) {

    case "index":
        $meta = new metaData();
        
        $indexblog = indexBlog();
        $indexSubscribers = indexSubscribers();
        $indexBacklinks = indexBacklinks();
        $indexTestimonials = indexTestimonials();
        $indexopt = "N";
        
        /*
        var_dump($indexblog);echo(' - $indexblog<br/>');
        var_dump($indexComments);echo(' - $indexComments<br/>');
        var_dump($indexSubscribers);echo(' - $indexSubscribers<br/>');
        var_dump($indexKitespots);echo(' - $indexKitespots<br/>');
        var_dump($indexSchools);echo(' - $indexSchools<br/>');
        var_dump($indexBacklinks);echo(' - $indexBacklinks<br/>'); */
        break;

    case "main_admin":
        $indexblog = indexBlog();
        $indexSubscribers = indexSubscribers();
        $indexBacklinks = indexBacklinks();
        $indexopt = "N";
        break;

// ***************************************  blog case elements   *****************************************
    case "Blog":
        {
            include ('controller_blog.php');
            $infoData = new infodata();
            global $infoData;	
	        getAllBlogs();   
            $indexopt = "";
	         
        }
        break;
            
    case "add_blog":
        {
            include ('controller_blog.php');
            $Blog = new blog();
            global $Blog;
	        $Blog->blogCateg = getBlogPostCategories();
            $infoData = new infodata();
            global $infoData;
            $infoData->SingleBlog = ["ID" => ""];
        }
        break;
          
    case "insertBlog":
        {
            verifyCsrfOrDie();
            include ('controller_blog.php');
            $admin = new pageAdmin();
			global $Blog;
		    global $esito;
		    global $imageBLog;
             
		    ini_set("memory_limit", "200000000"); // for large images so that we do not get "Allowed memory exhausted"
			
			    
                
                $CATEGORY = $_POST['CATEGORY'];
                $POSTCATEG1 = $_POST['POSTCATEG1'];
                if ($_POST['POSTCATEG2'] != '' && $_POST['POSTCATEG2'] != NULL ) {
                    $POSTCATEG2 = $_POST['POSTCATEG2'];
                } else {
                    $POSTCATEG2 = ""; 
                }
                if ($_POST['POSTCATEG3'] != '' && $_POST['POSTCATEG3'] != NULL ) {
                    $POSTCATEG3 = $_POST['POSTCATEG3'];
                } else {
                    $POSTCATEG3 = ""; 
                }
                $SUBTITLE = $_POST['SUBTITLE'];
                $TITLE = $_POST['TITLE'];
                $KEYWORDS =  $_POST['KEYWORDS'];
                $METADESCR =  $_POST['METADESCR'];
                $TEXT = $_POST['TEXT'];
                $LINKIMAGE = $_POST['LINKIMAGE'];
                $AUTHOR = $_SESSION['UtenteID'];
                $AUTHOR_NAME = $_POST['AUTHOR'];
                $RELPOSTS = $_POST['RELPOSTS'];
                $POST_DATE = date("y.m.d"); 
                $PRIORITY = $_POST['PRIORITY'];
                $FILENAME = $_POST['FILENAME'];
                AddBlogPost($CATEGORY,$POSTCATEG1,$POSTCATEG2,$POSTCATEG3,$TITLE,$SUBTITLE, $TEXT,$AUTHOR,$AUTHOR_NAME,$RELPOSTS,$POST_DATE,$KEYWORDS,$LINKIMAGE,$METADESCR,$PRIORITY,$FILENAME);
             
        }
        break;

    case "updateBlog":
        {
            verifyCsrfOrDie();
            include ('controller_blog.php');
            $admin = new pageAdmin();
			global $Blog;
		    global $esito;
		    global $imageBLog;
             
		    ini_set("memory_limit", "200000000"); // for large images so that we do not get "Allowed memory exhausted"
			           
            $IDblog = $_POST['IDblog'];
			$CATEGORY = $_POST['CATEGORY'];
            $POSTCATEG1 = $_POST['POSTCATEG1'];
            $POSTCATEG2 = $_POST['POSTCATEG2'];
            $POSTCATEG3 = $_POST['POSTCATEG3'];
			$SUBTITLE = $_POST['SUBTITLE'];
		    $TITLE = $_POST['TITLE'];
            $KEYWORDS =  $_POST['KEYWORDS']; 
            $METADESCR =  $_POST['METADESCR'];
            $AUTHOR_NAME = $_POST['AUTHOR'];
            $RELPOSTS = $_POST['RELPOSTS'];
            $UPDATEPOSTDATE = $_POST['UPDATEDATE'];
			$TEXT = $_POST['TEXT'];
            $LINKIMAGE = $_POST['LINKIMAGE'];
			$FILENAME = $_POST['FILENAME'];
            // sets the last post modification date
            if ($UPDATEPOSTDATE == 'true') {
                $LAST_MODIFIED  = date("y.m.d");
            } else { 
                $LAST_MODIFIED = '';
             }

			$PRIORITY = $_POST['PRIORITY'];
			
            $esito ="ID:________#".$IDblog."#________/r/n".$TEXT;
            UpdateBlogPost($IDblog,$CATEGORY,$POSTCATEG1,$POSTCATEG2,$POSTCATEG3,$TITLE,$SUBTITLE, $TEXT,$FILENAME,$KEYWORDS,$LINKIMAGE,$METADESCR,$AUTHOR_NAME,$RELPOSTS,$LAST_MODIFIED);
            
    }
        break;

    case "delete_blog":
        {
            verifyCsrfOrDie();
            include ('controller_blog.php');
        	$admin = new pageAdmin();
			$id = (int)$_GET['idBlog'];
		           
            deleteBlog($id);
            echo "<td colspan='10'><b>Deleted</b></td>";
       
        }
        break;

   case "definitivedelete_blog":
        {
            verifyCsrfOrDie();
            include ('controller_blog.php');
        	$admin = new pageAdmin();
			$id = (int)$_GET['idBlog'];
		           
            definitivedeleteBlog($id);
            echo "<td colspan='10'><b>Deleted</b></td>";
       
        }
        break;

    case "manageBlog":
        {
            include ('controller_blog.php');
        	$admin = new pageAdmin();
            $infoData = new infodata();
            $Blog = new blog();
			global $infoData;
		    global $esito;
		    global $imageBLog;
            global $Blog;

		    $id = (int)$_GET['idBlog'];
            $infoData->SingleBlog = getBlog($id);
            $Blog->blogCateg = getBlogPostCategories(); 
        }
        break;

    case "BlogImageGallery":
        {
            include ('controller_blog.php');
            $pgNumber = 1;
            if(isset($_GET['PAGENUMBER']))
            {
                //echo $pgNumber;
                $pgNumber = $_GET['PAGENUMBER'];
              //  echo $pgNumber;
            }
            $files = glob('./img/blog/*.*');
            natsort($files);
            $files = array_reverse($files);
            //echo $pgNumber;
            $newest = array_slice($files, 40*($pgNumber-1), 40);
            $imageBLog = new stdClass();
            $imageBLog->files = $newest;
            $imageBLog->fileNumber = count($files);
        }
        break;

    case "AddBlogImageGallery":
         {
            verifyCsrfOrDie();
            include ('controller_blog.php');
           // echo "AddBlogImageGallery";
            global $esito;
		    global $imageBLog;
		    ini_set("memory_limit", "200000000"); // for large images so that we do not get "Allowed memory exhausted"
			
            try {
                    $esito ="";		

                    if ($_FILES["FILE_INV"]["error"] > 0)
                    {
                        $esito="error_uploading";
                        error_log("Errore uploading image");	
                    }
                    else{
                        $FILE_INV = $_GET['FILE_INV'];
                        $esito.="Addding...".$STATUS;
                        AddBlogImage($FILE_INV);
                       
                        $esito.="Added.";
                    }
                }
                    catch(Exception $e)
                {
                    $esito.="ERRORE".$e->getMessage();
                }
        }
        break;
        
    case "DeleteBlogImageGallery":
         {
            verifyCsrfOrDie();
            include ('controller_blog.php');
            global $esito;
		    global $imageBLog;
            $fileToDelete = $_GET['fileName'];
			
            $filename = './img/blog/'.$fileToDelete;
            if (file_exists($filename)) {
                        unlink($filename);
                    }
    }
        break;
    
    // ***************************  Subscribers management case   *************************************
    
    case "Subscribers":
        
            include ('controller_subscribers.php');
            $infodata = new infodata();
             global $infodata;	
	         $infodata->subscribers=getListOFSubscribers();
        
        break; 
        
    case "SubscribersToExcel":
        {
            include ('controller_subscribers.php');
            global $infoData;	
	        SubscribersToExcel();
        }
        break; 

    case "DeleteSubscriber":
        {
            verifyCsrfOrDie();
            include ('controller_subscribers.php');
            $ID = (int)$_GET['idsubscriber'];
            DeleteSubscriber($ID);
        }
        break; 

    // ***************************  backlinks management  ******************************************
            
    case "Backlinks":
        {
            include ('controller_backlinks.php');
            global $backlinks;
	        $backlinks = getAllBacklinks();
        }
        break;
            
    case "insertBacklinks":
        {
            verifyCsrfOrDie();
            include ('controller_backlinks.php');
            $admin = new pageAdmin();
	
            $LINK_NAME = $_GET['LINK_NAME'];
            $CONTACT_NAME = $_GET['CONTACT_NAME'];
            $CONTACT_EMAIL = $_GET['CONTACT_EMAIL'];
            $COUNTRY = $_GET['COUNTRY'];
            $LINK = $_GET['LINK'];
            $DESCRIPTION = $_GET['DESCRIPTION'];
            $TOP_LINK = $_GET['TOP_LINK'];
            $IMAGEBKL = $_GET['IMAGEBKL'];          
            
            insertBacklinks($LINK_NAME,$CONTACT_NAME,$CONTACT_EMAIL,$COUNTRY,$LINK,$DESCRIPTION,$TOP_LINK,$IMAGEBKL);       
            }
        break;

    case "upd_backlinks":
        {
            include ('controller_backlinks.php');
        	$admin = new pageAdmin();
            $IDT = (int)$_GET['idBkl'];
            
            $query = "SELECT * from backlinks WHERE id=".$IDT;
            $result=$database->db_query($query);
		    $backlinksMod=$database->db_fetch_row($result);
            
        }    
        break;

    case "UpdateBacklinks":
        {
            verifyCsrfOrDie();
            include ('controller_backlinks.php');
            $admin = new pageAdmin();
	
            $IDT = (int)$_GET['IDT'];
            $LINK_NAME = $_GET['LINK_NAME'];
            $CONTACT_NAME = $_GET['CONTACT_NAME'];
            $CONTACT_EMAIL = $_GET['CONTACT_EMAIL'];
            $COUNTRY = $_GET['COUNTRY'];
            $LINK = $_GET['LINK'];
            $DESCRIPTION = $_GET['DESCRIPTION'];
            $TOP_LINK = $_GET['TOP_LINK'];
            $IMAGEBKL = $_GET['IMAGEBKL'];          
            
            updateBacklinks($IDT,$LINK_NAME,$CONTACT_NAME,$CONTACT_EMAIL,$COUNTRY,$LINK,$DESCRIPTION,$TOP_LINK,$IMAGEBKL);
            }
        break;

    case "delete_backlinks":
        {   
            verifyCsrfOrDie();
            include ('controller_backlinks.php');
        	$admin = new pageAdmin();
			$idbacklink = (int)$_GET['idbacklink'];
		           
            deleteBacklinks($idbacklink);
  
            }  
        break;

// ***************************  Clients logo management  ******************************************
            
case "Clients":
    {
        include ('controller_clients.php');
        global $clientLogos;
        $clientLogos = getAllClients();
    }
    break;

case "add_clients" : {

    }   
    break;

case "insertClients":
    {
        verifyCsrfOrDie();
        include ('controller_clients.php');
        $admin = new pageAdmin();
        $NAME = $_GET['NAME'];
        $EMAIL = $_GET['EMAIL'];
        $COUNTRY = $_GET['COUNTRY'];
        $LINK = $_GET['LINK'];
        $COMMENT = $_GET['COMMENT'];
        $VISORDER = $_GET['VISORDER'];
        $IMAGECL = $_GET['IMAGECL'];          
        
        insertClients($NAME,$EMAIL,$COUNTRY,$LINK,$COMMENT,$VISORDER,$IMAGECL);       
        }
    break;

case "upd_clients":
    {
        $admin = new pageAdmin();
        
        $IDT = (int)$_GET['idBkl'];
        
        $query = "SELECT * from clients WHERE id=".$IDT;
        $result=$database->db_query($query);
        $clientMod=$database->db_fetch_row($result);
        
    }    
    break;

case "UpdateClients":
    {
        verifyCsrfOrDie();
        include ('controller_clients.php');
        $admin = new pageAdmin();

        $IDT = (int)$_GET['IDT'];
        $NAME = $_GET['NAME'];
        $EMAIL = $_GET['EMAIL'];
        $COUNTRY = $_GET['COUNTRY'];
        $LINK = $_GET['LINK'];
        $COMMENT = $_GET['COMMENT'];
        $VISORDER = $_GET['VISORDER'];
        $IMAGECL = $_GET['IMAGECL'];            
        
        updateClients($IDT,$NAME,$EMAIL,$COUNTRY,$LINK,$COMMENT,$VISORDER,$IMAGECL);
        }
    break;

case "delete_client":
    {   
        verifyCsrfOrDie();
        include ('controller_clients.php');
        $admin = new pageAdmin();
        $idclient = (int)$_GET['idclient'];
        deleteClients($idclient);

        }  
    break;

 // ***************************  testimonials management  ******************************************
            
 case "Testimonials":
    {
        include ('controller_testimonials.php');
        global $testimonials;
        $testimonials = getAllTestimonials();
    }
    break;
        
case "insert_testimonial":
    {
        verifyCsrfOrDie();
        include ('controller_testimonials.php');
        $admin = new pageAdmin();

        $NAME = $_GET['NAME'];
        $POSITION = $_GET['POSITION'];
        $COMPANY = $_GET['COMPANY'];
        $LINK = $_GET['LINK'];
        $DISORDER = $_GET['DISORDER'];
        $TEXT = $_GET['TEXT'];
        $IMAGEBKL = $_GET['IMAGEBKL'];          
        
        insertTestimonials($NAME,$POSITION,$COMPANY,$LINK,$DISORDER,$TEXT,$IMAGEBKL);       
        }
    break;

case "upd_testimonial":
    {
        include ('controller_testimonials.php');
        $admin = new pageAdmin();
        $IDT = (int)$_GET['idtestim'];
        
        $query = "SELECT * from testimonials WHERE id=".$IDT;
        $result=$database->db_query($query);
        $testimonialsMod=$database->db_fetch_row($result);
        
    }    
    break;

case "UpdateTestimonial":
    {
        verifyCsrfOrDie();
        include ('controller_testimonials.php');
        $admin = new pageAdmin();

        $IDT = (int)$_GET['IDT'];
        $NAME = $_GET['NAME'];
        $POSITION = $_GET['POSITION'];
        $COMPANY = $_GET['COMPANY'];
        $LINK = $_GET['LINK'];
        $DISORDER = $_GET['DISORDER'];
        $TEXT = $_GET['TEXT'];
        $IMAGEBKL = $_GET['IMAGEBKL'];          
        filelog("info",$IDT);
        updateTestimonials ($IDT,$NAME,$POSITION,$COMPANY,$LINK,$DISORDER,$TEXT,$IMAGEBKL);
        }
    break;

case "delete_testimonial":
    {   
        verifyCsrfOrDie();
        include ('controller_testimonials.php');
        $admin = new pageAdmin();
        $id = (int)$_GET['idtestim'];
               
        deleteTestimonials($id);

        }  
    break;
}  

    //****************************  Database Access Methods for Index **************************************/

        function indexBlog() {
            global $database;
            $dataSumm = (object) [
                'total' => "",
                'approved' =>"",
                'notapproved' => "",
              ];
            $query = "SELECT COUNT(*) FROM blog";
            $resour = $database->db_query($query);
            $blognumber = $database->db_fetch_allrows($resour);
            $query = "SELECT COUNT(*) FROM blog WHERE CATEGORY = 1";
            $resour = $database->db_query($query);
            $approvedBlogs = $database->db_fetch_allrows($resour);
            $query = "SELECT COUNT(*) FROM blog WHERE CATEGORY = -1";
            $resour = $database->db_query($query);
            $notApprovedBlogs = $database->db_fetch_allrows($resour);
            $dataSumm->total = $blognumber[0]["COUNT(*)"];
            $dataSumm->approved = $approvedBlogs[0]["COUNT(*)"];
            $dataSumm->notapproved = $notApprovedBlogs[0]["COUNT(*)"];
            return $dataSumm;
        }
        
        function indexSubscribers(){
            global $database;
            $dataSumm = (object) [
                'total' => "",
                'both' =>"",
                'newsletter' => "",
                'messages' => "",
                'none' => "",
              ];
            $query = "SELECT COUNT(*) FROM newsletter_emails";
            $resour = $database->db_query($query);
            $subNumber = $database->db_fetch_allrows($resour);
            $query = "SELECT COUNT(*) FROM newsletter_emails WHERE NEWSLETTER = 'Y' AND MSGFOLLOW = 'Y'";
            $resour = $database->db_query($query);
            $both = $database->db_fetch_allrows($resour);
            $query = "SELECT COUNT(*) FROM newsletter_emails WHERE NEWSLETTER = 'Y' AND MSGFOLLOW = 'N'";
            $resour = $database->db_query($query);
            $newsletter = $database->db_fetch_allrows($resour);
            $query = "SELECT COUNT(*) FROM newsletter_emails WHERE NEWSLETTER = 'N' AND MSGFOLLOW = 'Y'";
            $resour = $database->db_query($query);
            $msg = $database->db_fetch_allrows($resour);
            $query = "SELECT COUNT(*) FROM newsletter_emails WHERE NEWSLETTER = 'N' AND MSGFOLLOW = 'N'";
            $resour = $database->db_query($query);
            $none = $database->db_fetch_allrows($resour);
            $dataSumm->total = $subNumber[0]["COUNT(*)"];
            $dataSumm->both = $both[0]["COUNT(*)"];
            $dataSumm->newsletter = $newsletter[0]["COUNT(*)"];
            $dataSumm->messages = $msg[0]["COUNT(*)"];
            $dataSumm->none = $none[0]["COUNT(*)"];
            return $dataSumm;
        }

        function indexBacklinks() {
            global $database;
            $query = "SELECT COUNT(*) FROM backlinks";
            $resour = $database->db_query($query);
            $total = $database->db_fetch_allrows($resour);
            return $total[0]["COUNT(*)"];
        }

        function indexTestimonials() {
            global $database;
            $query = "SELECT COUNT(*) AS total FROM testimonials";
            $resour = $database->db_query($query);
            $total = $database->db_fetch_row($resour);
            return $total['total'];
        }

    //**************************  uploaded images exif mobile orientation fix ********************************/

    function correctImageOrientation($filename) {
        if (function_exists('exif_read_data')) {
          $exif = exif_read_data($filename);
          if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
              $img = imagecreatefromjpeg($filename);
              $deg = 0;
              switch ($orientation) {
                case 3:
                  $deg = 180;
                  break;
                case 6:
                  $deg = 270;
                  break;
                case 8:
                  $deg = 90;
                  break;
              }
              if ($deg) {
                $img = imagerotate($img, $deg, 0);        
              }
              // then rewrite the rotated image back to the disk as $filename 
              imagejpeg($img, $filename, 95);
            } // if there is some rotation necessary
          } // if have the exif orientation info
        } // if function exists      
      }
?>

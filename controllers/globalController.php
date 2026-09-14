    <?php
    
    // set here all the global variables and DB call for general page management (left below some examples) 


    /*
    function getGlobalInfo()
    {
    	global $photo;
        global $global;
        $photo->photogallery = getListOfPhotoGallery();
        
          $UtenteID=$_SESSION['UtenteID'];
          //echo $UtenteID;
          $bookMarkBlogCount = 0;
       if($UtenteID>0)
        {

        $global->BlogsHome = getListOfBlogsHome($bookMarkBlogCount);
        $global->BlogsCommentCount = getBlogCommentsCount();
        $global->landscapes = loadLandscape();
      
    }

    function getListOfPhotoGallery(){
		global $database;
		$query = "SELECT * from riv_photogallery  where PG_VISIBLE = 1 ORDER BY RAND() LIMIT 8";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	} 
    
    function getSingleBlogHome($ID){
		global $database;
		$query = "SELECT * from riv_blog WHERE ID=".$ID;
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}

    function getListOfBlogCommentsHome($ID_BLOG){
		global $database;
		$query = "SELECT * from riv_blog_comments WHERE ID_BLOG=".$ID_BLOG." ORDER BY TIMESTAMP";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}
    
    function getBlogCommentsCount()
    {	global $database;
		$query = "SELECT count(*) as TOTAL, ID_BLOG FROM `riv_blog_comments` group by ID_BLOG ";
		$result=$database->db_query($query);
		return $database->db_fetch_allrows($result);
	}
    
    */
        
?>
        
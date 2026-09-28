<?php

/*==================== FUNZIONI PER BLOG ================== */

function getAllBlogs(){		
    global $infoData;	
    $infoData->Blogs = getListOfBlogs();
    $infoData->DeletedBlogs = getListOfDeletedBlogs();
}

function getBlog($ID){
    global $database;
    $ID = (int)$ID;
    $query = "SELECT blog.* FROM blog WHERE blog.ID =".$ID;
    
    $result=$database->db_query($query);
    return $database->db_fetch_row($result);
}

function getListOfBlogs(){
    global $infoData;	
    global $database;

   $query = "SELECT  blog.ID,
   blogcategories.name AS POSTCATEG1,
   blog.TITLE,
   blog.SUBTITLE,
   blog.AUTHOR_NAME,
   POST_DATE 
   FROM blog LEFT JOIN blogcategories ON blog.POSTCATEG1=blogcategories.ID
   WHERE CATEGORY >0  ORDER BY ID DESC";
   
   // $query = "SELECT * FROM blog "." WHERE CATEGORY >0  ORDER BY POST_DATE DESC,ID DESC ";
    
    if ( !empty($TOP)){
      $query.="LIMIT ".$TOP." ";
    }		

    $result=$database->db_query($query);
    return $database->db_fetch_allrows($result);
}    

function getListOfDeletedBlogs(){
    global $infoData;	
    global $database;

    $query = "SELECT  blog.ID,
       blogcategories.name AS POSTCATEG1,
       blog.TITLE,
       blog.SUBTITLE,
       blog.AUTHOR_NAME,
       POST_DATE 
       FROM blog LEFT JOIN blogcategories ON blog.POSTCATEG1=blogcategories.ID 
       WHERE CATEGORY <=0  ORDER BY ID DESC";
    
     //$query = "SELECT * FROM blog". " WHERE CATEGORY <0 ORDER BY POST_DATE DESC,ID DESC ";
    
    if ( !empty($TOP)){
      $query.="LIMIT ".$TOP." ";
    }		

    $result=$database->db_query($query);
    return $database->db_fetch_allrows($result);
}  

function getBlogPostCategories(){
    global $database;
    
    $query = "SELECT * FROM blogcategories";
    
    $result=$database->db_query($query);
    return $database->db_fetch_allrows($result);
}

function AddBlogPost($CATEGORY,$POSTCATEG1,$POSTCATEG2,$POSTCATEG3,$TITLE,$SUBTITLE, $TEXT,$AUTHOR,$AUTHOR_NAME,$RELPOSTS,$POST_DATE,$KEYWORDS,$LINKIMAGE,$METADESCR,$PRIORITY,$FILENAME){
    global $database;
    global $esito;
    
    global $root;

    $CATEGORY = (int)$CATEGORY;
    $POSTCATEG1 = (int)$POSTCATEG1;
    $POSTCATEG2 = $POSTCATEG2 !== "" ? (int)$POSTCATEG2 : "";
    $POSTCATEG3 = $POSTCATEG3 !== "" ? (int)$POSTCATEG3 : "";
    $TITLE = mysqli_real_escape_string($database->connection,$TITLE);
    $SUBTITLE = mysqli_real_escape_string($database->connection,$SUBTITLE);
    $KEYWORDS = mysqli_real_escape_string($database->connection,$KEYWORDS);
    $LINKIMAGE = mysqli_real_escape_string($database->connection,$LINKIMAGE);
    $METADESCR = mysqli_real_escape_string($database->connection,$METADESCR);
    $AUTHOR = (int)$AUTHOR;
    $AUTHOR_NAME = mysqli_real_escape_string($database->connection,$AUTHOR_NAME);
    $RELPOSTS = mysqli_real_escape_string($database->connection,$RELPOSTS);

    $query =  'INSERT INTO blog(ID,CATEGORY,POSTCATEG1,POSTCATEG2,POSTCATEG3,TITLE,SUBTITLE,AUTHOR,AUTHOR_NAME,RELPOSTS,POST_DATE, LAST_MODIFIED,KEYWORDS,LINKIMAGE,METADESCR,FILENAME)VALUES '.'(null,'.$CATEGORY.',"'.$POSTCATEG1.'","'.$POSTCATEG2.'","'.$POSTCATEG3.'","'.$TITLE.'","'.$SUBTITLE.'","'.$AUTHOR.'","'.$AUTHOR_NAME.'","'.$RELPOSTS.'","'.$POST_DATE.'","'.$POST_DATE.'","'.$KEYWORDS.'","'.$LINKIMAGE.'","'.$METADESCR.'","'.$FILENAME.'")';
    //filelog("controller_blog-Addblog",$query);
    $result=$database->db_query($query);   
    $id_inserito=0;
    $id_inserito = mysqli_insert_id($database->connection);
    //echo $id_inserito."<br/>";      
    // echo $root."<br/>";          
    $fileLocation = "docs/blog/".$id_inserito."_".$FILENAME;
    file_put_contents($fileLocation,  $TEXT, FILE_APPEND | LOCK_EX);   
  
     
     
     $esito.= $query."<br/>";
     $inserito="[".$result."]";
     if($inserito=="[1]")
     {
     $esito.="<br/>Blog post added succesfully".$inserito."   <br/>";
     }
     else{ $esito.="<br/>ERROR: Is not possible to create it <br/>";}             
}//AddBlogPost

function UpdateBlogPost($ID,$CATEGORY,$POSTCATEG1,$POSTCATEG2,$POSTCATEG3,$TITLE,$SUBTITLE, $TEXT,$FILENAME,$KEYWORDS,$LINKIMAGE,$METADESCR,$AUTHOR_NAME,$RELPOSTS,$LAST_MODIFIED){
    global $database;
    global $esito;
    $ID = (int)$ID;

     $fileLocation = "docs/blog/".$ID."_".$FILENAME;
     $esito = file_put_contents($fileLocation,  $TEXT, LOCK_EX);


    $CATEGORY = (int)$CATEGORY;
    $POSTCATEG1 = (int)$POSTCATEG1;
    $POSTCATEG2 = $POSTCATEG2 !== "" ? (string)(int)$POSTCATEG2 : "NULL";
    $POSTCATEG3 = $POSTCATEG3 !== "" ? (string)(int)$POSTCATEG3 : "NULL";
    $TITLE = mysqli_real_escape_string($database->connection,$TITLE);
    $SUBTITLE = mysqli_real_escape_string($database->connection,$SUBTITLE);
    $KEYWORDS = mysqli_real_escape_string($database->connection,$KEYWORDS);
    $LINKIMAGE = mysqli_real_escape_string($database->connection,$LINKIMAGE);
    $METADESCR = mysqli_real_escape_string($database->connection,$METADESCR);
    $AUTHOR_NAME = mysqli_real_escape_string($database->connection,$AUTHOR_NAME);
    $RELPOSTS = mysqli_real_escape_string($database->connection,$RELPOSTS);

    $query = "UPDATE blog SET ".
    " CATEGORY = ".$CATEGORY.",".
    " POSTCATEG1 = ".$POSTCATEG1.",".
    " POSTCATEG2 = ".$POSTCATEG2.",".
    " POSTCATEG3 = ".$POSTCATEG3.",".
    " TITLE = '".$TITLE."',".
    " SUBTITLE = '".$SUBTITLE."',".
    " FILENAME = '".$FILENAME."',".
    " KEYWORDS = '".$KEYWORDS."',".
    " LINKIMAGE = '".$LINKIMAGE."',".
    " AUTHOR_NAME = '".$AUTHOR_NAME."',".
    " RELPOSTS = '".$RELPOSTS."',".
    " METADESCR = '".$METADESCR."'";

    if ($LAST_MODIFIED != '' ) {
       $query .= ", LAST_MODIFIED = '".$LAST_MODIFIED."'";
    }
    
    $query .= " WHERE ID =".$ID;
    //filelog("controller_blog-updateblog",$query);
    $result=$database->db_query($query);
         
    $esito.=$query;
    $inserito="[".$result."]";
    if($inserito=="[1]")
         {
          $esito.="<br/>Blopg updated added succesfully".$inserito."   <br/>";
         } else { 
         $esito.="<br/>Is not possible to insert<br/>";
         }             
}

function deleteBlog($id){
    global $database;
    $id = (int)$id;
    $result=$database->db_query("UPDATE blog SET CATEGORY = -1 WHERE ID=".$id);
}

function definitivedeleteBlog($id){
    global $database;
    $id = (int)$id;
    // deletes all the files starting with the blog id_*.* in the blog files folder
    foreach (glob('./docs/blog/'.$id.'_*.*') as $filename) {
        unlink($filename);
            }
    
    $query = "delete from blog WHERE ID=".$id;
    //echo $query;
    $result=$database->db_query($query);
}

function AddBlogImage($MYATTACHMENT){
        global $esito;
        global $imageBLog;
        echo "AddBlogImage";
        echo "<br/>FILE:" .$_FILES["FILE_INV"]["type"];
        
        echo "<br/>FILE letto".$_FILES["FILE_INV"]["size"] ;
       
        if ( ($_FILES["FILE_INV"]["type"] == "image/jpeg" || $_FILES["FILE_INV"]["type"] == "image/pjpeg" || $_FILES["FILE_INV"]["type"] == "image/gif" ||     $_FILES["FILE_INV"]["type"] == "image/x-png") &&                 ($_FILES["FILE_INV"]["size"] < 24000000))
        {

            //inserire files con la data per ordinarli nella visualizzazione, aggiungendo il nome per questioni di seo
            $mydate =date('YmdHi');
            $fileNameTimeStamp = $mydate;
            
            $filenameSEO = $mydate."-".$_FILES["FILE_INV"]["name"];
            
            $ext= pathinfo("./img/blog/" . $_FILES["FILE_INV"]["name"], PATHINFO_EXTENSION);
             $fileNameTimeStamp= $fileNameTimeStamp.".".$ext;
               echo   "<br/>FILE: " .$filenameSEO." " ;
            if (file_exists("./img/blog/" . $filenameSEO)) {
                  $esito.="<br/>IMAGE:".	 $filenameSEO . " already exists. ";
                   echo   "<br/>FILE already exists: change the name or delete the previous image from blog image folder";
          
             } else {
                      move_uploaded_file($_FILES["FILE_INV"]["tmp_name"],"./img/blog/". $filenameSEO);
                      $esito.="<br/>IMAGE Stored in: img/blog/". $filenameSEO;
                            
                   
            }

        }
        else{$esito.="<br/>NO Image Uploaded";}
      echo $esito;
            
}//AddBlogImage


    /*==================== FUNZIONI PER COMMENTI AL BLOG ================== */

function getBlogWithComments(){
    global $database;
    $resour = $database->db_query("SELECT DISTINCT t1.ID, t1.TITLE 
    FROM blog AS t1 
    JOIN blog_comments AS t2
    WHERE t1.ID = t2.ID_BLOG
    ORDER BY t1.ID DESC ");
    $blogWithComments = $database->db_fetch_allrows($resour);
    return $blogWithComments;
}

function getComments() {
    global $database;
    $resour = $database->db_query("SELECT *
    FROM  blog_comments
    WHERE ID_COM_ANSWER=0
    ORDER BY ID DESC");
    $blogComments = $database->db_fetch_allrows($resour);
    return $blogComments;
}

function getSubComments() {
    global $database;
    $resour = $database->db_query("SELECT *
    FROM  blog_comments
    WHERE ID_COM_ANSWER!=0
    ORDER BY ID DESC");
    $blogSubComments = $database->db_fetch_allrows($resour);
    return $blogSubComments;
}

function getCommentsNA() {
    global $database;
    $resour = $database->db_query("SELECT *
    FROM  blog_comments
    WHERE APPROVED='N'
    ORDER BY ID DESC");
    $blogComments = $database->db_fetch_allrows($resour);
    return $blogComments;
}

function updateComment($idComment,$comment) {
    global $database;
    $query="UPDATE blog_comments SET TEXT ='".$comment."' WHERE ID=".$idComment;
    $result=$database->db_query($query);
    return $comment;
}

function commentApprove($idComment) {
    global $database;
    $query="UPDATE blog_comments SET APPROVED ='Y' WHERE ID=".$idComment;
    $result=$database->db_query($query);
    return $result;
}

function commentDisapprove($idComment) {
    global $database;
    $query="UPDATE blog_comments SET APPROVED ='N' WHERE ID=".$idComment;
    $result=$database->db_query($query);
    return $result;
}

function deleteComment($idComment) {
    global $database;
    $query = "delete from blog_comments WHERE ID=".$idComment;
    $result=$database->db_query($query);
    return $result;
}


?>
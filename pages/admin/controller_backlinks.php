<?php

/*==================== FUNZIONI PER backlinks ================== */  

function getAllBacklinks(){		

    global $database;
    
    $resour = $database->db_query("SELECT * FROM backlinks ORDER BY ID");
    $backlinks = $database->db_fetch_allrows($resour);
    return $backlinks;
    }


function insertBacklinks($LINK_NAME,$CONTACT_NAME,$CONTACT_EMAIL,$COUNTRY,$LINK,$DESCRIPTION,$TOP_LINK,$IMAGEBKL) {

    global $database;
    $LINK_NAME = mysqli_real_escape_string($database->connection,$LINK_NAME);
    $CONTACT_NAME = mysqli_real_escape_string($database->connection,$CONTACT_NAME);
    $CONTACT_EMAIL = mysqli_real_escape_string($database->connection,$CONTACT_EMAIL);
    $COUNTRY = mysqli_real_escape_string($database->connection,$COUNTRY);
    $LINK = mysqli_real_escape_string($database->connection,$LINK);
    if ($TOP_LINK == '1') {$TOP = '1';} else {$TOP = '0';}
    $DESCRIPTION = mysqli_real_escape_string($database->connection,$DESCRIPTION); 

    //insert in the database
    $query = 'INSERT INTO backlinks (CONTACT_NAME,CONTACT_EMAIL,COUNTRY,LINK,LINK_NAME,DESCRIPTION,TOP_LINK) VALUES ("'.$CONTACT_NAME.'","'.$CONTACT_EMAIL.'","'.$COUNTRY.'","'.$LINK.'","'.$LINK_NAME.'","'.$DESCRIPTION.'","'.$TOP.'")';
        
    $resour = $database->db_query($query);

    //gets the school id
    $queryId = 'SELECT LAST_INSERT_ID()';
    $lastIdNum = $database->db_query($queryId);
    $lastId = $database->db_fetch_allrows($lastIdNum);
    $newBacklinkId = $lastId[0]['LAST_INSERT_ID()'];

    // add the new image if added to the submission:
        if ($IMAGEBKL!="") {
            //adds the new image
            addBklImage($IMAGEBKL,$newBacklinkId);
        }

}

function updateBacklinks($IDT,$LINK_NAME,$CONTACT_NAME,$CONTACT_EMAIL,$COUNTRY,$LINK,$DESCRIPTION,$TOP_LINK,$IMAGEBKL) {
    global $database;

    $IDT = (int)$IDT;
    $LINK_NAME = mysqli_real_escape_string($database->connection,$LINK_NAME);
    $CONTACT_NAME = mysqli_real_escape_string($database->connection,$CONTACT_NAME);
    $CONTACT_EMAIL = mysqli_real_escape_string($database->connection,$CONTACT_EMAIL);
    $COUNTRY = mysqli_real_escape_string($database->connection,$COUNTRY);
    $LINK = mysqli_real_escape_string($database->connection,$LINK);
    if ($TOP_LINK == 1) {$TOP = 1;} else {$TOP = 0;}
    $DESCRIPTION = mysqli_real_escape_string($database->connection,$DESCRIPTION);

    // Udpade DB record
    $query = "UPDATE backlinks SET ".
    " LINK_NAME = '".$LINK_NAME."',".
    " CONTACT_NAME = '".$CONTACT_NAME."',".
    " CONTACT_EMAIL = '".$CONTACT_EMAIL."',".
    " COUNTRY = '".$COUNTRY."',".
    " LINK = '".$LINK."',".
    " DESCRIPTION = '".$DESCRIPTION."',".
    " TOP_LINK = '".$TOP."'";
    
    $query .= " WHERE ID =".$IDT;

    $result=$database->db_query($query);

    // update image if added to the file:
    if ($IMAGEBKL!="") {
        //check if old image exists and deletes it
        if (file_exists('imgs/backlinks/BKL_'.$IDT.'.jpg')) {
            unlink('imgs/backlinks/BKL_'.$IDT.'.jpg');
        }
        //adds the new image
        addBklImage($IMAGEBKL,$IDT);
    }

}

function deleteBacklinks($idbacklink){
    global $database;
    $idbacklink = (int)$idbacklink;
    //elimino il record nel database
    $query = "delete from backlinks WHERE ID=".$idbacklink;

    $result=$database->db_query($query);
    
    //cancello, se esiste, l'immagine nella cartella delle immagini

    $deleteimage = "./imgs/backlinks/BKL_".$idbacklink.".jpg";
    if (file_exists($deleteimage)) {
            unlink($deleteimage); 
            }      

}

function addBklImage($IMAGEBKL,$ID) {

$imagelink = "BKL_".$ID.".jpg";
// aggiugno l'immagine caricata
$previewFileName = $_FILES["IMAGEBKL"]["name"];


// upload the file
    // file needs to be jpg,gif,bmp,x-png and 4 MB max
    if ( ($_FILES["IMAGEBKL"]["type"] == "image/jpeg" || $_FILES["IMAGEBKL"]["type"] == "image/pjpeg" || $_FILES["IMAGEBKL"]["type"] == "image/gif" || $_FILES["IMAGEBKL"]["type"] == "image/x-png") && ($_FILES["IMAGEBKL"]["size"] < 4000000))
        {

            // if uploaded image was JPG/JPEG
            if( $_FILES["IMAGEBKL"]["type"] == "image/jpeg" || $_FILES["IMAGEBKL"]["type"] == "image/pjpeg"){	
                $image_source = imagecreatefromjpeg($_FILES["IMAGEBKL"]["tmp_name"]);
            }	
            // if uploaded image was GIF
            if($_FILES["IMAGEBKL"]["type"] == "image/gif"){	
                $image_source = imagecreatefromgif($_FILES["IMAGEBKL"]["tmp_name"]);
            }	
            // if uploaded image was PNG
            if($_FILES["IMAGEBKL"]["type"] == "image/x-png"){
                $image_source = imagecreatefrompng($_FILES["IMAGEBKL"]["tmp_name"]);
            }
            
            $target_Path = "./img/backlinks/".$previewFileName;
            move_uploaded_file( $_FILES['IMAGEBKL']['tmp_name'], $target_Path );

                $remote_file = $target_Path;
                $thumbnail_dest= "./img/backlinks/".$imagelink;
                
            // get width and height of original image
                list($image_width, $image_height) = getimagesize($remote_file);
        
            // if uploaded image was JPG/JPEG
            if( $_FILES["IMGPREVIEW"]["type"] == "image/jpeg" or $_FILES["IMGPREVIEW"]["type"] == "image/pjpeg"){	
                $image_source = imagecreatefromjpeg($remote_file);
            }	
            // if uploaded image was GIF
            if($_FILES["IMGPREVIEW"]["type"] == "image/gif"){	
                $image_source = imagecreatefromgif($remote_file);
            }	
            // if uploaded image was PNG
            if($_FILES["IMGPREVIEW"]["type"] == "image/x-png"){
                $image_source = imagecreatefrompng($remote_file);
            }
                
                $new_image = imagecreatetruecolor(640, 480); 
                imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, 648, 480, $image_width, $image_height);
                imagejpeg($new_image,$thumbnail_dest,100);
                imagedestroy($new_image);
        
            unlink($target_Path);
        }
}

?>
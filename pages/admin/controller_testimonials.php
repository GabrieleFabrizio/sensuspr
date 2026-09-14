<?php

/*==================== FUNZIONI PER testimonials ================== */  

function getAllTestimonials(){		

    global $database;
    
    $resour = $database->db_query("SELECT * FROM testimonials ORDER BY ID");
    $ts = $database->db_fetch_allrows($resour);
    return $ts;
    }


function insertTestimonials($NAME,$POSITION,$COMPANY,$LINK,$DISORDER,$TEXT,$IMAGEBKL) {

    global $database;
    $NAME = mysqli_real_escape_string($database->connection,$NAME);
    $POSITION = mysqli_real_escape_string($database->connection,$POSITION);
    $COMPANY = mysqli_real_escape_string($database->connection,$COMPANY);
    $DISORDER = mysqli_real_escape_string($database->connection,$DISORDER);
    $LINK = mysqli_real_escape_string($database->connection,$LINK);
    $TEXT = mysqli_real_escape_string($database->connection,$TEXT); 

    //insert in the database
    $query = 'INSERT INTO testimonials (NAME,POSITION,COMPANY,LINK,DISORDER,TEXT) VALUES ("'.$NAME.'","'.$POSITION.'","'.$COMPANY.'","'.$LINK.'","'.$DISORDER.'","'.$TEXT.'")';
        
    $resour = $database->db_query($query);

    //gets the testimonial id for the image name
    $queryId = 'SELECT LAST_INSERT_ID()';
    $lastIdNum = $database->db_query($queryId);
    $lastId = $database->db_fetch_allrows($lastIdNum);
    $newBacklinkId = $lastId[0]['LAST_INSERT_ID()'];

    // add the new image if added to the submission:
        if ($IMAGEBKL!="") {
            //adds the new image
            addTesImage($IMAGEBKL,$newBacklinkId);
        }
    }

function updateTestimonials($IDT,$NAME,$POSITION,$COMPANY,$LINK,$DISORDER,$TEXT,$IMAGEBKL) {
    global $database;

    $IDT = (int)$IDT;
    $NAME = mysqli_real_escape_string($database->connection,$NAME);
    $POSITION = mysqli_real_escape_string($database->connection,$POSITION);
    $COMPANY = mysqli_real_escape_string($database->connection,$COMPANY);
    $LINK = mysqli_real_escape_string($database->connection,$LINK);
    $DISORDER = mysqli_real_escape_string($database->connection,$DISORDER);
    $TEXT = mysqli_real_escape_string($database->connection,$TEXT);

    // Udpade DB record
    $query = "UPDATE testimonials SET ".
    " NAME = '".$NAME."',".
    " POSITION = '".$POSITION."',".
    " COMPANY = '".$COMPANY."',".
    " LINK = '".$LINK."',".
    " DISORDER = '".$DISORDER."',".
    " TEXT = '".$TEXT."'";
    
    $query .= " WHERE ID =".$IDT;
    $result=$database->db_query($query);

    // update image if added to the file:
    if ($IMAGEBKL!="") {
        //check if old image exists and deletes it
        if (file_exists('img/testimonials/T_'.$IDT.'.jpg')) {
            unlink('img/testimonials/T_'.$IDT.'.jpg');
        }
        //adds the new image
        addTesImage($IMAGEBKL,$IDT);
    }

}

function deleteTestimonials($id){
    global $database;
    $id = (int)$id;
    //elimino il record nel database
    $query = "delete from testimonials WHERE ID=".$id;

    $result=$database->db_query($query);
    
    //cancello, se esiste, l'immagine nella cartella delle immagini

    $deleteimage = "./img/testimonials/T_".$id.".jpg";

    if (file_exists($deleteimage)) {
            unlink($deleteimage); 
            }      

}

function addTesImage($IMAGEBKL,$ID) {

$imagelink = "T_".$ID.".jpg";
// aggiugno l'immagine caricata
$previewFileName = $_FILES["IMAGEBKL"]["name"];
// upload the file
    // file needs to be jpg,gif,bmp,x-png and 4 MB max
    if ( ($_FILES["IMAGEBKL"]["type"] == "image/jpeg" || $_FILES["IMAGEBKL"]["type"] == "image/png" || $_FILES["IMAGEBKL"]["type"] == "image/gif" || $_FILES["IMAGEBKL"]["type"] == "image/x-png") && ($_FILES["IMAGEBKL"]["size"] < 4000000))
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
            if($_FILES["IMAGEBKL"]["type"] == "image/png"){
                $image_source = imagecreatefrompng($_FILES["IMAGEBKL"]["tmp_name"]);
            }
            
            $target_Path = "./img/testimonials/".$previewFileName;
            move_uploaded_file( $_FILES['IMAGEBKL']['tmp_name'], $target_Path );
            
                $remote_file = $target_Path;
                $thumbnail_dest= "./img/testimonials/".$imagelink;
                
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
            if($_FILES["IMGPREVIEW"]["type"] == "image/png"){
                $image_source = imagecreatefrompng($remote_file);
            }
                
                $new_image = imagecreatetruecolor(200, 200); 
                $whiteColor = imagecolorallocate($new_image, 255, 255, 255);
                imagefill($new_image, 0, 0, $whiteColor);
                imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, 200, 200, $image_width, $image_height);
                imagejpeg($new_image,$thumbnail_dest,100);
                imagedestroy($new_image);
                imagedestroy($image_source);
        
            unlink($target_Path);
        }
}

?>
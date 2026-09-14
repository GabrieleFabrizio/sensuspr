<?php

/*==================== FUNZIONI PER backlinks ================== */  

function getAllClients(){		

    global $database;
    
    $resour = $database->db_query("SELECT * FROM clients ORDER BY ID");
    $clients = $database->db_fetch_allrows($resour);
    return $clients;
    }


function insertClients($NAME,$EMAIL,$COUNTRY,$LINK,$COMMENT,$VISORDER,$IMAGECL) {

    global $database;
    $NAME = mysqli_real_escape_string($database->connection,$NAME);
    $EMAIL = mysqli_real_escape_string($database->connection,$EMAIL);
    $COUNTRY = mysqli_real_escape_string($database->connection,$COUNTRY);
    $LINK = mysqli_real_escape_string($database->connection,$LINK);
    $COMMENT = mysqli_real_escape_string($database->connection,$COMMENT); 
    $VISORDER = mysqli_real_escape_string($database->connection,$VISORDER);

    if (is_numeric($VISORDER)) {
        // Convert to integer
        $VISORDER = (int)$VISORDER;
    } else {
        $VISORDER = 0;
    }
    //insert in the database
    $query = 'INSERT INTO clients (NAME,EMAIL,COUNTRY,LINK,COMMENT,VISORDER) 
    VALUES ("'.$NAME.'","'.$EMAIL.'","'.$COUNTRY.'","'.$LINK.'","'.$COMMENT.'","'.$VISORDER.'")';
        
    $resour = $database->db_query($query);

    //gets the school id
    $queryId = 'SELECT LAST_INSERT_ID()';
    $lastIdNum = $database->db_query($queryId);
    $lastId = $database->db_fetch_allrows($lastIdNum);
    $newClientId = $lastId[0]['LAST_INSERT_ID()'];

    // add the new image if added to the submission:
        if ($IMAGECL!="") {
            //adds the new image
            addClImage($IMAGECL,$newClientId);
        }

}

function updateClients($IDT,$NAME,$EMAIL,$COUNTRY,$LINK,$COMMENT,$VISORDER,$IMAGECL) {
    global $database;

    $IDT = (int)$IDT;
    $NAME = mysqli_real_escape_string($database->connection,$NAME);
    $EMAIL = mysqli_real_escape_string($database->connection,$EMAIL);
    $COUNTRY = mysqli_real_escape_string($database->connection,$COUNTRY);
    $LINK = mysqli_real_escape_string($database->connection,$LINK);
    $COMMENT = mysqli_real_escape_string($database->connection,$COMMENT); 
    $VISORDER = mysqli_real_escape_string($database->connection,$VISORDER);

    if (is_numeric($VISORDER)) {
        // Convert to integer
        $VISORDER = (int)$VISORDER;
    } else {
        $VISORDER = 0;
    }

    // Udpade DB record
    $query = "UPDATE clients SET ".
    " NAME = '".$NAME."',".
    " EMAIL = '".$EMAIL."',".
    " COUNTRY = '".$COUNTRY."',".
    " LINK = '".$LINK."',".
    " COMMENT = '".$COMMENT."',".
    " VISORDER = '".$VISORDER."'";
    
    $query .= " WHERE ID =".$IDT;

    //filelog("clients update", $query);

    $result=$database->db_query($query);

    // update image if added to the file:
    if ($IMAGECL!="") {
        //check if old image exists and deletes it
        if (file_exists('img/clients/CL_'.$IDT.'.webp')) {
            unlink('img/clients/BCL_'.$IDT.'.webp');
        }
        //adds the new image
        addClImage($IMAGECL,$IDT);
    }

}

function deleteClients($idclient){
    global $database;
    $idclient = (int)$idclient;
    //elimino il record nel database
    $query = "delete from clients WHERE ID=".$idclient;

    $result=$database->db_query($query);
    
    //cancello, se esiste, l'immagine nella cartella delle immagini

    $deleteimage = "./img/clients/CL_".$idclient.".webp";
    if (file_exists($deleteimage)) {
            unlink($deleteimage); 
            }      

}

function addClImage($IMAGECL, $ID) {
    $imagelink = "CL_" . $ID . ".webp";
    $previewFileName = $_FILES["IMAGECL"]["name"];

    // Allowed MIME types
    $allowedTypes = ["image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/webp"];
    if (in_array($_FILES["IMAGECL"]["type"], $allowedTypes) && $_FILES["IMAGECL"]["size"] < 4000000) {

        $target_Path = "./img/clients/" . $previewFileName;
        move_uploaded_file($_FILES['IMAGECL']['tmp_name'], $target_Path);

        $image_source = null;
        $remote_file = $target_Path;
        $thumbnail_dest = "./img/clients/" . $imagelink;

        // Create the image source based on the uploaded file's MIME type
        switch ($_FILES["IMAGECL"]["type"]) {
            case "image/jpeg":
            case "image/pjpeg":
                $image_source = imagecreatefromjpeg($remote_file);
                break;
            case "image/png":
            case "image/x-png":
                $image_source = imagecreatefrompng($remote_file);
                break;
            case "image/webp":
                $image_source = imagecreatefromwebp($remote_file);
                break;
            default:
                return; // Unsupported file type
        }

        if ($image_source) {
            list($image_width, $image_height) = getimagesize($remote_file);

            // Create the square canvas
            $square_size = 400;
            $new_image = imagecreatetruecolor($square_size, $square_size);

            // Preserve transparency for PNG and WebP
            if ($_FILES["IMAGECL"]["type"] === "image/png" || $_FILES["IMAGECL"]["type"] === "image/x-png" || $_FILES["IMAGECL"]["type"] === "image/webp") {
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
                $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagefill($new_image, 0, 0, $transparent);
            }

            // Calculate the cropping area to maintain aspect ratio
            $aspect_ratio = $image_width / $image_height;

            if ($aspect_ratio > 1) {
                // Wider image (crop horizontally)
                $crop_width = $image_height;
                $crop_height = $image_height;
                $crop_x = ($image_width - $image_height) / 2;
                $crop_y = 0;
            } else {
                // Taller image or square (crop vertically)
                $crop_width = $image_width;
                $crop_height = $image_width;
                $crop_x = 0;
                $crop_y = ($image_height - $image_width) / 2;
            }

            // Resample and crop the image into the square canvas
            imagecopyresampled(
                $new_image,        // Destination image
                $image_source,     // Source image
                0, 0,              // Destination coordinates (top-left corner)
                $crop_x, $crop_y,  // Source coordinates (cropping start)
                $square_size, $square_size, // Destination dimensions (400x400)
                $crop_width, $crop_height  // Source dimensions (cropped area)
            );

            // Save as WebP
            imagewebp($new_image, $thumbnail_dest, 100); // Quality set to 100

            // Clean up
            imagedestroy($new_image);
            imagedestroy($image_source);
            unlink($target_Path);
        }
    }
}



?>
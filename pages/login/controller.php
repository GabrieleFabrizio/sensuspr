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
	if(!isLegal("login"))
		 Header("Location: index.php?page=unauthorized");
		 
	global $UtenteID, $currentPageTitle;
  global $meta;
	$UtenteID= $_SESSION['UtenteID'];
	//echo $UtenteID;
	if ($_SESSION['authorized']=="true"){ 
		$currentPageTitle="User profile";
	} else{
		$currentPageTitle="Login";
	}
	
	  switch ($step) {
    case "index":
        	if(isset($_GET["operator"]))
               {
               if($_GET["operator"]=="update")
               { 
                 $NEWS=0;
                 if ($_POST["NEWSLETTER"]=="yes") {
                 $NEWS=1;
                 }else{
                 $NEWS=0;
                 }
                 UpdateProfile($UtenteID,$_POST["USERNAME"],$_POST["EMAIL"],$_POST["FIRSTNAME"],$_POST["LASTNAME"],$_POST["ADDRESS"],$_POST["CITY"],$_POST["COUNTRY"],$_POST["TELEPHONE"],$NEWS);
               }
            }     
        	global $login;
           // $login->Profile = GetProfile($UtenteID); 
          
          $pageCanonical = '<link rel="canonical" href="'.$root.'login" />';

          //meta elements
          $meta = new metaData();
          if ($_SESSION['authorized']=="true"){ 
            $meta->pageTitle ="Sensus PR User profile";
          } else{
            $meta->pageTitle ="Sensus PR Team Login";
          }
          $meta->pageMetaDescription = "Sensus PR Team Login";
          $meta->pageMetaKeywords = "Sensus PR Team Login";
          $meta->pageMetaImage = $root.'imgs/icons/logo_main.png';
          $meta->pageType = 'website';
          $meta->pageMetaUrl = $root.'login';
          $meta->author = "kitesurfculture";
          $meta->pageMetaRevisit = "1 MONTHS";
          $meta->author = 'Sensus PR';
          $meta->pageMetaRevisit = "1 MONTHS";

        break;
        case "update":
          {
    	     global $login;
             $NEWS=0;
             if ($_POST["NEWSLETTER"]=="yes") {
                 $NEWS=1;
                 }else{
                 $NEWS=0;
                 }
             UpdateProfile($UtenteID,$_POST["USERNAME"],$_POST["EMAIL"],$_POST["FIRSTNAME"],$_POST["LASTNAME"],$_POST["ADDRESS"],$_POST["CITY"],$_POST["COUNTRY"],$_POST["TELEPHONE"],$NEWS);
             $login->Profile = GetProfile($UtenteID);        
          }
        break;
      }
        
	
	function GetProfile($ID)
    {
        global $database;
		$query = "SELECT * from userprofile WHERE ID=".$ID;
		$result=$database->db_query($query);
		//echo $query;
		return $database->db_fetch_allrows($result);
    }

    
     function UpdateProfile($ID,$USERNAME,$EMAIL,$FIRSTNAME,$LASTNAME,$ADDRESS,$CITY,$COUNTRY,$TELEPHONE,$NEWSLETTER){
		global $database;
		global $esito;
        
		$query = "UPDATE userprofile SET ".
		" firstname = '".$FIRSTNAME."',".
		" lastname = '".$LASTNAME."',".
		" address = '".$ADDRESS."',".
		" city = '".$CITY."',".
		" country = '".$COUNTRY."',".
	    " telephone = '".$TELEPHONE."',".
        " newsletter = '".$NEWSLETTER."'"; 
        $query .= " WHERE id =".$ID;
       
         $result=$database->db_query($query);
         // echo $query;
         $esito.=$query;
         $inserito="[".$result."]";
         if($inserito=="[1]")
         {
          $esito.="<br/>Profile updated added succesfully".$inserito."   <br/>";
         }
         else
         { 
         $esito.="<br/>Is not possible to insert<br/>";
         }             
    }
?>

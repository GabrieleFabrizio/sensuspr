<?php

    include_once("utilities.php"); 
    include_once("config/mainConfig.php");
    include_once("model/db.php");


    session_start();

    error_reporting (E_ERROR);
    //echo ('name :'.$_SESSION['user_username']);
     

    //echo ('$_SESSION'."variable var_dump:\n");
    //var_dump($_SESSION);



    //*** Connect to database. set the following if the website needs the use of DB. remember to close the DB at the end of this file ***
 
    $database = new database();
    if ( !$database->db_connect($dbIP,$dbName,$dbUser,$dbPass) ){
        die("Database error: ".$database->db_geterror());
    }
       
    //Ambient setup
     
    global $root;
    global $pagehead;
    global $BlogCategories;
    $root = getBaseURL().$applicationURL;

    require_once("model/menu.php");
    require_once("model/classes.php");
    include_once("model/environment.php");
    include_once("controllers/globalController.php");

    //AJAX mode management: verify the reload isn't an Ajax call. If it is not, the page is loaded normally, otherwise AJAX is set
    $ajaxGET = filter_var($_GET['ajax'], FILTER_VALIDATE_BOOLEAN);
     
    //Page navigation management
    $pageGET = $_GET['page'];
    $stepGET = $_GET['step'];
 
    $errorPosGET = $_GET['errorpos'];
    $errorGET = $_GET['error'];
    $errorTypeGET = $_GET['errortype'];
     
    $isMobile = false;
    $isMobileBrowser = false;
     
 
    /*detect mobile browser
    require_once("config/Mobile_Detect.php");
    $detect = new Mobile_Detect;
    if ($detect->isMobile()) {
        $isMobileBrowser = true;
    }*/
         
    if (isset($pageGET))
        {$page=$pageGET;} else {$page='home';}
 
    if (isset($stepGET))
        $step=$stepGET; 
 
    //global variable to pass page parameter to the inc_head.php file to load appropriate local.css 
    $pagehead=$page;
      
    //Begin page construction
     
        //Template
        //Instead than layout folder in the address can be implemented the variable $template coming from the environment file that takes it from the record 'options' in the DB, this might be useful in case of need of chance of the theme through DB
        // theme defines the class recalling the files: inc_initialize.php, inc_head.php, inc_body.php e inc_foot.php
 
        include("template/layout/theme.php");
 
        //page:dataModel
        if(file_exists("pages/$page/DataModel.php"))        
            include("pages/$page/DataModel.php");
         
        //page:controller
        if(file_exists("pages/$page/controller.php"))
            include("pages/$page/controller.php");
     
        $themeSelected = new theme();
 
        if($ajaxGET == false)
        {
            $themeSelected->init();
            $themeSelected->meta();
            $themeSelected->head();
         
            if(file_exists("pages/$page/head_script.php"))
            {
                include("pages/$page/head_script.php");
            }
  
            $themeSelected->headerpage();
        }
 
        include("pages/$page/$step.php");
     
 
        //START: error management
 
        if(file_exists("pages/$page/errors.php"))
            include("pages/$page/errors.php");
     
 
        if(strlen($errorGET)>0){
            if(strlen($errorTypeGET)<=0)
                $errorTypeGET="2";
            if(strlen($errorPosGET)<=0)
                $errorPosGET="default";
             
            ?>
            <script>
                $(document).ready(function(){
                    loadControllerMessages("<?=$errorPosGET?>",<?=$errorTypeGET?>, "<?=${"errTitle_" . $errorGET}?>", "<?=${"errMessage_" . $errorGET}?>");
                });
            </script>
            <?php
        }   

if($ajaxGET == false) {
            $themeSelected->foot();
    
            $themeSelected->scripts();
            
            if(file_exists("pages/$page/localJs.php"))
            {   
                include("pages/$page/localJs.php");
            }

            $themeSelected->closure();
}
 
    //END: page construction
     
    //Close DB connection if DB was open at the beginning
 
    $database->db_close();   
 
?>
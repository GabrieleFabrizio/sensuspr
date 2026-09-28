<?php 
/**
 * Avoid direct access to controller file
*/
if (preg_match("/pages/",$_SERVER['PHP_SELF'])) {
  $gotohome = $_SERVER['HTTP_HOST'];
  Header("Location: ../../unauthorized");
  die();
}
	global $admin; 
?>
<!-- Start Main Body Wrap -->
<div id="main-wrap" class="dmn__top">
    <?php include ("index_menu.php");?>
    <div id="adminPageContent" class="well text-center">
        <?php include ("main_admin.php");?>
    </div>
</div>
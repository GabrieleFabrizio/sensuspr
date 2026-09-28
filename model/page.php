<?php
global $root;
/**
 * Evito che accedano direttamente al file
 */
if (preg_match("/page.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: ".$root."index.php");
  die();
}

class page {

	var $pageTitle, $pageMetaKeywords, $pageMetaDescription, $pageMetaRevisit, $color;

}
?>
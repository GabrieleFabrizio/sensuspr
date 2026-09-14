<?php
//Block direct access to file
if (preg_match("/homeDataModel.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: ../index.php");
  die();
}


?>
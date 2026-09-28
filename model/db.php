<?php
//Divieto di accesso diretto al file
if (preg_match("/db.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: ../index.php");
  die();
}

/**
 * Database utility class
 * 
 *
 */
  class database {
	var $connection;

	/**	
	 * Funzione di connessione al DB
	 */
      
 function db_connect($sqlhost,$sqldbname,$sqluser,$sqlpass){
     $this->connection = @mysqli_connect($sqlhost, $sqluser, $sqlpass,$sqldbname);
      
     if (!$this->connection || !@mysqli_select_db($this->connection,$sqldbname)) {
       return false;
     } else {
        mysqli_query($this->connection,"SET NAMES 'UTF8'");
       return true;
     }
    }
 
 
    function db_geterror(){
        return mysqli_error($this->connection);
    }
 
 
    function db_query($query){
        $result=mysqli_query($this->connection,$query);
        return($result);
    }
 
 
    function db_fetch_row($result){
        $row=mysqli_fetch_assoc($result);
        return($row);
    }
 
    function db_num_rows($result){
        $row=mysqli_num_rows($result);
        return($row);
    }
 
    function db_fetch_allrows($result){
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[]=$row;
        }
        return($rows);
    }
     
    function db_close(){
        mysqli_close($this->connection);
    }
 
  }

?>
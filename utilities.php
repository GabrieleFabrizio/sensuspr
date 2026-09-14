<?php
if (preg_match("/utilities.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: ".$root."index.php");
  die();
}

	function getBaseURL() {
		if ( (isset($_SERVER["HTTPS"])) && ($_SERVER["HTTPS"] == "on") ) 
			$base_url = "https://" ;
		else 
			$base_url = 'http://' ;
		if ($_SERVER["SERVER_PORT"] != "80") {
			$base_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"] ;
		} else {
			$base_url .= $_SERVER["SERVER_NAME"] ;
		}
		return $base_url ;
	}

	function getCurrentPageURL() {
		return getBaseURL().$_SERVER["REQUEST_URI"];
	}
    
	
	// FUNCTION convertiData: converts italian date formato to USA
	function convertiData($dataUsa)
	{
		$rsl = explode ('-',$dataUsa);
		$rsl = array_reverse($rsl);
		return implode($rsl,'-');
	}

	// FUNCTION convertiDataItaToEng: converts italian date formato to USA
	function convertiDataItaToEng($dataIta)
	{	
		if (strpos($dataIta,'-'))
			$rsl = explode ('-',$dataIta);
		else
			$rsl = explode ('/',$dataIta);
		$rsl = array_reverse($rsl);
		return implode($rsl,'-');
	}	

	// FUNZIONE cleanname: returns a string without special characters. useful to build URLs	
	function cleanname($str){
		$str=str_replace("%", "", $str);
		$str=str_replace("?", "", $str);
		$str=str_replace("!", "", $str);
		$str=str_replace(".", "", $str);
		$str=str_replace("[", "", $str);
		$str=str_replace("]", "", $str);
		$str=str_replace("{", "", $str);
		$str=str_replace("}", "", $str);		
		$str=str_replace("(", "", $str);
		$str=str_replace(")", "", $str);
		$str=str_replace(":", "", $str);
		$str=str_replace(",", "", $str);
		$str=str_replace("^", "", $str);
		$str=str_replace(" ", "-", $str);
		$str=str_replace("'", "", $str);	   
		$str=str_replace("&", "&amp;", $str);
		$str=str_replace("à", "a", $str);
		$str=str_replace("è", "e", $str);
		$str=str_replace("é", "e", $str);
		$str=str_replace("ì", "i", $str);
		$str=str_replace("ò", "o", $str);	   
		$str=str_replace("ò", "o", $str);
		$str=str_replace("ò", "o", $str);
		$str=str_replace("u", "u", $str);
		$str=str_replace("c", "c", $str);
		$str=str_replace("O", "O", $str);
		$str=str_replace("U", "U", $str);
		$str=str_replace("A", "A", $str);
		return $str;
	}
	
	// FUNCTION mydate: outputs date in extended format	
	//As format can be used $formatExtendedDate (se file environment.php)
	function mydate($format, $publictime)	
	{
	       $sec = substr($publictime, 15, 2);
	       $min = substr($publictime, 13, 2);
	       $hour = substr($publictime, 11, 2);
	       $day = substr($publictime, 8, 2);
	       $month = substr($publictime, 5, 2);	
	       $year = substr($publictime, 0, 4);	
	//strftime( '%A %d. %B %Y', mktime( 0,0,0,9,6,2001)); 
	       return utf8_encode(strftime($format, mktime($hour, $min, $sec, $month, $day, $year)));	
	}
	

	// FUNCTION tagliaStringaSenzaDot: returns a string without cutting words	
	function tagliaStringaSenzaDot($stringa, $max_char){
		if(strlen($stringa)>$max_char){
			$stringa_tagliata=substr($stringa, 0,$max_char);
			$last_space=strrpos($stringa_tagliata," ");
			$stringa_ok=substr($stringa_tagliata, 0,$last_space);
			return $stringa_ok;
		}else{
			return $stringa;
		}
	}

    // FUNZIONE isLegal: confronta il tipo utente con il tipo utente della pagina passata per argomento
  	function isLegal($page){
		global $database;
		
		$query = "SELECT access_type FROM pages WHERE page=\"$page\"";
		$result = $result=$database->db_query($query);
		$page_type = $database->db_fetch_row($result);	
		$userType = 0;
		if ($_SESSION['authorized']=="true" && strlen($_SESSION['user_type'])>0)	
			$userType = $_SESSION['user_type'];
	
		// Se il tipo utente in sessione è maggiore o uguale del tipo di accesso della pagina corrente allora
		// la funzione restituisce VERO
		if ( $page_type["access_type"] == NULL || $userType>=$page_type["access_type"] )
        {	    return TRUE;
        }
		else
        {
        	return FALSE;
        }
	}

	// cleans the text to any html tag to avoid cross script attack XSS
	function sanitize_xss($value) {
		try {
			$sanitizeword = htmlspecialchars($value,ENT_QUOTES,'UTF_8');
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $sanitizeword;
	}

	//function to save files on the root for debugging of queries etc
	function filelog ($name,$info) {
		$myfile = fopen($name.".txt", "w") or die("Unable to open file!");
		fwrite($myfile, $info);
		fclose($myfile);
	}

	// function to substitute php file_get_contents() that 

	function curlRequest($url) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($c);
        curl_close($c);
        return $data;
    }

	// when passing text variable from php to javascript to avoid escape char problems
	function escapeJavaScriptText($string)
	{
		return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
	}

	
?>
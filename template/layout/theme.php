<?php

//Direct access block
if (preg_match("/theme.php/",$_SERVER['PHP_SELF'])) {
	Header("Location: ../../index.php");
	die();
}

// define the functions to build the page

class theme {
	function init() {
		include 'a_doctype.php';
	}	

	function meta() {
		include 'b_meta.php';
	}

	function head() {
		include 'c_head.php';
	}
	
	function headerpage() {
		global $menu;	
		include 'd_headerbody.php';
	}	

	function foot(){
		global $copyright;
		include 'e_footer.php';
	}
    
    function scripts(){
		global $copyright;
		include 'f_scripts.php';
	}
    
    function closure(){
		global $copyright;
		include 'g_closure.php';
	}

}
?>
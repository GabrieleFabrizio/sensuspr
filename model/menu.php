<?php
global $root;
if (preg_match("/menu.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: " .$root."index.php");
  die();
}

class menu {

	var $menu_items;
	
	function  menu($userTypeIn){
		global $database;

/*
			$userType = 0;
	
		if ($_SESSION['authorized']=="true" && strlen($_SESSION['user_type'])>0)	
			$userType = $_SESSION['user_type'];
*/	
		if(!isset($userTypeIn))
		    $userTypeIn = 0;
		
		$query = "select title,link_menu,page,popup,color from pages where access_type<=$userTypeIn order by ordine";
		$result = $result=$database->db_query($query);
		$this->menu_items = $database->db_fetch_allrows($result);
	}
	
	function render(){
		global $page, $currentPageTitle, $root;

		foreach($this->menu_items as $row){		
			if ($row['page']==$page){
                $currentPageTitle = $row['title'];
				echo "\n<li class='active'>"	//class='vivi-menu-item'
					."<a href='"
					.$root   // Versione online -> da cambiare in    /index.php?=page=
					.$row['page']
					."' title='".
					$row['ll']
					."'>"
					.$row['link_menu']."</a></li>";			
			}
			else{
				echo "\n<li>"	//class='vivi-menu-item'
					."<a href='"
					.$root	// Versione online -> da cambiare in    /index.php?=page=
					.$row['page']
					."' title='".
					$row['ll']
					."'>"
					.$row['link_menu']."</a></li>";
			}
		}

	}

}
?>
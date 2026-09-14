<?php
global $root;

if (preg_match("/classes.php/",$_SERVER['PHP_SELF'])) {
  Header("Location: " .$root."index.php");
  die();
}

class user{
 	var 	$id
 		,	$username
 		,	$token
	 	,	$userType
 		,	$firsname
 		,	$surname
 		
 		,	$account_verified
 		,	$fb_userid
 		,	$privacy1
 		,	$privacy2
 		,	$Address
 		,	$City
 		,	$Country
 		,	$Telephone;
 		
 	function __to__toStringString(){
 		echo $this->username;
 	}	

}

class metaData {
	public	$pageTitle
		,	$pageMetaDescription
		,	$pageMetaKeywords
		,	$pageMetaImage
		,	$pageType
		,	$pageMetaUrl
		,	$lastPublished
		,	$twitterSite
		,	$twitterCreator
		,	$twitterCard 
		,	$author
		,	$pageMetaRevisit
		,	$ogpageTitle
		,	$ogpageDescription
		,	$ogUrl;
}

class strut {
	public	$type
	,	$title
	,	$url
	,	$descr
	,	$auth
	,	$written
	, 	$upd
	,	$address
	,	$Locality
	,	$region
	,	$country
	,	$price
	,	$currency;
}

class blog {
	public	$pageTitle
	,	$pageMetaDescription
	,	$pageMetaKeywords
	,	$latest
	,	$categories
	,	$blogCateg
	,	$AllBlogs
	, 	$upd
	,	$address
	,	$Locality
	,	$region
	,	$country
	,	$price
	,	$currency;
}

class infodata {
	public $Blogs
	,	$DeletedBlogs
	,	$SingleBlog
	,	$blogCateg;
}

?>

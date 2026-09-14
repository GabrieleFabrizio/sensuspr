<?php 
    global $meta;
    global $copyrighthead;
?>
<TITLE><?=$meta->pageTitle?></TITLE>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="DESCRIPTION" content="<?=$meta->pageMetaDescription?>" />
<meta name="KEYWORDS" content="<?=$meta->pageMetaKeywords?>" />
<?php if($meta->pageMetaRevisit != '') { ?>
<meta name="REVISIT-AFTER" content="<?=$meta->pageMetaRevisit?>">
<?php }?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="RESOURCE-TYPE" content="DOCUMENT"/>
<meta name="DISTRIBUTION" content="GLOBAL"/>
<?php if($meta->author != '') { ?>
<meta name="AUTHOR" content="<?=$meta->author?>"/>
<?php }?>
<meta name="COPYRIGHT" content="<?=$copyrighthead?>"/>
<meta name="ROBOTS" content="INDEX, FOLLOW"/>
<meta name="RATING" content="GENERAL"/>
<meta http-equiv="EXPIRES" content="0"/>
<?php if($meta->twitterCard == '') { 
    $meta->twitterCard = "summary";
    }
?><meta name="twitter:card" content="<?=$meta->twitterCard?>" />
<?php if($meta->twitterSite == '') { 
    $meta->twitterSite = "@";
    }
?><meta name="twitter:site" content="<?=$meta->twitterSite?>" />
<?php if($meta->twitterCreator == '') { 
    $meta->twitterCreator = "@";
    }
?><meta name="twitter:creator" content="<?=$meta->twitterCreator?>" />
<meta property="og:title" content="<?=$meta->pageTitle?>">
<?php if($meta->pageType != '') { ?>
<meta property="og:type" content="<?=$meta->pageType // can be article  for blog or anything else check meta og:type elements?>" /> 
<?php }?>
<meta property="og:description" content="<?=$meta->pageMetaDescription?>">
<?php if($meta->pageMetaImage != '') { ?>
<meta property="og:image" content="<?=$meta->pageMetaImage?>">
<?php }?>
<?php if($meta->pageMetaImage != '') { ?>
<meta property="og:image:alt" content="<?=$meta->pageTitle?>">
<?php }?>
<meta property="fb:app_id" content="245322243309035" />
<meta property="og:site_name" content="sensuspr.com" />
<?php if($meta->pageMetaUrl != '') { ?>
<meta property="og:url" content="<?=$meta->pageMetaUrl?>">
<?php }?>
<?php if($meta->lastPublished != '') { ?>
<meta property="article:published_time" content="<?=$meta->lastPublished?>T00:01:0+00:00" />
<?php }?>
<?php if($meta->author != '') { ?>
<meta property="article:author" content="<?=$meta->author?>" />
<?php }?>

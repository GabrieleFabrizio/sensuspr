<?php 
	global $root;
    global $pagehead;
    global $breadCrumbs;
    global $articleSchema;
?>

<link href="<?=$root?>template/css/style_2-10.css" rel="stylesheet" media="screen">
<link rel="shortcut icon" type="image/x-icon" href="<?=$root?>icon/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$root?>icon/apple/apple-touch-icon-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$root?>icon/apple/apple-touch-icon-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$root?>icon/apple/apple-touch-icon-72.png">
<link rel="apple-touch-icon-precomposed" href="<?=$root?>icon/apple/apple-touch-icon-57.png">

<?php  
global $page;
// avoids to call google analitics if goes to login or admin, to avoid not needed counts
if ($page!="login" && $page!="admin") { ?>

<!-- Google Analytics Here-->

<?php }?>

<!-- ***   Page scripts  *** -->
<!--script src="<?=$root?>template/js/smooth-scroll.js"></script-->
<script src="<?=$root?>template/js/jquery-3.2.1.min.js"></script>
<?php
// schema structured data elements
// general website info
echo '
<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@graph": [{
        "@type": "Organization",
        "name": "Sensus PR",
        "alternateName": "SensusPR",
        "url": "https://sensuspr.com/",
        "logo": "https://sensuspr.com/img/login-logo.png",
        "sameAs": [
            "https://www.facebook.com/sensuspr",
            "https://twitter.com/sensuspr",
            "https://sensuspr.com/"
        ]
    }, {
        "@type": "WebSite",
        "@id": "https://sensuspr.com/#website",
        "url": "https://sensuspr.com/",
        "name": "Sensus PR",
        "description": "Sensus PR: We have extensive experience in PR, Digital Marketing and Communications. We use hands-on approach, in-depth analysis of the product and targeted communication strategies to achieve the maximum exposure effect for our clients. We are also trained in communications crisis management, helping our clients deal with high pressure situations.",
        "publisher": {
            "@id": "https://sensuspr.com/#organization"
        },
        "inLanguage": "en-US"
    }';
// create the schema breadcrumbs here if the array breadcrumb is set
if (isset($breadCrumbs) && count($breadCrumbs) >0 ) {        
    $breadNumber = count($breadCrumbs); 
    $counter = 0;
    echo ', {'."\r\n";
    echo '        "@type": "BreadcrumbList",'."\r\n";
    echo '        "itemListElement": [';
    foreach ($breadCrumbs as $breadCrumb) {
        if ($counter+1 < $breadNumber ) {
            echo '{'."\r\n";
            echo '          "@type": "ListItem",'."\r\n";
            echo '          "position": '.($counter+1).",\r\n";
            echo '          "name": "'.$breadCrumb["NAME"].'"'.",\r\n";
            echo '          "item": "'.$root.$breadCrumb["LINK"].'"'."\r\n";
            echo '         },';
        } else {
            echo '{'."\r\n";
            echo '          "@type": "ListItem",'."\r\n";
            echo '          "position": '.($counter+1).",\r\n";
            echo '          "name": "'.$breadCrumb["NAME"].'"'."\r\n";
            echo '         }';
        }
        $counter++;
    }
    echo ']
      }';
}
// create the schema for the article here if the array articleSchema is set
if (isset($articleSchema) && count($articleSchema) >0 ) {
    echo ', {'."\r\n";
    echo '        "@type": "BlogPosting",'."\r\n";
    echo '        "mainEntityOfPage": {'."\r\n";
    echo '          "@type": "WebPage",'."\r\n";
    echo '          "@id": "'.$root.$articleSchema['LINK'].'"'."\r\n";
    echo '        },'."\r\n";
    echo '        "headline": "'.$articleSchema['TITLE'].'",'."\r\n";
    echo '        "description": "'.$articleSchema['DESCRIPTION'].'",'."\r\n";
    echo '        "image": {'."\r\n";
    echo '          "@type": "ImageObject",'."\r\n";
    echo '          "url": "'.$articleSchema['IMAGE'].'",'."\r\n";
    echo '          "width": "700",'."\r\n";
    echo '          "height": "577"'."\r\n";
    echo '        },'."\r\n";
    echo '        "author": {'."\r\n";
    echo '          "@type": "Person",'."\r\n";
    echo '          "name": "'.$articleSchema['AUTHOR'].'",'."\r\n";
    echo '          "url": "https://kitesurfculture.com/"'."\r\n";
    echo '        },'."\r\n";
    echo '        "publisher" : {'."\r\n";
    echo '          "@type": "Organization",'."\r\n";
    echo '          "name": "Kitesurf Culture",'."\r\n";
    echo '          "logo": {'."\r\n";
    echo '              "@type": "ImageObject",'."\r\n";
    echo '              "url": "'.$root.'imgs/icons/logo_header.png",'."\r\n";
    echo '              "width": "366",'."\r\n";
    echo '              "height": "80"'."\r\n";
    echo '          }'."\r\n";
    echo '        },'."\r\n";
    echo '        "datePublished": "'.$articleSchema['DATEP'].'",'."\r\n";
    echo '        "dateModified": "'.$articleSchema['DATEM'].'"'."\r\n";   
    echo '       }'."\r\n";  
}
// create the schema for the localbusiness here if the array schoolSchema is set
if (isset($schoolSchema) && count($schoolSchema) >0 ) {
    echo ', {'."\r\n";
    echo '        "@type": "SportsActivityLocation",'."\r\n";
    echo '        "name": "'.$schoolSchema['NAME'].'",'."\r\n";
    echo '        "image": {'."\r\n";
    echo '          "@type": "ImageObject",'."\r\n";
    echo '          "url": "'.$schoolSchema['IMAGE'].'",'."\r\n";
    echo '          "width": "600"'."\r\n";
    echo '        },'."\r\n";
    echo '        "url": "'.$schoolSchema['URL'].'",'."\r\n";
    echo '        "telephone": "'.$schoolSchema['TELEPHONE'].'",'."\r\n";
    echo '        "priceRange": "'.$schoolSchema['PRICERANGE'].'",'."\r\n";
    echo '        "geo": {'."\r\n";
    echo '          "@type": "GeoCoordinates",'."\r\n";
    echo '          "latitude": "'.$schoolSchema['LAT'].'",'."\r\n";
    echo '          "longitude": "'.$schoolSchema['LON'].'"'."\r\n";
    echo '        },'."\r\n";
    echo '        "address": {'."\r\n";
    echo '          "@type": "PostalAddress",'."\r\n";
    echo '          "streetAddress": "'.$schoolSchema['ADDRESS'].'",'."\r\n";
    echo '          "addressLocality": "'.$schoolSchema['CITY'].'",'."\r\n";
    echo '          "addressCountry": "'.$schoolSchema['COUNTRYCODE'].'"'."\r\n";
    echo '        }'."\r\n"; 
    echo '       }'."\r\n";  
}
// closure of the schema Json element
echo '    ]}
</script>';

?>


<script>
    window.applicationURL = "<?=$root?>";
</script>


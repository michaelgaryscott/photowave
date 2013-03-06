<?php
error_reporting(0);

$site1_link = "./index.php?active=1";
$site1_name = "Home";
$site2_link = "./about.html";
$site2_name = "About";
$site3_link = "./contact.php?active=3";
$site3_name = "Contacts";
$site4_link = "./gastebuch.html";
$site4_name = "Gästebuch";
$site5_link = "./links.html";
$site5_name = "Links";
$site6_link = "./impressum.html";
$site6_name = "Impressum";

$trig_active_site = $_GET["active"];


$site1_active = "";
$site2_active = "";
$site3_active = "";
$site4_active = "";
$site5_active = "";
$site6_active = "";

$set_active = ' class="active"';

switch($trig_active_site)
{
	case 1:
		$site1_active = $set_active;
		break;
	case 2:
		$site2_active = $set_active;
		break;
	case 3:
		$site3_active = $set_active;
		break;
	case 4:
		$site4_active = $set_active;
		break;
	case 5:
		$site5_active = $set_active;
		break;
	case 6:
		$site6_active = $set_active;
		break;	
}

echo '
<!-- HEADER - BEGIN -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Guestbook - Adrian Sameli</title>



    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
   <style type="text/css">
.art-post .layout-item-0 { padding-right: 10px;padding-left: 10px; }
   .ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
   .ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
   </style>

</head>
<body>
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div id="art-hmenu-bg" class="art-bar art-nav">
    </div>
    <div class="cleared reset-box"></div>
    <div class="art-header">
        <div class="art-header-position">
            <div class="art-header-wrapper">
                <div class="cleared reset-box"></div>
                <div class="art-header-inner">
                <div class="art-logo">
                                 <h1 class="art-logo-name">Gästebuch</h1>
                                                 <h2 class="art-logo-text">Modul 133 - Projekt Adrian Sameli</h2>
                                </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="cleared reset-box"></div>
    <div class="art-box art-sheet">
        <div class="art-box-body art-sheet-body">
<div class="art-bar art-nav">
<div class="art-nav-outer">
	<ul class="art-hmenu">
		<li>
			<a href="'.$site1_link.'"'.$site1_active.'>'.$site1_name.'</a>
		</li>	
		<li>
			<a href="'.$site2_link.'"'.$site2_active.'>'.$site2_name.'</a>
		</li>	
		<li>
			<a href="'.$site3_link.'"'.$site3_active.'>'.$site3_name.'</a>
		</li>	
		<li>
			<a href="'.$site4_link.'"'.$site4_active.'>'.$site4_name.'</a>
		</li>	
		<li>
			<a href="'.$site5_link.'"'.$site5_active.'>'.$site5_name.'</a>
		</li>	
		<li>
			<a href="'.$site6_link.'"'.$site6_active.'>'.$site6_name.'</a>
		</li>	
	</ul>
</div>
</div>
';

?>
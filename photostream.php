<?php

include 'includes/config.php';
$menu_active = 'Photostream';
?>
<!-- HEADER - BEGIN -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--[if IE 9]><META http-equiv="refresh" content="0; URL=./wrong_browser.html"><![endif]-->
	<!--[if IE 8]><META http-equiv="refresh" content="0; URL=./wrong_browser.html"><![endif]-->
	<!--[if IE 7]><META http-equiv="refresh" content="0; URL=./wrong_browser.html"><![endif]-->
	<!--[if IE 6]><META http-equiv="refresh" content="0; URL=./wrong_browser.html"><![endif]-->
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script>
		 <script>
				$(document).ready(function() {
					$(\'#UploadForm\').on(\'submit\', function(e) {
						e.preventDefault();
						$(\'#SubmitButton\').attr(\'disabled\', \'\'); // disable upload button
						//show uploading message
						$("#output").html(\'<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Uploading...</span></div>\');
						$(this).ajaxSubmit({
							target: \'#output\',
							success:  afterSuccess //call function after success
						});
					});
				});
				function afterSuccess()  {
					$(\'#UploadForm\').resetForm();  // reset form
					$(\'#SubmitButton\').removeAttr(\'disabled\'); //enable submit button
				}
			</script>
		 <link href="style/style.css" rel="stylesheet" type="text/css" />
   
   
</head>
<body>
<!--[if IE 9]><h1>Please use another Browser!</h1><![endif]-->
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
                                 <h1 class="art-logo-name">Photowave</h1>
                                                 <h2 class="art-logo-text">Modul 141 - Projekt Adrian Sameli & Fabio Colbrelli</h2>
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
<?php
	foreach ($menu as $l) {
		echo '
			<li>
				<a href="'.$l['link'].'"'.($l['name'] == $menu_active ? ' class="active"' : '').'>'.$l['name'].'</a>
			</li>';
	}
?>
	</ul>
</div>
</div>
<!-- HEADER - END -->
<?php

echo '
<div class="cleared reset-box"></div>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
                                <h2 class="art-postheader">Photostream
                                </h2>
                                                <div class="art-postcontent">
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%;">';


if(isset($_SESSION["userid"]))
{
	
	// Main Part
	echo '	<div><br />
			<div id="Wrapper">
			<div align="left">
			<form action="processupload.php" method="post" enctype="multipart/form-data" id="UploadForm">
			<input name="ImageFile" type="file" />
			<input type="submit"  id="SubmitButton" value="Upload" />
			</form>
			<div id="output"></div>
			</div>
			</div>
			</div>';
}
else
	echo 'Sie sind nicht berechtigt diese Seite zu sehen.';
	


echo'
    </div>
    </div>
</div>

                </div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>';

include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>
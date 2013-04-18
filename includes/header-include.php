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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="script.js"></script>
	<style type="text/css">
	.art-post .layout-item-0 { padding-right: 10px;padding-left: 10px; }
	.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
	.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
	</style>
<?php
	foreach ($header as $h) {
		echo $h;
	}
?>
</head>
<body onload="loadpos()" onunload="savepos()">
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div id="art-hmenu-bg" class="art-bar art-nav"></div>
    <div class="cleared reset-box"></div>
    <div class="art-header">
        <div class="art-header-position">
            <div class="art-header-wrapper">
                <div class="cleared reset-box"></div>
                <div class="art-header-inner">
					<div class="art-logo">
						<h1 class="art-logo-name">Photowave</h1>
						<h2 class="art-logo-text">Modul 141 - Projekt Adrian Sameli &amp; Fabio Colbrelli</h2>
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
			<div class="cleared reset-box"></div>
			<div class="art-layout-wrapper">
				<div class="art-content-layout">
					<div class="art-content-layout-row">
						<div class="art-layout-cell art-content">
							<div class="art-box art-post">
								<div class="art-box-body art-post-body">
									<div class="art-post-inner art-article">
										<h2 class="art-postheader"><?php echo $title;?></h2>
										<div class="art-postcontent">
											<div class="art-content-layout">
												<div class="art-content-layout-row">
													<div class="art-layout-cell layout-item-0" style="width: 100%;">
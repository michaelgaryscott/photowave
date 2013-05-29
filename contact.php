<?php

include 'includes/config.php';
$menu_active = 'Contacts';
$title = 'Kontakt';
include 'includes/header-include.php';

echo '
<p><span style="font-weight: bold;">Falls Fehler, Fragen oder sonstiges auftauchen, stehe ich jederzeit zur Verfügung.</span></p>


<h3>Kontakt</h3>

<p>W:  <a href="http://www.surwave.ch">www.surwave.ch</a><br />
E:    <a href="mailto:info@surwave.ch">info@surwave.ch</a></p>
';

include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>
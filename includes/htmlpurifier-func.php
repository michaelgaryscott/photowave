<?php
function clean_html($dirty_html)
{

require_once 'htmlpurifier/library/HTMLPurifier.auto.php';

$purifier = new HTMLPurifier();
$clean_html = $purifier->purify($dirty_html);
}

?>
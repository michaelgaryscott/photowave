<?php
$dbname="asameli_guestbook"; 
$dbhost="localhost";
$dbuser="root";
$dbpass=""; 

$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname,$dbconnection) or die(mysql_error()); 

$query = "
    INSERT INTO
        tbluser
        (name, vorname, titel, mail, password, groupid)
    VALUES
        ('Sameli', 'Adrian', 'Herr', 'adi@geilisieche.tk', 'admin', 2)
";

mysql_query($query, $dbconnection) or die(mysql_error());
echo 'Datensätze eingefügt: ', mysql_affected_rows($dbconnection);  

?>
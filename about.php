<?php
include 'includes/config.php';
$menu_active = 'About';
$title = 'Über dieses Projekt!';
include 'includes/header-include.php';
?>
<br />
<h2>Beschreibung</h2>
<p>Die Webseite soll eine Webseite mit integriertem Gästebuch sein. Der Fokus der Seite soll auf das Gästebuch gelegt werden. Es soll eine Benutzerverwaltung geben, in der Administratoren die Möglichkeit haben Benutzer zu löschen, zu editieren oder neue anzulegen. Jeder hat die Möglichkeit sich zu registrieren. Beiträge sollen nur von registrierten Benutzern verfasst werden können. Die Beiträge sollen durch den Verfasser wieder gelöscht oder editiert werden können. Selbstverständlich besitzen Administratoren das Recht alle Beiträge zu verwalten. Die Daten sollen in einer Datenbank gespeichert werden. Die PHP basierte Seite soll diese immer wieder auslesen und die Webseite in Echtzeit mit den entsprechenden Daten abfüllen. Es findet also kein Caching statt. Der Web-Inhalt der Seite wird direkt in den PHP Dateien gespeichert diese kommen nicht in Berührung mit der Datenbank.</p>
<h2>Layout</h2>
<p>Designtechnisch soll die Webseite schlicht aufgebaut sein. Sie soll aus einem Header mit Titel, Subtitel und Background bestehen. Darunter soll das Navigationsmenü sein. Der Inhalts Teil soll aus zwei Spalten bestehen. Links soll der Hauptinhalt präsentiert werden, wobei rechts eine Seitenleiste mit einem Login Formular angezeigt werden soll. Dier Fuss der Webseite soll sich unter den beiden Hauptinhalten befinden. Er soll ein Copyright enthalten und in selben Ton wie die Navigationsleiste gefärbt sein.</p>
<?php
include 'includes/sidebar-include.php';
include 'includes/footer-incude.php';
?>
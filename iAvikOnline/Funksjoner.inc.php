
<?php
function kobleTilDBLocalhost ($databasenavn="avsluttendeprosjekt"){
	$vert = "localhost";
	$bruker = "root";
	$passord = "";
	$db = new mysqli($vert, $bruker, $passord, $databasenavn);
	return $db;
}
?>

<?php
function kobleTilDBInfinity ($databasenavn="epiz_34002214_iavik"){
	$vert = "sql311.epizy.com";
	$bruker = "epiz_34002214";
	$passord = "IkMazuUrStQ";
	$db = new mysqli($vert, $bruker, $passord, $databasenavn);
	return $db;
}
?>

<?php
function sjekk_autentisert() {
    if ( false == $_SESSION['innlogget']) {
        header("Location: 0iAvikInnloggingMedDBSjekk.php");
        exit();
    }
}
?>

<?php
function dumpInnhold($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
}
?>
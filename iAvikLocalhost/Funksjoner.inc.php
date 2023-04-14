
<?php
function kobleTilDB ($databasenavn="avsluttendeprosjekt"){
	$vert = "localhost";
	$bruker = "root";
	$passord = "";
	$db = new mysqli($vert, $bruker, $passord, $databasenavn);
	return $db;
}
?>

<?php
function sjekk_autentisert() {
    if ( false == $_SESSION['innlogget']) {
        header("Location: 0_iAvikInnloggingMedDBSjekk");
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
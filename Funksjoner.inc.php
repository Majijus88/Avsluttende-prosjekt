
<?php
function kobleTilDB ($databasenavn="leksjon_databaser"){
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
        header("Location: 0_iAvikInnlogging.php");
        exit();
    }
}
?>

<?php
function bevarInformasjon($valg) {
	foreach($valg as $indeks=>$verdi){
			if( !strstr($indeks, "knapp") ) {
				echo "<input type='hidden' ";
				echo "name='$indeks' value='$verdi' />\n";
			}
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
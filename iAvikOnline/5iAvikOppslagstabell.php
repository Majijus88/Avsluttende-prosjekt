
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>iAvik - Kodeoversikt</title>
	<style>
		/* Tilpasser for eventuell mobilvisning */
		@media only screen and (max-width: 600px) {
			body {
				font-size: 1.2em;
			}
			img {
				max-width: 100%;
				height: auto;
			}
		}
	</style>
</head>


<?php
@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

echo "<h4> Følgende registrerte koder er funnet i databasen </h4>";

// Spørring som henter frem alle koder lagt inn i databasetabellen "koder"
$db = kobleTilDBInfinity();
$sql = "SELECT * FROM koder ";
$resultat = $db->query($sql);

//Lager en tabell som vil presentere inneholdet i databasen på en oversiktig måte 
echo "<table>";
echo "<tr><th style='border: 2px solid black;'> Kode-ID</th><th style='border: 2px solid black;'>Beskrivelse</th></tr>";

//While løkke som henter ut alle funn i databasen og lister opp basert på formatet nedenfor
while ($rad = $resultat->fetch_assoc()) {
    echo "<tr>";
    echo "<td style='border: 1px solid black;'>" . $rad['Kode ID'] . "<br>";
    echo "<td style='border: 1px solid black;'>" . $rad['Beskrivelse'] . "<br>";
    echo "</tr>";
}
// Avslutter tabellen
echo "</table>";

// Lukker forbindelsen til databasen
mysqli_close($db);

// Link tilbake til hovedmenyen
 echo "<p><a href='1iAvikHovedmeny.php'>Gå tilbake til hovedmenyen</a></p>";

?>

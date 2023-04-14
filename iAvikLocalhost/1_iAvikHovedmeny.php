
<?php
@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

// Oppretter to variabler som lagrer dagens dato, samt brukernavnet tilhørende personen som er innlogget
$dagensDato = date("d.m.y");
$innlogget_bruker = $_SESSION['bruker'];

//Gir bruker mulighet til å legge inn en ny hendelse for dagen
echo "<h4>Registrer ny hendelse:</h4>";
echo "<form action='3_iAvikRegistrerNyHendelse.php' method='post'>";
echo "<input type='submit' name='knapp' value='Registrer hendelse'/>";
echo "</form>";

//Gir bruker mulighet til å få en oversikt over hva de forskjellige kodene betyr
echo "<h4> Få oversikt over forskjellige avikskoder:</h4>";
echo "<form action='5_iAvikOppslagstabell.php' method='post'>";
echo "<input type='submit' name='knapp' value='Vis kodetabell'/>";
echo "</form>";

//Viser brukers siste loggede hendelser ved å hente ut data fra avik-tabellen som er lagt inn av innlogget bruker
echo "<p> Hei <b> $innlogget_bruker! </b>Du har følgende registrerte hendelser i databasen den<b> $dagensDato</b> </p>";
$db = kobleTilDB();
$sql = "SELECT * FROM avik WHERE brukernavn = '$innlogget_bruker' ";
$resultat = $db->query($sql);

//Henter ut alle funn i databasen og liser opp basert på formatet nedenfor
while ($rad = $resultat->fetch_assoc()) {
    echo "<hr>";
    echo "<strong> Hendelses-ID: </strong> " . $rad['id'] . "<br>";
    echo "<strong> Pasient:  </strong>" . $rad['initialer'] . "<br>";
    echo "<strong> Hendelse:  </strong>" . $rad['kode'] . "<br>";
    echo "<strong> Tidspunkt: </strong> " . $rad['tidspunkt'] . "<br> ";
    }

//Lukker forbindelsen til databasen
mysqli_close($db);

//Gir bruker mulighet til å logge ut, som sender bruker tilbake til forsiden og innloggingsmenyen
if ( isset($_SESSION['innlogget']) ) {
    echo "<form action='5_iAvikUtlogging.php' method='post'>";
    echo "<p>Om du er ferdig kan du logge ut nedenfor</p>";
	echo "<input type='submit' name='knapp' value='Logg ut' />";
    }

?>


<?php
include "Funksjoner.inc.php";
sjekk_autentisert();

// Oppretter to variabler som lagrer dagens dato, samt brukernavnet tilhørende personen som er innlogget
$dagensDato = date("d.m.y");
$innlogget_bruker = $_POST['bruker'];

echo " <h1> Velkommen til hovedmenyen </h1> ";
echo " <p>Du har følgende valg:</p> ";

//Gir innlogget bruker mulighet til å se på alle hendelser som er logget for dagen sålangt
echo "<h4> Se alt som ligger i databasen </h4>";
echo "<form action='3_iAvikFraDB' method='post'>";
echo "<input type='submit' name='knapp' value='Vis alle registrerte hendelser'/>";
echo "</form>";

//Gir bruker mulighet til å søke etter spesifikke koder eller initialer i databasen
echo "<h4>Søk etter konkret hendelse i databasen:</h4>";
echo "<form action='4_iAvikSøkInput.php' method='post'>";
echo "<input type='submit' name='knapp' value='Søk i databasen'/>";
echo "</form>";

<<<<<<< HEAD
//Gir bruker mulighet til å legge inn en ny hendelse for dagen
=======
//Gir bruker mulighet til å logge en ny hendelse i databasen
>>>>>>> c1e60bf05cb8df882cfe3913fdcb9e92327e4199
echo "<h4>Registrer ny hendelse:</h4>";
echo "<form action='5_iAvikRegistrerNyHendelse.php' method='post'>";
echo "<input type='submit' name='knapp' value='Registrer'/>";
echo "</form>";

<<<<<<< HEAD
//Gir bruker mulighet til å få en oversikt over hva de forskjellige kodene betyr
=======

//Gir bruker mulighet til å lese opp hva slags hendelser de ulike kodene tilsvarer
>>>>>>> c1e60bf05cb8df882cfe3913fdcb9e92327e4199
echo "<h4> Vis kodetabell:</h4>";
echo "<form action='6_iAvikOppslagstabell.php' method='post'>";
echo "<input type='submit' name='knapp' value='Informasjon'/>";
echo "</form>";

// Viser brukers siste loggede hendelser ved å hente ut data fra avik-tabellen.  lagt inn av bruker
echo "<p> Hei <b> $innlogget_bruker </b>Du har følgende registrerte hendelser " . $dagensDato . "</p>";

$db = kobleTilDB();
$sql = "SELECT * FROM avik WHERE brukernavn = '$innlogget_bruker' ";
$resultat = $db->query($sql);

// Henter ut alle funn i databasen og liser opp basert på formatet nedenfor
while ($rad = $resultat->fetch_assoc()) {
    echo "<strong> Hendelses-ID: </strong> " . $rad['id'] . "<br>";
    echo "<strong> Pasient:  </strong>" . $rad['initialer'] . "<br>";
    echo "<strong> Hendelse:  </strong>" . $rad['kode'] . "<br>";
    echo "<strong> Tidspunkt: </strong> " . $rad['tidspunkt'] . "<br> ";
    echo "<hr>";
}

// Lukker forbindelsen til databasen
mysqli_close($db);

if ( isset($_SESSION['innlogget']) ) {
    echo "<br>";
    echo "<form action='10_iAvikUtlogging.php' method='post'>";
    echo "<p>Om du er ferdig kan du logge ut nedenfor</p>";
	echo "<input type='submit' name='knapp' value='Logg ut' />";
    }
<<<<<<< HEAD

   // var_dump($_POST);
?>
=======
?>
>>>>>>> c1e60bf05cb8df882cfe3913fdcb9e92327e4199

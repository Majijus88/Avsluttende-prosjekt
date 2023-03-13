
<?php

@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

echo " <h1> Hovedmeny </h1> ";
echo " <p>Velg blant følgende:</p> ";

//Gir bruker mulighet til å se på alt som har blitt lagret i databasen sålangt
echo "<h4> Se alt som ligger i databasen </h4>";
echo "<form action='3_iAvikFraDB' method='post'>";
echo "<input type='submit' name='knapp' value='Vis alle registrerte hendelser'/>";
echo "</form>";

//Gir bruker mulighet til å søke etter spesifikke ord i databasen
echo "<h4>Søk etter konkret hendelse i databasen:</h4>";
echo "<form action='4_iAvikSøkInput.php' method='post'>";
echo "<input type='submit' name='knapp' value='Søk i databasen'/>";
echo "</form>";

//Gir bruker mulighet til å legge inn sine egne ord i databasen
echo "<h4>Registrer ny hendelse:</h4>";
echo "<form action='5_iAvikRegistrerNyHendelse.php' method='post'>";
echo "<input type='submit' name='knapp' value='Registrer'/>";
echo "</form>";


//Gir bruker mulighet til å opprette en ny ordsky i fremtiden
echo "<h4> Vis kodetabell:</h4>";
echo "<form action='6_iAvikOppslagstabell.php' method='post'>";
echo "<input type='submit' name='knapp' value='Informasjon'/>";
echo "</form>";

$dagensDato = date("d.m.y");

echo "<h3> Dine registrerte hendelser - " . $dagensDato . "</h3>";

$db = kobleTilDB();
$sql = "SELECT * FROM avik";
$resultat = $db->query($sql);

echo "<p>$db->error</p>";

while ($rad = $resultat->fetch_assoc()) {
    echo "<strong> Hendelses-ID: </strong> " . $rad['id'] . "<br>";
    echo "<strong> Pasient:  </strong>" . $rad['initialer'] . "<br>";
    echo "<strong> Hendelse:  </strong>" . $rad['kode'] . "<br>";
    echo "<strong> Tidspunkt: </strong> " . $rad['tidspunkt'] . "<br> ";
    echo "<hr>";
}


if ( isset($_SESSION['innlogget']) ) {
    echo "<br>";
    echo "<form action='10_iAvikUtlogging.php' method='post'>";
    echo "<p>Om du er ferdig kan du logge ut nedenfor</p>";
	echo "<input type='submit' name='knapp' value='Logg ut' />";
    }
?>
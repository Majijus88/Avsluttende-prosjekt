
<?php
include "Funksjoner.inc.php";

if(isset($_POST['knapp']) ){
    $brukernavn = $_POST['brukernavn'];
    $passord = $_POST['passord'];

    $db = kobleTilDB();

    // Kjører en spørring som ser om kombinasjonen av brukernavn og passord allerede finnes i databasen
    $sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord ='$passord' ";
    $resultat = mysqli_query($db, $sql);

    // Dersom det returneres noe, betyr det at kombinasjonen allerede finnes i databasen
    if (mysqli_num_rows($resultat) > 0) {
        echo "<h1>Brukernavnet er allerede tatt!! </h1>";
    } else {
    // Kombinasjonen ble ikke funnet i databasen, og ny bruker legges derfor til i databasen 
        $sql = "INSERT INTO brukere (brukernavn, passord) VALUES ('$brukernavn', '$passord')";
        if (mysqli_query($db, $sql)) {
            echo "<h1>Brukeren er opprettet :) </h1>";
        } else {
            echo "Noe gikk galt: " . mysqli_error($db);
        }
    }
    mysqli_close($db);
}

echo "<h3>Skriv inn ditt ønskede brukernavn og passord nedenfor</h3>";
echo "<form action=' ' method ='post'>";

// Tekstboks for å skrive inn ønsket brukernavn
echo "<p><label for ='bruker'>Brukernavn<br>";
echo "<input type='text' name='brukernavn' size = '15'> <br></p>";

// Tekstboks for å skrive inn ønsket passord
echo "<p><label for ='passord'> Passord  <br> ";
echo "<input type='text' name='passord' size = '15'> <br></p>";

// Knapp for å sende inn det som ble skrevet i tekstboksene ovenfor
echo "<input type= 'submit' name = 'knapp' value='Registrer meg!' >";
echo "<br>";
echo "<a href='0_iAvikinnloggingMedDBSjekk'>Gå tilbake til forsiden</a>";

var_dump($_POST);

?>

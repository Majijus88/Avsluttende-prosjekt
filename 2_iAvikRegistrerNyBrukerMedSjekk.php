
<?php
@session_start();
include "Funksjoner.inc.php";

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

//Sjekker om det finnes en skjema-variabel av typen $_POST som heter 'knapp'.
if(isset($_POST['knapp']) ){

    //Oppretter to variabler for å lagre innholdet av brukernavn og passord fra $_POST skjemaet for senere bruk
    $brukernavn = $_POST['brukernavn'];
    $passord = $_POST['passord'];

    //Kobler til databasen ved hjelp av funksjonen kobleTilDB()
    $db = kobleTilDB();

    //Kjører en spørring som ser om kombinasjonen av brukernavn og passord allerede finnes i databasen. Bruker variabelene definert ovenfor
    $sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord ='$passord' ";
    $resultat = mysqli_query($db, $sql);

    //Dersom det returneres noe, betyr det at kombinasjonen av brukernavn og passord allerede finnes i databasen. Bruker får tilbakemelding på dette
    if (mysqli_num_rows($resultat) > 0) {
        echo "<h1> Brukernavnet er allerede tatt!! </h1>";

    //Kombinasjonen ble ikke funnet i databasen, og ny bruker legges derfor til i databasen ved hjelp av prepared statements. Bruker får tilbakemelding
    } else {
        $sql = "INSERT INTO brukere (brukernavn, passord) VALUES (?, ?)";
        $statement = $db->prepare($sql);
        $statement->bind_param("ss", $brukernavn, $passord);
        if($statement->execute()) {
            echo "<h1>Suksess! Ny bruker er lagt inn i databasen :)</h1>";
        }else{
            echo "Noe gikk galt!";
            echo "<p>$db->error;</p>";
        }
    }
}

//Prompt for å be bruker om å skrive inn sitt ønskede brukernavn og passord
echo "<h4>Skriv inn ditt ønskede brukernavn og passord nedenfor</h4>";
echo "<form action=' ' method ='post'>";

//Tekstboks for å skrive inn ønsket brukernavn
echo "<p><label for ='bruker'>Brukernavn<br>";
echo "<input type='text' name='brukernavn' size = '15'> <br></p>";

//Tekstboks for å skrive inn ønsket passord
echo "<p><label for ='passord'> Passord  <br> ";
echo "<input type='password' name='passord' size = '15'> <br></p>";

//Knapp for å sende inn det som ble skrevet i tekstboksene ovenfor
echo "<input type= 'submit' name = 'knapp' value='Registrer meg!' >";
echo "</form>";

//Knapp som tar bruker tilbake til forsiden
echo "<p><form action='0_iAvikInnloggingMedDBSjekk' method='post'>";
echo "<input type='submit' name='tilbake' value='Tilbake til forsiden'/>";
echo "</form>";

?>




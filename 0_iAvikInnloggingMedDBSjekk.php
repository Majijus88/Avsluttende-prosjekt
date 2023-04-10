
<?php
// Starter session
@session_start();
// Sjekker om det finnes en skjema-variabel av typen $_POST som heter 'knapp'.
if(isset($_POST['knapp'])){
    // Konfigurerer databaseforbindelsen
    $servernavn = "localhost";
    $brukernavn = "root";
    $passord = "";
    $dbnavn = "avsluttendeprosjekt";
    // Oppretter forbindelse til databasen
    $tilkobling = mysqli_connect($servernavn, $brukernavn, $passord, $dbnavn);
    // Sjekker om forbindelsen er vellykket
    if (!$tilkobling) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Hent brukernavnet og passordet fra skjemaet
    $username = $_POST["bruker"];
    $passord = $_POST["passord"];
    // Sjekk om kombinasjon av brukernavn og passord finnes i databasen
    $sql = "SELECT * FROM brukere WHERE brukernavn='$username' AND passord ='$passord'";
    $resultat = mysqli_query($tilkobling, $sql);
    // Kombinasjon av brukernavn og passord finnes i databasen. Brukeren blir innlogget og hovedmenyen inkluderes på samme side
    if (mysqli_num_rows($resultat) == 1) {
        $_SESSION['navn'] = ucfirst($_POST['bruker']);
        $_SESSION['innlogget'] = true;
         include "1_iAvikHovedmeny.php";
    // Kombinasjon av brukernavn og passord finnes IKKE i databsen. Brukeren får ikke tilgang til hovedmenyen og må forsøke å logge inn på nytt
    } else {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
    // Lukker forbindelsen til databasen
    mysqli_close($tilkobling);
    }
else {
// Prompt til å legge inn brukernavn og passord for å logge inn og få tilgang til hovedmenyen
echo " <h3>Logg inn nedenfor</h3> ";
echo " <form action=' ' method='post'> ";
echo " <table> ";
//  Tekstbokst for inntasting av brukernavn
echo " <tr><td> Brukernavn: </td> ";
echo " <td><input type='text' name='bruker' /></td></tr> ";
// Tekstboks for inntasting av passord
echo " <tr><td>Passord:</td><td> ";
echo " <input type='password' name='passord' size='5' /></td></tr> ";
// Knapp for innsending av skjemadata til samme side
echo " <tr><td colspan='2'><input type='submit' name='knapp' value='Logg inn' /></td> ";
echo " </tr></table></form> ";
// Opsjon for å opprette en ny brukerprofil til systemet
echo " <h5> For å opprette en ny bruker, trykk på knappen nedenfor </h5> ";
echo " <form action = '2_iAvikRegistrerNyBrukerMedSjekk.php' method='post'> ";
// Knapp som gir mulighet for opprettelse av ny bruker
echo " <input type = 'submit' name = 'RegKnapp' value = 'Registrer ny bruker'/> ";
echo " </form> ";
}
?>


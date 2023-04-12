
<?php
//Starter session
@session_start();

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

//Sjekker om det finnes en skjema-variabel av typen $_POST som heter 'knapp'. Om dette er tilfelle vil databasen kontaktes for sjekk av brukernavn og passord
if(isset($_POST['knapp'])){

    //Konfigurerer først verdier for å kontakte den spesifkkke databasen "avsluttendeprosjekt"
    $servernavn = "localhost";
    $brukernavn = "root";
    $passord = "";
    $dbnavn = "avsluttendeprosjekt";

    //Oppretter selve forbindelsen til databasen og legger det i en variabelen "$tilkobling" som blir lettere å håndtere
    $tilkobling = mysqli_connect($servernavn, $brukernavn, $passord, $dbnavn);

    //Kontrollerer om forbindelsen til databasen ble velykket. Om ikke vises en beskrivelse av feilen som oppstod.
    if (!$tilkobling) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //Henter skjemaverdiene som ble innsendt fra samme side ved å benytte $_POST. Legger deretter brukernavn og passord i variablene "$username" og "$passord"
    $brukernavn = $_POST["bruker"];
    $passord = $_POST["passord"];

    //Lagrer en session-variabel for brukernavnet slik at jeg kan benytte dette på andre undersider av hovedmenyen
    $_SESSION['bruker'] = $_POST['bruker']; 

    //Kjører en spørring for å se om kombinasjon av brukernavn og passord finnes i tabellen "brukere"
    $sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord ='$passord'";
    $resultat = mysqli_query($tilkobling, $sql);

    //Kombinasjon av brukernavn og passord finnes i databasen. Brukeren blir innlogget og hovedmenyen inkluderes på samme side
    if (mysqli_num_rows($resultat) == 1) {
        $_SESSION['navn'] = ucfirst($_POST['bruker']);
        $_SESSION['innlogget'] = true;
        header('Location: 1_iAvikHovedmeny.php');
        exit;

    //Kombinasjon av brukernavn og passord finnes IKKE i databasen. Brukeren får ikke tilgang til hovedmenyen og må forsøke å logge inn på nytt
    } else {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
    //Lukker forbindelsen til databasen
    mysqli_close($tilkobling);

} else {
    //Prompt til å legge inn brukernavn og passord for å logge inn og få tilgang til hovedmenyen
    echo " <h3>Logg inn nedenfor</h3> ";
    echo " <form action=' ' method='post'> ";
    echo " <table> ";

    //Tekstbokst for inntasting av brukernavn
    echo " <tr><td> Brukernavn: </td> ";
    echo " <td><input type='text' name='bruker' /></td></tr> ";

    //Tekstboks for inntasting av passord
    echo " <tr><td>Passord:</td><td> ";
    echo " <input type='password' name='passord' size='5' /></td></tr> ";

    //Knapp for innsending av skjemadata til samme side
    echo " <tr><td colspan='2'><input type='submit' name='knapp' value='Logg inn' /></td> ";
    echo " </tr></table></form> ";

    //Opsjon for å opprette en ny brukerprofil til systemet
    echo " <h4> For å opprette en ny bruker, trykk på knappen nedenfor </h4> ";
    echo " <form action = '2_iAvikRegistrerNyBrukerMedSjekk' method='post'> ";
    echo " <input type = 'submit' name = 'RegKnapp' value = 'Registrer ny bruker'/> ";
    echo " </form> ";
}

?>


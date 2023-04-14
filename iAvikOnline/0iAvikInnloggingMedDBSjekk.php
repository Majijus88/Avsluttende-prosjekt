
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Velkommen til iAvik!</title>
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
//Starter session
@session_start();
include "Funksjoner.inc.php";

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

//Sjekker om det finnes en skjema-variabel av typen $_POST som heter 'knapp'. Om dette er tilfelle vil databasen kontaktes for sjekk av brukernavn og passord
if(isset($_POST['knapp'])){

    //Forsøker å koble til databasen ved hjelp av funksjonen kobleTilDBInfinity
     $db = kobleTilDBInfinity();
     if (!$db) {
         die("Connection failed: " . mysqli_connect_error());
    }

    //Henter skjemaverdiene som ble innsendt fra samme side ved å benytte $_POST. Legger deretter brukernavn og passord i variablene "$username" og "$passord"
    $brukernavn = $_POST["bruker"];
    $passord = $_POST["passord"];

    //Lagrer en session-variabel for brukernavnet slik at jeg kan benytte dette på andre undersider av hovedmenyen
    $_SESSION['bruker'] = $_POST['bruker']; 

    //Kjører en spørring for å se om kombinasjon av brukernavn og passord finnes i tabellen "brukere"
    $sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord ='$passord'";
    $resultat = mysqli_query($db, $sql);

    //Kombinasjon av brukernavn og passord finnes i databasen. Brukeren blir innlogget og hovedmenyen inkluderes på samme side
    if (mysqli_num_rows($resultat) == 1) {
        $_SESSION['navn'] = ucfirst($_POST['bruker']);
        $_SESSION['innlogget'] = true;
        header('Location: 1iAvikHovedmeny.php');
        exit;

    //Kombinasjon av brukernavn og passord finnes IKKE i databasen. Brukeren får ikke tilgang til hovedmenyen og må forsøke å logge inn på nytt
    } else {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
    //Lukker forbindelsen til databasen
    mysqli_close($db);

} else {
    //Prompt til å legge inn brukernavn og passord for å logge inn og få tilgang til hovedmenyen
    echo " <h3>Logg inn nedenfor</h3> ";
    echo " <form action=' ' method='post'> ";
    echo " <table> ";

    //Tekstbokst for inntasting av brukernavn
    echo " <tr><td> Brukernavn: </td> ";
    echo " <td><input type='text' name='bruker'size='8' /></td></tr> ";

    //Tekstboks for inntasting av passord
    echo " <tr><td>Passord:</td><td> ";
    echo " <input type='password' name='passord' size='8' /></td></tr> ";

    //Knapp for innsending av skjemadata til samme side
    echo " <tr><td colspan='2'><input type='submit' name='knapp' value='Logg inn' /></td> ";
    echo " </tr></table></form> ";

    //Opsjon for å opprette en ny brukerprofil til systemet
    echo " <h4> For å opprette en ny bruker, trykk på knappen nedenfor </h4> ";
    echo " <form action = '2iAvikRegistrerNyBrukerMedSjekk.php' method='post'> ";
    echo " <input type = 'submit' name = 'RegKnapp' value = 'Registrer ny bruker'/> ";
    echo " </form> ";
}

?>

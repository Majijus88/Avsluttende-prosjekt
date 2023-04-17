
<?php
@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

//Dersom bruker er logget inn, blir bruker sendt tilbake til forsiden/innloggingskjermen ved hjelp av header-funksjonen
if(isset($_SESSION['innlogget'])) {
    $_SESSION['innlogget'] = false;
    header("Location: 0iAvikInnloggingMedDBSjekk.php");
    exit();
}
else echo "Ikke innlogget, så du kan ikke logges ut";

?>
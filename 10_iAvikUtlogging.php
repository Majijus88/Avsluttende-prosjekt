
<?php
include "Funksjoner.inc.php";
sjekk_autentisert();
if(isset($_SESSION['innlogget'])) {
    $_SESSION['innlogget'] = false;
    header("Location: 0_iAvikInnloggingMedDBSjekk.php");
    exit();
}
else echo "Ikke innlogget, så du kan ikke logges ut";

?>
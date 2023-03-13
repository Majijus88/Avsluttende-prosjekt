
<?php

@session_start();
if(isset($_SESSION['innlogget'])) {
    $_SESSION['innlogget'] = false;
    header("Location: 0_iAvikInnlogging.php");
        exit();
}
else echo "Ikke innlogget, så du kan ikke logges ut";

?>
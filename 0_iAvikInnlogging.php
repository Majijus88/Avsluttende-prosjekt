<?php
@session_start();
if(isset($_POST['knapp']) ){
    if ( $_POST['bruker'] == "admin" && $_POST['passord'] == "1234") {
        $_SESSION['navn'] = ucfirst($_POST['bruker']);
        $_SESSION['innlogget'] = true;
         include "1_iAvikHovedmeny.php";
    }
    else {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}
else {

echo " <h3>Logg inn nedenfor</h3> ";
echo " <form action=' ' method='post'> ";
echo " <table> ";
echo " <tr><td> Brukernavn: </td> ";
echo " <td><input type='text' name='bruker' /></td></tr> ";
echo " <tr><td>Passord:</td><td> ";
echo " <input type='password' name='passord' size='5' /></td></tr> ";
echo " <tr><td colspan='2'><input type='submit' name='knapp' value='Logg inn' /></td> ";
echo " </tr></table></form> ";

echo " <h5> For å opprette en ny bruker, trykk på knappen nedenfor </h5> ";
echo " <form action = '2_iAvikRegistrerNyBruker.php' method='post'> ";
echo " <input type = 'submit' name = 'RegKnapp' value = 'Registrer ny bruker'/> ";
echo " </form> ";
}

?>
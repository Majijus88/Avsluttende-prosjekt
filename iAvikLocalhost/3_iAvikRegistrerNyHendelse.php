
<?php
@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

//Prompt for å be bruker om å skrive inn verdier for en nyoppstått hendelse som skal legges inn i databasen
echo "<h3>Registrering av ny hendelse</h3>";
echo "<form action='4_iAvikRegistrerNyHendelseSjekk' method ='post'>";

//Tekstboks for å skrive inn pasientens initialer
echo "<p><label for ='pasientinitialer'> Pasientens initialer <br> ";
echo "<input type='text' name='pasientinitialer' size = '5'> <br></p>";

//Tekstboks for å skrive inn koden på hendelsen
echo "<p><label for ='kode'> Kode på hendelse <br>";
echo "<input type='text' name='kode' size = '15'> <br></p>";

//Knapp for å sende inn det som ble skrevet i tekstboksene ovenfor
echo "<input type= 'submit' name = 'knapp' value='Registrer din hendelse' >";

//Link tilbake til hovedmenyen
 echo "<p><a href='1_iAvikHovedmeny'>Gå tilbake til hovedmenyen</a></p>";

?>

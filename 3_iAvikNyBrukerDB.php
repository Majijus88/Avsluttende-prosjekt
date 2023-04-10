
<?php
include "Funksjoner.inc.php";
echo " <h3> Kvittering for vedlagt beskrivelse </h3> ";

$db = kobleTilDB();

$brukernavn = ucfirst($_POST['brukernavn']);
$passord = ucfirst($_POST['passord']);

$sql = "INSERT INTO brukere (brukernavn, passord) VALUES (?, ?)";

$statement = $db->prepare($sql);
$statement->bind_param("ss", $brukernavn, $passord);

 if($statement->execute()) {
    echo "Suksess! Ny brukerkonto er opprettet :)";
        }else {
            echo "Noe gikk galt!";
            echo "<p>$db->error;</p>";
        }


echo "<br>";
echo "<br>";

echo "<a href='0_iAvikinnlogging_med_db'>Gå tilbake til forsiden</a>";

?>



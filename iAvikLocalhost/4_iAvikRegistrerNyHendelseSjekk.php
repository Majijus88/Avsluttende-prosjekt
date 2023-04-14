
<?php
@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

// Klargjør for spørring
$db = kobleTilDB();
$ansatt = $_SESSION['bruker'];
$pasient = $_POST['pasientinitialer'];
$kode = $_POST['kode'];

// Lager en spørring basert på data i innsendt skjema som skal legges inn i tabellen "avvik". Benytter prepared statements. Bruker får tilbakemelding
        $sql = "INSERT INTO avik (initialer, kode, brukernavn) VALUES (?, ?, ?)";
        $statement = $db->prepare($sql);
        $statement->bind_param("sis", $pasient, $kode, $ansatt);
        if($statement->execute()) {
            echo "<h1>Suksess! Ny hendelse er registrert i databasen :)</h1>";
        }else{
            echo "Noe gikk galt!";
            echo "<p>$db->error;</p>";
        }

// Link tilbake til hovedmenyen
 echo "<p><a href='1_iAvikHovedmeny'>Gå tilbake til hovedmenyen</a></p>";

 ?>
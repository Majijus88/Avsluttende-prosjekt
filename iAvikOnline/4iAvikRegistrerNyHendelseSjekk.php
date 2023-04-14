
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>iAvik - Database-kontroll</title>
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
@session_start();
include "Funksjoner.inc.php";
sjekk_autentisert();

//Logo på topp av siden
echo "<img src='Logo.jpg' alt='Fiktiv logo'>";

// Klargjør for spørring
$db = kobleTilDBInfinity();
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
 echo "<p><a href='http://iavik.infinityfreeapp.com/1iAvikHovedmeny.php'>Gå tilbake til hovedmenyen</a></p>";

 ?>
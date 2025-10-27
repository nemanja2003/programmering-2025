<?php
include("key.php");

try {

    $brukernavn = $_POST["data1"];
    $fornavn = $_POST["data2"];
    $etternavn = $_POST["data3"];
    $klassekode = $_POST["data4"];



    $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("err");
    $antallRader=mysqli_num_rows($sqlResultat);
    if ($antallRader != 0){print ("Brukeren er registrert fra før");}
    else {
    $sqlSetning="INSERT INTO student (brukernavn,fornavn,etternavn,klassekode)
    VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
    mysqli_query($db,$sqlSetning) or die ("err");
    }

} catch (Exception $e) {
    echo '<h2>Den oppgitte informasjonen passet ikke med kriteriene:</h2>';
    echo '<b>Dette er hva gikk galt: </b><i>' . $e->getMessage() . '</i>';
    echo '<br><br><a href="https://dokploy.usn.no/app/265635-programmering-2025"><button>Tilbake</button></a>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nyBruker.php</title>
</head>
<body>
    <script>
        window.location.replace("index.php");
    </script>
</body>
</html>

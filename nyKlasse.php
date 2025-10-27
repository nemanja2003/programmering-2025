<?php
include("key.php");

try {

    $klassekode = $_POST["data1"];
    $studiumkode = $_POST["data2"];
    $klassenavn = $_POST["data3"];
    $data4 = $_POST["data4"];



    $sqlSetning="SELECT * FROM klasse WHERE studiumkode='$klassekode';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("err");
    $antallRader=mysqli_num_rows($sqlResultat);
    if ($antallRader != 0){print ("Studie er registrert fra før");}
    else {
    $sqlSetning="INSERT INTO klasse (klassekode,studiumkode,klassenavn)
    VALUES('$klassekode','$studiumkode','$klassenavn');";
    mysqli_query($db,$sqlSetning) or die ("err");
    }

} catch (Exception $e) {
    echo '<h2>Den oppgitte informasjonen passet ikke med kriteriene:</h2>';
    echo '<b>Dette er hva gikk galt: </b><i>' . $e->getMessage() . '</i>';
    echo '<br><br><a href="https://web01.usn.no/~265635/prg120v/prg120v/levere%20inn%20ting"><button>Tilbake</button></a>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nyKlasse.php</title>
</head>
<body>
    <script>
        window.location.replace("index.php");
    </script>
</body>
</html>

<?php
include("key.php");

try {

    $brukernavn = $_POST["data1"];
    $data2 = $_POST["data2"];
    $data3 = $_POST["data3"];
    $data4 = $_POST["data4"];



    $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
    mysqli_query($db,$sqlSetning) or die ("err");
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
    <title>slettBruker.php</title>
</head>
<body>
    <script>
        window.location.replace("index.php");
    </script>
</body>
</html>

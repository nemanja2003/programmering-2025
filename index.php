<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innlevering 2</title>

    <style>
        body {
            text-align:center;
            margin:auto;
        }
        .settings {

            margin-left: auto;
            margin-right: auto;
            border-style: solid;
            border-width: 5px 5px 5px 5px;
        }
        .settings2 {
            margin-left: auto;
            margin-right: auto;
            border-style: solid;
            border-width: 2px 2px 2px 2px;
        }
        .align {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <h1>Innlvevering 2 - Nemanja Djuricic</h1>
    <form id="form" method="post" action="">
    <a style="font-size:25px;">Innstillinger</a>
    <table class="settings">
        <tr>
            <th>Tabel</th>
            <th>Handling</th>
            <th>Utfør handling</th>
        </tr>
        <tr>
            <td> 
            <label for="tabel"></label>
            <select id="tabel" name="tabel" onclick="">
                <option value="velg">Velg</option>
                <option value="student">Student</option>
                <option value="klasse">Klasse</option>
            </select>
            </td>

            <td>
            <form>
            <select id="handling" name="handling" oninput="" onclick="">
                <option value="velg">Velg</option>
                <option value="ny">Ny</option>
                <option value="rediger">Rediger</option>
                <option value="slett">Slett</option>
            </select>
            </form>
        </td>
        <th><input type="submit" value="Submit" id="nullstill" name="nullstill"></th>
        </tr>
    </table>

    <br>
    <table class="settings2">
        <tr>
            <th id="tittel1">Velkommen!</th>
            <th id="tittel2"></th>
            <th id="tittel3"></th>
            <th id="tittel4"></th>
        </tr>
        <tr>
            <td id="felt1"></td>
            <td id="felt2"></td>
            <td id="felt3"></td>
            <td id="felt4"></td>
        </tr>
    </table>

    </form>
    <script>
        function redirect(fil) {document.getElementById("form").action = fil}
        function write(id, text) {document.getElementById(id).innerHTML = text}
        function reset() {
            write('tittel1','Velkommen!')
            write("tittel2", "") 
            write("tittel3", "") 
            write("tittel4", "")
            write('felt1', "Hei!<br>Boksen du ser over deg, Innstillinger, er kontrollpanelet ditt.<br>Her kan du bruke Tabel for å velge hvilken tabell du ønsker å redigere.<br>Du kan også bruke Handling for å velge hvordan du vil redigere tabellen.<br><br>Når du har fylt ut alle nødvendige felter, trykk på Submit for å utføre endringene.<br>Hvis handlingen du prøver å utføre ikke er tillatt, vil den bli ignorert eller gi en feilmelding.<br><br>Lykke til med redigeringen!" )
            write("felt3", "") 
            write("felt4", "")
        }
        reset()
        function autoFill(index) {//Funksjon for å automatisk fylle inn informasjonen til brukeren du vil redigere
            console.log(index)
            var antallStudenter = document.getElementById("antallStudenter").innerHTML
            var brukernavn = [];
            var fornavn = [];
            var etternavn = [];
            var klassekode = [];
            for(i=1;i<=antallStudenter;i++) {
                var bruekrInfo = document.getElementById("S"+i).children
                brukernavn.push(bruekrInfo[0].innerHTML)
                fornavn.push(bruekrInfo[1].innerHTML)
                etternavn.push(bruekrInfo[2].innerHTML)
                klassekode.push(bruekrInfo[3].innerHTML)
            }

            var str ='<select id="data1" name="data1" oninput="autoFill(this.selectedIndex)">'
            for(i=0;i<brukernavn.length;i++) {
                if(brukernavn[i]===brukernavn[index]) {var selected = "selected"} else {var selected = ""}
                str += "<option value="+brukernavn[i]+" "+selected+">"+brukernavn[i]+"</option>"
            }
            str += "</select>"
            var primaryKeys = (document.getElementById("keys").innerHTML).split(",")
            var str2 ='<select id="data4" name="data4">'
            for(i=0;i<primaryKeys.length;i++) {
                console.log("key:"+primaryKeys[i])
                console.log("kode:"+klassekode[index])
                if(primaryKeys[i]===klassekode[index]) {var selected = "selected"} else {var selected = ""}
                str2 += "<option value="+primaryKeys[i]+" "+selected+">"+primaryKeys[i]+"</option>"
            }
            str2 += "</select>"
            write("felt1", str)
            write("felt2", "<input name='data2' value="+fornavn[index]+" required>") 
            write("felt3", "<input name='data3' value="+etternavn[index]+" required>") 
            write("felt4", str2)
        }

        function autoFillKlasse(index) {//Funksjon for å automatisk fylle inn informasjonen til klassenb du vil redigere
            console.log(index)
            var antallKlasser = document.getElementById("antallKlasser").innerHTML
            var klassekode = [];
            var studiumkode = [];
            var klassenavn = [];

            for(i=1;i<=antallKlasser;i++) {
                var bruekrInfo = document.getElementById("K"+i).children
                klassekode.push(bruekrInfo[0].innerHTML)
                studiumkode.push(bruekrInfo[1].innerHTML)
                klassenavn.push(bruekrInfo[2].innerHTML)
            }
            console.log(klassenavn[index])

            var str ='<select id="data1" name="data1" oninput="autoFillKlasse(this.selectedIndex)">'
            for(i=0;i<klassekode.length;i++) {
                if(klassekode[i]===klassekode[index]) {var selected = "selected"} else {var selected = ""}
                str += "<option value="+klassekode[i]+" "+selected+">"+klassekode[i]+"</option>"
            }
            str += "</select>"
            write("felt1", str)
            write("felt2", "<input name='data2' value="+studiumkode[index]+" required>") 
            write("felt3", "<input name='data3' value=\""+klassenavn[index]+"\" required>") 
            write("felt4", "")
        }

        var selectedTable = null
        var selectedAction = null
        function updateValues() {
            selectedTable = document.getElementById("tabel").value
            selectedAction = document.getElementById("handling").value
            updateMainAction()
        }

        //Event Listeners
        document.getElementById("tabel").onchange = function() {updateValues()};
        document.getElementById("handling").onchange = function() {updateValues()};

        function checkboxBruker() {if (document.getElementById('check').checked) redirect("slettBruker.php")}
        function checkboxKlasse() {if (document.getElementById('checkK').checked) redirect("slettStudie.php")}
        function updateMainAction() {
            if(selectedTable === "klasse") {//KLASSE TABEL

                if(selectedAction == "velg") {
                    reset()
                }
                else if(selectedAction == "ny") {
                    redirect("nyKlasse.php")
                    
                    write("tittel1", "Klassekode ")
                    write("tittel2", "Studiumkode") 
                    write("tittel3", "Klassenavn") 
                    write("tittel4", "")

                    write("felt1", "<input name='data1' required>")
                    write("felt2", "<input name='data2' required>") 
                    write("felt3", "<input name='data3' required>") 
                    write("felt4", "")
                }
                else if(selectedAction == "rediger") {
                    redirect("redigerKlasse.php")

                    write("tittel1", "Klassekode")
                    write("tittel2", "Studiumkode") 
                    write("tittel3", "Klassenavn") 
                    write("tittel4", "")
                    autoFillKlasse(0)
                }
                else if(selectedAction == "slett") {
                    redirect("")
                    //Lag dropdown
                    var primaryKeys = (document.getElementById("keys").innerHTML).split(",")
                    var str ='<select id="data1" name="data1">'
                    for(i=0;i<primaryKeys.length;i++) {
                        str += "<option value="+primaryKeys[i]+">"+primaryKeys[i]+"</option>"
                    }
                    str += "</select>"

                    
                    write("tittel1", "NB!")
                    write("tittel2", "Klassekode") 
                    write("tittel3", "") 
                    write("tittel4", "Sikker?")

                    write("felt1", "Du er i ferd med å slette:")
                    write("felt2", str) 
                    write("felt3", "") 
                    write("felt4", "<input type='checkbox' id='checkK' onclick='checkboxKlasse()'>")
                }


            } else if(selectedTable === "student") {//STUDENT TABEL

                if(selectedAction == "velg") {
                    reset()
                }
                else if(selectedAction === "ny") {
                    //Lag dropdown
                    var primaryKeys = (document.getElementById("keys").innerHTML).split(",")
                    var str ='<select id="data4" name="data4">'
                    for(i=0;i<primaryKeys.length;i++) {
                        str += "<option value="+primaryKeys[i]+">"+primaryKeys[i]+"</option>"
                    }
                    str += "</select>"

                    redirect("nyBruker.php")

                    write("tittel1", "Brukernavn")
                    write("tittel2", "Fornavn") 
                    write("tittel3", "Etternavn") 
                    write("tittel4", "Klassekode")

                    write("felt1", "<input name='data1' required>")
                    write("felt2", "<input name='data2' required>") 
                    write("felt3", "<input name='data3' required>") 
                    write("felt4", str)
                }
                else if(selectedAction === "rediger") {

                    redirect("redigerBruker.php")

                    write("tittel1", "Brukernavn")
                    write("tittel2", "Fornavn") 
                    write("tittel3", "Etternavn") 
                    write("tittel4", "Klassekode")
                    autoFill(0)

                }
                else if(selectedAction === "slett") {
                    redirect("")
                    //Lag dropdown
                    var brukere = (document.getElementById("brukere").innerHTML).split(",")
                    var str ='<select id="data1" name="data1">'
                    for(i=0;i<brukere.length;i++) {
                        str += "<option value="+brukere[i]+">"+brukere[i]+"</option>"
                    }
                    str += "</select>"
                    
                    write("tittel1", "NB!")
                    write("tittel2", "Brukernavn") 
                    write("tittel3", "") 
                    write("tittel4", "Sikker?")

                    write("felt1", "Du er i ferd med å slette:")
                    write("felt2", str) 
                    write("felt3", "") 
                    write("felt4", "<input type='checkbox' id='check' onclick='checkboxBruker()'>")
                }
                } else if (selectedTable == "velg") {
                    reset()
                }
        }
    </script>
</body>
</html>

<?php
include("key.php");

// STUDENT ------------------------------------------------------------------------------------------
$sqlSetning2="SELECT * FROM student ORDER BY klassekode;";
$sqlResultat2=mysqli_query($db,$sqlSetning2) or die ("Could not fetch data...");
$antallRader2=mysqli_num_rows($sqlResultat2);

print ("<h2>_________TABELLER_________</h2>");

print ("<a>Student</a><table class=align border=10>");
print ("<tr> <th align=left>Brukernavn</th> <th align=left>Fornavn</th> <th align=left>Etternavn</th> <th align=left>Klassekode</th> </tr>");

$brukere=[];
for ($r=1;$r<=$antallRader2;$r++) {
$rad=mysqli_fetch_array($sqlResultat2);
$brukernavn=$rad["brukernavn"];
$fornavn=$rad["fornavn"];
$etternavn=$rad["etternavn"];
$klassekode=$rad["klassekode"];
print ("<tr id=S$r> <td>$brukernavn</td> <td>$fornavn</td> <td>$etternavn</td>  <td>$klassekode</td> </tr>");
array_push($brukere, $brukernavn);
}
print(" (<a id=antallStudenter>");print($r-1);print("</a>)");

print ("</table></p>");
// STUDENT ------------------------------------------------------------------------------------------
// KLASSE ------------------------------------------------------------------------------------------
$sqlSetning="SELECT * FROM klasse ORDER BY studiumkode;";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("Could not fetch data...");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<a>Klasse</a><table class=align border=5>");
print ("<tr> <th align=left>Klassekode</th> <th align=left>Studiumkode</th> <th align=left>Klassenavn</th> </tr>");

$klassekoder = [];
for ($r=1;$r<=$antallRader;$r++) {
$rad=mysqli_fetch_array($sqlResultat);
$studiumkode=$rad["studiumkode"];
$klassenavn=$rad["klassenavn"];
$klassekode=$rad["klassekode"];
print ("<tr id=K$r> <td>$klassekode</td> <td>$studiumkode</td> <td>$klassenavn</td> </tr>");
array_push($klassekoder, $klassekode);
}
print(" (<a id=antallKlasser>");print($r-1);print("</a>)");

print ("</table><p>");

print ("<div style='color:white;'><a id='keys'>");
for ($r=0;$r<$antallRader;$r++) {print($klassekoder[$r]); if($r<$antallRader-1){print(",");}else{print("</a><br><a id='brukere'>");};};
for ($r=0;$r<$antallRader2;$r++) {print($brukere[$r]); if($r<$antallRader2-1){print(",");}else{print("</a></div>");};};
// KLASSE ------------------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>Het ultieme airfryer handboek</title>
    <style>
        .em {
            height: 1.5em;
        }
    </style>
</head>

<?php
echo "<table style='border: solid;'>";
echo "<tr><th>gerecht</th><th>instructies</th><th>stand</th><th>probe?</th><th>preset</th><th>vleessoort</th><th>gaarheid</th><th>target temp</th><th>temperatuur</th><th>kooktijd</th><th>opas oordeel</th><th>rons oordeel</th><th>volgende keer</th><th>door</th></tr>";

class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current()
    {
        return "<td style='border: solid;'>" . parent::current() . "</td>";
    }

    function beginChildren()
    {
        echo "<tr>";
    }

    function endChildren()
    {
        echo "</tr>" . "\n";
    }
}

include '.htdb';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT gerecht, instructies, stand, probe, preset, vleessoort, gaarheid, target_temp, temperatuur, kooktijd, cijferopa, cijferron, volgendekeer, door FROM gerechten");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

<body>
    <form action="insert.php" method="post">
        <table>
            <tr>
                <td><label for="gerecht">Gerecht:</label></td>
                <td><input type="text" name="gerecht" id="gerecht" required></td>
            </tr>
            <tr>
                <td><label for="instructies">Instructies:</label></td>
                <td><textarea name="instructies" id="instructies"></textarea></td>
            </tr>
            <tr>
                <td><label for="stand">Stand:</label></td>
                <td>
                    <select name="stand" id="stand" class="validate" required>
                        <option value="" selected>--Maak een keuze--</option>
                        <option value="max_crisp">MAX CRISP</option>
                        <option value="air_fry">AIR FRY</option>
                        <option value="roast">ROAST</option>
                        <option value="bake">BAKE</option>
                        <option value="reheat">REHEAT</option>
                        <option value="dehydrate">DEHYDRATE</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Probe?</td>
                <td>
                    <input type="radio" id="nee" name="probe" value="nee" class="validate" checked required disabled>
                    <label for="nee">nee</label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="radio" id="ja" name="probe" value="ja" class="validate" disabled>
                    <label for="ja">ja</label>
                </td>
            </tr>
            <tr>
                <td><label for="preset">Preset:</label></td>
                <td>
                    <select name="preset" id="preset" class="validate" required disabled>
                        <option value="" selected>--Maak een keuze--</option>
                        <option value="small">SMALL PRESET</option>
                        <option value="large">LARGE PRESET</option>
                        <option value="manual">MANUAL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="vleessoort">Vleessoort:</label></td>
                <td>
                    <select name="vleessoort" id="vleessoort" class="validate" required disabled>
                        <option value="" selected>--Maak een keuze--</option>
                        <option value="beef">BEEF</option>
                        <option value="lamb">LAMB</option>
                        <option value="fish">FISH</option>
                        <option value="pork">PORK</option>
                        <option value="chicken">CHICKEN</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="gaarheid">Gaarheid:</label></td>
                <td>
                    <select name="gaarheid" id="gaarheid" class="validate" required disabled>
                        <option value="" selected>--Maak een keuze--</option>
                        <option value="1" disabled class="beef">1</option>
                        <option value="2-rare" disabled class="beef">2-RARE</option>
                        <option value="3" disabled class="beef lamb">3</option>
                        <option value="4-med_rare" disabled class="beef lamb">4-MED RARE</option>
                        <option value="5-med" disabled class="beef lamb fish">5-MED</option>
                        <option value="6" disabled class="beef lamb fish">6</option>
                        <option value="7-med_well" disabled class="beef lamb fish pork">7-MED WELL</option>
                        <option value="8" disabled class="beef lamb fish pork">8</option>
                        <option value="9-well" disabled class="beef lamb fish pork chicken">9-WELL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="target_temp">TARGET TEMP:</label></td>
                <td><select name="target_temp" id="target_temp" class="validate" required disabled>
                        <option value="" selected>--Maak een keuze--</option>
                        <option value="40">40</option>
                        <option value="45">45</option>
                        <option value="50">50</option>
                        <option value="55">55</option>
                        <option value="60">60</option>
                        <option value="65">65</option>
                        <option value="70">70</option>
                        <option value="75">75</option>
                        <option value="80">80</option>
                        <option value="85">85</option>
                    </select></td>
            </tr>
            <tr>
                <td><label for="temperatuur">Temperatuur:</label></td>
                <td>
                    <input type="number" name="temperatuur" id="temperatuur" step="5" class="validate" disabled
                        required>
                    graden
                </td>
            </tr>
            <tr>
                <td><label for="kooktijd">Kooktijd:</label></td>
                <td>
                    <input type="number" name="kooktijd" id="kooktijd" class="validate" disabled required>
                    minuten
                </td>
            </tr>
            <tr>
                <td><label for="cijferopa">Opa's oordeel:</label></td>
                <td><input type="number" name="cijferopa" id="cijferopa" min="0" max="10" list="oordeel">/10</td>
            </tr>
            <tr>
                <td><label for="cijferron">Ron's oordeel:</label></td>
                <td><input type="number" name="cijferron" id="cijferron" min="0" max="10" list="oordeel">/10</td>
            </tr>
            <tr>
                <td><label for="volgendekeer">Tips voor volgende keer:</label></td>
                <td><textarea name="volgendekeer" id="volgendekeer"></textarea></td>
            </tr>
            <tr>
                <td><label for="door">Ingevuld door:</label></td>
                <td>
                    <select name="door" id="door" required>
                        <option value="" selected>----</option>
                        <option value="opa">Opa</option>
                        <option value="ron">Ron</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit">
    </form>
    <datalist id="oordeel">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </datalist>
    <script src="script.js" defer></script>
    <footer>
        <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/">
            <a property="dct:title" rel="cc:attributionURL" href="https://github.com/CD-R0n/Ninja-Air-Fryer">
                Ninja Air Fryer
            </a>
            by
            <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/CD-R0n">
                Ron Sedee
            </a>
            is licensed under
            <a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1" target="_blank"
                rel="license noopener noreferrer" style="display:inline-block;">
                CC BY-NC 4.0 
                <img class="em" src="/airfryer/images/cc.svg" alt=""><img class="em" src="/airfryer/images/by.svg" alt=""><img class="em" src="/airfryer/images/nc.svg" alt="">
            </a>
        </p>
    </footer>
</body>

</html>
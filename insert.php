<?php
// login informatie
include '.htdb';

// get post records
$gerecht = $_POST['gerecht'];
$instructies = $_POST['instructies'];
$stand = $_POST['stand'];
$probe = $_POST['probe'];
$preset = $_POST['preset'];
$vleessoort = $_POST['vleessoort'];
$gaarheid = $_POST['gaarheid'];
$target_temp = $_POST['target_temp'];
$temperatuur = $_POST['temperatuur'];
$kooktijd = $_POST['kooktijd'];
$cijferopa = $_POST['cijferopa'];
$cijferron = $_POST['cijferron'];
$volgendekeer = $_POST['volgendekeer'];
$door = $_POST['door'];

// in database plaatsen
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO gerechten (gerecht, instructies, stand, probe, preset, vleessoort, gaarheid, target_temp, temperatuur, kooktijd, cijferopa, cijferron, volgendekeer, door)
        VALUES ('$gerecht', '$instructies', '$stand', '$probe', '$preset', '$vleessoort', '$gaarheid', '$target_temp', '$temperatuur', '$kooktijd', '$cijferopa', '$cijferron', '$volgendekeer', '$door')";
    // use exec() because no results are returned
    $conn->exec($sql);
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    $conn = null;
    sleep(7);
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
$conn = null;
echo "<script>window.location.href='index.php';</script>";
exit;

?>
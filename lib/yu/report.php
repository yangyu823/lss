<?php
include('conn.php');

$connect = mysqli_connect($hostname, $uname, $pwd, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

//  Query DB to get team name
$objid = $profile;
$date = date("Ymd");


if ($profile == 1) {
    $sql = "SELECT * FROM lss_employee_profile where releaseDate <" . date("Ymd") . " "; // add date condition
} else {
    $sql = "SELECT * FROM lss_employee_profile where practiceTeam = (select value from lov WHERE splvalue = '" . $objid . "' and type='team') AND releaseDate <" . date("Ymd") . " "; // add date condition
}
$result = $connect->query($sql);

$NAcount = 0;
$Nocount = 0;
$Yescount = 0;

while ($row = $result->fetch_assoc()) {
    if ($row["peelService"] == "NA") {
        $NAcount += 1;
    } elseif ($row["peelService"] == "No") {
        $Nocount += 1;
    } elseif ($row["peelService"] == "Yes") {
        $Yescount += 1;
    }
}

$pie = array(
    array("label" => ["Yes", "No", "NA"]),
    array("value" => [$Yescount, $Nocount, $NAcount]),
);
$dataPoints = array(
    array("label" => "NA", "value" => ($NAcount), "color" => "#4daf4a"),
    array("label" => "No", "value" => ($Nocount), "color" => "#377eb8"),
    array("label" => "Yes", "value" => ($Yescount), "color" => "#ff7f00"),
);
$sum = ($NAcount + $Nocount + $Yescount);
?>

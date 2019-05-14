<?php

date_default_timezone_set("Australia/Melbourne");
//error_reporting(0);

$profile = 6;

//Yu Script for DB connection
// Create connection
$conn = new mysqli("localhost", "root", "root", "rp_db", 8889);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

switch ($profile) {
    case "1":
        $team_name = "L & SS";
        break;
    case "2":
        $team_name = "C&SB";
        break;
    case "3":
        $team_name = "Enterprise";
        break;
    case "4":
        $team_name = "Infra co";
        break;
    case "5":
        $team_name = "ALM";
        break;
    case "6":
        $team_name = "Solutions";
        break;
    case "7":
        $team_name = "Functional Practice";
        break;
    case "8":
        $team_name = "Non Functional";
        break;
    case "9":
        $team_name = "Release Orchestration";
        break;
    case "10":
        $team_name = "OWOW";
        break;
    case "11":
        $team_name = "Emer tech";
        break;
    case "12":
        $team_name = "Bus Ops";
        break;
}
$sql = "SELECT * FROM lss_employee_profile WHERE practiceTeam = '" . $team_name . "'";

//                    $NAcount = "SELECT COUNT(dnumber) FROM lss_employee_profile where peelService = 'NA'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["peelService"] == "NA") {
            $NAcount += 1;
        } elseif ($row["peelService"] == "No") {
            $Nocount += 1;
        } elseif ($row["peelService"] == "Yes") {
            $Yescount += 1;
        }
//                            echo "<br> D.ID: " . $row["dnumber"] .  " -Service " . $row["peelService"];
//                            echo "<br>".$row['COUNT(dnumber)'];
    }
} else {
    echo "No Data for this team";
}

$pie = array(
    array("label" => ["Yes", "No", "NA"]),
    array("value" => [$Yescount, $Nocount, $NAcount]),
);

$dataPoints = array(
    array("label" => "NA", "value" => ($NAcount)),
    array("label" => "No", "value" => ($Nocount)),
    array("label" => "Yes", "value" => ($Yescount)),
);
$sum = ($NAcount + $Nocount + $Yescount);

// Close connection
$conn->close();

?>


<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
    <!--    <script src="http://d3js.org/d3.v5.min.js"></script>-->
    <script type="text/javascript" src="/lss/lib/yu/d3/d3.v4.js"></script>


</head>
</head>
<body>
<!-- Add 2 buttons -->
<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>

<script>

    var data_yu = (<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
    var sum = (<?php echo json_encode($sum, JSON_NUMERIC_CHECK); ?>);
    var color = d3.scaleOrdinal(['#4daf4a', '#377eb8', '#ff7f00', '#984ea3', '#e41a1c']);</script>



</body>
</html>

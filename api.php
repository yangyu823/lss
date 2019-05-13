<?php
$profile = "6";
//Yu Script for DB connection
// Create connection
$conn = new mysqli("localhost", "root", "root", "rp_db", 8889);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

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
$sum = $NAcount + $Nocount + $Yescount;

$dataPoints = array(
    array("label" => "NA", "y" => ($NAcount)),
    array("label" => "No", "y" => ($Nocount)),
    array("label" => "Yes", "y" => ($Yescount)),

);

$pie = array(
    array("Yes", "No", "NA"),
    array($Yescount, $Nocount, $NAcount),
);


//echo json_encode($dataPoints);
echo json_encode($pie[0]);
// Close connection
$conn->close();



<?php
//  Create connection
$conn = new mysqli($yu_hostname, $yu_username, $yu_password, $yu_dbname, $yu_port);

//  Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
//  Query DB to get team name
$objid = $profile + 9;
$team = "SELECT * FROM lov WHERE objid = '" . $objid . "'";
$team_conn = $conn->query($team);
if ($team_conn->num_rows > 0) {
    while ($row = $team_conn->fetch_assoc()) {
        $team_name = $row["value"];
    }
}
//  Query DB to get PeelService Count
$sql = "SELECT * FROM lss_employee_profile WHERE practiceTeam = '" . $team_name . "'";
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
    }
} else {
    echo "No Data for this team";
}
$pie = array(
    array("label" => ["Yes", "No", "NA"]),
    array("value" => [$Yescount, $Nocount, $NAcount]),
);
$dataPeel = array(
    array("label" => "NA", "value" => ($NAcount), "color" => "#4daf4a"),
    array("label" => "No", "value" => ($Nocount), "color" => "#377eb8"),
    array("label" => "Yes", "value" => ($Yescount), "color" => "#ff7f00"),
);
$sum_peel = ($NAcount + $Nocount + $Yescount);

//  Query DB to get Location Count (2019-05-30 new feature)
$location_result = $conn->query($sql);
if ($location_result->num_rows > 0) {
    while ($row = $location_result->fetch_assoc()) {
        if (strcasecmp($row["location"], "sydney") == 0) {
            $ON_shore += 1;
        } elseif (strcasecmp($row["location"], "melbourne") == 0) {
            $ON_shore += 1;
        } else {
            $OFF_shore += 1;
        }
    }
}
$dataLocation = array(
    array("label" => "On", "value" => ($ON_shore), "color" => "#4daf4a"),
    array("label" => "Off", "value" => ($OFF_shore), "color" => "#377eb8"),
);
$sum_location = ($OFF_shore + $ON_shore);

// Close connection
$conn->close();
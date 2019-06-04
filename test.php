<?php
$profile = 1;
$yu_hostname = "127.0.0.1";
$yu_username = "root";
$yu_password = "root";
$yu_dbname = "rp_db";
$yu_port = "8889";
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
echo $team_name;
//  Query DB to get PeelService Count
if ($profile != 1) {
    $sql = "SELECT * FROM lss_employee_profile WHERE practiceTeam = '" . $team_name . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["execution"] == "execution") {
                $Excount += 1;
            } elseif ($row["execution"] == "services" && $row["peelService"] == "No") {
                $Nocount += 1;
            } elseif ($row["execution"] == "services" && $row["peelService"] == "Yes") {
                $Yescount += 1;
            } elseif ($row["execution"] == "services" && $row["peelService"] == "NA") {
                $NAcount += 1;
            }
        }
    } else {
        echo "No Data for this team";
    }
    $pie = array(
        array("label" => ["Yes", "No", "NA", "Execution"]),
        array("value" => [$Yescount, $Nocount, $NAcount, $Excount]),
    );
    $dataPeel = array(
        array("label" => "Execution", "value" => ($Excount), "color" => "#4daf4a"),
        array("label" => "No", "value" => ($Nocount), "color" => "#377eb8"),
        array("label" => "Yes", "value" => ($Yescount), "color" => "#ff7f00"),
        array("label" => "NA", "value" => ($NAcount), "color" => "#ff134c"),
    );
    $sum_peel = ($Excount + $Nocount + $Yescount);
    echo "Profile is 1";


} else {
    $sql = "SELECT practiceTeam,COUNT(IF(execution='execution',1, NULL)) 'Execution',
COUNT(IF(execution='services' AND peelService='Yes',1, NULL)) 'Yes',
COUNT(IF(execution='services' AND peelService='No',1, NULL)) 'No',
COUNT(IF(execution='services' AND peelService='NA',1, NULL)) 'NA' 
FROM lss_employee_profile GROUP BY practiceTeam";
    $result = $conn->query($sql);
    $data_total = array();
    while ($row = $result->fetch_assoc()) {
//        echo $row['Yes'];
        array_push($data_total,$row);
    }
}


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
    array("label" => "OnShore", "value" => ($ON_shore), "color" => "#4daf4a"),
    array("label" => "OffShore", "value" => ($OFF_shore), "color" => "#377eb8"),
);
$sum_location = ($OFF_shore + $ON_shore);

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <script>
        var data = (<?php echo json_encode($data_total, JSON_NUMERIC_CHECK); ?>);
    </script>
</head>
<body>
<script>
    console.log(data[0])
</script>
<h1>This is a Heading</h1>
<p>This is a paragraph.</p>

</body>
</html>



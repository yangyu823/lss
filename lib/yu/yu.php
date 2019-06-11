<?php
//  Create connection
$conn = new mysqli($yu_hostname, $yu_username, $yu_password, $yu_dbname, $yu_port);

//  Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
//  Query DB to get team name
$objid = $profile;
//$team = "SELECT * FROM lov WHERE objid = '" . $objid . "'";
//$team_conn = $conn->query($team);
//if ($team_conn->num_rows > 0) {
//    while ($row = $team_conn->fetch_assoc()) {
//        $team_name = $row["value"];
//    }
//}
//  Query DB to get PeelService Count
if ($profile != 1) {
    $sql = "SELECT * FROM lss_employee_profile where practiceTeam = (select value from lov WHERE splvalue = '" . $objid . "' and type='team') AND releaseDate >" . date("Ymd") . " "; // add date condition
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
} else {
    $sql = "SELECT practiceTeam,COUNT(IF(execution like 'execution',1, NULL)) 'Execution',
COUNT(IF(execution like 'services' AND peelService like 'Yes',1, NULL)) 'Yes',
COUNT(IF(execution like 'services' AND peelService like 'No',1, NULL)) 'No',
COUNT(IF(execution like 'services' AND peelService like 'NA',1, NULL)) 'NA',
COUNT(IF(execution like 'services' OR execution like 'execution',1, NULL)) 'Total' 
FROM lss_employee_profile GROUP BY practiceTeam";
    $data_result = $conn->query($sql);
    $data_total = array();
    $key_peel = ["Execution", "Yes", "No", "NA"];
    while ($row = $data_result->fetch_assoc()) {
        array_push($data_total, $row);
    }
    $sql_loca = "SELECT practiceTeam,COUNT(IF(location like 'Melbourne' OR location like 'Sydney',1, NULL)) 'OnShore',
COUNT(IF(location !='Melbourne' AND location !='Sydney',1, NULL)) 'OffShore',
COUNT(*) 'Total'
FROM lss_employee_profile GROUP BY practiceTeam";
    $key_location = ["OnShore", "OffShore"];
    $data_result2 = $conn->query($sql_loca);
    $data_location = array();
    while ($row = $data_result2->fetch_assoc()) {
        array_push($data_location, $row);
    }

    $location_sql = "SELECT * FROM lss_employee_profile";
    //  Query DB to get Location Count (2019-05-30 new feature)
    $location_result = $conn->query($location_sql);
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
    $result = $conn->query($location_sql);
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
}

$dataPeel = array(
    array("label" => "Execution", "value" => ($Excount), "color" => "#4daf4a"),
    array("label" => "No", "value" => ($Nocount), "color" => "#377eb8"),
    array("label" => "Yes", "value" => ($Yescount), "color" => "#ff7f00"),
    array("label" => "NA", "value" => ($NAcount), "color" => "#ff134c"),
);

$sum_peel = ($Excount + $Nocount + $Yescount + $NAcount);


// Close connection
$conn->close();
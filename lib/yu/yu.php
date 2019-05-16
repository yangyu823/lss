<?php

date_default_timezone_set("Australia/Melbourne");
//error_reporting(0);

$profile = 1;


if ($profile == 1) {
    $team_color = "linear-gradient(50deg, #008fb3, rgba(101, 47, 142, 0.88))"; #Capability //need to change for L&SS
} else if ($profile == 2 or $profile == 3 or $profile == 4 or $profile == 5) {
    $team_color = "linear-gradient(50deg, #008fb3, rgba(101, 47, 142, 0.88))"; #Capability
} else if ($profile == 6) {
    $team_color = "linear-gradient(90deg,#009792 0%,#23B8D6 35%,#C6D86b 70%)"; #solutions
} else if ($profile == 7 or $profile == 8 or $profile == 9) {
    $team_color = "linear-gradient(50deg, #ff8533 , #cc0066)"; #Functional
} else if ($profile == 10) {
    $team_color = "linear-gradient(50deg, #ff66ff , #660066)"; #NWoW
} else if ($profile == 11) {
    $team_color = "linear-gradient(50deg, #ff6600  ,#00ffbf)"; #Emerg tech
} else {
    $team_color = "linear-gradient(50deg, #3366ff ,#00ffbf)"; #Bus Ops
}

$connect = mysqli_connect($hostname, $uname, $pwd, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}


//Yu Script for DB connection
// Create connection
$conn = new mysqli("localhost", "root", "root", "rp_db", 8889);

// Check connection
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
$dataPoints = array(
    array("label" => "NA", "value" => ($NAcount), "color" => "#4daf4a"),
    array("label" => "No", "value" => ($Nocount), "color" => "#377eb8"),
    array("label" => "Yes", "value" => ($Yescount), "color" => "#ff7f00"),
);
$sum = ($NAcount + $Nocount + $Yescount);

echo "<br><br><br><br><br><br>";
echo $team_name;

// Close connection
$conn->close();

?>


<html>
<head></head>
<body>

<div id="pie_Chart"></div>

<script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
<script src="d3pie.min.js"></script>
<script>
    var data_yu = (<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);

    function pie() {
        var pie = new d3pie("pie_Chart", {
            "header": {
                "title": {
                    "text": "PeelService Report",
                    "fontSize": 22,
                    "font": "verdana",
                    "color": "teal"
                },
                "subtitle": {
                    "text": "PeelService",
                    "color": "#ffffff",
                    "fontSize": 22,
                    "font": "verdana"
                },
                "titleSubtitlePadding": 12
            },

            "size": {
                "canvasHeight": 600,
                "canvasWidth": 700,
                "pieInnerRadius": "50%",
                "pieOuterRadius": "100%"
            },
            "data": {
                "content": data_yu
            },
            "labels": {
                "outer": {
                    "pieDistance": 32
                },
                "inner": {
                    "format": "value"
                },
                "mainLabel": {
                    "font": "verdana",
                    "fontSize": 14
                },
                "percentage": {
                    "color": "#e1e1e1",
                    "font": "verdana",
                    "decimalPlaces": 0
                },
                "value": {
                    "color": "#e1e1e1",
                    "font": "verdana",
                    "fontSize": 20
                },
                "lines": {
                    "enabled": true,
                    "color": "#cccccc"
                },
                "truncation": {
                    "enabled": true
                }
            },
            "tooltips": {
                "enabled": true,
                "type": "placeholder",
                "string": "{label}: {value}",
                "styles": {
                    "fadeInSpeed": 300,
                    "borderRadius": 3,
                    "fontSize": 20
                }
            },
            "effects": {
                "pullOutSegmentOnClick": {
                    "effect": "linear",
                    "speed": 400,
                    "size": 20
                }
            }
        })
    };

    pie()

</script>

</body>
</html>

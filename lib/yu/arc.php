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
    array("label" => "NA", "value" => ($NAcount)),
    array("label" => "No", "value" => ($Nocount)),
    array("label" => "Yes", "value" => ($Yescount)),
);
$sum = ($NAcount + $Nocount + $Yescount);

echo "<br><br><br><br><br><br>";
echo $team_name;

// Close connection
$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .arc text {
            font: 10px sans-serif;
            text-anchor: middle;
        }

        .arc path {
            stroke: #fff;
        }

        .title {
            fill: teal;
            font-weight: bold;
        }
    </style>
    <script src="https://d3js.org/d3.v4.min.js"></script>
</head>
<body>
<svg width="500" height="400"></svg>
<script>

    var data_yu = (<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
    var sum = (<?php echo json_encode($sum, JSON_NUMERIC_CHECK); ?>);

    var svg = d3.select("svg"),
        width = svg.attr("width"),
        height = svg.attr("height"),
        radius = Math.min(width, height) / 2;

    var g = svg.append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    var color = d3.scaleOrdinal(['#4daf4a','#377eb8','#ff7f00','#984ea3','#e41a1c']);

    var pie = d3.pie().value(function(d) {
        return d.value;
    });

    var path = d3.arc()
        .outerRadius(radius - 10)
        .innerRadius(50);

    var label = d3.arc()
        .outerRadius(radius)
        .innerRadius(radius - 80);


        var arc = g.selectAll(".arc")
            .data(pie(data_yu))
            .enter().append("g")
            .attr("class", "arc");

        arc.append("path")
            .attr("d", path)
            .attr("fill", function(d) { return color(d.data.label); })

        console.log(arc)

        arc.append("text")
            .attr("transform", function(d) {
                return "translate(" + label.centroid(d) + ")";
            })
            .text(function(d) { return d.data.label; });

    svg.append("g")
        .attr("transform", "translate(" + (width / 2 - 120) + "," + 20 + ")")
        .append("text")
        .text("Browser use statistics - Jan 2017")
        .attr("class", "title")




</script>
</body>
</html>






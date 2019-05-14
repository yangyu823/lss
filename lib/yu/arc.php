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
    array("label" => "NA", "y" => ($NAcount)),
    array("label" => "No", "y" => ($Nocount)),
    array("label" => "Yes", "y" => ($Yescount)),
);

// Close connection
$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
    <style>
        .arc text {
            font: 15px sans-serif;
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
    <script src="http://d3js.org/d3.v5.min.js"></script>
</head>
<script src="yu.js"></script>
<link href="yu.css" rel="stylesheet">
</head>
<body>
<svg width="500" height="400"></svg>
<script>
    var data = (<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>)
    var pie = d3.pie()
    console.log(pie(data))


    var svg = d3.select("svg"),
        width = svg.attr("width"),
        height = svg.attr("height"),
        radius = Math.min(width, height) / 2;

    var g = svg.append("g")
        .attr("transform", "translate(" + (width / 2 + 100) + "," + (height / 2 + 100) + ")");

    var color = d3.scaleOrdinal(['#4daf4a', '#377eb8', '#ff7f00', '#984ea3', '#e41a1c']);

    var pie = d3.pie().value(function (d) {
        return d.y;
    });

    var path = d3.arc()
        .outerRadius(radius - 10)
        .innerRadius(100);

    var label = d3.arc()
        .outerRadius(radius)
        .innerRadius(radius - 150);

    var arc = g.selectAll(".arc")
        .data(pie(data))
        .enter().append("g")
        .attr("class", "arc");

    arc.append("path")
        .attr("d", path)
        .attr("fill", function (d) {
            return color(d.data.label);
        });


    arc.append("text")
        .attr("transform", function (d) {
            return "translate(" + label.centroid(d) + ")";
        })
        .text(function (d) {
            return d.data.label + "(" + d.data.y + ")";
        });


    svg.append("g")
        .attr("transform", "translate(" + (width / 2 + 30) + "," + 40 + ")")
        .append("text")
        .text("PeelService Report")
        .attr("class", "title")

    //legend
    var legend = svg.selectAll('.legend')
        .data(color.domain())
        .enter()                                                
        .append('g')
        .attr('class', 'legend')                                
        .attr('transform', function(d, i) {
            var heightz = 22;
            var offset =  heightz * color.domain().length / 2;
            var horz = -2 * 18;
            var vert = i * heightz - offset;
            return 'translate(' + (horz+370) + ',' + (vert+300) + ')';
        })

    legend.append('rect')
        .attr('width', 20)
        .attr('height', 20)
        .style('fill', color)
        .style('stroke', color);

    legend.append('text')
        .attr('x', 25)
        .attr('y', 15)
        .text(function(d) { return d; });



</script>
</body>
</html>

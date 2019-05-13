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
    array("Yes", "No", "NA"),
    array($Yescount, $Nocount, $NAcount),
);

// Close connection
$conn->close();


?>


<!DOCTYPE html>
<meta charset="utf-8">
<body>
<button class="randomize">randomize</button>
<div class="container">
    <div class="row">
        <pie/>
    </div>
</div>
<button class="randomize">randomize</button>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="yu.js"></script>
<link href="yu.css" rel="stylesheet">
<script>

    var width = 960,
        height = 450,
        radius = Math.min(width, height) / 2;

    var svg = d3.select("pie")
        .append("svg")
        .append("g");

    svg.append("g")
        .attr("transform", "translate(" + (width / 2 - 600) + "," + -200 + ")")
        .append("text")
        .text("Browser use statistics - Jan 2017")
        .attr("class", "title");

    svg.append("g")
        .attr("class", "slices");

    svg.append("g")
        .attr("class", "labels");

    svg.append("g")
        .attr("class", "counts");

    svg.append("g")
        .attr("class", "lines");


    var pie = d3.layout.pie()
        .sort(null)
        .value(function (d) {
            return d.value;
        });

    var arc = d3.svg.arc()
        .outerRadius(radius * 0.8)
        .innerRadius(radius * 0.4);

    var outerArc = d3.svg.arc()
        .innerRadius(radius * 0.9)
        .outerRadius(radius * 0.9);

    var index = d3.svg.arc()
        .innerRadius(radius * 0.8)
        .outerRadius(radius * 0.8);

    svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    var key = function (d) {
        return d.data.label;
    };

    var color = d3.scale.category10()
        .domain(<?php echo json_encode($pie[0], JSON_NUMERIC_CHECK); ?>)
    var num = (<?php echo json_encode($pie, JSON_NUMERIC_CHECK); ?>);

    function changeData() {
        // var labels = color.domain();
        var labels = color.domain();

        return color.domain().map(function (label) {
            var i = 0;
            return {label: label, value: num[1][i]}
            i += 1;
        });
    }


    // Later for data change

    /*    function changeData (){
            var labels = color.domain();
            return labels.map(function(label){
                return { label: label, value: Math.random() }
            });
        }*/


    change(changeData());

    d3.select(".randomize")
        .on("click", function () {
            change(changeData());
        });


    function change(data) {

        /* ------- PIE SLICES -------*/
        var slice = svg.select(".slices").selectAll("path.slice")
            .data(pie(data), key);

        slice.enter()
            .insert("path")
            .style("fill", function (d) {
                return color(d.data.label);
            })
            .attr("class", "slice");

        slice
            .transition().duration(1000)
            .attrTween("d", function (d) {
                this._current = this._current || d;
                var interpolate = d3.interpolate(this._current, d);
                this._current = interpolate(0);
                return function (t) {
                    return arc(interpolate(t));
                };
            })

        slice.exit()
            .remove();

        /* ------- TEXT LABELS -------*/

        var text = svg.select(".labels").selectAll("text")
            .data(pie(data), key);

        text.enter()
            .append("text")
            .attr("dy", ".35em")
            .text(function (d) {
                return d.data.label;
            });

        // var arcs = g.selectAll(".arc")
        //     .data(pie(num[1]))
        //     .enter().append("g")
        //     .attr("class", "arc");
        // arcs.append("text")
        //     .attr("d", arc)
        //     .attr("fill", "e41a1c" });

        function midAngle(d) {
            return d.startAngle + (d.endAngle - d.startAngle) / 2;
        }

        text.transition().duration(1000)
            .attrTween("transform", function (d) {
                this._current = this._current || d;
                var interpolate = d3.interpolate(this._current, d);
                this._current = interpolate(0);
                return function (t) {
                    var d2 = interpolate(t);
                    var pos = outerArc.centroid(d2);
                    pos[0] = radius * (midAngle(d2) < Math.PI ? 1 : -1);
                    return "translate(" + pos + ")";
                };
            })
            .styleTween("text-anchor", function (d) {
                this._current = this._current || d;
                var interpolate = d3.interpolate(this._current, d);
                this._current = interpolate(0);
                return function (t) {
                    var d2 = interpolate(t);
                    return midAngle(d2) < Math.PI ? "start" : "end";
                };
            });

        text.exit()
            .remove();

        /* ------- SLICE TO TEXT POLYLINES -------*/

        var polyline = svg.select(".lines").selectAll("polyline")
            .data(pie(data), key);

        polyline.enter()
            .append("polyline");

        polyline.transition().duration(1000)
            .attrTween("points", function (d) {
                this._current = this._current || d;
                var interpolate = d3.interpolate(this._current, d);
                this._current = interpolate(0);
                return function (t) {
                    var d2 = interpolate(t);
                    var pos = outerArc.centroid(d2);
                    pos[0] = radius * 0.95 * (midAngle(d2) < Math.PI ? 1 : -1);
                    return [arc.centroid(d2), outerArc.centroid(d2), pos];
                };
            });

        polyline.exit()
            .remove();
    };

</script>
</body>

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
$objid = $profile;
//  Query DB to get PeelService Count
if ($profile != 1) {
    $sql = "SELECT * FROM lss_employee_profile where practiceTeam = (select value from lov WHERE splvalue = '" . $objid . "' and type='team') AND releaseDate >" . date("Ymd") . " "; // add date condition
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["execution"] == "No") {
                $Excount += 1;
            } elseif ($row["execution"] == "Yes" && $row["peelService"] == "No") {
                $Nocount += 1;
            } elseif ($row["execution"] == "Yes" && $row["peelService"] == "Yes") {
                $Yescount += 1;
            } elseif ($row["execution"] == "Yes" && $row["peelService"] == "NA") {
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
    $sql = "SELECT practiceTeam,COUNT(IF(execution like 'No',1, NULL)) 'Execution',
COUNT(IF(execution like 'Yes' AND peelService like 'Yes',1, NULL)) 'Yes',
COUNT(IF(execution like 'Yes' AND peelService like 'No',1, NULL)) 'No',
COUNT(IF(execution like 'Yes' AND peelService like 'NA',1, NULL)) 'NA',
COUNT(IF(execution like 'Yes' OR execution like 'No',1, NULL)) 'Total' 
FROM lss_employee_profile  WHERE releaseDate >" . date("Ymd") . " GROUP BY practiceTeam";
    $data_result = $conn->query($sql);
    $data_total = array();
    $key_peel = ["Execution", "Yes", "No", "NA"];
    while ($row = $data_result->fetch_assoc()) {
        array_push($data_total, $row);
    }
    $sql_loca = "SELECT practiceTeam,COUNT(IF(location like 'Melbourne' OR location like 'Sydney',1, NULL)) 'OnShore',
COUNT(IF(location !='Melbourne' AND location !='Sydney',1, NULL)) 'OffShore',
COUNT(*) 'Total'
FROM lss_employee_profile WHERE releaseDate >" . date("Ymd") . " GROUP BY practiceTeam";
    $key_location = ["OnShore", "OffShore"];
    $data_result2 = $conn->query($sql_loca);
    $data_location = array();
    while ($row = $data_result2->fetch_assoc()) {
        array_push($data_location, $row);
    }

    $location_sql = "SELECT * FROM lss_employee_profile WHERE releaseDate >" . date("Ymd") . " ";
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
            if ($row["execution"] == "No") {
                $Excount += 1;
            } elseif ($row["execution"] == "Yes" && $row["peelService"] == "No") {
                $Nocount += 1;
            } elseif ($row["execution"] == "Yes" && $row["peelService"] == "Yes") {
                $Yescount += 1;
            } elseif ($row["execution"] == "Yes" && $row["peelService"] == "NA") {
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
?>
<!DOCTYPE html>
<style>
    body {
        font-family: 'Open Sans', sans-serif;
    }

    #main {
        width: 960px;
    }

</style>
<div id="main">
    <div class="col-8" id="bar_chart" style="display: block">
        <svg width="960" height="500"></svg>
    </div>

</div>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>
    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 30, bottom: 60, left: 40};
    height = (parseInt(d3.select("tr").style('height')) * 8 / 15) - 2 * margin.bottom
    if ((parseInt(d3.select("tr").style('width'))) * 4 / 5 <= 1140) {
        width = ((parseInt(d3.select("tr").style('width')) * 4 / 5) - margin.left - margin.right)
    } else {
        width = 1140 - margin.left - margin.right
    }


    var temp = d3.select("#bar_chart")
        .append("svg")
        .attr("width", width)
        .attr("height", height + margin.top + margin.bottom)
        .attr("id", "svg_bar")

    width = width * 0.9;
    var svg = d3.select("svg"),
        margin = {top: 20, right: 20, bottom: 30, left: 40},
        g = svg.append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    // set x scale
    var x = d3.scaleBand()
        .rangeRound([0, width])
        .paddingInner(0.05)
        .align(0.1);

    // set y scale
    var y = d3.scaleLinear()
        .rangeRound([height, 0]);

    // set the colors
    var z = d3.scaleOrdinal()
        .range(['#4daf4a', '#ff7f00', '#377eb8', '#ff134c', '#e7ba52', '#f781bf']);

    // # sorting
    data_lss.sort(function (a, b) {
        return b.Total - a.Total;
    });
    x.domain(data_lss.map(function (d) {
        return d.practiceTeam;
    }));
    y.domain([0, d3.max(data_lss, function (d) {
        return (d.Total) * 1.01;
    })]).nice();
    z.domain(keys);

    g.append("g")
        .selectAll("g")
        .data(d3.stack().keys(keys)(data_lss))
        .enter().append("g")
        .attr("fill", function (d) {
            return z(d.key);
        })
        .selectAll("rect")
        .data(function (d) {
            return d;
        })
        .enter().append("rect")
        .attr("x", function (d) {
            return x(d.data.practiceTeam) + x.bandwidth() * 0.25;
        })
        .attr("y", function (d) {
            // console.log(d[1])
            return y(d[0]);
        })
        .attr("height", function (d) {
            return 0;
            // console.log(d[0]-d[1])
            // return y(d[0]) - y(d[1])
        })
        .attr("width", x.bandwidth() * 0.5)
        .on("mouseover", function () {
            tooltip.style("display", null);
        })
        .on("mouseout", function () {
            tooltip.style("display", "none");
        })
        .on("mousemove", function (d) {
            var xPosition = d3.mouse(this)[0];
            var yPosition = d3.mouse(this)[1] - 10;
            tooltip.attr("transform", "translate(" + xPosition + "," + yPosition + ")")
                .style("opacity", 1)
                .style("display", "inline-block");
            tooltip.select("text").text(d[1] - d[0]);
        });
    {
        svg.selectAll("rect")
            .transition()
            .duration(500)
            .attr("y", function (d) {
                return y(d[1]);
            })
            .attr("height", function (d) {
                return y(d[0]) - y(d[1])
            })
            .delay(function (d, i) {
                return (i * 35)
            });
    }

    g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0," + height + ")")
        .attr("id", "anchor")
        .call(d3.axisBottom(x))
        .selectAll(".tick text")
        .call(wrap, x.bandwidth());

    g.append("g")
        .attr("class", "axis")
        .call(d3.axisLeft(y).ticks(null, "s"))
        .style("font-size", "15px")
        .append("text")
        .attr("x", 2)
        .attr("y", y(y.ticks().pop()) + 0.5)
        .attr("dy", "0.32em")
        .attr("fill", "#000")
        .attr("font-weight", "bold")
        .attr("text-anchor", "start");

    var legend = g.append("g")
        .attr("font-family", "sans-serif")
        .attr("font-size", 10)
        .attr("text-anchor", "end")
        .selectAll("g")
        .data(z.domain())
        .enter().append("g")
        .attr("transform", function (d, i) {
            return "translate(0," + i * 20 + ")";
        });

    legend.append("rect")
        .attr("x", width - 19)
        .attr("width", 19)
        .attr("height", 19)
        .attr("fill", z);

    legend.append("text")
        .attr("x", width - 24)
        .attr("y", 9.5)
        .attr("dy", "0.32em")
        .text(function (d) {
            return d;
        });

    // Prep the tooltip bits, initial display is hidden
    var tooltip = svg.append("g")
        .attr("class", "tooltip")
        .attr("id", "tooltip")
        .style("display", "none");

    tooltip.append("rect")
        .attr("width", 60)
        .attr("height", 30)
        .attr("fill", "#feffdb")
        .style("opacity", 0.8);

    tooltip.append("text")
        .attr("x", 30)
        .attr("dy", "1.2em")
        .style("text-anchor", "middle")
        .attr("font-size", "16px")
        .attr("font-weight", "bold");

    function wrap(text, width) {
        text.each(function () {
            var text = d3.select(this),
                words = text.text().split(/\s+/).reverse(),
                word,
                line = [],
                lineNumber = 0,
                lineHeight = 1.1, // ems
                y = text.attr("y"),
                dy = parseFloat(text.attr("dy")),
                tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em")
            while (word = words.pop()) {
                line.push(word)
                tspan.text(line.join(" "))
                if (tspan.node().getComputedTextLength() > width) {
                    line.pop()
                    tspan.text(line.join(" "))
                    line = [word]
                    tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", `${++lineNumber * lineHeight + dy}em`).text(word)
                }
            }
        })
    }

    // Data Reformat
    var n = 1;
    var titles = d3.keys(data_lss[0])
    var new_data = []
    while (n < titles.length) {
        var m = 0;
        var element = {};
        while (m < data_lss.length) {
            if (m === 0) {
                element.Team = titles[n]
            }
            element[data_lss[m][titles[0]]] = data_lss[m][titles[n]]
            m++
        }
        new_data.push(element)
        n++
    }

    width = width + 95
    // ### table
    var table = d3.select('#bar_chart')
        .append('table')
        .attr("width", width - 40)
        .attr("id", "stats_tb");
    var titles = d3.keys(new_data[0])

    // ##########Header########
    var headers = table.append('thead').append('tr')
        .selectAll('th')
        .data(titles).enter()
        .append('th')
        .text(function (d) {
            return d;
        });


    var rows = table.append('tbody').selectAll('tr')
        .data(new_data).enter()
        .append('tr');
    rows.selectAll('td')
        .data(function (d) {
            return titles.map(function (k) {
                return {'value': d[k], 'name': k};
            });
        }).enter()
        .append('td')
        .style("text-align", "center")
        .attr('data-th', function (d) {
            return d.name;
        })
        .text(function (d) {
            return d.value;
        });


</script>



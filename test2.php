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
    $sql = "SELECT practiceTeam,COUNT(IF(execution like 'execution',1, NULL)) 'Execution',
COUNT(IF(execution='services' AND peelService like 'Yes',1, NULL)) 'Yes',
COUNT(IF(execution='services' AND peelService like 'No',1, NULL)) 'No',
COUNT(IF(execution='services' AND peelService like 'NA',1, NULL)) 'NA',
COUNT(IF(execution='services' OR execution='execution',1, NULL)) 'total' 
FROM lss_employee_profile GROUP BY practiceTeam";
    $result = $conn->query($sql);
    $data_total = array();
    $key = ["Execution", "Yes", "No", "NA"];
    while ($row = $result->fetch_assoc()) {
//        echo $row['Yes'];
        array_push($data_total, $row);
    }
}


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
    <br>
    <div class="new_table" id="new_id">
        <a>hello world</a>
    </div>

</div>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>
    var data_total = (<?php echo json_encode($data_total, JSON_NUMERIC_CHECK); ?>);
    var key_total = (<?php echo json_encode($key, JSON_NUMERIC_CHECK); ?>);

    // create the svg
    var svg = d3.select("svg"),
        // .append("svg"),
        margin = {top: 20, right: 20, bottom: 30, left: 40},
        width = +svg.attr("width") - margin.left - margin.right,
        height = +svg.attr("height") - margin.top - margin.bottom,
        g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

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
        .range(['#4daf4a', '#377eb8', '#ff7f00', '#ff134c']);

    // #Self

    var keys = key_total;
    // data_total.sort(function (a, b) {
    //     return b.total - a.total;
    // });
    x.domain(data_total.map(function (d) {
        return d.practiceTeam;
    }));
    y.domain([0, d3.max(data_total, function (d) {
        // console.log(d.total)
        return (d.total) * 1.01;
    })]).nice();
    z.domain(keys);

    g.append("g")
        .selectAll("g")
        .data(d3.stack().keys(keys)(data_total))
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
            // return y(d[1]);
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
            // console.log(d);
            var xPosition = d3.mouse(this)[0] - 5;
            var yPosition = d3.mouse(this)[1] - 5;
            tooltip.attr("transform", "translate(" + xPosition + "," + yPosition + ")");
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
        .call(d3.axisBottom(x))
        .selectAll("text")
        .call(wrap, x.bandwidth())


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
        .style("display", "none");

    tooltip.append("rect")
        .attr("width", 60)
        .attr("height", 20)
        .attr("fill", "white")
        .style("opacity", 0.5);

    tooltip.append("text")
        .attr("x", 30)
        .attr("dy", "1.2em")
        .style("text-anchor", "middle")
        .attr("font-size", "12px")
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
    d3.csv("test2.csv", function(error, data) {
        if (error) throw error;
        // var sortAscending = true;
        var table = d3.select('#new_id').append('table');
        var titles = d3.keys(data[0]);
        console.log(data[0])

        var headers = table.append('thead').append('tr')
            .selectAll('th')
            .data(titles).enter()
            .append('th')
            .text(function (d) {
                return d;
            })
            .on('click', function (d) {
                headers.attr('class', 'header');

                if (sortAscending) {
                    rows.sort(function(a, b) { return b[d] < a[d]; });
                    sortAscending = false;
                    this.className = 'aes';
                } else {
                    rows.sort(function(a, b) { return b[d] > a[d]; });
                    sortAscending = true;
                    this.className = 'des';
                }

            });

        var rows = table.append('tbody').selectAll('tr')
            .data(data).enter()
            .append('tr');
        rows.selectAll('td')
            .data(function (d) {
                return titles.map(function (k) {
                    return { 'value': d[k], 'name': k};
                });
            }).enter()
            .append('td')
            .attr('data-th', function (d) {
                return d.name;
            })
            .text(function (d) {
                return d.value;
            });
    });
</script>



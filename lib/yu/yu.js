//  Pie Chart - Yu
function pie() {
    var init = (parseInt(d3.select("#pie_chart").style('width')));
    console.log(init)

    var pie = new d3pie("pie_chart", {
        "size": {
            "canvasHeight": init * 0.6,
            "canvasWidth": init * 0.6,
            "pieInnerRadius": "50%",
            "pieOuterRadius": "80%"
        },
        "data": {
            "content": data_yu,
        },
        "labels": {
            "outer": {
                "pieDistance": 32,
            },
            "inner": {
                "format": "value"
            },
            "mainLabel": {
                "font": "verdana",
                "fontSize": 14,
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
                "size": 10
            }
        }
    })
}

//  Bar Chart - Yu
function bar() {
    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 30, bottom: 90, left: 40},
        width = (parseInt(d3.select("#bar_chart").style('width')) * 0.8) - margin.left - margin.right,
        height = (parseInt(d3.select("#bar_chart").style('width')) * .64) - margin.top - margin.bottom;

    // ----------------
    // Create a tooltip
    // ----------------
    var tooltip = d3.select("body")
        .append("g")
        .style("opacity", 0)
        .attr("class", "tooltip")
        .attr("id", "tooltip");
    // append the svg object to the body of the page

    var svg = d3.select("#bar_chart")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .attr("id", "svg_bar")
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + (margin.top * 6) + ")")
    ;
    // X axis
    var x = d3.scaleBand()
        .range([0, width])
        .domain(data_yu.map(function (d) {
            return d.label;
        }))
        .padding(0.2);
    svg.append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x))
        .selectAll("text")
        .attr("transform", "translate(8,0)")
        .style("text-anchor", "end")
        .style("font-size", "15px");


    // Add Y axis
    var y = d3.scaleLinear()
        .domain([0, sum])
        .range([height, 0]);
    svg.append("g")
        .call(d3.axisLeft(y));

    // Bars
    svg.selectAll("bar")
        .data(data_yu)
        .enter()

        .append("rect")
        .attr("x", function (d) {
            return x(d.label);
        })
        .attr("width", x.bandwidth())
        .style("fill", function (d) {
            return color(d.label);
        })
        // no bar at the beginning thus:
        .attr("height", function (d) {
            return height - y(0);
        }) // always equal to 0
        .attr("y", function (d) {
            return y(0);
        })
        .on("mousemove", function (d) {
            // var abs_x = d3.event.pageX - document.getElementById("svg_bar").getBoundingClientRect().x;
            var abs_x = d3.event.pageX;
            var abs_y = d3.event.pageY - 80;
            tooltip
                .style("left", abs_x + "px")
                .style("top", abs_y + "px")
                .style("display", "inline-block")
                .style("opacity", 1)
                .html(d.value);
        })
        .on("mouseout", function (d) {
            tooltip.style("display", "none");
        });

    // Animation
    {
        svg.selectAll("rect")
            .transition()
            .duration(800)
            .attr("y", function (d) {
                return y(d.value);
            })
            .attr("height", function (d) {
                return height - y(d.value);
            })
            .delay(function (d, i) {
                return (i * 100)
            });
    }
    //  Title for Bar Chart (Redundant)
    // svg.append("g")
    //     .attr("transform", "translate(" + (width / 3 - 37) + "," + (-40) + ")")
    //     .append("text")
    //     .text("PeelService Report")
    //     .attr("id", "chart_title")

}

//Switch Button Function - Yu
{
    function SwapChart() {
        var d1 = document.getElementById("pie_chart");
        var d2 = document.getElementById("bar_chart");
        if (d2.style.display === "none") {
            d1.style.display = "none";
            d2.style.display = "block";
        } else {
            d1.style.display = "block";
            d2.style.display = "none";
        }
    }

    function bar_chart() {
        d3.select("svg").remove();
        var d1 = document.getElementById("pie_chart");
        var d2 = document.getElementById("bar_chart");
        if (d2.style.display === "none") {
            d1.style.display = "none";
            d2.style.display = "block";
        }
        bar()
    }

    function pie_chart() {
        d3.select("svg").remove();
        var d1 = document.getElementById("pie_chart");
        var d2 = document.getElementById("bar_chart");
        if (d1.style.display === "none") {
            d1.style.display = "block";
            d2.style.display = "none";
        }
        pie()
    }
}
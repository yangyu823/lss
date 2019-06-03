//  Pie Chart - Yu
function pie() {
    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 30, bottom: 90, left: 40},
        width = (parseInt(d3.select("tr").style('width')) * 32 / 75) - margin.left - margin.right,
        height = (parseInt(d3.select("tr").style('width')) * 128 / 375) - margin.top - margin.bottom;
    var init = (parseInt(d3.select("#pie_chart").style('width')));
    var color = d3.scaleOrdinal(['#4daf4a', '#377eb8', '#ff7f00']);
    var pie = new d3pie("pie_chart", {
        "size": {
            "canvasHeight": init * 0.64,
            "canvasWidth": init * 0.8,
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
                "font-weight": "bold",
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
            "string": "{label}: {percentage}%",
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
    });
    var svg = d3.select("#pie_chart")
    var x = d3.scaleBand()
        .range([0, width])
        .domain(data_yu.map(function (d) {
            return d.label;
        }))
        .padding(0.2);

    svg.selectAll("bar")
        .data(data_yu)
        .enter()
        .append("rect")
        .attr("x", function (d) {
            return x(d.label);
        })
        .attr("width", x.bandwidth())
        .style("fill", function (d) {
            return color(d.label + ' ' + (Math.round(d.value * 100 / sum) + '%'));
        });

    var svg_bar = d3.select("svg")
        .append("g")
        .attr("class", "legend")
        .attr("transform", "translate(50,30)")
        .style("font-size", "12px");

    var legend = svg_bar.selectAll('.legend')
        .data(color.domain())
        .enter()
        .append('g')
        .attr('class', 'legend')
        .attr('transform', function (d, i) {
            var vert = (i - color.domain().length) * (height / -15);
            return 'translate(' + (0) + ',' + (vert) + ')';
        });

    legend.append('rect')
        .attr('width', 15)
        .attr('height', 15)
        .style('fill', color)
        .style('stroke', color);
    legend.append('text')
        .attr('x', 16)
        .attr('y', 12)
        .text(function (d) {
            return d;
        });
}

//  Bar Chart - Yu
function bar() {
    // Update & Clear Dataset testing
    var color = d3.scaleOrdinal(['#4daf4a', '#377eb8', '#ff7f00']);
    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 30, bottom: 90, left: 40},
        width = (parseInt(d3.select("tr").style('width')) * 32 / 75) - margin.left - margin.right,
        height = (parseInt(d3.select("tr").style('width')) * 128 / 375) - margin.top - margin.bottom,
        tipH = (parseInt(d3.select("tr").style('height')) * 0.25),
        tip_size = (parseInt(d3.select("tr").style('width')) * 3 / 5) - (parseInt(d3.select("#bar_chart").style('width'))) / 2;

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
    // ----------------
    // Create a tooltip
    // ----------------
    var tooltip = d3.select("#bar_chart")
        .append("g")
        .style("opacity", 0)
        .attr("class", "tooltip")
        .attr("id", "tooltip");
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
    if (sum < 10) {
        var y = d3.scaleLinear()
            .domain([0, sum, 10])
            // .rangeRound([height,0])
            .range([height, 0]);
    } else {
        var y = d3.scaleLinear()
            .domain([0, sum])
            // .rangeRound([height,0])
            .range([height, 0]);
    }

    svg.append("g")
        .call(d3.axisLeft(y))
        .style("font-size", "15px");


    // Bars
    svg.selectAll("bar")
        .data(data_yu)
        .enter()
        .append("rect")
        .attr("x", function (d) {
            return x(d.label) + x.bandwidth() * 1 / 4;
        })
        .attr("width", x.bandwidth() * 1 / 2)
        .style("fill", function (d) {
            return color(d.label + ' ' + (Math.round(d.value * 100 / sum) + '%'));
        })
        // .attr("Percentage",function (d) {
        //     return color(d3.format(".3f")(d.value/sum)*100+ '%')
        // })
        // no bar at the beginning thus:
        .attr("height", function () {
            return height - y(0);
        }) // always equal to 0
        .attr("y", function () {
            return y(0);
        })
        .on("mousemove", function (d) {
            // var abs_x = d3.event.pageX - document.getElementById("svg_bar").getBoundingClientRect().x;
            var abs_x = d3.event.pageX;
            var abs_y = d3.event.pageY;
            tooltip
                .style("left", abs_x - tip_size + "px")
                .style("top", abs_y - tipH + "px")
                .style("display", "inline-block")
                .style("opacity", 1)
                .html(d3.format(".3f")(d.value / sum) * 100 + '%');
        })
        .on("mouseout", function (d) {
            tooltip.style("display", "none");
        });
    console.log(color.domain())

    //  Index
    svg.selectAll("bar")
        .data(data_yu)
        .enter()
        .append("text")
        .attr("x", function (d) {
            return x(d.label) + (x.bandwidth()) * 4 / 9;
        })
        .attr("height", function (d) {
            return height - y(0);
        })
        .attr("y", function (d) {
            return height * (1 - (d.value / sum)) - 10
        })
        .text(function (d) {
            return d.value
        })
        .style("font-size", "30px");


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
    // Title for Bar Chart (Redundant)
    // svg.append("g")
    //     .attr("transform", "translate(" + (width / 3 - 37) + "," + (-40) + ")")
    //     .append("text")
    //     .text("PeelService Report")
    //     .attr("id", "chart_title")


    //legend

    var svg_bar = d3.select("svg")
        .append("g")
        .attr("class", "legend")
        .attr("transform", "translate(50,30)")
        .style("font-size", "12px");

    var legend = svg_bar.selectAll('.legend')
        .data(color.domain())
        .enter()
        .append("g")
        .attr('class', 'legend')
        .attr('transform', function (d, i) {
            var vert = (i - color.domain().length) * (height / -15);
            return 'translate(' + (width - 55) + ',' + (vert) + ')';
        });
    legend.append('rect')
        .attr('width', 15)
        .attr('height', 15)
        .style('fill', color)
        .style('stroke', color);
    legend.append('text')
        .attr('x', 16)
        .attr('y', 12)
        .text(function (d) {
            return d;
        });
}

// update legend:

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

    // add new feature (30.05.2019)
    function bar_chart() {
        d3.selectAll("svg").remove();
        var d1 = document.getElementById("pie_chart");
        var d2 = document.getElementById("bar_chart");
        if (d2.style.display === "none") {
            d1.style.display = "none";
            d2.style.display = "block";
        }
        bar()
    }

    function pie_chart() {
        d3.selectAll("svg").remove();
        var d1 = document.getElementById("pie_chart");
        var d2 = document.getElementById("bar_chart");
        if (d1.style.display === "none") {
            d1.style.display = "block";
            d2.style.display = "none";
        }
        pie()
    }

    function openTab(evt, tag_num) {
        let i, tablinks;
        let slider = $('#toggle-event').prop('checked')
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        }
        switch (tag_num) {
            case 0:
                data_yu = data_peel;
                sum = sum_peel;
                break;
            case 1:
                data_yu = data_loca;
                sum = sum_loca;
                break;
            case 2:
                break;
        }
        if (slider === true) {
            bar_chart()
        } else if (slider === false) {
            pie_chart()
        }
        evt.currentTarget.firstElementChild.className += " w3-border-red";
        $('#console-event').html(title())

    }

    $(function () {
        $('#toggle-event').change(function () {
            let tablinks = document.getElementsByClassName("tablink");
            $('#console-event').html(title())


            if (tablinks[0].className.includes(" w3-border-red") === false &&
                tablinks[1].className.includes(" w3-border-red") === false &&
                tablinks[2].className.includes(" w3-border-red") === false) {
                data_yu = data_peel;
                sum = sum_peel;
                // console.log("Found it")
            }
            if ($('#toggle-event').prop('checked') === true) {
                bar_chart()
            } else {
                pie_chart()
            }
        })
    });

    function title() {
        let tablinks = document.getElementsByClassName("tablink");
        var title;
        if (tablinks[0].className.includes(" w3-border-red") === true) {
            title = "Peel Service Report"
        } else if (tablinks[1].className.includes(" w3-border-red") === true) {
            title = "Location Report"
        } else if (tablinks[2].className.includes(" w3-border-red") === true) {
            title = "Disable Temp"
        } else {
            title = "Peel Service Report"
        }
        return title
    }
}
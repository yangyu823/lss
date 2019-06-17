//  Pie Chart - Yu
function pie() {
    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 30, bottom: 90, left: 40},
        height = (parseInt(d3.select("tr").style('height')) * 4 / 5) - margin.top - margin.bottom;
    if ((parseInt(d3.select("tr").style('width'))) * 4 / 5 <= 1140) {
        width = (parseInt(d3.select("tr").style('width')) * 2 / 3) - margin.left - margin.right;
    } else {
        width = 1140 - margin.left - margin.right;
    }
    var color = d3.scaleOrdinal(['#4daf4a', '#377eb8', '#ff7f00', '#ff134c', '#e7ba52', '#f781bf']);


    var pie = new d3pie("pie_chart", {
        "size": {
            "canvasHeight": height,
            "canvasWidth": width,
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
    if (temp_show) {
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
                return color(d.label + '-' + (Math.round(d.value * 100 / sum) + '%'));
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
}

//  Bar Chart - Yu
function bar() {
    if (pick !== 1 || showtable === false) {
        console.log(lss_tab)

        // Update & Clear Dataset testing
        var color = d3.scaleOrdinal(['#4daf4a', '#377eb8', '#ff7f00', '#ff134c', '#e7ba52', '#f781bf']);
        // set the dimensions and margins of the graph
        var margin = {top: 10, right: 30, bottom: 90, left: 40},
            height = (parseInt(d3.select("tr").style('height')) * 2 / 3) - margin.top - margin.bottom,
            tip_size = (parseInt(d3.select("tr").style('width')) * 3 / 5) - (parseInt(d3.select("#bar_chart").style('width'))) / 2;
        if ((parseInt(d3.select("tr").style('width'))) * 4 / 5 <= 1140) {
            width = (parseInt(d3.select("tr").style('width')) * 4 / 5) - margin.left - margin.right
        } else {
            width = 1140 - margin.left - margin.right
        }
        // console.log(parseInt(d3.select("#row").style('width')))

        // append the svg object to the body of the page
        var svg = d3.select("#bar_chart")
            .append("svg")
            .attr("width", width + margin.left)
            .attr("height", height + margin.top + margin.bottom)
            .attr("id", "svg_bar")
            .append("g")
            .attr("transform", "translate(" + 80 + "," + (margin.top * 4) + ")")
        ;

        width = width * 0.8
        // ----------------
        // Create a tooltip
        // ----------------
        var tooltip = d3.select("#bar_chart")
            .append("g")
            .style("opacity", 0)
            .style("display", "none")
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
            .attr("id", "bar_label")
            .attr("transform", "translate(0,0)")
            .style("text-anchor", "end")
            .style("font-size", "15px");

        // Add Y axis
        if (sum <= 7) {
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
                return color(d.label + "-" + (Math.round(d.value * 100 / sum) + '%'));
            })
            // no bar at the beginning thus:
            .attr("height", function () {
                return height - y(0);
            }) // always equal to 0
            .attr("y", function () {
                return y(0);
            })
            .on("mousemove", function (d) {
                var abs_x = d3.event.pageX;
                var abs_y = d3.event.pageY;
                tooltip
                    .style("left", abs_x - tip_size + "px")
                    .style("top", abs_y - 245 + "px")
                    .style("display", "inline-block")
                    .style("opacity", 1)
                    .html(Math.round(d.value * 100 / sum) + '%');

                // .html(d3.format(".4f")(d.value / sum) * 100 + '%');
            })
            .on("mouseout", function (d) {
                tooltip.style("display", "none");
            });

        //  Index
        svg.selectAll("bar")
            .data(data_yu)
            .enter()
            .append("text")
            .attr("x", function (d) {
                return x(d.label) + (x.bandwidth()) * 4 / 9;
            })
            .attr("height", function (d) {
                return 0;
            })
            .attr("y", function (d) {
                return height * (1 - (d.value / sum)) - 10
            })
            .text(function (d) {
                return d.value;
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
        //legend

        var svg_bar = d3.select("svg")
            .append("g")
            .attr("class", "legend")
            .attr("transform", "translate(" + (width * 0.2 + 40) + "," + 30 + ")")
            .style("font-size", "12px");


        var legend = svg_bar.selectAll('.legend')
            .data(color.domain())
            .enter()
            .append("g")
            .attr('class', 'legend')
            .attr('transform', function (d, i) {
                var vert = (i - color.domain().length) * (height / -15);
                return 'translate(' + width * 0.8 + ',' + (vert) + ')';
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
    } else {
        console.log(data_lss)
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

        // set the colors & sorting
        if (temp_show) {
            var z = d3.scaleOrdinal()
                .range(['#4daf4a', '#ff7f00', '#377eb8', '#ff134c', '#e7ba52', '#f781bf']);
            data_lss.sort(function (a, b) {
                return b.Total - a.Total;
            });
        } else {
            var z = d3.scaleOrdinal()
                .range(['#79af79', '#ffde0d', '#ffaa2d', '#ff5724', '#ff1517', '#097aff', '#980cff', '#f781bf']);
            // .range([ '#ffa476', '#ff7f00']);
            '#097aff', '#980cff', '#d355e7', '#f781bf'

        }

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

        if (temp_show) {
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


        }

    }
}

// update legend:
//Switch Button Function - Yu
{
    // add new feature (30.05.2019)
    function bar_chart() {
        d3.selectAll("svg").remove();
        d3.selectAll("#stats_tb").remove();
        d3.selectAll("#tooltip").remove();

        // d3.selectAll("table").remove();
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
        d3.selectAll("#stats_tb").remove();
        d3.selectAll("#tooltip").remove();

        // d3.selectAll("table").remove();
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
                showtable = true;
                data_yu = data_peel;
                sum = sum_peel;
                if (pick === 1) {
                    temp_show = true;
                    data_lss = data_total;
                    keys = key_peel;
                }
                break;
            case 1:
                showtable = true;
                data_yu = data_loca;
                sum = sum_loca;
                if (pick === 1) {
                    temp_show = true;
                    data_lss = data_location;
                    keys = key_location;
                }
                break;
            case 2:
                // showtable = false;
                data_yu = newTab;
                sum = sum_tab3;
                if (pick === 1) {
                    temp_show = false;
                    data_lss = lss_tab;
                    data_yu = lss_pie;
                    keys = new_key;
                }
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
                tablinks[2].className.includes(" w3-border-red") === false
            ) {
                data_yu = data_peel;
                sum = sum_peel;
                if (pick === 1) {
                    data_lss = data_total;
                    keys = key_peel;
                }
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

    function initial() {
        temp_show = true;
        showtable = true;
        data_yu = data_peel;
        sum = sum_peel;
        if (pick === 1) {
            data_lss = data_total;
            keys = key_peel;
        }
        bar_chart();
    }

    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }

}
<?php

date_default_timezone_set("Australia/Melbourne");
//error_reporting(0);

$profile = 7;


if ($profile == 100) {
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
//  Setup DB variable
include "lib/yu/db.php";
include "lib/yu/yu.php";


// Close connection
$conn->close();

?>

    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>L&SS Team</title>
        <link href="lib/bootstrap-4.1.3/css/bootstrap.css" rel="stylesheet">
        <link href="lib/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet">
        <link href="lib/homestyle.css" rel="stylesheet">
        <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">

        <script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="lib/bootstrap-4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="lib/jquery-ui-1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="lib/sweetalert.min.js"></script>

        <link href="lib/bootstrap/css/datepicker.css" rel="stylesheet">
        <script type="text/javascript" src="lib/bootstrap/js/bootstrap-datepicker.js"></script>

        <!--        ##########################################-->
        <!--        ### Yu Source Script report function start   -->
        <link href="lib/yu/bootstrap-toggle.min.css" rel="stylesheet">
        <link href="lib/yu/w3.css" rel="stylesheet">
        <link href="lib/yu/yu.css" rel="stylesheet">
        <script src="lib/yu/bootstrap-toggle.min.js"></script>
        <script src="lib/yu/d3/d3.min.js"></script>
        <script src="lib/yu/d3/d3.v4.js"></script>
        <script src="lib/yu/d3pie.min.js"></script>
        <script src="lib/yu/yu.js"></script>
        <script>
            //  Global Variable
            var pick = (<?php echo json_encode($profile, JSON_NUMERIC_CHECK); ?>);
            if (pick === 1) {
                var data_total = (<?php echo json_encode($data_total, JSON_NUMERIC_CHECK); ?>);
                var data_location = (<?php echo json_encode($data_location, JSON_NUMERIC_CHECK); ?>);
                var key_peel = (<?php echo json_encode($key_peel, JSON_NUMERIC_CHECK); ?>);
                var key_location = (<?php echo json_encode($key_location, JSON_NUMERIC_CHECK); ?>);
            }
            var sum_peel = (<?php echo json_encode($sum_peel, JSON_NUMERIC_CHECK); ?>);
            var data_peel = (<?php echo json_encode($dataPeel, JSON_NUMERIC_CHECK); ?>);
            var sum_loca = (<?php echo json_encode($sum_location, JSON_NUMERIC_CHECK); ?>);
            var data_loca = (<?php echo json_encode($dataLocation, JSON_NUMERIC_CHECK); ?>);
        </script>

        <?php
        include "lib/yu/yu.php";

        ?>

        <!--        ### Yu Source Script report function finished-->
        <!--        #############################################-->


        <style type="text/css">
            body {
                font-family: sans-serif;
                width: 100%;
                height: 100%;
                background-image: url(img/bg_white1.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }

            .avatar {
                vertical-align: middle;
                width: 165px;
                height: 165px;
                border-radius: 50%;
            }

            .tncellspace {
                border-collapse: collapse;
                border-spacing: 0px;
            }

            .tcellspace {
                border-collapse: separate;
                border-spacing: 25px;
                background-color: transparent;
                padding: 0 !important;
            }

            .bgteam {
                background: <?php echo $team_color; ?>;;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                opacity: 1;
                visibility: inherit;
                position: fixed !important;
                width: 100%;
                height: 55px !important;
                top: 0 !important;
                left: 0 !important;
                font-size: 30px;
                color: white !important;
            }

            a {
                text-decoration: none !important;
            }

            .regForm {
                background-color: #ffffff;
                margin: 0px auto 0px auto;
                font-family: sans-serif;
                padding: 30px;
                width: 80%;
                min-width: 300px;
                box-shadow: 0 15px 20px rgba(0, 0, 0, 0.5);
                border-radius: 6px;
                border: 1px grey;
            }

            button {
                background-color: #4CAF50;
                color: #ffffff;
                border: none;
                border-radius: 6px;
                padding: 10px 20px;
                font-size: 15px;
                font-family: sans-serif;
                cursor: pointer;
            }

            button:hover {
                opacity: 0.8;
            }

            /* Make circles that indicate the steps of the form: */
            .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5;
            }

            .step.active {
                opacity: 1;
            }

            /* Mark the steps that are finished and valid: */
            .step.finish {
                background-color: #4CAF50;
            }

            .leftpanea:link, .leftpanea:visited {
                color: #007bff;
                text-decoration: underline;
                cursor: pointer;
            }

            .leftpanea:hover {
                background: <?php echo $team_color; ?>;
                color: white;
            }

            .leftpanea:active, .leftpanea:visited:active {
                font-size: 120%;
            }

            .leftpanea.active {
                background: <?php echo $team_color; ?>;
                font-size: 120%;
                color: white;
            }


            /****  floating-Lable style start ****/
            .floating-label {
                position: relative;
                margin-bottom: 20px;
            }

            .floating-input, .floating-select {
                font-size: 14px;
                padding: 4px 4px;
                display: block;
                width: 100%;
                height: 30px;
                background-color: transparent;
                border: none;
                border-bottom: 1px solid #757575;
            }

            .floating-input:focus, .floating-select:focus {
                outline: none;
                border-bottom: 2px solid #5264AE;
            }

            /*label {*/
            /*    color: #999;*/
            /*    font-size: 14px;*/
            /*    font-weight: normal;*/
            /*    position: absolute;*/
            /*    pointer-events: none;*/
            /*    left: 5px;*/
            /*    top: 5px;*/
            /*    transition: 0.2s ease all;*/
            /*    -moz-transition: 0.2s ease all;*/
            /*    -webkit-transition: 0.2s ease all;*/
            /*}*/

            .floating-input:focus ~ label, .floating-input:not(:placeholder-shown) ~ label {
                top: -18px;
                font-size: 14px;
                color: #5264AE;
            }

            .floating-select:focus ~ label, .floating-select:not([value=""]):valid ~ label {
                top: -18px;
                font-size: 14px;
                color: #5264AE;
            }

            /* active state */
            .floating-input:focus ~ .bar:before, .floating-input:focus ~ .bar:after, .floating-select:focus ~ .bar:before, .floating-select:focus ~ .bar:after {
                width: 50%;
            }

            *, *:before, *:after {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }


            /* highlighter */
            .highlight {
                position: absolute;
                height: 50%;
                width: 100%;
                top: 15%;
                left: 0;
                pointer-events: none;
                opacity: 0.5;
            }

            /* active state */
            .floating-input:focus ~ .highlight, .floating-select:focus ~ .highlight {
                -webkit-animation: inputHighlighter 0.3s ease;
                -moz-animation: inputHighlighter 0.3s ease;
                animation: inputHighlighter 0.3s ease;
            }

            /* animation */
            @-webkit-keyframes inputHighlighter {
                from {
                    background: #5264AE;
                }
                to {
                    width: 0;
                    background: transparent;
                }
            }

            @-moz-keyframes inputHighlighter {
                from {
                    background: #5264AE;
                }
                to {
                    width: 0;
                    background: transparent;
                }
            }

            @keyframes inputHighlighter {
                from {
                    background: #5264AE;
                }
                to {
                    width: 0;
                    background: transparent;
                }
            }

            /****  floating-Lable style end ****/


            .ui-autocomplete {
                position: absolute;
                cursor: default;
                z-index: 4000 !important
            }

            .rotate-center {
                -webkit-animation: rotate-center 0.6s ease-in-out both;
                animation: rotate-center 0.6s ease-in-out both;
            }


            @-webkit-keyframes rotate-center {
                0% {
                    -webkit-transform: rotate(0);
                    transform: rotate(0);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            @keyframes rotate-center {
                0% {
                    -webkit-transform: rotate(0);
                    transform: rotate(0);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }


        </style>

        <script type="text/javascript">
            //Yu Script for Report Chart Display
            //Yu Script for canvasjs pie chart

            //Yu Script finished


            $(function () {

                $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();

                $(document).on('click', '.datepicker', function () {
                    $(this).datepicker({dateFormat: 'yy-mm-dd'});
                });
            });

            $(document).ready(function () {
                $("#searchval").on('keyup', function (e) {
                    if (e.keyCode == 13) {
                        $("#searchlnki").click();
                    }
                });

                $("#searchrlink").click(function () {
                    $("#livestat").css("display", "none");
                    $("#addresour").css("display", "none");
                    $("#Requestres").css("display", "none");
                    $("#Managealloc").css("display", "none");
                    $("#report").css("display", "none");
                    $("#searchr").css("display", "block");
                    //left navigation pane Active link
                    $('#livestatlink').removeClass('active');
                    $('#addresourlink').removeClass('active');
                    $('#Managealloclink').removeClass('active');
                    $('#Requestreslink').removeClass('active');
                    $('#reportlink').removeClass('active');
                    $('#searchrlink').addClass('active');

                });
                // view live status
                $("#livestatlink").click(function () {
                    $("#searchr").css("display", "none");
                    $("#addresour").css("display", "none");
                    $("#Requestres").css("display", "none");
                    $("#Managealloc").css("display", "none");
                    $("#report").css("display", "none");
                    $("#livestat").css("display", "block");
                    //left navigation pane Active link
                    $('#searchrlink').removeClass('active');
                    $('#addresourlink').removeClass('active');
                    $('#Managealloclink').removeClass('active');
                    $('#Requestreslink').removeClass('active');
                    $('#reportlink').removeClass('active');
                    $('#livestatlink').addClass('active');
                });

                // view add resource
                $("#addresourlink").click(function () {
                    $("#livestat").css("display", "none");
                    $("#searchr").css("display", "none");
                    $("#Requestres").css("display", "none");
                    $("#Managealloc").css("display", "none");
                    $("#report").css("display", "none");
                    $("#addresour").css("display", "block");
                    //left navigation pane Active link
                    $('#searchrlink').removeClass('active');
                    $('#livestatlink').removeClass('active');
                    $('#Managealloclink').removeClass('active');
                    $('#Requestreslink').removeClass('active');
                    $('#reportlink').removeClass('active');
                    $('#addresourlink').addClass('active');
                });

                // view Manage allocations
                $("#Managealloclink").click(function () {
                    $("#livestat").css("display", "none");
                    $("#searchr").css("display", "none");
                    $("#Requestres").css("display", "none");
                    $("#addresour").css("display", "none");
                    $("#report").css("display", "none");
                    $("#Managealloc").css("display", "block");
                    //left navigation pane Active link
                    $('#searchrlink').removeClass('active');
                    $('#livestatlink').removeClass('active');
                    $('#addresourlink').removeClass('active');
                    $('#Requestreslink').removeClass('active');
                    $('#reportlink').removeClass('active');
                    $('#Managealloclink').addClass('active');

                });

                // view Report Page
                $("#reportlink").click(function () {
                    $("#livestat").css("display", "none");
                    $("#searchr").css("display", "none");
                    $("#Requestres").css("display", "none");
                    $("#Managealloc").css("display", "none");
                    $("#addresour").css("display", "none");
                    $("#report").css("display", "block");
                    //left navigation pane Active link
                    $('#searchrlink').removeClass('active');
                    $('#livestatlink').removeClass('active');
                    $('#Managealloclink').removeClass('active');
                    $('#Requestreslink').removeClass('active');
                    $('#addresourlink').removeClass('active');
                    $('#reportlink').addClass('active');
                    initial();
                });


                // Modal pop-up link for add new allocation
                $("#regallocFormaddresoulink").click(function () {

                });

                // view resource Request management
                $("#Requestreslink").click(function () {
                    $("#livestat").css("display", "none");
                    $("#searchr").css("display", "none");
                    $("#addresour").css("display", "none");
                    $("#Managealloc").css("display", "none");
                    $("#report").css("display", "none");
                    $("#Requestres").css("display", "block");
                    // View under the Resource management - right pane
                    $("#regFormaddresqallocres").css("display", "none");
                    $("#regFormaddresq").css("display", "none");
                    $("#Requestreqsdetails").css("display", "block");
                    //left navigation pane Active link
                    $('#searchrlink').removeClass('active');
                    $('#livestatlink').removeClass('active');
                    $('#addresourlink').removeClass('active');
                    $('#Managealloclink').removeClass('active');
                    $('#reportlink').removeClass('active');
                    $('#Requestreslink').addClass('active');

                });

                //adding a new row for resource allocation
                $(document).on("click", "#resallocate", function (event) {
                    $('#resallocatetable td:last-child').html("<a href='#' style='color:red' id='resallocatedelete'><i class='fa fa-minus fa-fw'></i></a>");

                    $('#resallocatetable tr:last').after("<tr style='padding: 5px !important;'><td style= 'padding: 5px; width: 20% !important;'><div class='field'><input type='text' id ='resallocateresnamein' name='resallocateresnamein[]' size='30'  placeholder='Resource Name...'><label for='resallocateresnamein'>Resource Name...</label></div></td><td style= 'padding: 5px; width: 15% !important;'><div class='field'><input class = 'datepicker' type='text' id='resallocatesdin' name='resallocatesdin[]' size='15' placeholder='Start Date...'><label for='resallocatesdin'>Start Date...</label></div></td><td style= 'padding: 5px; width: 15% !important;'><div class='field'><input class = 'datepicker' type='text'  size='15' placeholder='End Date...'  id='resallocateedin' name='resallocateedin[]' ><label for='resallocateedin'>End Date...</label></div></td><td style= 'padding: 5px; width: 10% !important;'><div class='field'><input type='number'  size='8' placeholder='Percentage...'   id='resallocperin' name='resallocperin[]' ><label for='resallocperin'>Percentage...</label></div></td><td style= 'padding: 5px; width: 30% !important;'><div class='field'><input type='text'  size='5'  placeholder='Message...'  id='resalloccomin' name='resalloccomin[]' ><label for='resalloccomin'>Message...</label></div></td><td style= 'width: 10% !important;' id='addresourceplustd'> <a href='#' style='color:green' id='resallocate'><i class='fa fa-plus fa-fw'></i></a></td></tr>");

                    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});

                });

                //autocomplete for adding resource
                $(function () {
                    $(document).on('keydown.autocomplete', '#resallocateresnamein', function () {
                        $(this).autocomplete({
                            source: "lookupex.php",
                            minLength: 2
                        });
                    });
                });


                //view New resource allocation Request details form - All request details
                $("#Requestreqsdetailslink").click(function () {
                    //getting the attributes
                    var fteam = $("#fteamin").val();
                    var pname = $("#pnamein").val();
                    var eng = $("#engin").val();
                    var ppoc = $("#ppocin").val();
                    var ir = $("#irin").val();
                    var nwa = $("#nwain").val();
                    var sdate = $("#sdatein").val();
                    var edate = $("#edatein").val();

                    if (fteam === "" || fteam === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Feature Team name",
                            icon: "warning",
                        });
                    } else if (pname === "" || pname === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Project name",
                            icon: "warning",
                        });
                    } else if (eng === "" || eng === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Engine",
                            icon: "warning",
                        });
                    } else if (ppoc === "" || ppoc === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Project POC",
                            icon: "warning",
                        });
                    } else if (sdate === "" || sdate === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Start Date",
                            icon: "warning",
                        });
                    } else if (edate === "" || edate === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide End Date",
                            icon: "warning",
                        });
                    } else {
                        var flag = 3;
                        $.ajax({
                            type: "post",
                            url: 'teamajax.php',
                            data: {
                                'fteam': fteam,
                                'pname': pname,
                                'eng': eng,
                                'ppoc': ppoc,
                                'ir': ir,
                                'nwa': nwa,
                                'sdate': sdate,
                                'edate': edate,
                                'flag': flag
                            },
                            success: function (response) {
                                var data = JSON.parse(response);
                                if (data[0] == 0) {
                                    $('#reqtable tr:last').after(data[1]);
                                    $("#regFormaddresqallocres").css("display", "none");
                                    $("#regFormaddresq").css("display", "none");
                                    $("#Requestreqsdetails").css("display", "block");
                                } else {
                                    swal({
                                        title: "Portal Info",
                                        text: "some issue, please reach out to Admin",
                                        icon: "error",
                                    });
                                }
                            },
                            error: function (errors) {
                                swal({
                                    title: "Portal Info",
                                    text: "some issue, please reach out to Admin",
                                    icon: "error",
                                });
                            }
                        });
                    }
                });

                // view New resource allocation Request details form - All request details --working
                $("#Requestreqsdetailslinks").click(function () {
                    //project name
                    var pname = $("#pnamespan").html();
                    //getting resource details
                    var resalloc = $("input[name='resallocateresnamein[]']").map(function () {
                        return $(this).val();
                    }).get();

                    var resallocsd = $("input[name='resallocatesdin[]']").map(function () {
                        return $(this).val();
                    }).get();

                    var resalloced = $("input[name='resallocateedin[]']").map(function () {
                        return $(this).val();
                    }).get();

                    var resallocper = $("input[name='resallocperin[]']").map(function () {
                        return $(this).val();
                    }).get();

                    var resalloccom = $("input[name='resalloccomin[]']").map(function () {
                        return $(this).val();
                    }).get();


                    var rescount = resalloc.length;

                    var tempv = 0;
                    var temptext = ""
                    for (i = 0; i < rescount; i++) {
                        var temprow = i + 1;
                        if (resalloc[i] == "" || resalloc[i] == " ") {
                            temptext = temptext + ' Please select resource for ' + temprow + ' row\n';
                            tempv = tempv + 1;
                        }
                        if (resallocsd[i] == "" || resallocsd[i] == " ") {
                            temptext = temptext + ' Please provide start date for ' + temprow + ' row\n';
                            tempv = tempv + 1;
                        }
                        if (resalloced[i] == "" || resalloced[i] == " ") {
                            temptext = temptext + ' Please provide end date for ' + temprow + ' row\n';
                            tempv = tempv + 1;
                        }
                        if (resallocper[i] == "" || resallocper[i] == " " || resallocper[i] > 100 || resallocper[i] < 0) {
                            temptext = temptext + ' Please provide valid allocation percentage for ' + temprow + ' row\n';
                            tempv = tempv + 1;
                        }
                    }
                    var flag = 4;
                    if (tempv == 0) {
                        /*Ajax Request*/
                        $.ajax({
                            type: "post",
                            url: 'teamajax.php',
                            data: {
                                'flag': flag,
                                'resalloc': resalloc,
                                'resallocsd': resallocsd,
                                'resalloced': resalloced,
                                'resallocper': resallocper,
                                'resalloccom': resalloccom,
                                'pname': pname
                            },
                            success: function (response) {
                                if (response == 1) {
                                    $("#regFormaddresqallocres").css("display", "none");
                                    $("#regFormaddresq").css("display", "none");
                                    $("#Requestreqsdetails").css("display", "block");
                                } else {
                                    swal({
                                        title: "Portal Info",
                                        text: "some issue, please reach out to Admin",
                                        icon: "error",
                                    });
                                }
                            },
                            error: function (errors) {
                                swal({
                                    title: "Portal Info",
                                    text: "some issue, please reach out to Admin",
                                    icon: "error",
                                });
                            }
                        });


                    } else {
                        swal({
                            title: "Portal Info",
                            text: temptext,
                            icon: "error",
                        });
                    }


                    console.log(pname);


                });

                // view New resource allocation Request details form - Request
                $("#regFormaddresqlink").click(function () {
                        $("#Requestreqsdetails").css("display", "none");
                        $("#regFormaddresqallocres").css("display", "none");
                        $("#regFormaddresq").css("display", "block");
                    }
                );

                // view New resource allocation Request details form - Allocate
                $("#regFormaddresqallocreslink").click(function () {
                    //getting the attributes
                    var fteam = $("#fteamin").val();
                    var pname = $("#pnamein").val();
                    var eng = $("#engin").val();
                    var ppoc = $("#ppocin").val();
                    var ir = $("#irin").val();
                    var nwa = $("#nwain").val();
                    var sdate = $("#sdatein").val();
                    var edate = $("#edatein").val();

                    if (fteam === "" || fteam === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Feature Team name",
                            icon: "warning",
                        });
                    } else if (pname === "" || pname === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Project name",
                            icon: "warning",
                        });
                    } else if (eng === "" || eng === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Engine",
                            icon: "warning",
                        });
                    } else if (ppoc === "" || ppoc === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Project POC",
                            icon: "warning",
                        });
                    } else if (sdate === "" || sdate === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Start Date",
                            icon: "warning",
                        });
                    } else if (edate === "" || edate === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide End Date",
                            icon: "warning",
                        });
                    } else {
                        var flag = 3;
                        $.ajax({
                            type: "post",
                            url: 'teamajax.php',
                            data: {
                                'fteam': fteam,
                                'pname': pname,
                                'eng': eng,
                                'ppoc': ppoc,
                                'ir': ir,
                                'nwa': nwa,
                                'sdate': sdate,
                                'edate': edate,
                                'flag': flag
                            },
                            success: function (response) {
                                var data = JSON.parse(response);
                                if (data[0] == 0) {
                                    $('#reqtable tr:last').after(data[1]);
                                    $("#pnamespan").html(pname);
                                    $("#startdatespan").html(sdate + " - " + edate);
                                    $("#Requestreqsdetails").css("display", "none");
                                    $("#regFormaddresq").css("display", "none");
                                    $("#regFormaddresqallocres").css("display", "block");
                                } else {
                                    swal({
                                        title: "Portal Info",
                                        text: "some issue, please reach out to Admin",
                                        icon: "error",
                                    });
                                }
                            },
                            error: function (errors) {
                                swal({
                                    title: "Portal Info",
                                    text: "some issue, please reach out to Admin",
                                    icon: "error",
                                });
                            }
                        });
                    }
                });

                //canceling the new request form
                $("#Requestreqsdetailslinkcancel").click(function () {
                    $("#regFormaddresq").css("display", "none");
                    $("#Requestreqsdetails").css("display", "block");
                });

                //canceling the new request form (resource allocation one)
                $("#reqallocresourcecancel").click(function () {
                    $("#regFormaddresq").css("display", "none");
                    $("#regFormaddresqallocres").css("display", "none");
                    $("#Requestreqsdetails").css("display", "block");
                });


                //showing filter for request
                $("#sfilter").click(function () {
                    $("#reqfilter").css("display", "table-row");
                    $("#sfilter").css("display", "none");
                });

                //hiding filter for request
                $("#clrfilter").click(function () {
                    $("#reqfilter").css("display", "none");
                    $("#sfilter").css("display", "block");
                });

                $("#searchlnki").click(function () {
                    var keyval = $('#searchval').val();
                    var flag = 1;

                    /*Ajax Request*/
                    $.ajax({
                        type: "post",
                        url: 'teamajax.php',
                        data: {
                            'val': keyval,
                            'flag': flag
                        },
                        success: function (response) {
                            var data = JSON.parse(response);
                            if (data[0] == 1) {
                                $("#appneddata").html("");
                                $("#appneddata").append(data[1]);
                            } else if (data[0] == 2) {
                                swal({
                                    title: "Portal Info",
                                    text: "No Result Found!",
                                    icon: "info",
                                });
                            } else {
                                swal({
                                    title: "Portal Info",
                                    text: "some issue, please reach out to Admin",
                                    icon: "error",
                                });
                            }
                        },
                        error: function (errors) {
                            $("#fogpass").modal("toggle");
                            swal({
                                title: "Portal Info",
                                text: "some issue, please reach out to Admin",
                                icon: "error",
                            });
                        }
                    });
                });

                //duration change
                $("#dnum").focusout(function () {
                    var val = $(this).val();

                    var res = val.charAt(0);
                    console.log(res);

                    if (res.localeCompare('C') == 0 || res.localeCompare('c') == 0 || res.localeCompare('d') == 0 || res.localeCompare('D') == 0) {
                        if (val.length == 7) {
                            var numval = val.substr(1, 6);
                            var isnum = /^\d+$/.test(numval);
                            if (isnum) {
                                flag = 1;
                                /*Ajax Request*/
                                $.ajax({
                                    type: "post",
                                    url: 'arajax.php',
                                    data: {
                                        'flag': flag,
                                        'val': val
                                    },
                                    success: function (response) {
                                        if (response == 1) {
                                            swal({
                                                title: "Portal Info",
                                                text: "This d number is already present in L&SS directory",
                                                icon: "error",
                                            });
                                        }
                                    },
                                    error: function (errors) {
                                    }
                                });
                            } else {
                                swal({
                                    title: "Portal Info",
                                    text: "Please provide valid d number",
                                    icon: "warning",
                                });
                            }
                        } else {
                            swal({
                                title: "Portal Info",
                                text: "Please provide valid d number",
                                icon: "warning",
                            });
                        }
                    } else {
                        swal({
                            title: "Portal Info",
                            text: "Please provide valid d number, d number must start with c/C/d/D",
                            icon: "warning",
                        });
                    }
                });

                $("#nextBtn").click(function () {
                    //checking again d number validation
                    var val = $("#dnum").val();

                    var res = val.charAt(0);
                    console.log(res);

                    if (res.localeCompare('C') == 0 || res.localeCompare('c') == 0 || res.localeCompare('d') == 0 || res.localeCompare('D') == 0) {
                        if (val.length == 7) {
                            var numval = val.substr(1, 6);
                            var isnum = /^\d+$/.test(numval);
                            if (isnum) {
                                flag = 1;
                                /*Ajax Request*/
                                $.ajax({
                                    type: "post",
                                    url: 'arajax.php',
                                    data: {
                                        'flag': flag,
                                        'val': val
                                    },
                                    success: function (response) {
                                        if (response == 1) {
                                            swal({
                                                title: "Portal Info",
                                                text: "This d number is already present in L&SS directory",
                                                icon: "error",
                                            });
                                        } else {
                                            //employee number
                                            var empnum = $("#empid").val();

                                            //full name
                                            var flname = $("#name").val();

                                            //email id
                                            var emailid = $("#email").val();

                                            //checking location is selected
                                            var loc = $("#loc option:selected").val();

                                            //role
                                            var role = $("#role option:selected").val();

                                            //specialization
                                            var spl = $("#specialization option:selected").val();

                                            //checking employee number is not blank
                                            if (empnum == "" || empnum == " ") {
                                                swal({
                                                    title: "Portal Info",
                                                    text: "Please provide employee number",
                                                    icon: "error",
                                                });
                                            }
                                            //checking full name is not blank
                                            else if (flname == "" || flname == " ") {
                                                swal({
                                                    title: "Portal Info",
                                                    text: "Please provide full name",
                                                    icon: "error",
                                                });
                                            }
                                            //checking email id is not blank and in format
                                            else if (emailid == "" || emailid == " ") {
                                                swal({
                                                    title: "Portal Info",
                                                    text: "Please provide email id",
                                                    icon: "error",
                                                });
                                            }
                                            //checking location is selected
                                            else if (loc == "Select Location") {
                                                swal({
                                                    title: "Portal Info",
                                                    text: "Please select location of resource",
                                                    icon: "error",
                                                });
                                            }
                                            //checking role is selected
                                            else if (role == "Select Role") {
                                                swal({
                                                    title: "Portal Info",
                                                    text: "Please select role of resource",
                                                    icon: "error",
                                                });
                                            }
                                            //checking specialization is selected
                                            else if (spl == "Select Specialization") {
                                                swal({
                                                    title: "Portal Info",
                                                    text: "Please select specialization of resource",
                                                    icon: "error",
                                                });
                                            } else {
                                                if (validateEmail(emailid)) {
                                                    //team.telstra.com check
                                                    emailval = emailid.split("@");
                                                    semail = emailval.length;
                                                    if (semail == 2) {
                                                        if (emailval[1].toUpperCase() === 'TEAM.TELSTRA.COM') {
                                                            //div
                                                            $("#basinfo").css("display", "none");
                                                            $("#tminfo").css("display", "block");

                                                            //button
                                                            $("#nextBtn").css("display", "none");
                                                            $("#prevBtn").css("display", "inline");
                                                            $("#subBtn").css("display", "inline");

                                                            //step
                                                            $('#step1').addClass('finish').removeClass('active');
                                                            $('#step2').addClass('active');
                                                        } else {
                                                            swal({
                                                                title: "Portal Info",
                                                                text: "Email id must contain @team.telstra.com",
                                                                icon: "error",
                                                            });
                                                        }
                                                    } else {
                                                        swal({
                                                            title: "Portal Info",
                                                            text: "Email id format is not correct",
                                                            icon: "error",
                                                        });
                                                    }
                                                } else {
                                                    swal({
                                                        title: "Portal Info",
                                                        text: "Email id format is not correct",
                                                        icon: "error",
                                                    });
                                                }
                                            }
                                        }
                                    },
                                    error: function (errors) {
                                    }
                                });
                            } else {
                                swal({
                                    title: "Portal Info",
                                    text: "Please provide valid d number",
                                    icon: "warning",
                                });
                            }
                        } else {
                            swal({
                                title: "Portal Info",
                                text: "Please provide valid d number",
                                icon: "warning",
                            });
                        }
                    } else {
                        swal({
                            title: "Portal Info",
                            text: "Please provide valid d number, d number must start with c/C/d/D",
                            icon: "warning",
                        });
                    }
                });

                $("#prevBtn").click(function () {
                    //div
                    $("#basinfo").css("display", "block");
                    $("#tminfo").css("display", "none");

                    //button
                    $("#nextBtn").css("display", "inline");
                    $("#prevBtn").css("display", "none");
                    $("#subBtn").css("display", "none");

                    //step
                    $('#step1').addClass('active').removeClass('finish');
                    $('#step2').removeClass('active');
                });

                $("#subBtn").click(function () {
                    //dnumber
                    var val = $("#dnum").val();

                    //employee number
                    var empnum = $("#empid").val();

                    //full name
                    var flname = $("#name").val();

                    //email id
                    var emailid = $("#email").val();

                    //checking location is selected
                    var loc = $("#loc option:selected").val();

                    //role
                    var role = $("#role option:selected").val();

                    //specialization
                    var spl = $("#specialization option:selected").val();

                    //team
                    var team = $("#team option:selected").val();

                    //sub stream
                    var stream = $("#stream option:selected").val();

                    //direct report
                    var drmanager = $("#dirreport option:selected").val();

                    //PEX manager
                    var pexmanager = $("#pexmanager option:selected").val();

                    //organization
                    var org = $("#org option:selected").val();

                    //Peel
                    var peel = $("#peel option:selected").val();

                    //Release Date
                    var reldate = $("#reldate").val();

                    //validate team
                    if (team == "Select Team") {
                        swal({
                            title: "Portal Info",
                            text: "Please select Team",
                            icon: "error",
                        });
                    }
                    //validate sub stream
                    else if (stream == "Select Sub Stream") {
                        swal({
                            title: "Portal Info",
                            text: "Please select Sub Stream",
                            icon: "error",
                        });
                    }
                    //validate direct report
                    else if (drmanager == "Select Reporting Manager") {
                        swal({
                            title: "Portal Info",
                            text: "Please select Reporting Manager",
                            icon: "error",
                        });
                    }
                    //validate PEX manager
                    else if (pexmanager == "Select PEX Manager") {
                        swal({
                            title: "Portal Info",
                            text: "Please select PEX Manager",
                            icon: "error",
                        });
                    }
                    //validate organization
                    else if (org == "Select Organization") {
                        swal({
                            title: "Portal Info",
                            text: "Please select Organization",
                            icon: "error",
                        });
                    }
                    //validate Peel
                    else if (peel == "Select Peel(Yes/No)") {
                        swal({
                            title: "Portal Info",
                            text: "Please select Peel info",
                            icon: "error",
                        });
                    }
                    //validate release date
                    else if (reldate == "" || reldate == " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please select Release Date of Resource",
                            icon: "error",
                        });
                    } else {
                        flag = 2;
                        /*Ajax Request*/
                        $.ajax({
                            type: "post",
                            url: 'arajax.php',
                            data: {
                                'flag': flag,
                                'val1': val,
                                'empnum1': empnum,
                                'flname1': flname,
                                'emailid1': emailid,
                                'loc1': loc,
                                'role1': role,
                                'spl1': spl,
                                'team1': team,
                                'stream1': stream,
                                'drmanager1': drmanager,
                                'pexmanager1': pexmanager,
                                'org1': org,
                                'peel1': peel,
                                'reldate1': reldate
                            },
                            success: function (response) {
                                if (response == 1) {
                                    $("#regFormaddresou").css("display", "none");
                                    $("#infodiv").css("display", "block");
                                } else {
                                    swal({
                                        title: "Portal Info",
                                        text: "some issue, please reach out to Admin",
                                        icon: "error",
                                    });
                                }
                            },
                            error: function (errors) {
                            }
                        });
                    }
                });

                $(document).on("click", "#resalloclinkind", function (event) {
                    var dnum = $(this).find('#resalloclinkinddnum').html();
                    var ftext = $(this).text();
                    var fname = ftext.substring(7);

                    var flag = 5;

                    var val = '<?php echo $team_color; ?>';

                    /*Ajax Request*/
                    $.ajax({
                        type: "post",
                        url: 'teamajax.php',
                        data: {
                            'val': val,
                            'dnum': dnum,
                            'fname': fname,
                            'flag': flag
                        },
                        success: function (response) {
                            $("#modpopup").html("");
                            $("#modpopup").append(response);
                            $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
                            $("#dummylnk").click();
                        },
                        error: function (errors) {
                            swal({
                                title: "Portal Info",
                                text: "some issue, please reach out to Admin",
                                icon: "error",
                            });
                        }
                    });

                });

                $(document).on("click", "#newallocmodpop", function (event) {
                    var modpoppn = $('#resallocatepnmp').val();
                    var modpopft = $('#resallocateftmp').val();
                    var modpopen = $('#resallocateenmp').val();
                    var modpoppp = $('#resallocateppmp').val();
                    var modpopnw = $('#resallocatenwmp').val();
                    var modpoppr = $('#resallocateprmp').val();
                    var modpopsd = $('#resallocatesdmp').val();
                    var modpoped = $('#resallocateedmp').val();

                    var modpopdnum = $('#allocatednum').html();

                    var flag = 6;

                    //validation for all the field
                    //validate team
                    if (modpoppn === "" || modpoppn === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Project Name",
                            icon: "error",
                        });
                    } else if (modpopft == "" || modpopft === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Feature Team",
                            icon: "error",
                        });
                    } else if (modpopen == "" || modpopen === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Engine",
                            icon: "error",
                        });
                    } else if (modpoppp == "" || modpoppp === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Project POC",
                            icon: "error",
                        });
                    } else if (modpopnw == "" || modpopnw === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide NWA",
                            icon: "error",
                        });
                    } else if (modpoppr == "" || modpoppr === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Allocation Percentage",
                            icon: "error",
                        });
                    } else if (modpopsd == "" || modpopsd === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide Satrt Date",
                            icon: "error",
                        });
                    } else if (modpoped == "" || modpoped === " ") {
                        swal({
                            title: "Portal Info",
                            text: "Please provide End date",
                            icon: "error",
                        });
                    } else {
                        /*Ajax Request*/
                        $.ajax({
                            type: "post",
                            url: 'teamajax.php',
                            data: {
                                'modpoppn': modpoppn,
                                'modpopft': modpopft,
                                'modpopen': modpopen,
                                'modpoppp': modpoppp,
                                'modpopnw': modpopnw,
                                'modpoppr': modpoppr,
                                'modpopsd': modpopsd,
                                'modpoped': modpoped,
                                'modpopdnum': modpopdnum,
                                'flag': flag
                            },
                            success: function (response) {
                                if (response == 1) {
                                    $('#addresourcemod').modal('toggle');
                                    swal({
                                        title: "Portal Info",
                                        text: "Allocation is successful",
                                        icon: "success",
                                    });
                                } else {
                                    swal({
                                        title: "Portal Info",
                                        text: "some issue, please reach out to Admin",
                                        icon: "error",
                                    });
                                }
                            },
                            error: function (errors) {
                                swal({
                                    title: "Portal Info",
                                    text: "some issue, please reach out to Admin",
                                    icon: "error",
                                });
                            }
                        });
                    }
                });

                function validateEmail(email) {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                }
            });


        </script>

    </head>

    <body class="home">
    <header>
        <nav class="navbar navbar-expand-lg bgteam">
            <div class="page-title" style="opacity: 1 !important; ">
                <a href="home.php" rel="home"><img src="img/logo.png" alt="Logo"
                                                   style=" height: 40px;width: 35px; opacity: 1 !important; ">
                    <span style="font-family: sans-serif !important;font-size: 20px !important;font-weight: bold !important;font-style: normal !important;font-stretch: normal !important;line-height: normal !important;letter-spacing: 1px !important; color:white !important; opacity: 1 !important;">&nbsp;&nbsp;L&SS Resource Directory
					</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style='margin-left:30%'>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href=""></a>
                    </li>&nbsp;
                    <li class="nav-item">
                        <a href=""></a>
                    </li>&nbsp;
                    <li class="nav-item">
                        <a href=""></a>
                    </li>&nbsp;
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post">
                    <h6 style="margin:0;">Welcome <a href='resource.php'
                                                     style='color:white; font-weight:bold; '><?php echo $_SESSION['fullname']; ?></a>
                    </h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit" name="logout" id="logout">Logout</button>
                </form>
            </div>
        </nav>
    </header>
    <?php
    $pcount = 20;
    $ecount = 30;
    $ccount = 70;
    $etcount = 80;
    $bocount = 90;
    $available = 10;
    ?>

    <table class="tncellspace"
           style=" width:100%; height:100%; background-color: transparent ; border: none !important; border-radius:10px; border-spacing: 0px; table-layout:fixed">
        <tbody>
        <tr style=" border: none !important; margin : 0px">
            <td style="text-align:center; color: white; padding:0; border: none ;  width:20% ;background: #f0f0f5; overflow:hidden ">
                <table class="tncellspace"
                       style="background-color: transparent; border-spacing: 0px; border: none !important; border-radius:10px; width:100%; height:100%; ">
                    <tbody>
                    <tr style="text-align:center;  border: none; height:30%;">
                        <td style="text-align:center; padding:0; border: none; ">
                            </br></br></br></br>
                            <img src="img/profile_photo.png" alt="Avatar" class="avatar">
                            </br>
                            <span style='text-align:center; font-size: 1.25rem; color: <?php echo $team_color; ?>;'> <?php echo $leadname; ?> </span></br>
                            <span style='text-align:center; font-size: .7rem; color: <?php echo $team_color; ?>;'> <?php echo $leadrole; ?> </span>
                        </td>
                    </tr>
                    <tr style="  border: none; height:70%;">
                        <td style="border: none ;padding:0; opacity: 0.7; text-align:top" valign="top">
                            </br>
                            &nbsp;<span style='font-size: 1rem; padding-bottom:8px;'><a class='leftpanea active'
                                                                                        href="#" id="livestatlink"> &nbsp;&nbsp;Live Status &nbsp;  </a></span></br>
                            &nbsp;<span style='font-size: 1rem; padding-bottom:8px;'><a class='leftpanea' href="#"
                                                                                        id="addresourlink"> &nbsp;&nbsp;Add New Resource &nbsp; </a></span></br>
                            &nbsp;<span style='font-size: 1rem; padding-bottom:8px;'><a class='leftpanea' href="#"
                                                                                        id="searchrlink"> &nbsp;&nbsp;Search Resource &nbsp; </a></span></br>
                            &nbsp;<span style='font-size: 1rem; padding-bottom:8px;'><a class='leftpanea' href="#"
                                                                                        id="Requestreslink"> &nbsp;&nbsp;Request Management &nbsp;  </a></span></br>
                            &nbsp;<span style='font-size: 1rem; padding-bottom:8px;'><a class='leftpanea' href="#"
                                                                                        id="Managealloclink"> &nbsp;&nbsp;Manage Allocations &nbsp;  </a></span></br>
                            &nbsp;<span style='font-size: 1rem; padding-bottom:8px;'><a class='leftpanea' href="#"
                                                                                        id="reportlink"> &nbsp;&nbsp;Report Resource &nbsp; </a></span></br>

                        </td>
                    </tr>

                    </tbody>
                </table>
            </td>
            <td style="text-align:center;  padding:0px ; border: none ;border-radius:40px !important ; width:80% ; overflow:hidden  "
                valign="top">

                <div id="livestat" name="livestat" style='padding-top:60px'>
                    <h4 style=" font-family: Akkurat;
                											font-size: 36px;
                											font-weight: bold;
                											font-style: normal;
                											font-stretch: normal;
                											line-height: normal;
                											letter-spacing: normal;
                											color: grey; "> Resource Status </h4>

                    <hr style="margin:0"></hr>
                    <table class="tcellspace" style="text-align:center; width:100%;">
                        <tbody>
                        <tr style="text-align:center; height:70%">
                            <td style='text-align:center; color: white; padding:5px; border: none; border-radius:10px; height:20%; width:10%; font-size:100px;background:none;opacity:0.7;vertical-align:middle;'>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <hr style="margin:0"></hr>
                    </br>
                    <span> Active Projects </span>
                </div>

                <div id="searchr" name="searchr" style='display:none;padding-top:60px'>
                    <h4 style=" font-family: Akkurat;
											font-size: 36px;
											font-weight: bold;
											font-style: normal;
											font-stretch: normal;
											line-height: normal;
											letter-spacing: normal;
											color: grey; "> Search a resource </h4>
                    <hr style="margin:0"></hr>
                    <table style="text-align:center;width:100%">
                        <tbody>
                        <tr style="text-align:center; height:10%">
                            <span style="text-align:center;font-size:26px"></span>
                            </br></br>
                        </tr>
                        <tr style="text-align:center; height:20%" align="center">
                            <td style='width:20%'></td>
                            <td style='width:60%'>
                                <div class="input-group" style='width:100%;'>
                                    <input class="form-control my-0 py-1 red-border" type="text"
                                           placeholder="Search by Name, UserId, Skills" aria-label="Search"
                                           style='float:center' id='searchval' name='searchval'>
                                    <div class="input-group-append">
                                        <span class="input-group-text red lighten-3" id="basic-text1"><a href="#"
                                                                                                         id="searchlnki"
                                                                                                         name="searchlnki"
                                                                                                         class="fa fa-search text-grey"
                                                                                                         aria-hidden="true"></a></span>
                                    </div>
                                </div>
                            </td>
                            <td style='width:20%'></td>
                        </tr>
                        <tr style="text-align:center; height:10%">
                            <td style='width:20%'></td>
                            <td style='width:60%'></td>
                            <td style='width:20%'></td>
                        </tr>
                        <tr style="text-align:center; height:60%">
                            <td style='width:20%'></td>
                            <td style='width:60%'>
                                <div id='appneddata' style='height:400px;overflow-y:auto'></div>
                            </td>
                            <td style='width:20%'></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div id="addresour" name="addresour" style="display:none; padding-top:60px">

                    <form id="regFormaddresou" class="regForm">
                        <h4 style=" font-family: Akkurat;
                                font-size: 36px;
                                font-weight: bold;
                                font-style: normal;
                                font-stretch: normal;
                                line-height: normal;
                                letter-spacing: normal;
                                color: white; background : <?php echo $team_color; ?>; opacity:.5 ;border-radius: 2px;">
                            Add new resource </h4>

                        <!-- One "tab" for each step in the form: -->

                        <div class="tab" name="basinfo" id="basinfo" align="center" style="display:block">
                            <table style="table-layout:auto;width:75%;">
                                <tr><h5 style="color:grey;padding: 15px;"> Enter basic information</h5></tr>
                                <tr>
                                    <td>
                                        <div class="field">
                                            <input type="text" name="dnum" id="dnum" placeholder="c/dxxxxxx">
                                            <label for="dnum">Enter Dnumber...</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <input type="number" name="empid" id="empid" placeholder="3/4xxxxxxx">
                                            <label for="empid">Enter Employee Number...</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            </br>
                            <table style="table-layout:auto;width:75%;">
                                <tr>
                                    <td>
                                        <div class="field">
                                            <input type="text" name="name" id="name" placeholder="Fname Lname">
                                            <label for="name">Enter Full Name...</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <input type="email" name="email" id="email"
                                                   placeholder="Fname.Lname@team.telstra.com">
                                            <label for="email">Enter Email Address...</label>
                                        </div>

                                    </td>
                                </tr>
                            </table>
                            <table style="table-layout:auto;width:75%;">
                                <tr>
                                    <td style=" width: 50%;">
                                        <div class='field'>
                                            <select name="loc" id="loc" style="width: 100%;border:0px;outline:0px;">
                                                <option value="" disabled="" selected="">Select Location</option>

                                            </select>
                                            <label for="loc">Select Location</label>
                                        </div>
                                    </td>
                                    <td style=" width: 50%;">
                                        <div class='field'>
                                            <select name="role" id="role"
                                                    style="width: 100%;border:0px;outline:0px;">
                                                <option disabled="" selected="">Select Role</option>

                                            </select>
                                            <label for="loc">Select Role</label>
                                        </div>
                                    </td>

                                </tr>
                            </table>

                            <table align="center" style="table-layout:auto;width:25%;">
                                <tr>
                                    <td style="padding:0 !important;"></br>
                                        <div class='field'>
                                            <select name="specialization" id="specialization"
                                                    style="width: 100%;border:0px;outline:0px;">
                                                <option disabled="" selected="">Select Specialization</option>

                                            </select>
                                            <label for="loc">Select Specialization</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab" name="tminfo" id="tminfo" align="center" style="display:none">

                            <table style="table-layout:auto;width:75%;">
                                <tr><h5 style="color:grey;padding: 15px;"> Enter team information</br></h5></tr>
                                <tr>
                                    <td style="padding: 15px;" width="50%">
                                        <select name="team" id="team" style="width: 100%;border:0px;outline:0px;">
                                            <option selected>Select Team</option>

                                        </select>
                                    </td>
                                    <td style="padding: 15px;" width="50%">
                                        <select name="stream" id="stream"
                                                style="width: 100%;border:0px;outline:0px;">
                                            <option selected>Select Sub Stream</option>

                                        </select>
                                    </td>
                                </tr>
                            </table>
                            </br>
                            <table style="table-layout:auto;width:75%;">
                                <tr>
                                    <td style="padding: 15px;" width="50%">
                                        <select name="dirreport" id="dirreport"
                                                style="width: 100%;border:0px;outline:0px;">
                                            <option selected>Select Reporting Manager</option>

                                        </select>
                                    </td>
                                    <td style="padding: 15px;" width="50%">
                                        <select name="pexmanager" id="pexmanager"
                                                style="width: 100%;border:0px;outline:0px;">
                                            <option selected>Select PEX Manager</option>

                                        </select>
                                    </td>
                                </tr>
                            </table>
                            </br>
                            <table style="table-layout:auto;width:75%;">
                                <tr>
                                    <td style="padding: 15px; width: 50%;">
                                        <select name="org" id="org" style="width: 100%;border:0px;outline:0px;">
                                            <option selected>Select Organization</option>

                                        </select>
                                    </td>
                                    <td style="padding: 15px; width: 50%;">
                                        <select name="peel" id="peel" style="width: 100%;border:0px;outline:0px;">
                                            <option selected>Select Peel(Yes/No)</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            </br>
                            <table align="center" style="table-layout:auto;width:25%;">
                                <tr>
                                    <td style="padding:0 !important;"><input id='reldate' name='reldate'
                                                                             class='datepicker' type='text'
                                                                             placeholder='Release Date'></input>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </br>
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" id="prevBtn"
                                        style="background-color:green;color:white;display:none">Previous
                                </button>
                                <button type="button" id="nextBtn" style="background-color:green;color:white">Next
                                </button>
                                <button type="button" id="subBtn"
                                        style="background-color:green;color:white;display:none">Submit
                                </button>
                            </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <div style="text-align:center;">
                            <span id="step1" class="step active"></span>
                            <span id="step2" class="step"></span>
                        </div>
                    </form>
                    <form id="infodiv" class="regform"
                          style="box-shadow: 0 15px 20px rgba(0, 0, 0, 0.5); border-radius:6px;display:none">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-8" align="center">
                                <a><i class="fa fa-check-circle" style='color:green;font-size:25px'></i> User has
                                    been
                                    added successfully in L&SS Portal and mail has been sent to user with
                                    credentials</a><br>
                            </div>
                            <div class="col"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col" align="center">
                                <a href="addresource.php">Add another user</a>
                            </div>
                            <div class="col" align="center">
                                <a href="resource.php">Go to Resource page</a>
                            </div>
                            <div class="col" align="center">
                                <a href="home.php">Go to Home</a>
                            </div>
                            <div class="col"></div>
                        </div>
                    </form>
                </div>

                <div id="Requestres" name="Requestres"
                     style="display:none; padding-left:20px; padding-right:20px;padding-top:60px ">

                    <div id="Requestreqsdetails" style="text-align:center; display:block ;">
                        <h4 style=" font-family: Akkurat;
												font-size: 36px;
												font-weight: bold;
												font-style: normal;
												font-stretch: normal;
												line-height: normal;
												letter-spacing: normal;
												color: grey; "> Resource Allocation Requests </h4>
                        <div style="text-align:center; display:block ; height:80vh; overflow: auto !important">
                            <table class='table' style="text-align:center; width:100% ; " id='reqtable'>
                                <thead style="overflow: auto; ">
                                <tr style="text-align:center; height:45px ; position: relative; ">
                                    <td colspan='7'>
                                    </td>
                                    <td>
                                        <a href='#' id='sfilter' name='sfilter'><i
                                                    class='fa fa-eye fa-fw'></i>Filters</a>
                                    </td>
                                </tr>
                                </thead>
                                <thead style="overflow: auto; ">
                                <tr style="position: relative; ">
                                    <th style='width:15%'>Feature Team</th>
                                    <th style='width:15%'>Engine</th>
                                    <th style='width:15%'>Project name</th>
                                    <th style='width:15%'>Project POC</th>
                                    <th style='width:10%'>Start Date</th>
                                    <th style='width:10%'>End Date</th>
                                    <th style='width:10%'>Status</th>
                                    <th style='width:10%'><a href='#' id='regFormaddresqlink'
                                                             name='regFormaddresqlink'
                                                             style='color:green'><i class='fa fa-plus fa-fw'></i>Request</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody style="overflow: auto; ">
                                <tr id='reqfilter' style='display:none'>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><input style='text-align: center !important; width:100%'/></td>
                                    <td><a href='#' id='clrfilter' name='clrfilter'><i
                                                    class='fa fa-eye-slash fa-fw'></i>Filters</a></td>
                                </tr>
                                <tr>
                                    <td id='objid' style='display:none'>" . $row["objid"] . "</td>
                                    <td>" . $row["featureteam"] . "</td>
                                    <td>" . $row["engine"] . "</td>
                                    <td>" . $row["projectname"] . "</td>
                                    <td>" . $row["projectpoc"] . "</td>
                                    <td>" . $row["startdate"] . "</td>
                                    <td>" . $row["enddate"] . "</td>
                                    <td>" . $row["status"] . "</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="regFormaddresq" style="display:none">


                        <!-- One "tab" for each step in the form: -->
                        <form class="regForm">
                            <h4 style=" font-family: Akkurat;
                                    font-size: 36px;
                                    font-weight: bold;
                                    font-style: normal;
                                    font-stretch: normal;
                                    line-height: normal;
                                    letter-spacing: normal;
                                    color: white; background : <?php echo $team_color; ?>; opacity:.5 ;border-radius: 2px; ">
                                Create request </h4>
                            <hr style="margin:0"></hr>
                            <div class="tab" name="basinfo" id="basinfo" align="center" style="display:block">
                                <table style="table-layout:auto;width:75%;">
                                    <tr><h5 style="color:grey;padding: 15px;"> Enter Request information</br></h5>
                                    </tr>
                                    <tr style="padding: 15px !important;">
                                        <td>
                                            <div class="field">
                                                <input type="text" name="fteamin" id="fteamin"
                                                       placeholder="Feature Team...">
                                                <label for="fteamin">Feature Team...</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="field">
                                                <input type="text" name="pnamein" id="pnamein"
                                                       placeholder="Project name...">
                                                <label for="pnamein">Project name...</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="padding: 15px !important;">
                                        <td>
                                            <div class="field">
                                                <input type="text" name="engin" id="engin" placeholder="Engine...">
                                                <label for="engin">Engine...</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="field">
                                                <input type="text" name="ppocin" id="ppocin"
                                                       placeholder="Project POC...">
                                                <label for="ppocin">Project POC...</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="padding: 15px !important;">
                                        <td>
                                            <div class="field">
                                                <input name="irin" id="irin" placeholder="IR no...">
                                                <label for="irin">IR no...</label>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="field">
                                                <input type="text" name="nwain" id="nwain" placeholder="NWA...">
                                                <label for="nwain">NWA...</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="padding: 15px !important;">
                                        <td>
                                            <div class="field">
                                                <input class='datepicker' type="text" name="sdatein" id="sdatein"
                                                       placeholder='Start Date...'>
                                                <label for="sdatein">Start Date...</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="field">
                                                <input class='datepicker' type="text" name="edatein" id="edatein"
                                                       placeholder='End Date...'>
                                                <label for="edatein">End Date...</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <br>

                            </div>


                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <a href='#' id="Requestreqsdetailslinkcancel">
                                        <button type="button"
                                                style="background-color:#f7a438 !important; color:white;">
                                            Cancel
                                        </button>
                                    </a>&nbsp; &nbsp;
                                    <a href='#' id="Requestreqsdetailslink">
                                        <button type="button" style="background-color:green;color:white;"> Save
                                        </button>&nbsp;
                                        &nbsp; </a>
                                    <a href='#' id="regFormaddresqallocreslink">
                                        <button type="button" style="background-color:green;color:white"> Save &
                                            Allocate
                                        </button>
                                    </a>
                                    <button type="button" style="background-color:green;color:white;display:none">
                                        Allocate
                                    </button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>

                    <div id="regFormaddresqallocres" style=" display:none">

                        <form class="regForm" style=" width: 100% !important;">
                            <h4 style=" font-family: Akkurat;
                                    font-size: 36px;
                                    font-weight: bold;
                                    font-style: normal;
                                    font-stretch: normal;
                                    line-height: normal;
                                    letter-spacing: normal;
                                    color: white; background : <?php echo $team_color; ?>; opacity:.5 ;border-radius: 2px; ">
                                Resource Allocation </h4>
                            <hr style="margin:0"></hr>

                            <!-- One "tab" for each step in the form: -->
                            <div class="tab" name="basinfo" id="basinfo" align="center" style="display:block">
                                <table style="width:80%;" id='resallocatetable'>
                                    <thead>
                                    <tr style="border-bottom: 1px solid #eaeef0;">

                                        <th colspan='6'>
                                            <br>
                                            <h5 class='w3-text-grey' style="color:grey;"><i
                                                        class='fa fa-info fa-fw w3-margin-right w3-text-teal'></i><b>Request
                                                    Details </b> &nbsp;&nbsp;Project Name&nbsp;:&nbsp;<span
                                                        id='pnamespan'></span> &nbsp;&nbsp;<i
                                                        class='fa fa-calendar fa-fw w3-margin-right'></i>Duration&nbsp;:&nbsp;<span
                                                        id='startdatespan'></span></h5>

                                            <br>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="padding: 10px !important;">
                                        <td style="padding: 5px; width: 20% !important;">
                                            <div class="field">
                                                <input type="text" id='resallocateresnamein'
                                                       name='resallocateresnamein[]' size="30"
                                                       placeholder="Resource Name...">
                                                <label for="resallocateresnamein">Resource Name...</label>
                                            </div>
                                        </td>
                                        <td style="padding: 5px; width: 15% !important;">
                                            <div class="field">
                                                <input class='datepicker' type='text' id='resallocatesdin'
                                                       name='resallocatesdin[]' size="15"
                                                       placeholder='Start Date...'>
                                                <label for="resallocatesdin">Start Date...</label>
                                            </div>

                                        </td>
                                        <td style="padding: 5px; width: 15% !important;">

                                            <div class="field">
                                                <input class='datepicker' type='text' size="15"
                                                       placeholder='End Date...' id='resallocateedin'
                                                       name='resallocateedin[]'>
                                                <label for="resallocateedin">End Date...</label>
                                            </div>
                                        </td>
                                        <td style="padding: 5px; width: 10% !important;">
                                            <div class="field">
                                                <input type='number' size="8" placeholder="Percentage..."
                                                       id='resallocperin' name='resallocperin[]'>
                                                <label for="resallocperin">Percentage...</label>
                                            </div>
                                        </td>
                                        <td style="padding: 5px; width: 30% !important;">
                                            <div class="field">
                                                <input type='text' size="5" placeholder="Message..."
                                                       id='resalloccomin'
                                                       name='resalloccomin[]'>
                                                <label for="resalloccomin">Message...</label>
                                            </div>
                                        </td>
                                        <td style="width: 10% !important;" id='addresourceplustd'><a href="#"
                                                                                                     style='color:green'
                                                                                                     id='resallocate'><i
                                                        class='fa fa-plus fa-fw'></i></a></td>
                                    </tr>
                                    <tbody>
                                </table>
                                <br><br>
                            </div>
                            </br>
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <a href='#' id="reqallocresourcecancel">
                                        <button type="button"
                                                style="background-color:#f7a438 !important; color:white;">
                                            Cancel
                                        </button>
                                    </a>&nbsp; &nbsp;
                                    <a href='#' id='Requestreqsdetailslinks'>
                                        <button type="button" style="background-color:green;color:white">Allocate
                                            and
                                            Submit
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>

                <div id="Managealloc" name="Managealloc" class="row"
                     style="display:none; padding-left:20px; padding-right:20px;padding-top:60px;  ">
                    <h4 style=" font-family: Akkurat;
											font-size: 36px;
											font-weight: bold;
											font-style: normal;
											font-stretch: normal;
											line-height: normal;
											letter-spacing: normal;
											color: grey; "> Manage Resource Allocations </h4>
                    <div id='alforcast' name='alforcast' style='height:75vh; overflow: auto !important;'>

                        <table class="table" style=' width:95%; border-spacing: 2px !important;'>
                            <thead>
                            <tr>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 28%'>
                                    Name
                                </th>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 12%'>
                                    $a1mon
                                </th>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 12%'>
                                    $a2mon
                                </th>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 12%'>
                                    $a3mon
                                </th>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 12%'>
                                    $a4mon
                                </th>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 12%'>
                                    $a5mon
                                </th>
                                <th style='text-align: center !important; border-right:1px solid #dee2e6; !important; width: 12%'>
                                    $a6mon
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style='text-align: center !important; border-bottom:1px solid #dee2e6 !important; padding:5px'
                                    align='center'><a href='#' id='resalloclinkind'><span style='display:none'
                                                                                          id='resalloclinkinddnum'></span></a>
                                </td>

                                <td style='background-color:green; border-radius: 30px;' align='center'><a href='#'
                                                                                                           style='color:green;width:100%'>
                                        <div style='color:green'>1</div>
                                    </a></td>

                                <td style='background-color:#da9645; border-radius: 30px;' align='center'><a
                                            href='#'
                                            style='color:#da9645;width:100%'>
                                        <div style='color:#da9645'>1</div>
                                    </a></td>

                                <td style='background-color:red; border-radius: 30px;' align='center'><a href='#'
                                                                                                         style='color:red;width:100%'>
                                        <div style='color:red'>1</div>
                                    </a></td>

                                <td style='background-color:transparent' align='center'><a href='#'
                                                                                           style='color:grey;width:100%'>
                                        <div style='color:transparent'>1</div>
                                    </a></td>
                                </td>

                                </td></tr>

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class='col' align='center' style=' width: 100%'>
                        <table id='legend' style=' width:70%;  margin-left: 230px !important'>
                            <tbody>
                            <tr>

                                <td style='background-color:grey;border-top-left-radius:10px !important;border-bottom-left-radius:10px !important;'
                                    align='center'><a style='color:black;width:0%'>0% Available</a></td>
                                <td style='background-color:red' align='center'><a style='color:black;width:100%'>Allocated
                                        less than 50%</a></td>
                                <td style='background-color:#da9645' align='center'><a
                                            style='color:black;width:100%'>Allocated
                                        between 50% to 99%</a></td>
                                <td style='background-color:Green;border-top-right-radius:10px !important;border-bottom-right-radius:10px !important'
                                    align='center'><a style='color:black;width:100%'>100% Allocated</a></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!--                ########################-->
                <!--                ### Yu Report tab  start-->
                <!--                # New Feature from 12.06.2019-->
                <?php
                if ($profile == 1) {
                    $pName = "L&SS";
                    $eName = "Capability Teams";
                    $cName = "Practices Teams";
                    $etName = "S&O";
                    $boName = "Bus Ops";
                    $aName = "Available";
//                    #####Special
                    {
                        $ecount1 = 10;
                        $ecount2 = 10;
                        $ecount3 = 5;
                        $ecount4 = 5;
                        $ccount1 = 20;
                        $ccount2 = 20;
                        $ccount3 = 30;

                    }
                } else if ($profile == 2 or $profile == 3 or $profile == 4 or $profile == 5) {
                    $pName = "Engine";
                    $eName = "FP";
                    $cName = "NFP";
                    $etName = "Release Orch";
                    $boName = "Others";
                    $aName = "Available";
                } else if ($profile == 6 or $profile == 7 or $profile == 8 or $profile == 9 or $profile == 10) {
                    $pName = "Practice";
                    $eName = "C&SB";
                    $cName = "Enterprise";
                    $etName = "InfraCo";
                    $boName = "ALM";
                    $aName = "Available";
                }
                $tab3 = array(
                    array("label" => $pName, "value" => ($pcount), "color" => "#4daf4a"),
                    array("label" => "$eName", "value" => ($ecount), "color" => "#377eb8"),
                    array("label" => "$cName", "value" => ($ccount), "color" => "#ff7f00"),
                    array("label" => "$etName", "value" => ($ecount), "color" => "#ff134c"),
                    array("label" => "$boName", "value" => ($bocount), "color" => "#e7ba52"),
                    array("label" => "$aName", "value" => ($available), "color" => "#f781bf"),
                );
                $lss_tab = array(
                    array("practiceTeam" => $pName, "init" => ($pcount), "C&SB" => 0, "Enterprise" => 0, "Infra Co" => 0,
                        "ALM" => 0, "Functional" => 0, "Non Functional" => 0, "Orchestration" => 0, "Total" => ($pcount)),
                    array("practiceTeam" => "$eName", "init" => 0, "C&SB" => $ecount1, "Enterprise" => $ecount2,
                        "Infra Co" => $ecount3, "ALM" => $ecount4, "Functional" => 0, "Non Functional" => 0, "Orchestration" => 0, "Total" => ($ecount)),
                    array("practiceTeam" => "$cName", "init" => 0, "C&SB" => 0, "Enterprise" => 0, "Infra Co" => 0,
                        "ALM" => 0, "Functional" => $ccount1, "Non Functional" => $ccount2, "Orchestration" => $ccount3, "Total" => ($ccount)),
                    array("practiceTeam" => "$etName", "init" => ($ecount), "C&SB" => 0, "Enterprise" => 0, "Infra Co" => 0,
                        "ALM" => 0, "Functional" => 0, "Non Functional" => 0, "Orchestration" => 0, "Total" => ($ecount)),
                    array("practiceTeam" => "$boName", "init" => ($bocount), "C&SB" => 0, "Enterprise" => 0, "Infra Co" => 0,
                        "ALM" => 0, "Functional" => 0, "Non Functional" => 0, "Orchestration" => 0, "Total" => ($bocount)),
                    array("practiceTeam" => "$aName", "init" => ($available), "C&SB" => 0, "Enterprise" => 0, "Infra Co" => 0,
                        "ALM" => 0, "Functional" => 0, "Non Functional" => 0, "Orchestration" => 0, "Total" => ($available)),
                );
                $new_key = ["init" , "C&SB", "Enterprise", "Infra Co","ALM", "Functional", "Non Functional", "Orchestration",];


                $sum_tab3 = ($pcount + $ecount + $ccount + $ecount + $bocount + $available);
                ?>
                <script>
                    if (pick === 1) {
                        var lss_tab = (<?php echo json_encode($lss_tab, JSON_NUMERIC_CHECK); ?>);
                        var new_key = (<?php echo json_encode($new_key, JSON_NUMERIC_CHECK); ?>);

                    }
                    var newTab = (<?php echo json_encode($tab3, JSON_NUMERIC_CHECK); ?>);
                    var sum_tab3 = (<?php echo json_encode($sum_tab3, JSON_NUMERIC_CHECK); ?>);
                </script>
                <!--                # New Feature End 12.06.2019-->

                <div id="report" name="report" style="display:none; padding-top:60px" onload="pureTest()">
                    <div class="container">
                        <div class="w3-row row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <a href="javascript:void(0)" onclick="openTab(event,0)" id="tab_title tag01">
                                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">
                                        Peel
                                        Service
                                    </div>
                                </a>
                                <a href="javascript:void(0)" onclick="openTab(event,1)" id="tab_title tag_02">
                                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Location
                                    </div>
                                </a>
                                <a href="javascript:void(0)" onclick="openTab(event,2)" id="tab_title tag_03">
                                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Disable
                                    </div>
                                </a>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                    <input id="toggle-event" type="checkbox" data-on="Bar Chart" data-off="Pie Chart"
                           checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="150"
                           data-height="34">
                    <br>
                    <div id="console-event"> Slide to display the graph</div>
                    <!--                    <h1 style="font-size:2vw;">PeelService Report</h1>-->
                    <div class="container" id="chart_style">
                        <div class="row">
                            <div class="col-12" id="pie_chart" style="display: none"></div>
                            <div class="col-12" id="bar_chart" style="display: block"></div>
                            <div class="col-12" id="new_chart" style="display: none"></div>
                        </div>
                    </div>
                </div>

                <!--                ########################-->


            </td>
        </tr>
        </tbody>
    </table>
    <div id='modpopup'>
    </div>
    <a href='#' data-target='#addresourcemod' data-toggle='modal' id='dummylnk' name='dummylnk'
       style='display:none'></a>
    </body>
    </html>

<?php
if (isset($_POST['logout'])) {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    echo '<script type="text/javascript">window.location = "login.php"</script>';
}
/*if(isset($_POST['irsubmit']))
    {
        header('Location: irpage.php');
    }*/
?>
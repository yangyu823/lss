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


$sql = "SELECT COUNT(IF(execution='execution',1, NULL)) 'Execution',
COUNT(IF(execution='services' AND peelService='Yes',1, NULL)) 'Yes',
COUNT(IF(execution='services' AND peelService='No',1, NULL)) 'No',
COUNT(IF(execution='services' AND peelService='NA',1, NULL)) 'NA' 
FROM lss_employee_profile GROUP BY practiceTeam";
//$result = $conn->query($sql);
$result = mysqli_query($conn, $sql);
//while ($row = $result->fetch_assoc()) {
//    echo $row['Yes'];
//}
$row = $result->fetch_assoc();


// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <script>
        var data = (<?php echo json_encode($row, JSON_NUMERIC_CHECK); ?>);
    </script>
</head>
<body>
<script>
    console.log(data)
</script>
<h1>This is a Heading</h1>
<p>This is a paragraph.</p>

</body>
</html>


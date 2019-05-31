<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="yu.css" rel="stylesheet">

<body>

<div class="w3-container">
    <h2>Tabs in a Grid</h2>

    <div class="w3-row">
        <a href="javascript:void(0)" onclick="openTab(event)" id="tab_title">
            <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">London</div>
        </a>
        <a href="javascript:void(0)" onclick="openTab(event)" id="tab_title">
            <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Paris</div>
        </a>
        <a href="javascript:void(0)" onclick="openTab(event)" id="tab_title">
            <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Tokyo</div>
        </a>
    </div>
</div>

<script>
    function openTab(evt) {
        var i, tablinks;
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        }
        evt.currentTarget.firstElementChild.className += " w3-border-red";
    }
</script>

</body>
</html>
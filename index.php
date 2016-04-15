<?php require_once("config.php");  ?>
<!DOCTYPE html>
<html lang="nl">
<head> 
	<meta name="description" content="gstar kleding">
	<meta name="keywords" content="gstar, kleding, door, komma's">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="icon" type="image/png" href="favicon.ico">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/mobile.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="js/main.js"></script>
	<title>g-star</title>
</head>
<body>
<header>
<a href="?">
<img class="mobilelogo" src="images/mobile.png" />
<img class="logo" src="images/logo.png" />
</a>
</header>
<nav>
<li><h1>Menu</h1></li>
<li><a href="?page=artikelen">artikelen</a></li>
<li><a href="?page=type" >artikelen per type</a></li>
<li><a href="?page=facturen">facturen</a></li>
<li><a href="?page=onbetaald">niet betaalde facturen</a></li>
<li><a href="?page=factuurperdatum">factuur per datum</a></li>
<li><a href="?page=klanten">klanten</a></li>
<li><a href="?page=klantenzoeken">klanten zoeken</a></li>
<li><a href="?page=uitverkocht">uitverkocht</a></li>
<li><a href="?page=zoeken">artikelen zoeken</a></li>
<div class="clear">.</div>
</nav>

<article>

<?php
if(isset($_GET['page'])){
$p = $_GET['page'];
switch ($p) {
    case "artikelen":
        include("artikelen.php");
        break;
    case "klanten":
        include("klanten.php");
        break;
    case "zoeken":
        include("artikelzoeken.php");
        break;
    case "type":
        include("artikelenpertype.php");
        break;
    case "klantenzoeken":
        include("klantenzoeken.php");
        break;
    case "onbetaald":
        include("factuurnietbetaald.php");
        break;
    case "facturen":
        include("facturen.php");
        break;
    case "factuurperdatum":
        include("factuurperdatum.php");
        break;
    case "factuurperklant":
        include("factuurperklant.php");
        break;
    case "uitverkocht":
        include("uitverkocht.php");
        break;
    case "maps":
        include("maps.php");
        break;
	default:
		include("home.php");
}
}else{
include("home.php");
}

 ?>
</article>
<div class="clear">.</div>
<footer>
<a href="?" class="gstar">G-Star raw&copy;</a>
<span class="by">designed by Damian Fonville</span>
</footer>
</body>
</html>
	
 <script>
$(function() {
$( "#date" ).datepicker({
showOtherMonths: true,
selectOtherMonths: true,
dateFormat: "yy-mm-dd"
});
$("#date").change(function(){
$("#form").submit();
});

});
</script>
<?php if(!isset($_GET['date'])){ $_GET['date'] = date("Y-m-d"); } ?> 
<h1>Facturen per datum</h1>
<form method="get" action="" id="form">
<span for="date">Datum: </span><input type="text" id="date" style="width:75px;cursor:pointer;" name="date" value="<?php echo $_GET['date']; ?>"/>
<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
</form>

<?php
echo "<h2>facturen van ".$_GET['date']."</h2>";
?>
<?php

function artikel($artikelnr){
global $db;
$query = $db->prepare("SELECT naam, prijs FROM artikel WHERE artikelnummer = ?");
$query->bindValue(1, $artikelnr, PDO::PARAM_INT);
$query->execute();
$count = $query->rowCount();
if($count > 0){
return $query->fetch(PDO::FETCH_ASSOC);
}else{
return false;
}
}


// alle facturen

$sth = $db->prepare("SELECT * FROM factuur, klanten WHERE klanten.klantnr = factuur.klantnr and datum = ? ORDER BY datum DESC");
$sth->bindValue(1, $_GET['date'], PDO::PARAM_STR);
$sth->execute();
if($sth->rowCount() > 0){
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
$totaal = 0;
$artikelen = explode(",", $result['artikelnummer']);
$nummers = array_count_values($artikelen);
echo "<div class=\"artikel\"><h3>(".$result['factuurnr'].") ".$result['vnaam']." ".$result['anaam']." - ".$result['datum']."</h3>\n";
echo "<table style=\"width:100%\">\n";
foreach($nummers as $artikelnummer => $aantal){
$artikelinfo = artikel($artikelnummer);
if($artikelinfo != false){
$totaalprijsproduct = $artikelinfo['prijs'] * $aantal;
echo "<tr>";
echo "<td style=\"colspan:2;\">".$artikelinfo['naam']."</td><td></td>\n";
echo "<td>".$aantal."X</td>";	
echo "<td>&euro; ".number_format($totaalprijsproduct, 2, ',', '.')."</td>\n";	
echo "</tr>";	
$totaal = $totaal + $totaalprijsproduct;
}
}
echo "</table>";
echo "Betaald : ";
if($result['betaalddatum'] == "0000-00-00")
echo "Nog niet betaald";
else
echo $result['betaalddatum'];


echo "<div style=\"float:right;\">Totaal : &euro;".number_format($totaal, 2, ',', '.')."</div>\n";
echo "<div style=\"clear:both;visibility:hidden;\">.</div>\n";
echo 'klant gegevens : <a href="?page=klantenzoeken&id='.$result['klantnr'].'">Klik hier</a>';
echo "</div>";
}
}else{
echo "Er zijn geen facturen op ".$_GET['date'];
}
?>


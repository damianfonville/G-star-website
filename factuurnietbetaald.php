<h1>niet betaalde facturen</h1>
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
$sth = $db->prepare("SELECT * FROM factuur, klanten WHERE klanten.klantnr = factuur.klantnr and betaalddatum = '0000-00-00' ORDER BY datum DESC");
$sth->execute();
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

?>



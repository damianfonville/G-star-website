<h1>Uitverkochte Artikelen</h1>
<div class="alleartikelen">
<?php
// alle producten
$query = $db->prepare("SELECT * FROM artikel WHERE voorraad = 0");
$query->execute();
while($result = $query->fetch(PDO::FETCH_ASSOC)){
echo "<div class=\"artikel\"><h3>".$result['naam']." (".$result['type'].")</h3>";
echo "<h2>&euro; ".number_format($result['prijs'], 2, ',', '.')."</h2>";
echo "<div style=\"height:20px;width:20px;background:".$result['kleur'].";\"title=\"".$result['kleur']."\"></div>";
echo nl2br($result['beschrijving']);
echo "</div>";
}

?>

</div>

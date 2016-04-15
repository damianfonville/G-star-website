
<h1>Artikelen</h1>
<div class="alleartikelen">
<?php
// alle producten
try{
$query = $db->prepare("SELECT * FROM artikel ORDER BY type");
$query->execute();
while($result = $query->fetch(PDO::FETCH_ASSOC)){
$prijs = number_format($result['prijs'], 2, ',', '.');
$prijs = explode(",", $prijs);
echo "<div class=\"artikel\">";
echo "<h3>".$result['naam']." (".$result['type'].")";
if($result['voorraad'] == 0)
echo "   UITVERKOCHT!!!";
echo"</h3>";
echo "<h2><span class=\"euro\">&euro;</span>".$prijs[0].",<sup>".$prijs[1]."</sup></h2>";
echo "<div class=\"color\" style=\"background:".$result['kleur'].";\" title=\"".$result['kleur']."\"></div>";
echo nl2br($result['beschrijving']);
echo "</div>";
}
}
catch(PDOException $e){
echo "line: ".$e->getLine()."<br/>";
echo "file: ".$e->getFile()."<br/>";
echo "message: ".$e->getMessage()."<br/>";
}
?>

</div>
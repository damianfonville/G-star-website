 <link rel="stylesheet" href="http://andreaslagerkvist.com/aFramework/Modules/Base/jquery.liveSearch.css">
<script src="http://andreaslagerkvist.com/aFramework/Modules/Base/jquery.liveSearch.js"></script>
<script>
$(function(){
$('.naam').liveSearch({url: 'zoekartikel.php?q='});
});
</script>
<h1>Artikelen zoeken</h1>
<table>
<form method="get" action="" id="form">
<tr><td>Artikelnaam :</td><td><input style="width:250px;" type="text" name="search" class="naam" /></td></tr>
<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
</form>
</table>

<?php
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM artikel where artikelnummer = ?");
$query->bindValue(1, $_GET['id'], PDO::PARAM_STR);
$query->execute();
echo '<div class="alleartikelen">';
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

}elseif(isset($_GET['search'])){
$search = trim($_GET['search']);
$query2 = $db->prepare("SELECT * FROM artikel WHERE naam LIKE ?");
$query2->bindValue(1, "%".$search."%", PDO::PARAM_STR);
$query2->execute();
$count = $query2->rowCount();
if($count != 1){
echo "<h2>".$count." resultaten gevonden</h2>";
}else{
echo "<h2>1 resultaat gevonden</h2>";
}
echo '<div class="alleartikelen">';
while($result = $query2->fetch(PDO::FETCH_ASSOC)){
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
?>
</div>


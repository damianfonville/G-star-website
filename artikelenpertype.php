<script>
 $(function() {
 document.getElementById('select').selectedIndex = -1;

$("#select").change(function(){
$("#form").submit();
});
});
</script>
<h1>Artikelen per type</h1>
<form method="get" action="" id="form">
type: <label>
<?php
echo'<select name="type" id="select">';


$list = $db->prepare("SELECT type FROM artikel GROUP BY type");
$list->execute();
while($result = $list->fetch(PDO::FETCH_ASSOC)){
  echo'<option value="'.$result['type'].'">'.$result['type'].'</option>';
}

echo "</select>";

?>
</label>
<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
</form>
<br/>
<div class="alleartikelen">
<?php
if(isset($_GET['type'])){

// productenper type
$query = $db->prepare("SELECT * FROM artikel WHERE type = ?");
$query->bindValue(1, $_GET['type'], PDO::PARAM_STR);
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

}else{
// alle producten
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

?>

</div>

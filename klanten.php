<h1>Klanten</h1>
<div class="alleartikelen">
<?php
try{
$sth = $db->prepare("SELECT * FROM klanten");
$sth->execute();
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
if($result['nieuwsbrief'] == 0){
$nieuwsbrief = "Nee";
}elseif($result['nieuwsbrief'] == 1){
$nieuwsbrief = "Ja";
}else{
$nieuwsbrief = "Error";
}
echo "<div class=\"artikel\"><h3>".$result['vnaam']." ".$result['anaam']."</h3>";
echo "<table>
<tr>
<td>Klantnummer:</td><td>".$result['klantnr']."</td>
</tr>
<tr>
<td>Naam:</td><td>".$result['vnaam']." ".$result['anaam']."</td>
</tr>
<tr>
<td>Adres:</td><td>".$result['adres']."</td>
</tr>
<tr>
<td>Postcode:</td><td>".$result['postcode']."</td>
</tr> 
<tr>
<td>Woonplaats:</td><td>".$result['stad']."</td>
</tr> 
<tr>
<td>Telefoonnr.:</td><td>".$result['telnr']."</td>
</tr> 
<tr>
<td>Email:</td><td>".$result['email']."</td>
</tr> 
<tr>
<td>Nieuwsbrief:</td><td>".$nieuwsbrief."</td>
</tr> 
<tr>
<td>Alle facturen:</td><td><a href=\"?page=factuurperklant&id=".$result['klantnr']."\">Klik hier!</a></td>
</tr> 
</table>
</div>";
}
}
catch(PDOException $e){
echo "line: ".$e->getLine()."<br/>";
echo "file: ".$e->getFile()."<br/>";
echo "message: ".$e->getMessage()."<br/>";
}
?>
</div>

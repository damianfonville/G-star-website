 <link rel="stylesheet" href="http://andreaslagerkvist.com/aFramework/Modules/Base/jquery.liveSearch.css">
<script src="http://andreaslagerkvist.com/aFramework/Modules/Base/jquery.liveSearch.js"></script>
<script>
$(function(){
$('.vnaam').liveSearch({url: 'zoekklanten.php?search=vnaam&q='});
$('.anaam').liveSearch({url: 'zoekklanten.php?search=anaam&q='});
$('.klantnr').liveSearch({url: 'zoekklanten.php?search=klantnr&q='});
$('.postcode').liveSearch({url: 'zoekklanten.php?search=postcode&q='});
});
</script>
<div>
<h1>Klant zoeken</h1>
<table>
<tr><td>Klantnummer :</td><td><input type="text" class="klantnr" /></td></tr>
<tr><td>Voornaam : </td><td><input type="text" class="vnaam" /></td></tr>
<tr><td>Achternaam : </td><td><input type="text" class="anaam" /></td></tr>
<tr><td>Postcode : </td><td><input type="text" class="postcode" /></td></tr>
</table>
<br />
<hr />
<br />
<?php
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM klanten where klantnr = ?");
$query->bindValue(1, $_GET['id'], PDO::PARAM_STR);
$query->execute();
while($result = $query->fetch(PDO::FETCH_ASSOC)){
if($result['nieuwsbrief'] == 0){
$nieuwsbrief = "Nee";
}elseif($result['nieuwsbrief'] == 1){
$nieuwsbrief = "Ja";
}else{
$nieuwsbrief = "Error";
}
echo "<table>
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
</table>";
}

}
?>



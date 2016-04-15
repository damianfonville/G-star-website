<?php
include("config.php");

$q=$_GET["q"];

$hint="";
try{
$query = $db->prepare("SELECT * FROM artikel WHERE naam LIKE ? LIMIT 5");
$query->bindValue(1, "%$q%", PDO::PARAM_STR);
$query->execute();
while($result = $query->fetch(PDO::FETCH_ASSOC)){
      if ($hint=="")
        {
        $hint="<a href='?page=zoeken&id=" .
        $result['artikelnummer'] .
        "' >" .
        $result['naam'] . "</a>";
        }
      else
        {
        $hint.= "<hr /><a href='?page=zoeken&id=" .
        $result['artikelnummer'] .
        "' >" .
        $result['naam'] . "</a>";
        }
      }
    
  }
  catch(PDOException $e){
echo "line: ".$e->getLine()."<br/>";
echo "file: ".$e->getFile()."<br/>";
echo "message: ".$e->getMessage()."<br/>";
}



if ($hint=="")
  {
  $response="niets gevonden";
  }
else
  {
  $response=$hint;
  }

echo $response;
?> 
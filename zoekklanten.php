<?php
include("config.php");

$q = $_GET["q"];
$search = mysql_real_escape_string($_GET['search']);

$hint = "";
try{
$query = $db->prepare("SELECT * FROM klanten WHERE $search LIKE ? LIMIT 5");
$query->bindValue(1, "$q%", PDO::PARAM_STR);
$query->execute();
while($result = $query->fetch(PDO::FETCH_ASSOC)){
      if ($hint=="")
        {
        $hint.="<a href='?page=klantenzoeken&id=" .
        $result['klantnr'] .
        "' >" .
        $result['vnaam'] ."  ". $result['anaam'] . "</a>";
        }
      else
        {
        $hint.= "<hr /><a href='?page=klantenzoeken&id=" .
        $result['klantnr'] .
        "' >" .
        $result['vnaam'] ."  ". $result['anaam'] . "</a>";
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

echo mysql_error();
echo $response;
?> 
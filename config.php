<?php

try{
$db = new PDO('mysql:host=127.0.0.1;dbname=gstar;charset=utf8','root','fonville');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query("SET SESSION sql_mode='ANSI,ONLY_FULL_GROUP_BY'");

}
catch(PDOException $e){
echo "line: ".$e->getLine()."<br/>";
echo "file: ".$e->getFile()."<br/>";
echo "message: ".$e->getMessage()."<br/>";
}
?>
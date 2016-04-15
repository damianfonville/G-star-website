<?php

include("config.php");

$dbname = 'gstar';

function rows($table){
$result = mysql_query("SELECT * FROM {$table}");

$fields_num = mysql_num_fields($result);

$return =  "<ul>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    $return .= "<li>{$field->name}</li>";
}
$return .= "</ul>\n";
return $return;

}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit();
}

while ($row = mysql_fetch_row($result)) {
    echo "tabel: {$row[0]}<br />\n";
echo rows($row[0]);
echo "<hr />";
}
mysql_free_result($result);

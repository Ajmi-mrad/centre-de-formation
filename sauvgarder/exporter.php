<?php
// require_once '../db/conn.php';
$mysqlDatabaseName ='centre_inf';
$mysqlUserName ='root';
$mysqlPassword ='';
$mysqlHostName ='127.0.0.1';
$mysqlExportPath ='safe.sql';


$command='C:\\xampp\\mysql\\bin\\mysqldump.exe --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath;

exec($command,$output,$worked);
// print_r($worked);
// print_r($output);
// print_r($command);
switch($worked){
case 0:
echo 'La base de données <b>' .$mysqlDatabaseName .'</b> a été stockée avec succès dans le chemin suivant '.getcwd().'\\' .$mysqlExportPath .'</b>';
break;
case 1:
echo 'Une erreur s est produite lors de la exportation de <b>' .$mysqlDatabaseName .'</b> vers'.getcwd().'\\' .$mysqlExportPath .'</b>';
break;
case 2:
echo 'Une erreur d exportation s est produite, veuillez vérifier les informations suivantes : <br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
break;
}
?>
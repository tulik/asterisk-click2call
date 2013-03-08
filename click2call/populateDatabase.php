<?php
/**********************************************************************************/
/***************!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*************************/
/***************NEVER ENABLE TO EXECUTE THIS IN PRODUCTION*************************/
/***************!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*************************/
/**********************************************************************************/


$startNum = 6050;
$endNum = 6199;
databaseConnector::connect("localhost", "root", "c3xa9w", "asterisk");
for ($i = $startNum; $i <= $endNum; $i++) {
    $dbConnector->query("INSERT INTO `asterisk`.`phoneNumbersTable` (`IdPhoneNumbers` ,`numberHash` ,`number`) VALUES ( NULL , '', $i);");
}
?>
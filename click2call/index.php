<?php 
error_reporting(E_ALL);

require_once '../_dataBase/dataBaseConnector.class.php';
require_once './Dialer.class.php';
$Dialer = new Dialer();
$databaseConnector = new databaseConnector();
$databaseConnector->connect("192.168.130.128", "root", "c3xa9w", "asterisk");

$databaseConnector->query("select number from phoneNumbersTable where numberHash = \"");
echo "to ja, twoj plik<br />";
echo "....to caly czas ja<br />";
echo "nadal dzialam!";

?>
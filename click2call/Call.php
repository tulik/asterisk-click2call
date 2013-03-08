<?php
error_reporting(E_ALL);
require_once '../_dataBase/dataBaseConnector.class.php';
require_once './Dialer.class.php';
$Dialer = new Dialer();
$databaseConnector = new databaseConnector();
$databaseConnector->connect("localhost", "root", "c3xa9w", "asterisk");

$from = null;
$to = null;
if (isset($_GET['to']) && isset($_GET['from'])) {
    $hash = $_GET['to'];
    $callTo = $databaseConnector->query("select number from phoneNumbersTable where numberHash = \"" . $hash . "\"");
  
    $to =$callTo;
    echo $callTo;
//    $to = "sip:" . $to . "@192.168.1.135";
//    $from = $_GET['from'];
//    $from = "sip:" . $from . "@192.168.1.135";
//  
//    try {
//
//        $Dialer = new dialer();
//        $Dialer->from = $from;
//        $Dialer->to = $to;
//
//        $Dialer->makeCall($from, $to);
//    } catch (Exception $e) {
//
//        echo "Opps... Caught exception:";
//        echo $e;
//    }
//} else {
//    echo "Error: variables not set.";
//}
//

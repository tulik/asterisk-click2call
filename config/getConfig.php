<?php

header('Content-Type: text/xml; charset=utf-8');


    if (isset($_GET['user_id'])) {
        databaseConnector::connect("asterisk.toxic-software.pl", "root", "c3xa9w", "asterisk");
        $server = $_SERVER['SERVER_ADDR'];
        $username = '6111';
        $password = 'proxyad';
        $phone = '6111';
        $mailbox = '6111';
        $red5 = "rtmp://" . $server . "sip";
        $sipRealm = '6111';
        $sipServer = $server;
        $user_number = 'e3b80d30a727c738f3cff0941f6bc55a';



    }


echo <<< KONIEC

<config>
    <username>$username</username>
    <password>$password</password>
    <phone>$phone</phone>
    <mailbox>$mailbox</mailbox>
    <red5Url>$red5</red5Url>
    <sipRealm>$sipRealm</sipRealm>
    <sipServer>$sipServer</sipServer>
    <user_number>$user_number</user_number>
</config>
   
KONIEC;

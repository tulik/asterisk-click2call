<?php

function exec_get_output($command) {
    $output = null;
    exec($command, $output);
    return implode("\n", $output);
}

if (isset($_GET['user'])) {

    $user = $_GET['user'];
    $peers = exec_get_output("bin/sip-show-peers");

//Find user
    $matches = null;
    preg_match_all("/([0-9a-z]*)(\/[0-9a-z]*)?[ ]*(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}|[0-9a-z\/]*[ ]*\(Unspecified\))/", $peers, $matches);

    $names = $matches[1];
    $ipAddresses = $matches[3];

    header('Content-Type: text/xml; charset=utf-8');
    echo "<status>";
    if (($index = array_search($user, $names)) === false) {
        //User was not found
        echo "<notfound>true</notfound>";
        echo "<loggedoff>false</loggedoff>";
        echo "<available>false</available>";
        echo "<busy>false</busy>";

        //echo "status=notFound";
    } else if ($ipAddresses[$index] == '(Unspecified)') {
        //User is not logged in
        echo "<notfound>false</notfound>";
        echo "<loggedoff>true</loggedoff>";
        echo "<available>false</available>";
        echo "<busy>false</busy>";
    } else {

        //Get current calls
        $channels = exec_get_output("bin/sip-show-channels");

        //Find requested user
        $matches2 = null;
        preg_match("*" . $user . "*", $channels, $matches2);

        if ($matches2[0] == $user) {
            //User is on the phone
            echo "<notfound>false</notfound>";
            echo "<loggedoff>false</loggedoff>";
            echo "<available>false</available>";
            echo "<busy>true</busy>";
        } else {
            //User is available
            echo "<notfound>false</notfound>";
            echo "<loggedoff>false</loggedoff>";
            echo "<available>true</available>";
            echo "<busy>false</busy>";
        }
    }
} else {
    echo "Error: variables not set.";
}
echo "</status>";
?>

<?php

/**
 * Description of clickToCall
 *
 * @author lukasz
 */
class Dialer {

    var $from = null;
    var $to = null;

    public function makeCall($from, $to) {
        require '../config/ConfigClass.php';
        require_once 'PhpSip.class.php';
        echo "Trying call from $from to $to \n";

        flush();

        try {
            $api = new PhpSIP(ConfigClass::HOST);
            $api->setDebug(true);
            $api->addHeader('Subject: click2call');
            $api->setMethod('INVITE');
            $api->setFrom('sip:c2c@' . $api->getSrcIp());
            $api->setUri($from);
            $res = $api->send();

            if ($res == 200) {
                $api->setMethod('REFER');
                $api->addHeader('Refer-to: ' . $to);
                $api->addHeader('Referred-By: sip:c2c@' . $api->getSrcIp());
                $api->send();

                $api->setMethod('BYE');
                $api->send();

                $api->listen('NOTIFY');
                $api->reply(481, 'Call Leg/Transaction Does Not Exist');
            }

            if ($res == 'No final response in 5 seconds.') {
                $api->setMethod('CANCEL');
                $res = $api->send();
            }

            echo $res;
        } catch (Exception $e) {

            echo "Opps... Caught exception:";
            echo $e;
        }
    }

}

?>
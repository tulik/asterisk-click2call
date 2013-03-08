<?php

abstract class databaseConnector {

    var $Conn = null;
    var $ConnectionID = null;
    var $Host = null;
    var $User = null;
    private $Password = null;
    var $Database = null;
    var $QueryCount = 0;
    var $Error = null;
    var $LastQuery = null;
    var $Link = null;
    
    function connect($host, $user, $password, $database) {
        $id = $_GET['id'];
        
        $link = mysqli_init();
        $this->Host = $host;
        $this->User = $user;
        $this->Password = $password;
        $this->Database = $database;
        //$this->ConnectionID = md5($link, $host . $user . $password . $database);

        if (!$link) {
            die('mysqli_init failed');
        }
        if (!$link->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
            die('Settings MYSQLI_INIT_COMMAND failed');
        }
        if (!$link->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
            die("Setting MYSQLI_OPT_CONNECT_TIMEOUT failed");
        }
        if (!$link->real_connect($host, $user, $password, $database)) {
            die('Connect Error(' . mysqli_errno($link) . ') ' . mysqli_connect_error());
        }
 
        $this->Link =$link;
//    if(!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMIT = 0')){
//        die('Settings MYSQLI_')
//    }
//$this->Conn=  mysqli_real_connect($link, $host, $user, $password, $database, $port='');
//    $this->Link = $link;
//    echo $link;
//    $this->Conn = mysql_connect($host, $user, $password);
//    mysql_select_db($database, $this->Conn);
    }

    function query($query) {

        $this->QueryCount++;
        $link = $this->Link;
//   $q = mysql_query($sql);
//   $this->Error = mysql_error();
        $q = $link->query($query);
        $this->LastQuery = $query;
        return $q;
    }

    function rowCount($rset) {

        $rows = mysql_num_rows($rset);

        return $rows;
    }

    function getResults($rset) {

//  return mysql_fetch_object($rset);
    }

    function mysqlEvaluate($rset) {

        if ($this->rowCount($rset)) {
//          return mysql_result($rset, 0);
        } else {
            return null;
        }
    }

    function getNumber($hash) {
//      $q = $this->query("SELECT * FROM phoneNumbersTable WHERE hashNumber = ". $hash);
//      mysqlEvaluate($q);
    }

}
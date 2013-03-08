<?php

/**
 * @author lukasz
 * @version 1.0
 * @created 20-sty-2013 20:07:50
 */
class DataBase {

    static private $Server = 'localhost';
    static private $Username = 'tulik13';
    static private $Password = ';SR;x3dQj8o';
    static private $Database_name = 'tulik13';
    static private $Link = null;
    static $Result_array = "";
    public $Row_Count = null;
    function __construct() {
        self::DataBaseCon();
    }

    static protected function DataBaseCon() {
        $server = self::$Server;
        $username = self::$Username;
        $password = self::$Password;
        $database_name = self::$Database_name;

        $link = mysqli_init();

        if (!$link) {
            throw new Exception('mysqli_init failed');
        }
        if (!$link->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
            throw new Exception('Settings MYSQLI_INIT_COMMAND failed');
        }
        if (!$link->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
            throw new Exception("Setting MYSQLI_OPT_CONNECT_TIMEOUT failed");
        }
        if (!$link->real_connect($server, $username, $password, $database_name)) {
            throw new Exception('Connect Error(' . mysqli_errno($link) . ') ' . mysqli_connect_error());
        }

        self::$Link = $link;
    }

    public function select($query) {
        $link = self::$Link;
        $result = $link->query($query);
        if (!$result)
            throw new Exception('Failed to execute select query! ');
        if ($result) {
            while ($row = $result->fetch_array()) {
                $result_array[] = $row;
            }
            if (self::$Link->close())
                $this->Result_array = $result_array;
        }
       $result->close();
    }

    public function insert($query) {
        $link = self::$Link;
        $result = $link->query($query);
        if (!$result) {
            throw new Exception('Failed to execute insert query! ');
        }
       
    }

    public function getRowCount($query) {
        $link = self::$Link;
        //$stmt = $link->prepare($query);
        if ($stmt = $link->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $this->Row_Count = $stmt->num_rows;
            $stmt->close();
        }else{
            throw new Exception('Failed to execute row counter! ');
        }
    }

}

//test
//$test = new BazaDanych();
//$test->select("SELECT * FROM harmonogram_linkowania");
//   foreach ($test->Result_array as $row){
//       print_r($row);
//   }
?>
